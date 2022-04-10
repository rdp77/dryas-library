<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book\BookshelfDetail;
use Illuminate\Http\Request;

class BookshelfDetailController extends Controller
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
        $data = BookshelfDetail::with('m_rak_buku_dt')->get();
        $data = BookshelfDetail::get();
        return view('backend_view.master.rak_buku.rak_buku_index', compact('data'));
    }

    public function store(Request $req)
    {
        $validasi = $this->validate($req, [
            'kode_dt' => 'required',
        ]);
        $id = BookshelfDetail::max('mrbd_dt') + 1;
        $id = BookshelfDetail::max('mrbd_id') + 1;
        if ($validasi == true) {
            BookshelfDetail::create([
                'mrbd_dt' => $id,
                'mrbd_id' => 'mrb_id',
                'mrbd_kode' => $req->kode_dt,
            ]);
            return Response()->json(['status' => 'sukses']);
        } else {
            return Response()->json(['status' => 'gagal']);
        }
    }
}