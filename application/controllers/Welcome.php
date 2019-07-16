<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Welcome extends CI_Controller {
	public function index()
	{
		if ($this->session->login) {
			redirect(base_url('transaksi'));
		} else {
			return blade('template.login');
		}
	}
	
	public function getkuotasms()
	{
		$req = helper()->cekKuotaSms();
		
		if(isset($req->message->value)) {
			echo $req->message->value;
		} else {
			echo $req->message->text;
		}
	}
}
