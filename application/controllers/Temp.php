<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

use application\eloquents\PemilikKendaraan as PemilikKendaraan_model;

class Temp extends CI_Controller {
	public function index()
	{
		$jumlahBelumBayar1 = helper()->jumlahBelumBayar(1);

		$jumlahBelumBayar2 = [];
		$jumlahBelumBayar2['total'] = 0;
		$jumlahBelumBayar2['jumlah'] = 0;
		$jumlahBelumBayar2['kendaraan'] = [];
		foreach (PemilikKendaraan_model::all() as $pemilikKendaraan) {
			$belumBayar = helper()->jumlahBelumBayar($pemilikKendaraan->id);
			$jumlahBelumBayar2['total'] += $belumBayar['total'];
			$jumlahBelumBayar2['jumlah'] += $belumBayar['jumlah'];
			
			foreach ($belumBayar['kendaraan'] as $kendaraan) {
				array_push($jumlahBelumBayar2['kendaraan'], $kendaraan);
			}
		}

		dd(compact([
			'jumlahBelumBayar1',
			'jumlahBelumBayar2',
		]));
	}

}