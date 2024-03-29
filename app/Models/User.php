<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'name', 'password', 'id', 'previleges', 'kode',
        'address_univ', 'address', 'tlp', 'photo', 'registration_kode',
        'username', 'fakultas', 'jurusan', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fakultasuser()
    {
        return $this->belongsTo('App\Models\Faculty', 'fakultas', 'mf_id');
    }
    public function jurusanuser()
    {
        return $this->belongsTo('App\Models\Major', 'jurusan', 'mj_id');
    }
    public function hak_akses()
    {
        return $this->belongsTo('App\Models\Previleges', 'previleges', 'mp_id');
    }
    public function peminjaman_anggota()
    {
        return $this->hasMany('App\peminjaman', 'tpj_anggota', 'id');
    }
    public function peminjaman_staff()
    {
        return $this->hasMany('App\peminjaman', 'tpj_staff', 'id');
    }
    public function created_by()
    {
        return $this->hasMany('App\buku', 'mb_created_by', 'id');
    }
}