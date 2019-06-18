<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\PemilikKendaraan as PemilikKendaraan_model;

class Pemilikkendaraan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// helper()->auth(['a']);
	}

	public function index()
	{
		$pemilikkendaraans = PemilikKendaraan_model::all();
		
		return blade('pemilikkendaraan.index', compact(['pemilikkendaraans']));
	}

	public function tambah()
	{
		return blade('pemilikkendaraan.tambah');
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'nama' => 'required',
			'nohp' => 'required|numeric',
		]);

		if (PemilikKendaraan_model::where(['nohp' => $requestData['nohp']])->first()) {
			$validator->errors()->add('nohp', 'No HP sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('pemilikkendaraan/tambah'));
		}

		PemilikKendaraan_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('pemilikkendaraan'));
	}

	public function ubah($id)
	{
		$pemilikkendaraan = PemilikKendaraan_model::find($id);

		return blade('pemilikkendaraan.ubah', compact(['pemilikkendaraan']));
	}

	public function aksiubah($id)
	{
		$pemilikkendaraan = PemilikKendaraan_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'nama' => 'required',
			'nohp' => 'required|numeric',
		]);

		if ($requestData['nohp'] != $pemilikkendaraan->nohp && PemilikKendaraan_model::where(['nohp' => $requestData['nohp']])->first()) {
			$validator->errors()->add('nohp', 'No HP sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('pemilikkendaraan/ubah/' . $id));
		}

		PemilikKendaraan_model::where('id', $id)->update($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('pemilikkendaraan'));
	}

	public function aksihapus($id)
	{
		try {
			PemilikKendaraan_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => ENVIRONMENT == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('pemilikkendaraan'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('pemilikkendaraan'));
	}
}
