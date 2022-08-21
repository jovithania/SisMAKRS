<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

// Deklarasi pembuatan class Admin
class Admin extends CI_Controller
{

	// Konstrutor 
	function __construct()
	{
		parent::__construct();
		$this->load->model('Akun');
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
	}

	// Fungsi untuk menampilkan halaman utama admin
	public function index()
	{
		// Menampilkan data berdasarkan id-nya yaitu username
		$row = $this->Akun->get_by_id($this->session->userdata['username']);
		$data = array(
			'univ'     => 'Sekolah Tinggi Teologi Tawangmangu',
			'username' => $row->username,
			'level'    => $row->level,
		);

		$this->load->view('beranda', $data); // Menampilkan halaman utama admin

	}

	// Fungsi melakukan logout
	function logout()
	{
		//$level= $sess_data['level'];
		$this->session->sess_destroy();
		redirect(str_replace("dosen/", "", base_url()));
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
/* Please DO NOT modify this information : */
