<?php
namespace application\classes;

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\User as User_model;
use application\eloquents\Kendaraan as Kendaraan_model;
use application\eloquents\Transaksi as Transaksi_model;

class Helper extends \agungdh\Pustaka
{

	public function jumlahBelumBayar($id_pemilik_kendaraan)
	{
		$kendaraans = Kendaraan_model::where('id_pemilik_kendaraan', $id_pemilik_kendaraan)->get();

		$kendaraanJadi = [];
		$kendaraanJadi['total'] = 0;
		$kendaraanJadi['jumlah'] = 0;
		foreach($kendaraans as $item) {
		    $detailKendaraan = self::detilBulanTahunKendaraanBelumBayar($item->id);
		    if(count($detailKendaraan['bulanTahunBelumBayar']) > 0) {
	        	$kendaraanJadi['total'] += count($detailKendaraan['bulanTahunBelumBayar']);
	        	$kendaraanJadi['jumlah']++;
		    }
	    }

	    return $kendaraanJadi;
	}

	public function detilBulanTahunKendaraanBelumBayar($id_kendaraan)
	{
		$kendaraan = Kendaraan_model::find($id_kendaraan);

		$bulanLoop = date('m');
		$tahunLoop = date('Y');
		$i = 0;
		$bulanTahunSudahBayar = [];
		$bulanTahunBelumBayar = [];
		$bulansForLooping = [];
		do {
			$bulan = explode('-', date("m-Y", strtotime("-" . $i . " months")))[0];
			$tahun = explode('-', date("m-Y", strtotime("-" . $i . " months")))[1];	

			$bulanLoop = $bulan;
			$tahunLoop = $tahun;

			$bulansForLooping[] = [$bulan, $tahun];

			$transaksiTemp = Transaksi_model::where('id_kendaraan', $id_kendaraan)->where('bulan', $bulan)->where('tahun', $tahun)->first();

			if($transaksiTemp) {
				$bulanTahunSudahBayar[] = [$bulan, $tahun];
			} else {
				$bulanTahunBelumBayar[] = [$bulan, $tahun];
			}

			$i++;
		} while ($bulanLoop != $kendaraan->mulai_penagihan_bulan || $tahunLoop != $kendaraan->mulai_penagihan_tahun);

		return compact(['kendaraan', 'bulansForLooping', 'bulanTahunBelumBayar', 'bulanTahunSudahBayar']);
	}

	public static function bulanIndonesia()
	{
		return [
	        '1' => 'Januari',
	        '2' => 'Februari',
	        '3' => 'Maret',
	        '4' => 'April',
	        '5' => 'Mei',
	        '6' => 'Juni',
	        '7' => 'Juli',
	        '8' => 'Agustus',
	        '9' => 'September',
	        '10' => 'Oktober',
	        '11' => 'November',
	        '12' => 'Desember',
		];
	}

	public static function getKonfigurasi()
	{
		$temp = DB::table('konfigurasi')->get();

		$newVar = [];
		foreach ($temp as $item) {
			$newVar[$item->konfigurasi] = $item->value;
		}

		return $newVar;
	}

	public static function cekKuotaSms()
	{
		$config = helper()->getKonfigurasi();

		return json_decode(
			json_encode(
				simplexml_load_string(
					file_get_contents(
						"http://reguler.zenziva.net/apps/smsapibalance.php?userkey="
						. $config['ZENZIVA_API_USER'] 
						. "&passkey=" 
						. $config['ZENZIVA_API_PASS']
					)
				)
			)
		);
	}

	public static function bootEloquent() {
		$db = new DB;

		$db->addConnection([
			"driver"    => "mysql",
			"host" => 'localhost',
			"database" => 'lili_ta',
			"username" => 'root',
			"password" => '',
		]);

		$db->setAsGlobal();
		$db->bootEloquent();
	}
}