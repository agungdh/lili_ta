<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Transaksi extends Eloquent {
    protected $table = "transaksi";
    public $timestamps = false;

    public function kendaraan(){
        return $this->belongsTo('application\eloquents\Kendaraan', 'id_kendaraan');
    }

    public function loket(){
        return $this->belongsTo('application\eloquents\Loket', 'id_loket');
    }

    public function karyawan(){
        return $this->belongsTo('application\eloquents\Karyawan', 'nik', 'nik');
    }
}