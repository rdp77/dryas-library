<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Major;
use App\Models\Previleges;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $data = User::where('previleges', '!=', '1')
            ->with('hak_akses', 'fakultasuser')
            ->get();
        $datas = User::where('previleges', '=', '1')
            ->get();
        return view('pages.backend.data.user.indexUser', [
            'data' => $data,
            'datas' => $datas
        ]);
    }

    public function create()
    {
        $previlege = Previleges::all();
        $fakultas = Faculty::all();
        $jurusan = Major::all();
        return view('pages.backend.data.user.createUser', compact('previlege', 'fakultas', 'jurusan'));
    }

    public function save(Request $req)
    {
        $id = User::max('id') + 1;
        $validasi = $this->validate($req, [
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'previleges' => 'required',
            'address' => 'required',
            'addressuniv' => 'required',
            'reg' => 'required',
            'tlp' => 'required',
            'username' => 'required',
        ]);
        // if ($req->fakultas = '' && $req->jurusan = '') {
        //     $req->fakultas = null;
        //     $req->jurusan = null;
        // }
        $req->previleges == '1' ? $kode = $this->kodeadm()
            : ($req->previleges == '2'
                ? $kode =  $this->kodedsn()
                :  $kode =  $this->kodemhs());
        if ($validasi == true) {
            User::create([
                'id' => $id,
                'name' => $req->name,
                'email' => $req->email,
                'password' => Hash::make($req->password),
                'previleges' => $req->previleges,
                'kode' => $kode,
                'address' => $req->address,
                'address_univ' => $req->addressuniv,
                'registration_kode' => $req->reg,
                'tlp' => $req->tlp,
                'username' => $req->username,
                'photo' => 'default.svg',
                'fakultas' => $req->fakultas,
                'jurusan' => $req->jurusan,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s", strtotime("+4 years")),
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }

    public function edit(Request $req)
    {
        $data = User::where('id', $req->id)->first();
        $previlege = $this->model->previleges()->get();
        $fakultas = $this->model->fakultas()->get();
        $jurusan = $this->model->jurusan()->get();
        return view('pages.backend.data.user.editUser', compact('data', 'previlege', 'fakultas', 'jurusan'));
    }

    public function update(Request $req)
    {
        $validasi = $this->validate($req, [
            'name' => 'required',
            'email' => ['required', 'email'],
            'previleges' => 'required',
            'addressuniv' => 'required',
            'address' => 'required',
            'tlp' => 'required',
            'reg' => 'required',
            'username' => 'required',
        ]);
        // if ($req->fakultas = '- Pilih Fakultas -' && $req->jurusan = '- Pilih Fakultas -') {
        //     $req->fakultas = null;
        //     $req->jurusan = null;
        // }
        $req->previleges == '1' ? $kode = $this->kodeadm()
            : ($req->previleges == '2'
                ? $kode =  $this->kodedsn()
                :  $kode =  $this->kodemhs());
        if ($validasi == true) {
            User::where('id', $req->id)->update([
                'name' => $req->name,
                'email' => $req->email,
                'previleges' => $req->previleges,
                'kode' => $kode,
                'address_univ' => $req->addressuniv,
                'address' => $req->address,
                'tlp' => $req->tlp,
                'registration_kode' => $req->reg,
                'username' => $req->username,
                'fakultas' => $req->fakultas,
                'jurusan' => $req->jurusan,
            ]);
            return Response()->json(['status' => 'sukses']);
        }
    }

    public function hapus(Request $req)
    {
        DB::table('users')->where('id', $req->id)->delete();
        return redirect()->back();
    }

    public function extends(Request $req)
    {
        $users = DB::table('users')::table('users')->where('id', $req->id);
        $userdate = $users->first()->updated_at;
        $newdate = date("Y-m-d H:i:s", strtotime("+4 years", strtotime($userdate)));
        $users->update(['updated_at' => $newdate]);
        return redirect()->back();
    }

    public function kodemhs()
    {
        $count = User::where('kode', 'like', 'MHS%')->count();
        $date = date("ym");
        $newcount = str_pad($count + 1, 5, '0', STR_PAD_LEFT);
        $kode = 'MHS/' . $date . "/" . $newcount;
        return $kode;
    }

    public function kodedsn()
    {
        $count = User::where('kode', 'like', 'DSN%')->count();
        $date = date("ym");
        $newcount = str_pad($count + 1, 5, '0', STR_PAD_LEFT);
        $kode = 'DSN/' . $date . "/" . $newcount;
        return $kode;
    }

    public function kodeadm()
    {
        $count = User::where('kode', 'like', 'ADM%')->count();
        $date = date("ym");
        $newcount = str_pad($count + 1, 5, '0', STR_PAD_LEFT);
        $kode = 'ADM/' . $date . "/" . $newcount;
        return $kode;
    }

    public function useraktif()
    {
        $yearnow = date("Y");
        $peminjaman =  $this->model->log()->where([
            ['log_created_at', 'like', $yearnow . '%'],
            ['log_user', 'like', Auth::user()->id],
            ['log_feature', 'like', 'PEMINJAMAN']
        ])->count();
        if ($peminjaman >= 10) {
            return 'A';
        } else {
            return 'T';
        }
    }

    public function show($id)
    {
        //
    }
}