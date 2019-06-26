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
				self::textBelumBayarPerPemilikKendaraan(),
				self::dataBelumBayar(),
			]
		);
	}

	public function textBelumBayarPerPemilikKendaraan()
	{
		$belumBayarsPerPemilik = [];
		foreach (PemilikKendaraan_model::all() as $item) {
			$belumBayarsPerPemilik[$item->id] = helper()->jumlahBelumBayar($item->id);

			if ($belumBayarsPerPemilik[$item->id]['jumlah'] == 0) {
				unset($belumBayarsPerPemilik[$item->id]);
			}			
		}

		$datas = [];
		foreach ($belumBayarsPerPemilik as $key => $value) {
			$datas[$key] = helper()->textKePemilik($key);	
		}

		return compact(['datas']);
	}

	public function dataBelumBayar()
	{
		$belumBayarsPerPemilik = [];
		foreach (PemilikKendaraan_model::all() as $item) {
			$belumBayarsPerPemilik[$item->id] = helper()->jumlahBelumBayar($item->id);

			if ($belumBayarsPerPemilik[$item->id]['jumlah'] == 0) {
				unset($belumBayarsPerPemilik[$item->id]);
			}
		}

		$belumBayars = [];
		$belumBayars['total'] = 0;
		$belumBayars['jumlah'] = 0;
		foreach ($belumBayarsPerPemilik as $item) {
			$belumBayars['total'] += $item['total'];
			$belumBayars['jumlah'] += $item['jumlah'];
		}

		return compact(['belumBayarsPerPemilik', 'belumBayars']);
	}
}
