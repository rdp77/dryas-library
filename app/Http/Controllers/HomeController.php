<?php

namespace App\Http\Controllers;

use App\Models\Book\BookDetail;
use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
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
        // $log = Log::limit(7)
        //     ->orderBy('log_id', 'desc')
        //     ->get();
        $users = User::count();
        // $logCount = Log::where('u_id', Auth::user()->id)
        //     ->count();
        $idcard = $this->calculateid();
        $pengembalian = $this->calculatepengembalian();
        $total_user = User::where('previleges', '!=', '1')
            ->count();
        $total_buku = BookDetail::count();
        $total_buku_dipinjam = BookDetail::where('mbdt_status', 'TERPINJAM')
            ->count();
        $total_buku_terpinjam = Log::where('log_feature', 'PEMINJAMAN')
            ->where('log_action', 'CREATE')
            ->count();
        return view('pages.backend.dashboard', [
            'total_user' => $total_user,
            'total_buku' => $total_buku,
            'total_buku_dipinjam' => $total_buku_dipinjam,
            'total_buku_terpinjam' => $total_buku_terpinjam,
            'idcard' => $idcard,
            'pengembalian' => $pengembalian,
            // 'log' => $log,
        ]);
    }

    public function calculateid()
    {
        $dateid = strtotime("+1 month", strtotime(Auth::user()->updated_at));
        $dateuser = strtotime(date("Y-m-d H:i:s"));
        $date = floor(($dateid - $dateuser) / 60 / 60 / 24);
        if ($date <= 30) {
            return 'Hallo ' . Auth::user()->name .
                ' masa berlaku ID Card Anda kurang dari ' . $date .
                ' hari, silahkan melakukan perpanjangan.';
        }
    }

    public function calculatepengembalian()
    {
        $date = date("Y-m-d");
        $data =  DB::table('m_buku_dt')->join('t_peminjaman_dt', 'm_buku_dt.mbdt_isbn', '=', 't_peminjaman_dt.tpjdt_isbn')
            ->join('t_peminjaman', 't_peminjaman_dt.tpjdt_id', '=', 't_peminjaman.tpj_id')
            ->where([
                ['mbdt_status', '=', 'TERPINJAM'],
                ['tpj_anggota', '=', Auth::user()->id]
            ])->first();
        if ($data != null) {
            $kembali = strtotime($data->tpj_date_kembali);
            $tempo = date('Y-m-d', strtotime($data->tpj_date_tempo . ' +1 week'));
            $datekembali = floor(($kembali - strtotime($date)) / 60 / 60 / 24);
            if ($datekembali <= 7) {
                return 'Buku yang Anda pinjam kurang dari ' . $datekembali .
                    ' hari, segera lakukan pengembalian sebelum tanggal ' . $data->tpj_date_tempo;
            } elseif ($date <= $tempo) {
                return 'Buku yang Anda pinjam telah melewati tanggal tempo ' . $data->tpj_date_tempo .
                    ' dimohon segera mengembalikan buku yang anda pinjam dan membayar denda.';
            }
        }
    }

    public function log(Request $req)
    {
        // if ($req->ajax()) {
        //     $data = Log::where('u_id', Auth::user()->id)
        //         ->get();
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('added_at', function ($row) {
        //             return date("d-M-Y H:m", strtotime($row->added_at));
        //         })
        //         ->rawColumns(['added_at'])
        //         ->make(true);
        // }
        // return view('pages.backend.log.IndexLog');
    }
}