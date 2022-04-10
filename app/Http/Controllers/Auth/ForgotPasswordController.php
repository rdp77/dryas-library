<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Auth::user()->username == null ?
            redirect()->route('profile_index')->with(['status' => 'Pastikan sudah mengisi semua data diri']) :
            view('backend_view.master.user.profile.profile_forgot');
    }

    public function changepassword(Request $req)
    {
        $validasi = $this->validate($req, [
            'reg' => 'required',
            'email' => 'required',
            'kode' => 'required',
            'username' => 'required',
            'password' => ['required', 'min:8'],
        ]);

        if ($validasi == true) {
            if (Auth::user()->username != $req->username) {
                return Response()->json(['status' => 'gagal']);
            } else {
                User::where('id', $req->id)->update([
                    'registration_kode' => $req->reg,
                    'email' => $req->email,
                    'kode' => $req->kode,
                    'username' => $req->username,
                    'password' => Hash::make($req->password),
                ]);
                return Response()->json(['status' => 'sukses']);
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}