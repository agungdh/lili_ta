<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\Kendaraan as Kendaraan_model;
use application\eloquents\PemilikKendaraan as PemilikKendaraan_model;
use application\eloquents\FormulaTarif as FormulaTarif_model;

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
		$pemilikKendaraans = PemilikKendaraan_model::all();
		$formulaTarifs = FormulaTarif_model::all();

		return blade('kendaraan.tambah', compact(['pemilikKendaraans', 'formulaTarifs']));
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'id_pemilik_kendaraan' => 'required',
			'id_formula_tarif' => 'required',
			'nomor_polisi' => 'required',
			'seat_aktif' => 'required|numeric|min:1|lte:jumlah_seat',
			'jumlah_seat' => 'required|numeric|min:1',
			'mulai_penagihan_bulan' => 'required|numeric|min:1|max:12',
			'mulai_penagihan_tahun' => 'required|numeric|min:1900|max:2900',
		], [
			'lte' => [
				'numeric' => 'The :attribute must be less than or equal :value.',
			],
		]
		);

		if (Kendaraan_model::where(['nomor_polisi' => $requestData['nomor_polisi']])->first()) {
			$validator->errors()->add('nomor_polisi', 'Nomor Polisi sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('kendaraan/tambah'));
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
		$pemilikKendaraans = PemilikKendaraan_model::all();
		$formulaTarifs = FormulaTarif_model::all();

		return blade('kendaraan.ubah', compact(['kendaraan', 'pemilikKendaraans', 'formulaTarifs']));
	}

	public function aksiubah($id)
	{
		$kendaraan = Kendaraan_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'id_pemilik_kendaraan' => 'required',
			'id_formula_tarif' => 'required',
			'nomor_polisi' => 'required',
			'seat_aktif' => 'required|numeric|min:1|lte:jumlah_seat',
			'jumlah_seat' => 'required|numeric|min:1',
			'mulai_penagihan_bulan' => 'required|numeric|min:1|max:12',
			'mulai_penagihan_tahun' => 'required|numeric|min:1900|max:2900',
		], [
			'lte' => [
				'numeric' => 'The :attribute must be less than or equal :value.',
			],
		]
		);

		if ($requestData['nomor_polisi'] != $kendaraan->nomor_polisi && Kendaraan_model::where(['nomor_polisi' => $requestData['nomor_polisi']])->first()) {
			$validator->errors()->add('nomor_polisi', 'Nomor Polisi sudah ada !!!');
		}

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('kendaraan/ubah/' . $id));
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
                'message' => ENVIRONMENT == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
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
