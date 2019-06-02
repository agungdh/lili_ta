<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class PemilikKendaraan extends Eloquent {
    protected $table = "pemilik_kendaraan";
    public $timestamps = false;
}