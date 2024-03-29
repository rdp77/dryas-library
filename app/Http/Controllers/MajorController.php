<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
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
        $data = Major::get();

        return view('pages.backend.data.user.major.indexMajor', compact('data'));
    }

    public function create()
    {
        $kode = $this->kodejr();
        $fakultas = $this->model->fakultas()->get();
        return view('pages.backend.data.user.major.createMajor', compact('kode', 'fakultas'));
    }

    public function store(Request $req)
    {
        $validasi = $this->validate($req, [
            'kode' => 'required',
            'name' => 'required',
            'fakultas' => 'required',
        ]);
        $id = Major::max('mj_id') + 1;
        if ($validasi == true) {
            Major::create([
                'mj_id' => $id,
                'mj_kode' => $req->kode,
                'mj_name' => $req->name,
                'mj_fakultas' => $req->fakultas,
            ]);
            return Response()->json(['status' => 'sukses']);
        } else {
            return Response()->json(['status' => 'gagal']);
        }
    }

    public function edit(Request $req)
    {
        $data = Major::where('mj_id', $req->id)->first();
        $fakultass = $this->model->fakultas()->get();
        return view('pages.backend.data.user.major.editMajor', compact('data', 'fakultass'));
    }

    public function update(Request $req)
    {
        $validasi = $this->validate($req, [
            'kode' => 'required',
            'name' => 'required',
            'fakultas' => 'required',
        ]);
        if ($validasi == true) {
            Major::where('mj_id', $req->id)->update([
                'mj_kode' => $req->kode,
                'mj_name' => $req->name,
                'mj_fakultas' => $req->fakultas,
            ]);
            return Response()->json(['status' => 'sukses']);
        } else {
            return Response()->json(['status' => 'gagal']);
        }
    }

    public function destroy(Request $req)
    {
        Major::where('mj_id', $req->id)->delete();
        return redirect()->back();
    }

    public function kodejr()
    {
        $id = Major::max('mj_id') + 1;
        $date = date('m') . date('y');
        $kode = 'JS/' . $date . '/' . str_pad($id, 5, '0', STR_PAD_LEFT);
        return $kode;
    }

    public function show($id)
    {
        //
    }
}