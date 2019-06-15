<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use application\eloquents\User as User_model;

class Konfigurasi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// helper()->auth(['a', 'p']);
	}
	
	public function index()
	{
		$konfigurasi = helper()->getKonfigurasi();
		
		return blade('template.konfigurasi', compact(['konfigurasi']));
	}

	public function ubah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'APP_TITLE' => 'required',
			'APP_TITLE_SHORT' => 'required',
			'APP_TITLE_SHORTER' => 'required',
			'DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN' => 'required|numeric|min:1|max:12',
			'DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN' => 'required|numeric|min:1900|max:2900',
			'ZENZIVA_API_PASS' => 'required',
			'ZENZIVA_API_USER' => 'required',
		]);

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('konfigurasi'));
		}

		foreach ($requestData as $key => $value) {
			DB::table('konfigurasi')->where('konfigurasi', $key)->update(['value' => $value]);
		}


		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Konfigurasi Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('konfigurasi'));
	}
}
