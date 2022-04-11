<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book\BookAuthor;
use Illuminate\Http\Request;

class BookAuthorController extends Controller
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
        $data = BookAuthor::all();
        return view('pages.backend.data.book.author.indexAuthor', compact('data'));
    }

    public function create()
    {
        return view('pages.backend.data.book.author.createAuthor');
    }

    public function store(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
            'alamat' => 'required',
            'tlp' => 'required',
        ]);
        $id = BookAuthor::max('mpg_id') + 1;
        if ($validasi == true) {
            BookAuthor::create([
                'mpg_id' => $id,
                'mpg_name' => $req->name,
                'mpg_alamat' => $req->alamat,
                'mpg_tlp' => $req->tlp,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }

    public function edit(Request $req)
    {
        $data = BookAuthor::where('mpg_id', $req->id)->first();
        return view('pages.backend.data.book.author.editAuthor', compact('data'));
    }

    public function update(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
            'alamat' => 'required',
            'tlp' => 'required',
        ]);
        if ($validasi == true) {
            BookAuthor::where('mpg_id', $req->id)->update([
                'mpg_name' => $req->name,
                'mpg_alamat' => $req->alamat,
                'mpg_tlp' => $req->tlp,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }

    public function destroy(Request $req)
    {
        BookAuthor::where('mpg_id', $req->id)->delete();
        return redirect()->back();
    }

    public function show()
    {
        //
    }
}