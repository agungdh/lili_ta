<?php
namespace application\classes;

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\User as User_model;
use application\eloquents\Kendaraan as Kendaraan_model;
use application\eloquents\Transaksi as Transaksi_model;

class Helper extends \agungdh\Pustaka
{

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

	public static function jumlahKendaraansBelumBayarSampaiSaatIniPerPemilikKendaraan($id_pemilik_kendaraan)
	{
		$data = self::kendaraansBelumBayarSampaiSaatIniPerPemilikKendaraan($id_pemilik_kendaraan);

		$newData = [];

		$newData['count'] = count($data);
		$newData['total'] = 0;

		foreach ($data as $item) {
			$newData['total'] += $item;
		}

		return $newData;
	}

	public static function kendaraansBelumBayarSampaiSaatIniPerPemilikKendaraan($id_pemilik_kendaraan)
	{
		$lowestYear = Kendaraan_model::where('id_pemilik_kendaraan', $id_pemilik_kendaraan)->orderBy('mulai_penagihan_tahun', 'ASC')->limit(1)->first();
		$lowestMonth = Kendaraan_model::where('id_pemilik_kendaraan', $id_pemilik_kendaraan)->orderBy('mulai_penagihan_bulan', 'ASC')->limit(1)->first();

		if($lowestYear && $lowestMonth) {
			$lowestYear = $lowestYear->mulai_penagihan_tahun;
			$lowestMonth = $lowestMonth->mulai_penagihan_bulan;

			$bulansForLooping = [];
			$bulanLoop = date('m');
			$tahunLoop = date('Y');
			$i = 0;
			do {
				$bulan = explode('-', date("m-Y", strtotime("-" . $i . " months")))[0];
				$tahun = explode('-', date("m-Y", strtotime("-" . $i . " months")))[1];	

				$bulanLoop = $bulan;
				$tahunLoop = $tahun;

				$bulansForLooping[] = [$bulan, $tahun];

				$i++;
			} while ($bulanLoop != $lowestMonth || $tahunLoop != $lowestYear);

			$newDatas = [];

			$kendaraansID_raw = Kendaraan_model::where('id_pemilik_kendaraan', $id_pemilik_kendaraan)->get();

			$kendaraansID = [];
			foreach ($kendaraansID_raw as $item) {
				$kendaraansID[] = $item->id;
				$newDatas[$item->id] = 0;
			}

			$datas = [];

			foreach ($bulansForLooping as $item) {
				$datas[] = helper()->kendaraanBelumBayarPerBulanPerPemilikKendaraan($item[0], $item[1], $id_pemilik_kendaraan, false);
			}

			foreach ($datas as $item) {
				foreach ($kendaraansID as $item2) {
					if (in_array($item2, $item)) {
						$newDatas[$item2]++;
					}
				}
			}
			// return compact(['datas', 'bulansForLooping', 'newDatas', 'kendaraansID']);
			return array_diff($newDatas, [0]);
		} else {
			return [];
		}
	}

	public static function belumBayar($bulan, $tahun)
	{
		$kendaraansID_raw = Kendaraan_model::select('id')->where('mulai_penagihan_bulan', '<=', $bulan)->where('mulai_penagihan_tahun', '<=', $tahun)->get();

		$kendaraansID = [];
		foreach ($kendaraansID_raw as $item) {
			$kendaraansID[] = $item->id;
		}

		$transaksis = Transaksi_model::whereIn('id_kendaraan', $kendaraansID)->where('bulan', $bulan)->where('tahun', $tahun)->count();

		return count($kendaraansID) - $transaksis;
	}

	public static function kendaraanBelumBayarPerBulanPerPemilikKendaraan($bulan, $tahun, $id_pemilik_kendaraan, $kendaraanInstance = true)
	{
		$kendaraansID_raw = Kendaraan_model::select('id')->where('mulai_penagihan_bulan', '<=', $bulan)->where('mulai_penagihan_tahun', '<=', $tahun)->where('id_pemilik_kendaraan', $id_pemilik_kendaraan)->get();

		$kendaraansID = [];
		foreach ($kendaraansID_raw as $item) {
			$kendaraansID[] = $item->id;
		}

		$kendaraansIDSudahBayars_raw = Transaksi_model::whereIn('id_kendaraan', $kendaraansID)->where('bulan', $bulan)->where('tahun', $tahun)->get();

		$kendaraansIDSudahBayars = [];
		foreach ($kendaraansIDSudahBayars_raw as $item) {
			$kendaraansIDSudahBayars[] = $item->id_kendaraan;
		}

		$IDKendaraanBelumBayars = array_values(array_diff( $kendaraansID, $kendaraansIDSudahBayars));

		$kendaraanBelumBayars = Kendaraan_model::whereIn('id', $IDKendaraanBelumBayars)->get();

		return $kendaraanInstance ? $kendaraanBelumBayars : $IDKendaraanBelumBayars;
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