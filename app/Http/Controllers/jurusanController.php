<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models;

class jurusanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $model;

    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new models();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->model->jurusan()->get();

        return view('backend_view.master.jurusan.jurusan_index', compact('data'));
    }
    public function create()
    {
        $kode = $this->kodejr();
        $fakultas = $this->model->fakultas()->get();
        return view('backend_view.master.jurusan.jurusan_create', compact('kode', 'fakultas'));
    }
    public function save(Request $req)
    {
        $validasi = $this->validate($req, [
            'kode' => 'required',
            'name' => 'required',
            'fakultas' => 'required',
        ]);
        $id = $this->model->jurusan()->max('mj_id') + 1;
        if ($validasi == true) {
            $this->model->jurusan()->create([
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
        $data = $this->model->jurusan()->where('mj_id', $req->id)->first();
        $fakultass = $this->model->fakultas()->get();
        return view('backend_view.master.jurusan.jurusan_edit', compact('data', 'fakultass'));
    }
    public function update(Request $req)
    {
        $validasi = $this->validate($req, [
            'kode' => 'required',
            'name' => 'required',
            'fakultas' => 'required',
        ]);
        if ($validasi == true) {
            $this->model->jurusan()->where('mj_id', $req->id)->update([
                'mj_kode' => $req->kode,
                'mj_name' => $req->name,
                'mj_fakultas' => $req->fakultas,
            ]);
            return Response()->json(['status' => 'sukses']);
        } else {
            return Response()->json(['status' => 'gagal']);
        }
    }
    public function hapus(Request $req)
    {
        $this->model->jurusan()->where('mj_id', $req->id)->delete();
        return redirect()->back();
    }
    public function kodejr()
    {
        $id = $this->model->jurusan()->max('mj_id') + 1;
        $date = date('m') . date('y');
        $kode = 'JS/' . $date . '/' . str_pad($id, 5, '0', STR_PAD_LEFT);
        return $kode;
    }
}
