<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class BookshelfDetail extends Model
{
  protected $table = 'm_rak_buku_dt';
  protected $primaryKey = 'mrbd_id';
  public $remember_token = false;
  public $timestamps = false;
  const UPDATED_AT = 'updated_at';
  const CREATED_AT = 'created_at';

  protected $fillable = [
    'mrbd_dt',
    'mrbd_id',
    'mrbd_kode',
  ];

  public function getDateFormat()
  {
    return 'Y-m-d H:i:s';
  }
  public function rak_buku()
  {
    return $this->belongsTo('App\rak_buku', 'mrbd_id', 'mrb_id');
  }
  public function buku()
  {
    return $this->hasMany('App\buku', 'mrbd_dt', 'mrbd_id');
  }
}