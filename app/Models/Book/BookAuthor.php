<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
  protected $table = 'm_pengarang';
  protected $primaryKey = 'mpg_id';
  public $remember_token = false;
  public $timestamps = false;
  const UPDATED_AT = 'updated_at';
  const CREATED_AT = 'created_at';

  protected $fillable = [
    'mpg_id',
    'mpg_name',
    'mpg_alamat',
    'mpg_tlp',
  ];

  public function getDateFormat()
  {
    return 'Y-m-d H:i:s';
  }
  public function buku()
  {
    return $this->hasMany('App\buku', 'mb_pengarang', 'mpg_id');
  }
  public function buku_katalog()
  {
    return $this->hasMany('App\buku_katalog', 'mb_pengarang', 'mpg_id');
  }
}