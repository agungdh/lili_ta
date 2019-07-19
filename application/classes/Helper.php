<?php
namespace application\classes;

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\User as User_model;
use application\eloquents\Kendaraan as Kendaraan_model;
use application\eloquents\Transaksi as Transaksi_model;
use application\eloquents\PemilikKendaraan as PemilikKendaraan_model;

class Helper extends \agungdh\Pustaka
{

	public static function textKePemilik($id_pemilik_kendaraan)
	{
		$pemilikKendaraan = PemilikKendaraan_model::findOrFail($id_pemilik_kendaraan);

		$belumBayar = self::jumlahBelumBayar($id_pemilik_kendaraan);
		$jumlahKendaraan = $belumBayar['jumlah'];
		$totalBulanBelumBayar = $belumBayar['total'];

		$url = base_url();
		$url = str_replace('http://', '', $url);
		$url = str_replace('https://', '', $url);

		return "Anda mempunyai {$jumlahKendaraan} kendaraan dengan jumlah {$totalBulanBelumBayar} bulan yang belum dibayar. Buka link ini untuk lebih lanjut {$url}cek/nohp/{$pemilikKendaraan->nohp}";
	}

	public static function jumlahBelumBayar($id_pemilik_kendaraan)
	{
		$kendaraans = Kendaraan_model::where('id_pemilik_kendaraan', $id_pemilik_kendaraan)->get();

		$kendaraanJadi = [];
		$kendaraanJadi['total'] = 0;
		$kendaraanJadi['jumlah'] = 0;
		$kendaraanJadi['kendaraan'] = [];
		$i = 0;
		foreach($kendaraans as $item) {
		    $detailKendaraan = self::detilBulanTahunKendaraanBelumBayar($item->id);
		    if(count($detailKendaraan['bulanTahunBelumBayar']) > 0) {
				$kendaraanJadi['kendaraan'][$i]['id'] = $item->id;
				$kendaraanJadi['kendaraan'][$i]['jumlahBulanBelumBayar'] = count($detailKendaraan['bulanTahunBelumBayar']);
				$kendaraanJadi['kendaraan'][$i]['detilBulanBelumBayar'] = $detailKendaraan['bulanTahunBelumBayar'];
				$kendaraanJadi['kendaraan'][$i]['instance'] = Kendaraan_model::find($item->id);

	        	$kendaraanJadi['total'] += count($detailKendaraan['bulanTahunBelumBayar']);
	        	$kendaraanJadi['jumlah']++;
		    }
		    $i++;
	    }

	    return $kendaraanJadi;
	}

	public static function detilBulanTahunKendaraanBelumBayar($id_kendaraan)
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

	public static function kirimSms($nohp, $pesan)
	{
		$config = helper()->getKonfigurasi();

		return json_decode(
			json_encode(
				simplexml_load_string(
					file_get_contents(
						"http://reguler.zenziva.net/apps/smsapi.php?userkey="
						. $config['ZENZIVA_API_USER'] 
						. "&passkey=" 
						. $config['ZENZIVA_API_PASS']
						. "&nohp="
						. $nohp
						. "&pesan="
						. urlencode($pesan)
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
			"username" => 'lili',
			"password" => 'lili',
		]);

		$db->setAsGlobal();
		$db->bootEloquent();
	}

	public static function textBelumBayarPerPemilikKendaraan()
	{
		$dataBelumBayar = self::dataBelumBayar();

		$printID = [];
		$datas = [];
		foreach ($dataBelumBayar['belumBayarsPerPemilik'] as $key => $value) {
			$datas[$key] = self::textKePemilik($key);

			$text = $datas[$key];

			$pemilikKendaraan = PemilikKendaraan_model::find($key);
			$id = DB::table('log')->insertGetId([
				'request' => json_encode([
					'id_pemilik_kendaraan' => $pemilikKendaraan->id,
					'nohp' => $pemilikKendaraan->nohp,
					'text' => $text,
				]),
				'datetime' => date('Y-m-d H:i:s'),
				'req_id_pemilik_kendaraan' => $pemilikKendaraan->id,
				'req_nohp' => $pemilikKendaraan->nohp,
				'req_text' => $text,
			]);
			
			$rawKirimSms = self::kirimSms($pemilikKendaraan->nohp, $text);
			DB::table('log')->where('id', $id)->update([
				'respond' => json_encode($rawKirimSms),
				'res_status' => $rawKirimSms->message->status,
				'res_text' => $rawKirimSms->message->text,
			]);

			$printID[] = $id;
		}

		return DB::table('log')->whereIn('id', $printID)->get();
	}

	public static function dataBelumBayar()
	{
		$belumBayarsPerPemilik = [];
		foreach (PemilikKendaraan_model::all() as $item) {
			$belumBayarsPerPemilik[$item->id] = self::jumlahBelumBayar($item->id);

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