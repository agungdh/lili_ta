<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Kendaraan as Kendaraan_model;
use application\eloquents\PemilikKendaraan as PemilikKendaraan_model;

class Kendaraan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// helper()->auth(['a']);
	}

	public function ajaxtable($id_pemilik_kendaraan = null)
	{
		if ($id_pemilik_kendaraan) {
			$kendaraans = Kendaraan_model::where('id_pemilik_kendaraan', $id_pemilik_kendaraan)->get();
		} else {
			$kendaraans = Kendaraan_model::all();
		}

		return blade('kendaraan.ajaxtable', compact(['kendaraans']));
	}

	public function index()
	{	
		$pemilikKendaraans = PemilikKendaraan_model::all();

		return blade('kendaraan.index', compact(['pemilikKendaraans']));
	}

	public function tambah()
	{
		return blade('kendaraan.tambah');
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'lokasi' => 'required',
		]);

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('loket/tambah'));
		}

		Kendaraan_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('kendaraan'));
	}

	public function ubah($id)
	{
		$kendaraan = Kendaraan_model::find($id);

		return blade('kendaraan.ubah', compact(['kendaraan']));
	}

	public function aksiubah($id)
	{
		$loket = Kendaraan_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'lokasi' => 'required',
		]);

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('loket/ubah/' . $id));
		}

		Kendaraan_model::where('id', $id)->update($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('kendaraan'));
	}

	public function aksihapus($id)
	{
		try {
			Kendaraan_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => getenv('CI_ENV') == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('kendaraan'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('kendaraan'));
	}
}
