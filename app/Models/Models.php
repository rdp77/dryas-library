<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\fakultas;
use App\Models\jurusan;
use App\Models\previleges;
use App\Models\penerbit;
use App\Models\pengarang;
use App\Models\kategori;
use App\Models\buku;
use App\Models\buku_dt;
use App\Models\rak_buku;
use App\Models\peminjaman;
use App\Models\peminjaman_dt;
use App\Models\pengembalian;
use App\Models\pengembalian_dt;
use App\Models\rak_buku_dt;
use App\Models\log;

class Models extends model
{
  public function user()
  {
    $user = new User();

    return $user;
  }

  public function fakultas()
  {
    $fakultas = new fakultas();

    return $fakultas;
  }

  public function previleges()
  {
    $previleges = new previleges();

    return $previleges;
  }

  public function buku()
  {
    $buku = new buku();

    return $buku;
  }
  public function buku_dt()
  {
    $buku_dt = new buku_dt();

    return $buku_dt;
  }

  public function buku_katalog()
  {
    $buku_katalog = new buku_katalog();

    return $buku_katalog;
  }

  public function penerbit()
  {
    $penerbit = new penerbit();

    return $penerbit;
  }
  public function pengarang()
  {
    $pengarang = new pengarang();

    return $pengarang;
  }
  public function kategori()
  {
    $kategori = new kategori();

    return $kategori;
  }
  public function jurusan()
  {
    $jurusan = new jurusan();

    return $jurusan;
  }
  public function rak_buku()
  {
    $rak_buku = new rak_buku();

    return $rak_buku;
  }
  public function rak_buku_dt()
  {
    $rak_buku_dt = new rak_buku_dt();

    return $rak_buku_dt;
  }
  public function peminjaman()
  {
    $peminjaman = new peminjaman();

    return $peminjaman;
  }
  public function peminjaman_dt()
  {
    $peminjaman_dt = new peminjaman_dt();

    return $peminjaman_dt;
  }
  public function pengembalian()
  {
    $pengembalian = new pengembalian();

    return $pengembalian;
  }
  public function pengembalian_dt()
  {
    $pengembalian_dt = new pengembalian_dt();

    return $pengembalian_dt;
  }
  public function log()
  {
    $log = new log();

    return $log;
  }
}
