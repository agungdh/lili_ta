<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Log extends Eloquent {
    protected $table = "log";
    public $timestamps = false;

    public function pemilikKendaraan(){
        return $this->belongsTo('application\eloquents\PemilikKendaraan', 'req_id_pemilik_kendaraan');
    }
}