<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Transaksi extends Eloquent {
    protected $table = "transaksi";
    public $timestamps = false;
}