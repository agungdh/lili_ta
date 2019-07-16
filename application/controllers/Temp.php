<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

use application\eloquents\Kendaraan as Kendaraan_model;
use application\eloquents\Transaksi as Transaksi_model;
use application\eloquents\PemilikKendaraan as PemilikKendaraan_model;

class Temp extends CI_Controller {
	public function index()
	{
		dd(
			[
				helper()->textBelumBayarPerPemilikKendaraan(),
				helper()->dataBelumBayar(),
			]
		);
	}

}