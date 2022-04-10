<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Log;
use App\Models\Major;
use App\Models\Previleges;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
        $data = User::get();
        $user_aktif = $this->checkActiveUser();
        return view('pages.backend.data.user.profile.indexProfile', compact('data', 'user_aktif'));
    }

    public function profileedit(Request $req)
    {
        $data = User::where('id', $req->id)->first();
        $fakultas = $this->model->fakultas()->get();
        $jurusan = $this->model->jurusan()->get();
        return view('backend_view.master.user.profile.profile_edit', compact('data', 'fakultas', 'jurusan'));
    }

    public function profileupdate(Request $req)
    {
        $validasi = $this->validate($req, [
            'photo' => 'image|mimes:jpeg,png,jpg,svg|max:2000',
            'name' => 'required',
            'email' => ['required', 'email'],
            'address' => 'required',
            'tlp' => 'required',
            'reg' => 'required',
            'username' => 'required',
        ]);
        if ($req->hasFile('photo')) {
            $imagePath = $req->file('photo');
            $fileName =  $req->id . '.' . $imagePath->getClientOriginalExtension();
            $imagePath->move(public_path('storage/user'), $fileName);
        } else {
            $fileName =  'default.svg';
        }
        if ($validasi == true) {
            User::where('id', $req->id)->update([
                'photo' => $fileName,
                'name' => $req->name,
                'email' => $req->email,
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

    public function profileprint()
    {
        if (Auth::user()->username == null) {
            return redirect()->route('profile_index')->with(['status' => 'Pastikan sudah mengisi semua data diri']);
        } else {
            $pdf = PDF::loadView('backend_view.master.user.profile.profile_print');
            return $pdf->stream("ID Card " . Auth::user()->name . ".pdf", array("Attachment" => 0));
        }
    }

    public function checkActiveUser()
    {
        $yearnow = date("Y");
        $peminjaman = Log::where([
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
}