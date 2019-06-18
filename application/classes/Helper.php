<?php
namespace application\classes;

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\User as User_model;
use application\eloquents\IjinAbsensi as IjinAbsensi_model;
use application\eloquents\Absensi as Absensi_model;

class Helper extends \agungdh\Pustaka
{

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

		// $db->addConnection([
		// 	"driver"    => "mysql",
		// 	"host" => getenv('DB_HOST'),
		// 	"database" => getenv('DB_DB'),
		// 	"username" => getenv('DB_USER'),
		// 	"password" => getenv('DB_PASS')
		// ]);

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