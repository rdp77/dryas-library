<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
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
        $data = Faculty::get();

        return view('pages.backend.data.user.faculty.indexFaculty', compact('data'));
    }

    public function create()
    {
        $kode = $this->kodefk();
        return view('pages.backend.data.user.faculty.createFaculty', compact('kode'));
    }

    public function store(Request $req)
    {
        $validasi = $this->validate($req, [
            'kode' => 'required',
            'name' => 'required',
        ]);
        $id = Faculty::max('mf_id') + 1;
        if ($validasi == true) {
            Faculty::create([
                'mf_id' => $id,
                'mf_kode' => $req->kode,
                'mf_name' => $req->name,
            ]);
            return Response()->json(['status' => 'sukses']);
        } else {
            return Response()->json(['status' => 'gagal']);
        }
    }

    public function edit(Request $req)
    {
        $data = Faculty::where('mf_id', $req->id)->first();
        return view('pages.backend.data.user.faculty.editFaculty', compact('data'));
    }

    public function update(Request $req)
    {
        $validasi = $this->validate($req, [
            'kode' => 'required',
            'name' => 'required',
        ]);
        if ($validasi == true) {
            Faculty::where('mf_id', $req->id)->update([
                'mf_kode' => $req->kode,
                'mf_name' => $req->name,
            ]);
            return Response()->json(['status' => 'sukses']);
        } else {
            return Response()->json(['status' => 'gagal']);
        }
    }

    public function destroy(Request $req)
    {
        Faculty::where('mf_id', $req->id)->delete();
        return redirect()->back();
    }

    public function kodefk()
    {
        $id = Faculty::max('mf_id') + 1;
        $date = date('m') . date('y');
        $kode = 'FK/' . $date . '/' . str_pad($id, 5, '0', STR_PAD_LEFT);
        return $kode;
    }

    public function show($id)
    {
        //
    }
}