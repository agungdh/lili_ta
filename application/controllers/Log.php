<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

use application\eloquents\Karyawan as Karyawan_model;
use application\eloquents\Log as Log_model;

class Log extends CI_Controller {

	public function index()
	{
		$logs = Log_model::with('pemilikKendaraan')->get();

		return blade('log.index', compact(['logs']));
	}

	public function in()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'nik' => 'required',
			'password' => 'required',
		]);

		if ($validator->passes()) {
			$karyawan = Karyawan_model::where(['nik' => $requestData['nik']])->first();
			if (!($karyawan && $karyawan->user && password_verify($requestData['password'], $karyawan->user->password))) {
				$validator->errors()->add('nik', 'NIK / Password Salah !!!');
				$validator->errors()->add('password', 'NIK / Password Salah !!!');
			}
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
		} else {
			$this->session->set_userdata([
				'userID' => $karyawan->user->id,
				'login' => true,
			]);
		}

		redirect(base_url());
	}

	public function out() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
