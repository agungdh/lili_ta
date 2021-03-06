<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Karyawan as Karyawan_model;

class Karyawan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		helper()->auth(['o']);
	}

	public function getJabatan($phrase)
	{
		$datas = DB::select("SELECT DISTINCT(jabatan) name FROM karyawan WHERE jabatan like ?", ["%" . $phrase . "%"]);
		echo json_encode($datas);
	}

	public function index()
	{
		$karyawans = Karyawan_model::all();
		
		return blade('karyawan.index', compact(['karyawans']));
	}

	public function tambah()
	{
		return blade('karyawan.tambah');
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'nik' => 'required',
			'nama' => 'required',
			'jabatan' => 'required',
		]);

		if (Karyawan_model::where(['nik' => $requestData['nik']])->first()) {
			$validator->errors()->add('nik', 'NIK sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('karyawan/tambah'));
		}

		Karyawan_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('karyawan'));
	}

	public function ubah($id)
	{
		$karyawan = Karyawan_model::find($id);

		return blade('karyawan.ubah', compact(['karyawan']));
	}

	public function aksiubah($id)
	{
		$karyawan = Karyawan_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'nik' => 'required',
			'nama' => 'required',
			'jabatan' => 'required',
		]);

		if ($requestData['nik'] != $karyawan->nik && Karyawan_model::where(['nik' => $requestData['nik']])->first()) {
			$validator->errors()->add('nik', 'NIK sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('karyawan/ubah/' . $id));
		}

		Karyawan_model::where('nik', $id)->update($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('karyawan'));
	}

	public function aksihapus($id)
	{
		try {
			Karyawan_model::where('nik', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => ENVIRONMENT == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('karyawan'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('karyawan'));
	}
}
