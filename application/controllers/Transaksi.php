<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Transaksi as Transaksi_model;
use application\eloquents\Loket as Loket_model;
use application\eloquents\Kendaraan as Kendaraan_model;

class Transaksi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// helper()->auth(['a']);
	}

	public function index()
	{
		$transaksis = Transaksi_model::all();
		
		return blade('transaksi.index', compact(['transaksis']));
	}

	public function tambah()
	{
		$lokets = Loket_model::all();
		$kendaraans = Kendaraan_model::with('pemilikKendaraan')->get();

		return blade('transaksi.tambah', compact(['lokets', 'kendaraans']));
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'id_kendaraan' => 'required',
			'id_loket' => 'required',
			'tanggal' => 'required',
			'bulan' => 'required|numeric|min:1|max:12',
			'tahun' => 'required|numeric|min:1900|max:2900',
			'outstanding' => 'required|numeric|min:0',
			'potensi' => 'required|numeric|min:0',
		]);

		if (Transaksi_model::where(['id_kendaraan' => $requestData['id_kendaraan'], 'bulan' => $requestData['bulan'], 'tahun' => $requestData['tahun']])->first()) {
			$validator->errors()->add('id_kendaraan', 'Transaksi sudah ada !!!');
			$validator->errors()->add('bulan', 'Transaksi sudah ada !!!');
			$validator->errors()->add('tahun', 'Transaksi sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('transaksi/tambah'));
		}

		$requestData['nik'] = getUserData()->nik;
		$requestData['outstanding'] = str_replace('.', '', $requestData['outstanding']);
		$requestData['potensi'] = str_replace('.', '', $requestData['potensi']);
		$requestData['tanggal'] = helper()->parseTanggalIndo($requestData['tanggal']);

		Transaksi_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('transaksi'));
	}

	public function ubah($id)
	{
		$loket = Loket_model::find($id);

		return blade('transaksi.ubah', compact(['loket']));
	}

	public function aksiubah($id)
	{
		$loket = Loket_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'lokasi' => 'required',
		]);

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('transaksi/ubah/' . $id));
		}

		Loket_model::where('id', $id)->update($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('transaksi'));
	}

	public function aksihapus($id)
	{
		try {
			Loket_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => getenv('CI_ENV') == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('transaksi'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('transaksi'));
	}
}
