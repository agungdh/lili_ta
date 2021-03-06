<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

use application\eloquents\FormulaTarif as FormulaTarif_model;

class Formulatarif extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		helper()->auth(['o']);
	}

	public function getJenisAngkutan($phrase)
	{
		$datas = DB::select("SELECT DISTINCT(jenis_angkutan) name FROM formula_tarif WHERE jenis_angkutan like ?", ["%" . $phrase . "%"]);
		echo json_encode($datas);
	}


	public function index()
	{
		$formulatarifs = FormulaTarif_model::all();
		
		return blade('formulatarif.index', compact(['formulatarifs']));
	}

	public function tambah()
	{
		return blade('formulatarif.tambah');
	}

	public function aksitambah()
	{
		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'tarif' => 'required',
			'jenis_angkutan' => 'required',
			'jumlah_seat_sampai_dengan' => 'required',
		]);

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('formulatarif/tambah'));
		}

		$requestData['tarif'] = str_replace('.', '', $requestData['tarif']);
		$requestData['jumlah_seat_sampai_dengan'] = str_replace('.', '', $requestData['jumlah_seat_sampai_dengan']);

		FormulaTarif_model::insert($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Tambah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('formulatarif'));
	}

	public function ubah($id)
	{
		$formulatarif = FormulaTarif_model::find($id);

		return blade('formulatarif.ubah', compact(['formulatarif']));
	}

	public function aksiubah($id)
	{
		$formulaTarif = FormulaTarif_model::find($id);

		$requestData = $this->input->post();
		
		$validator = validator()->make($requestData, [
			'tarif' => 'required',
			'jenis_angkutan' => 'required',
			'jumlah_seat_sampai_dengan' => 'required',
		]);

		if (count($validator->errors()) > 0) {
			$this->session->set_flashdata('errors', $validator->errors());
			$this->session->set_flashdata('old', $requestData);
			
			redirect(base_url('formulatarif/ubah/' . $id));
		}

		$requestData['tarif'] = str_replace('.', '', $requestData['tarif']);
		$requestData['jumlah_seat_sampai_dengan'] = str_replace('.', '', $requestData['jumlah_seat_sampai_dengan']);

		FormulaTarif_model::where('id', $id)->update($requestData);
		
		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Ubah Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('formulatarif'));
	}

	public function aksihapus($id)
	{
		try {
			FormulaTarif_model::where('id', $id)->delete();
		} catch (QueryException $exception) {
            $this->session->set_flashdata(
			'alert',
			[
				'title' => 'ERROR !!!',
                'message' => ENVIRONMENT == 'development' ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
			]);

			redirect(base_url('formulatarif'));
        }

		$this->session->set_flashdata(
			'alert',
			[
				'title' => 'Sukses',
				'message' => 'Hapus Data Berhasil !!!',
				'class' => 'success',
			]
		);

		redirect(base_url('formulatarif'));
	}
}
