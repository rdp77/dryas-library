<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book\BookPublisher;
use Illuminate\Http\Request;

class BookPublisherController extends Controller
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
        $data = BookPublisher::get();
        return view('backend_view.master.penerbit.penerbit_index', compact('data'));
    }

    public function create()
    {
        return view('backend_view.master.penerbit.penerbit_create');
    }

    public function store(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
            'alamat' => 'required',
            'tlp' => 'required',
        ]);
        $id = BookPublisher::max('mpn_id') + 1;
        if ($validasi == true) {
            BookPublisher::create([
                'mpn_id' => $id,
                'mpn_name' => $req->name,
                'mpn_alamat' => $req->alamat,
                'mpn_tlp' => $req->tlp,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }

    public function edit(Request $req)
    {
        $data = BookPublisher::where('mpn_id', $req->id)->first();
        return view('backend_view.master.penerbit.penerbit_edit', compact('data'));
    }

    public function update(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
            'alamat' => 'required',
            'tlp' => 'required',
        ]);
        if ($validasi == true) {
            BookPublisher::where('mpn_id', $req->id)->update([
                'mpn_name' => $req->name,
                'mpn_alamat' => $req->alamat,
                'mpn_tlp' => $req->tlp,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }

    public function destroy(Request $req)
    {
        BookPublisher::where('mpn_id', $req->id)->delete();
        return redirect()->back();
    }
}