<?php


if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Akun_control extends CI_Controller
{
	// Konstruktor	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Akun'); // Memanggil Akun yang terdapat pada models
		$this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library        
		$this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
	}

	// Fungsi untuk menampilkan halaman users
	public function index()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		// Menampilkan data berdasarkan id-nya yaitu username
		$rowAdm = $this->Akun->get_by_id($this->session->userdata['username']);
		$dataAdm = array(
			'wa'       => 'Web Administrator',
			'univ'     => 'Sekolah Tinggi Teologi Tawangmangu',
			'username' => $rowAdm->username,
			'level'    => $rowAdm->level,
		);
		$this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
		$this->load->view('users/users_list'); // Menampilkan halaman users
		$this->load->view('footer_list'); // Menampilkan bagian footer
	}

	// Fungsi JSON
	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Akun->json();
	}

	// Fungsi menampilkan form Create Users
	public function create()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		// Menampilkan data berdasarkan id-nya yaitu username
		$rowAdm = $this->Akun->get_by_id($this->session->userdata['username']);


		// Menampung data yang diinputkan
		$data = array(
			'button' => 'Create',
			'back'   => site_url('Akun_control'),
			'action' => site_url('Akun_control/create_action'),
			'username' => set_value('username'),
			'password' => set_value('password'),
			'level' => set_value('level'),
			'blokir' => set_value('blokir'),
		);

		$this->load->view('header'); // Menampilkan bagian header dan object data users
		$this->load->view('users/users_form', $data); // Menampilkan halaman utama yaitu form users 
		$this->load->view('footer'); // Menampilkan bagian footer
	}

	// Fungsi untuk melakukan aksi simpan data
	public function create_action()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->_rules(); // Rules atau aturan bahwa setiap form harus diisi

		// Jika form users belum diisi dengan benar 
		// maka sistem akan meminta user untuk menginput ulang
		if ($this->form_validation->run() == FALSE) {
			$this->create();
		}
		// Jika form users telah diisi dengan benar 
		// maka sistem akan menyimpan kedalam database
		else {
			$data = array(
				'username' => $this->input->post('username', TRUE),
				'password' => md5($this->input->post('password', TRUE)),
				'level' => $this->input->post('level', TRUE),
				'blokir' => $this->input->post('blokir', TRUE),
				'id_sessions' => md5($this->input->post('password', TRUE)),
			);

			$this->Akun->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('users'));
		}
	}

	// Fungsi menampilkan form users
	public function update($id)
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		// Menampilkan data berdasarkan id-nya yaitu username
		$rowAdm = $this->Akun->get_by_id($this->session->userdata['username']);
		$dataAdm = array(
			'wa'       => 'Web Administrator',
			'univ'     => 'Sekolah Tinggi Teologi Tawangmangu',
			'username' => $rowAdm->username,
			'level'    => $rowAdm->level,
		);

		// Menampilkan data berdasarkan id-nya yaitu username
		$row = $this->Akun->get_by_id($id);

		// Jika id-nya dipilih maka data tahun akademik semester ditampilkan ke form edit users
		if ($row) {
			$data = array(
				'button' => 'Update',
				'back'   => site_url('Akun_control'),
				'action' => site_url('Akun_control/update_action'),
				'username' => set_value('username', $row->username),
				'level' => set_value('level', $row->level),
				'blokir' => set_value('blokir', $row->blokir),
			);
			$this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users
			$this->load->view('users/users_form', $data); // Menampilkan form tahun akademik semester
			$this->load->view('footer'); // Menampilkan bagian footer
		}
		// Jika id-nya yang dipilih tidak ada maka akan menampilkan pesan 'Record Not Found'
		else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('Akun_control'));
		}
	}

	// Fungsi untuk melakukan aksi update data
	public function update_action()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		// Rules atau aturan bahwa setiap form harus diisi
		$this->_rules();

		// Jika form users belum diisi dengan benar 
		// maka sistem akan meminta user untuk menginput ulang
		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('username', TRUE));
		}
		// Jika form users telah diisi dengan benar 
		// maka sistem akan melakukan update data tahun akademik semester kedalam database
		else {
			$data = array(
				'username' => $this->input->post('username', TRUE),
				'password' => md5($this->input->post('password', TRUE)),
				'level' => $this->input->post('level', TRUE),
				'blokir' => $this->input->post('blokir', TRUE),
				'id_sessions' => md5($this->input->post('password', TRUE)),
			);

			$this->Akun->update($this->input->post('username', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('Akun_control'));
		}
	}

	// Fungsi untuk melakukan aksi delete data berdasarkan id yang dipilih
	public function delete($id)
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Akun->get_by_id($id);

		//jika id users yang dipilih tersedia maka akan dihapus
		if ($row) {
			$this->Akun->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('Akun_control'));
		}
		//jika id users yang dipilih tidak tersedia maka akan muncul pesan 'Record Not Found'
		else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('Akun_control'));
		}
	}

	// Fungsi rules atau aturan untuk pengisian pada form (create/input dan update)
	public function _rules()
	{
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('level', 'level', 'trim|required');
		$this->form_validation->set_rules('blokir', 'blokir', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
