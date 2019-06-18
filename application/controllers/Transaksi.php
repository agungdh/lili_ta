<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Transaksi as Transaksi_model;
use application\eloquents\Loket as Loket_model;
use application\eloquents\Kendaraan as Kendaraan_model;
use application\eloquents\PemilikKendaraan as PemilikKendaraan_model;

class Transaksi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		// helper()->auth(['a']);
	}

	public function ajaxtable($id_pemilik_kendaraan = null)
	{
		if ($id_pemilik_kendaraan) {
			$kendaraanIDArrays_raw = Kendaraan_model::where('id_pemilik_kendaraan', $id_pemilik_kendaraan)->get();
			$kendaraanIDArrays = [];
			foreach ($kendaraanIDArrays_raw as $item) {
				$kendaraanIDArrays[] = $item->id;
			}

			$transaksis = Transaksi_model::with('kendaraan.pemilikKendaraan', 'kendaraan.formulaTarif', 'karyawan', 'loket')->whereIn('id_kendaraan', $kendaraanIDArrays)->where('nik', getUserData()->nik)->get();
		} else {
			$transaksis = Transaksi_model::with('kendaraan.pemilikKendaraan', 'kendaraan.formulaTarif', 'karyawan', 'loket')->where('nik', getUserData()->nik)->get();
		}

		return blade('transaksi.ajaxtable', compact(['transaksis']));
	}

	public function index()
	{
		$pemilikKendaraans = PemilikKendaraan_model::all();
		
		return blade('transaksi.index', compact(['pemilikKendaraans']));
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
		$transaksi = Transaksi_model::find($id);
		$transaksi->tanggal = helper()->tanggalIndo($transaksi->tanggal);

		$lokets = Loket_model::all();
		$kendaraans = Kendaraan_model::with('pemilikKendaraan')->get();

		return blade('transaksi.ubah', compact(['transaksi', 'lokets', 'kendaraans']));
	}

	public function aksiubah($id)
	{
		$transaksi = Transaksi_model::find($id);

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

		if (($requestData['id_kendaraan'] != $transaksi->id_kendaraan || $requestData['bulan'] != $transaksi->bulan || $requestData['tahun'] != $transaksi->tahun) && Transaksi_model::where(['id_kendaraan' => $requestData['id_kendaraan'], 'bulan' => $requestData['bulan'], 'tahun' => $requestData['tahun']])->first()) {
			$validator->errors()->add('id_kendaraan', 'Transaksi sudah ada !!!');
			$validator->errors()->add('bulan', 'Transaksi sudah ada !!!');
			$validator->errors()->add('tahun', 'Transaksi sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('transaksi/ubah/' . $id));
		}

		$requestData['nik'] = getUserData()->nik;
		$requestData['outstanding'] = str_replace('.', '', $requestData['outstanding']);
		$requestData['potensi'] = str_replace('.', '', $requestData['potensi']);
		$requestData['tanggal'] = helper()->parseTanggalIndo($requestData['tanggal']);

		Transaksi_model::where('id', $id)->update($requestData);
		
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
			Transaksi_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => ENVIRONMENT == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
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
