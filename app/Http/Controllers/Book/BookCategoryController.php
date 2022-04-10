<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
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
        $data = BookCategory::all();
        return view('backend_view.master.kategori.kategori_index', compact('data'));
    }

    public function create()
    {
        return view('backend_view.master.kategori.kategori_create');
    }

    public function store(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
        ]);
        $id = BookCategory::max('mk_id') + 1;
        if ($validasi == true) {
            BookCategory::create([
                'mk_id' => $id,
                'mk_name' => $req->name,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }

    public function edit(Request $req)
    {
        $data = BookCategory::where('mk_id', $req->id)->first();
        return view('backend_view.master.kategori.kategori_edit', compact('data'));
    }

    public function update(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
        ]);
        if ($validasi == true) {
            BookCategory::where('mk_id', $req->id)->update([
                'mk_name' => $req->name,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }

    public function destroy(Request $req)
    {
        $data = BookCategory::where('mk_id', $req->id)->delete();
        return redirect()->back();
    }
}