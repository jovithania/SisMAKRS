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
		$this->load->view('beranda'); // Menampilkan halaman utama admin

	}

	// Fungsi melakukan logout
	function logout()
	{
		//$level= $sess_data['level'];
		$this->session->sess_destroy();
		redirect(str_replace("administrator/", "", base_url()));
	}
}
