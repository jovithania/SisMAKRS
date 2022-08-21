<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Mahasiswa_control extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa');
		$this->load->model('Akun');
		$this->load->model('Krs');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->library('datatables');
	}

	public function index()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}


		$rowAdm = $this->Akun->get_by_id($this->session->userdata['username']);

		$this->load->view('header_list');
		$this->load->view('sidebar');
		$this->load->view('mahasiswa/mahasiswa_list');
		$this->load->view('footer_list');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Mahasiswa->json();
	}

	public function lihatKrs()
	{

		$nim = $_POST['nim'];
		echo $this->Mahasiswa->get_krsMahasiswa($nim);
	}

	public function validasi($nim)
	{

		$cekRow = $this->Krs->get_checkJadwal();
		$cek = 'T';
		if ($cekRow) {
			$cek = $cekRow->cek;
		}
		if ($cek == 'T') {

			$this->session->set_flashdata('message', 'Validasi KRS Belum Aktif');
			redirect(site_url('mahasiswa'));
		} else {

			$this->Mahasiswa->updateValidasi($nim, 'Y');
			redirect(site_url('mahasiswa'));
		}
	}

	public function batal_validasi($nim)
	{

		$cek = $this->Krs->get_checkJadwal()->cek;

		if ($cek == 'T') {

			$this->session->set_flashdata('message', 'Validasi KRS Belum Aktif');
			redirect(site_url('mahasiswa'));
		} else {
			$this->Mahasiswa->updateValidasi($nim, 'T');
			redirect(site_url('mahasiswa'));
		}
	}
}
