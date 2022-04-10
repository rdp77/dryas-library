<?php

namespace App\Http\Controllers;

use App\Models\Previleges;
use Illuminate\Http\Request;

class PrevilegesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Previleges::get();
        return view('backend_view.master.previleges.previleges_index', compact('data'));
    }
    public function create()
    {
        return view('backend_view.master.previleges.previleges_create');
    }
    public function store(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
        ]);
        $id = Previleges::max('mp_id') + 1;
        if ($validasi == true) {
            Previleges::create([
                'mp_id' => $id,
                'mp_name' => $req->name,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }
    public function edit(Request $req)
    {
        $data = Previleges::where('mp_id', $req->id)->first();
        return view('backend_view.master.previleges.previleges_edit', compact('data'));
    }
    public function update(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
        ]);
        if ($validasi == true) {
            Previleges::where('mp_id', $req->id)->update([
                'mp_name' => $req->name,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }
    public function destroy(Request $req)
    {
        Previleges::where('mp_id', $req->id)->delete();
        return redirect()->back();
    }
}