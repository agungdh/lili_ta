<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Kendaraan extends Eloquent {
    protected $table = "kendaraan";
    public $timestamps = false;
}