<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Kendaraan extends Eloquent {
    protected $table = "kendaraan";
    public $timestamps = false;

    public function pemilikKendaraan(){
        return $this->belongsTo('application\eloquents\PemilikKendaraan', 'id_pemilik_kendaraan');
    }

    public function formulaTarif(){
        return $this->belongsTo('application\eloquents\FormulaTarif', 'id_formula_tarif');
    }
}