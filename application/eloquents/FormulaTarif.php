<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class FormulaTarif extends Eloquent {
    protected $table = "formula_tarif";
    public $timestamps = false;
}