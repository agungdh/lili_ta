<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

use application\eloquents\PemilikKendaraan as PemilikKendaraan_model;

class Kendaraanbelumbayar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// helper()->auth(['a']);
	}

	public function index()
	{	
		$pemilikKendaraans = PemilikKendaraan_model::all();

		return blade('kendaraanbelumbayar.index', compact(['pemilikKendaraans']));
	}
}