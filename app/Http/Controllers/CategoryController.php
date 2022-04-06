<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Category::all();
        return view('backend_view.master.kategori.kategori_index', compact('data'));
    }
    public function create()
    {
        return view('backend_view.master.kategori.kategori_create');
    }
    public function save(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
        ]);
        $id = $this->model->kategori()->max('mk_id') + 1;
        if ($validasi == true) {
            $this->model->kategori()->create([
                'mk_id' => $id,
                'mk_name' => $req->name,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }
    public function edit(Request $req)
    {
        $data = $this->model->kategori()->where('mk_id', $req->id)->first();
        return view('backend_view.master.kategori.kategori_edit', compact('data'));
    }
    public function update(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
        ]);
        if ($validasi == true) {
            $this->model->kategori()->where('mk_id', $req->id)->update([
                'mk_name' => $req->name,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }
    public function hapus(Request $req)
    {
        $data = $this->model->kategori()->where('mk_id', $req->id)->delete();
        return redirect()->back();
    }
}