<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class BookLoanDetail extends Model
{
  protected $table = 't_peminjaman_dt';
  protected $primaryKey = 'tpjdt_id';
  public $remember_token = false;
  public $timestamps = false;
  const UPDATED_AT = 'updated_at';
  const CREATED_AT = 'created_at';

  protected $fillable = [
    'tpjdt_id',
    'tpjdt_dt',
    'tpjdt_isbn',
  ];

  public function getDateFormat()
  {
    return 'Y-m-d H:i:s';
  }
  public function peminjaman()
  {
    return $this->belongsTo('App\peminjaman', 'tpj_id', 'tpjdt_id');
  }
  public function buku_dt()
  {
    return $this->belongsTo('App\buku_dt', 'tpjdt_isbn', 'mbdt_isbn');
  }
}