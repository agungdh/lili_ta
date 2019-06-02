<?php
namespace application\classes;

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\HariLibur as HariLibur_model;
use application\eloquents\User as User_model;
use application\eloquents\IjinAbsensi as IjinAbsensi_model;
use application\eloquents\Absensi as Absensi_model;

class Helper extends \agungdh\Pustaka
{
	public static function cekKuotaSms()
	{
		return json_decode(
			json_encode(
				simplexml_load_string(
					file_get_contents(
						"http://reguler.zenziva.net/apps/smsapibalance.php?userkey="
						. env('ZENZIVA_API_USER') 
						. "&passkey=" 
						. env('ZENZIVA_API_PASS')
					)
				)
			)
		);
	}

	public static function bootEloquent() {
		$db = new DB;

		$db->addConnection([
			"driver"    => "mysql",
			"host" => getenv('DB_HOST'),
			"database" => getenv('DB_DB'),
			"username" => getenv('DB_USER'),
			"password" => getenv('DB_PASS')
		]);

		$db->setAsGlobal();
		$db->bootEloquent();
	}
}