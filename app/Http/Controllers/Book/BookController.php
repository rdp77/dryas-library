<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
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
        $data = Book::all();
        return view('pages.backend.data.book.indexBook', compact('data'));
    }

    public function create()
    {
        $id = Book::max('mb_id') + 1;
        $date = date('m') . date('y');
        $kode = 'BK/' . $date . '/' . str_pad($id, 5, '0', STR_PAD_LEFT);
        $kategoris = $this->model->kategori()->get();
        $penerbits = $this->model->penerbit()->get();
        $pengarangs = $this->model->pengarang()->get();
        $rak_bukus = $this->model->rak_buku_dt()->get();
        return view(
            'pages.backend.data.book.createBook',
            compact('kategoris', 'rak_bukus', 'penerbits', 'pengarangs', 'kode')
        );
    }

    public function store(Request $req)
    {
        // return filesize($req->file('gambar'));
        DB::beginTransaction();
        try {
            // dd($req->all());
            $id = Book::max('mb_id') + 1;
            if (filesize($req->file('gambar')) > 2000000) {
                return Response()->json(['status' => 'big_image']);
            } elseif ($req->hasFile('gambar')) {
                $imagePath = $req->file('gambar');
                // $fileName =  '/public/buku/buku_' . $id . '.' . $imagePath->getClientOriginalExtension();
                $fileNames =  'buku_' . $id . '.' . $imagePath->getClientOriginalExtension();
                // Storage::put($fileName, file_get_contents($req->file('gambar')));
                $imagePath->move(public_path('storage/buku'), $fileNames);
            } else {
                $fileNames = 'default.svg';
            }

            Book::create([
                'mb_id' => $id,
                'mb_kode' => $req->kode,
                'mb_kategori' => $req->kategori,
                'mb_penerbit' => $req->penerbit,
                'mb_pengarang' => $req->pengarang,
                'mb_created_by' => Auth::user()->id,
                'mb_created_at' => date('Y-m-d H:i:s'),
                'mb_name' => $req->name,
                'mb_image' => $fileNames,
                'mb_desc' => $req->desc,
                'mb_pinjam' => $req->pinjam,
            ]);
            for ($i = 0; $i < count($req->isbn); $i++) {
                $this->model->buku_dt()->create([
                    'mbdt_id'  => $id,
                    'mbdt_dt'  => $i + 1,
                    'mbdt_isbn' => $req->isbn[$i],
                    'mbdt_status' => $req->status[$i],
                    'mbdt_rak_buku_dt' => $req->kode_rak_dt[$i],
                    'mbdt_kondisi' => $req->kondisi[$i],
                ]);
            }
            DB::commit();

            return Response()->json(['status' => 'sukses']);

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return Response()->json(['status' => 'error']);
        }
    }

    public function edit(Request $req)
    {
        $data = Book::with('buku_dt')->where('mb_id', $req->id)->first();
        $kategoris = $this->model->kategori()->get();
        $penerbits = $this->model->penerbit()->get();
        $pengarangs = $this->model->pengarang()->get();
        $rak_bukus = $this->model->rak_buku_dt()->get();
        return view(
            'pages.backend.data.book.editBook',
            compact('kategoris', 'rak_bukus', 'penerbits', 'pengarangs', 'data')
        );
    }

    public function update(Request $req)
    {
        // dd($req->all());
        DB::beginTransaction();
        try {
            // if ($req->hasFile('gambar')) {
            //     if (filesize($req->file('gambar')) > 2000000) {
            //         return Response()->json(['status' => 'big_image']);
            //     } else {
            //         $imagePath = $req->file('gambar');
            //         $fileName =  '/public/buku/buku_' . $req->id . '.' . $imagePath->getClientOriginalExtension();
            //         $fileNames =  'buku_' . $req->id . '.' . $imagePath->getClientOriginalExtension();
            //         Storage::put($fileName, file_get_contents($req->file('gambar')));
            //     }
            // } else {
            //     $fileName = $req->gambar_old;
            // }
            if (filesize($req->file('gambar')) > 2000000) {
                return Response()->json(['status' => 'big_image']);
            } elseif ($req->hasFile('gambar')) {
                $imagePath = $req->file('gambar');
                // $fileName =  '/public/buku/buku_' . $id . '.' . $imagePath->getClientOriginalExtension();
                $fileNames =  'buku_' . $req->id . '.' . $imagePath->getClientOriginalExtension();
                // Storage::put($fileName, file_get_contents($req->file('gambar')));
                $imagePath->move(public_path('storage/buku'), $fileNames);
            } else {
                $fileNames = 'default.svg';
            }

            Book::where('mb_id', $req->id)->update([
                'mb_kategori' => $req->kategori,
                'mb_penerbit' => $req->penerbit,
                'mb_pengarang' => $req->pengarang,
                'mb_created_by' => Auth::user()->id,
                'mb_created_at' => date('Y-m-d H:i:s'),
                'mb_name' => $req->name,
                'mb_image' => $fileNames,
                'mb_desc' => $req->desc,
                'mb_pinjam' => $req->pinjam,
            ]);
            for ($i = 0; $i < count($req->isbn); $i++) {
                $this->model->buku_dt()->where('mbdt_status', 'TERSEDIA')->where('mbdt_id', $req->id)->delete();
            }
            for ($i = 0; $i < count($req->isbn); $i++) {
                if ($req->status[$i] == 'TERSEDIA') {
                    $dt = $this->model->buku_dt()->where('mbdt_id', $req->id)->max('mbdt_dt') + 1;
                    $this->model->buku_dt()->create([
                        'mbdt_id'  => $req->id,
                        'mbdt_dt'  => $dt,
                        'mbdt_isbn' => $req->isbn[$i],
                        'mbdt_status' => $req->status[$i],
                        'mbdt_rak_buku_dt' => $req->kode_rak_dt[$i],
                        'mbdt_kondisi' => $req->kondisi[$i],
                    ]);
                }
            }
            DB::commit();

            return Response()->json(['status' => 'sukses']);

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return Response()->json(['status' => 'error']);
        }
    }

    public function destroy(Request $req)
    {
        $dt = $this->model->buku_dt()->where('mbdt_id', $req->id)->get();
        $d = 0;
        for ($i = 0; $i < count($dt); $i++) {
            if ($dt[$i]->mbdt_status == 'TERPINJAM') {
                $d += 1;
            }
        }
        return $d;
        Book::where('mb_id', $req->id)->delete();
        $this->model->buku_dt()->where('mbdt_id', $req->id)->delete();
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }
}