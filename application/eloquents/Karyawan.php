<?php
namespace application\eloquents;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Karyawan extends Eloquent {
    protected $table = "karyawan";
    public $timestamps = false;
    protected $primaryKey = 'nik';
    public $incrementing = false;

    public function user(){
    	return $this->hasOne('application\eloquents\User', 'nik', 'nik');
    }
}