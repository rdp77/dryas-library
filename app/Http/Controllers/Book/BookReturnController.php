<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book\BookReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookReturnController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware(['auth', 'roles'])->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = BookReturn::with([
            'pengembalian_dt', 'pengembalian_dt.buku_dt', 'pengembalian_dt.buku_dt.buku'
        ])->get();
        return view('pages.backend.transaction.return.indexBookReturn', compact('data'));
    }

    public function create()
    {
        $id = BookReturn::max('tpg_id') + 1;
        $date = date('m') . date('y');
        $kode = 'PG/' . $date . '/' . str_pad($id, 5, '0', STR_PAD_LEFT);
        $peminjaman = $this->model->peminjaman()->DoesntHave('pengembalian')->with('peminjaman_anggota')->get();
        return view('pages.backend.transaction.return.createBookReturn', compact('kode', 'peminjaman'));
    }

    public function get_data_peminjaman(Request $req)
    {
        $peminjaman = $this->model->peminjaman()->where('tpj_id', $req->id_peminjaman)->with(['peminjaman_anggota', 'peminjaman_dt', 'peminjaman_dt.buku_dt', 'peminjaman_dt.buku_dt.buku'])->first();

        return Response()->json(['status' => 'sukses', 'hasil' => $peminjaman]);
    }

    public function get_data_pengembalian(Request $req)
    {
        $data = BookReturn::with(['pengembalian_anggota', 'pengembalian_dt', 'pengembalian_dt.buku_dt', 'pengembalian_dt.buku_dt.buku'])->where('tpg_peminjaman', $req->id_peminjaman)->first();

        return Response()->json(['status' => 'sukses', 'hasil' => $data]);
    }

    public function store(Request $req)
    {

        DB::beginTransaction();
        try {
            $total_unique = array_unique($req->isbn);

            $id = BookReturn::max('tpg_id') + 1;
            BookReturn::create([
                'tpg_id' => $id,
                'tpg_kode' => $req->kode,
                'tpg_peminjaman' => $req->kode_pinjam,
                'tpg_anggota' => $req->peminjam_id,
                'tpg_staff' => Auth::user()->id,
                'tpg_date_pinjam' => $req->tgl_pinjam,
                'tpg_date_kembali' => date('Y-m-d', strtotime($req->tgl_kembali)),
                'tpg_created_by' => Auth::user()->username,
                'tpg_created_at' => date('Y-m-d'),
                'tpg_date_tempo' => $req->tgl_tempo,
            ]);
            for ($i = 0; $i < count($req->isbn); $i++) {
                $dt = $this->model->pengembalian_dt()->max('tpgdt_id') + 1;
                $this->model->pengembalian_dt()->create([
                    'tpgdt_id'  => $id,
                    'tpgdt_dt'  => $dt,
                    'tpgdt_isbn' => $req->isbn[$i],
                    'tpgdt_kondisi' => $req->kondisi[$i],
                ]);

                $this->model->buku_dt()->where('mbdt_isbn', $req->isbn[$i])->update([
                    'mbdt_status' => 'TERSEDIA',
                    'mbdt_kondisi' => $req->kondisi[$i],
                ]);

                $log_id = $this->model->log()->max('log_id') + 1;
                $this->model->log()->create([
                    'log_id' => $log_id,
                    'log_name' => 'pengembalian BUKU ATAS ISBN = ' . $req->isbn[$i],
                    'log_kode' => $req->isbn[$i],
                    'log_feature' => 'pengembalian',
                    'log_action' => 'CREATE',
                    'log_created_by' => Auth::user()->id,
                    'log_user' => $req->peminjam_id,
                    'log_created_at' => date('Y-m-d h:i:s'),
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
        $data = BookReturn::with(['pengembalian_dt', 'pengembalian_dt.buku_dt', 'pengembalian_dt.buku_dt.buku'])->where('tpg_id', $req->id)->first();
        $data_ex = BookReturn::select('tpg_peminjaman')->where('tpg_id', '!=', $data->tpg_peminjaman)->get();
        $dt_ex = [];
        for ($i = 0; $i < count($data_ex); $i++) {
            $dt_ex[] = $data_ex[$i]->tpg_peminjaman;
        }
        $peminjaman = $this->model->peminjaman()
            ->whereHas('pengembalian', function ($query) use ($data) {
                $query->where('tpg_peminjaman', $data->tpg_peminjaman);
            })->with('peminjaman_anggota')->get();

        $user = $this->model->user()->get();
        $buku = $this->model->buku_dt()
            ->where('mbdt_status', 'TERSEDIA')
            ->with(['buku' => function ($q) {
                return $q->where('mb_pinjam', 'YA');
            }])
            ->get();
        return view('pages.backend.transaction.return.editBookReturn', compact('data', 'user', 'buku', 'peminjaman'));
    }

    public function update(Request $req)
    {
        DB::beginTransaction();
        try {
            BookReturn::where('tpg_id', $req->id)->update([
                'tpg_date_kembali' => date('Y-m-d', strtotime($req->tgl_kembali)),
            ]);
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
        return $pengembalian = BookReturn::where('tpg_id', $req->id)->get();
        $pengembalian_dt = $this->model->pengembalian_dt()->where('tpgdt_id', $req->id)->get();

        // for ($i=0; $i <count($pengembalian_dt) ; $i++) { 
        //     $detail[$i] = $this->model->buku_dt()->where('mbdt_isbn',$pengembalian_dt[$i]->tpjdt_isbn)
        //         ->update([
        //             'mbdt_status'=>'TERSEDIA',
        //         ]);
        // }

        $peminjaman_dt = BookReturn::where('tpg_id', $pengembalian->tpg_peminjaman)->get();
        $pengembalian_dt = $this->model->pengembalian_dt()->where('tpgdt_id', $pengembalian->tpg_peminjaman)->get();


        $data = BookReturn::where('tpj_id', $req->id)->delete();
        $data = $this->model->pengembalian_dt()->where('tpjdt_id', $req->id)->delete();
        return redirect()->back();
    }
}