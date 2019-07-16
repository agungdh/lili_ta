<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\PemilikKendaraan as PemilikKendaraan_model;

class Cek extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function nohp($nohp)
	{
		$pemilikKendaraan = PemilikKendaraan_model::where('nohp', $nohp)->first();
		
		if ($pemilikKendaraan) {
			return blade('cek.index', compact(['pemilikKendaraan']));
		} else {
			echo 'Hello, World!';
		}
	}
}
