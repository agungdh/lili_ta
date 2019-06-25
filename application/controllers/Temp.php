<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

use application\eloquents\Kendaraan as Kendaraan_model;

class Temp extends CI_Controller {
	public function index()
	{
		$test = helper()->kendaraansBelumBayarSampaiSaatIniPerPemilikKendaraan(2);

		dd($test);
	}
}
