<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

use application\eloquents\Transaksi as Transaksi_model;

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		helper()->auth(['b', 'o']);
	}

	public function index()
	{	
		return blade('laporan.index');
	}

	public function cetak($bulan, $tahun)
	{
		$transaksis = Transaksi_model::with('kendaraan.pemilikKendaraan', 'loket', 'karyawan')->whereRaw('month(tanggal) = ? AND year (tanggal) = ?', [$bulan, $tahun])->get();
	
		$dompdf = new Dompdf\Dompdf();
		$dompdf->set_option('defaultFont', 'Courier');
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->loadHtml(bladeHtml('laporan.pdf', compact(['transaksis', 'bulan', 'tahun'])));
		$dompdf->render();
		$dompdf->stream('Laporan Bulanan Transaksi ' . helper()->tanggalIndoStringBulanTahun("{$bulan}-{$tahun}") . '.pdf', ["Attachment" => false]);
	}

}