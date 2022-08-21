<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Jadwal_control extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Jadwal'); // Memanggil Jadwal yang terdapat pada models
		$this->load->model('Akun'); // Memanggil Akun yang terdapat pada models 
		$this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library        
		$this->load->library('datatables'); // Memanggil datatables yang terdapat pada library
	}

	// Fungsi untuk menampilkan halaman tahun akademik semester
	public function index()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->load->view('header'); // Menampilkan bagian header dan object data users 
		$this->load->view('sidebar'); // Menampilkan bagian header dan object data users 
		$this->load->view('jadwal/jadwal_list'); // Menampilkan halaman tahun akademik
		$this->load->view('footer'); // Menampilkan bagian footer
	}

	// Fungsi JSON
	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Jadwal->json();
	}

	// Fungsi menampilkan form Create Tahun akademik semester
	public function create()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$data = array(
			'button' => 'Create',
			'back'   => site_url('jadwal_control'),
			'action' => site_url('jadwal_control/create_action'),
			'id_thn_akad' => set_value('id_thn_akad'),
			'thn_akad' => set_value('thn_akad'),
			'semester' => set_value('semester'),
			'thn_akademik' => $this->Jadwal->get_tahunAkademik(),
		);

		$this->load->view('header'); // Menampilkan bagian header dan object data users
		$this->load->view('sidebar'); // Menampilkan bagian header dan object data users
		$this->load->view('jadwal/jadwal_form', $data); // Menampilkan halaman utama yaitu form tahun akademik semester
		$this->load->view('footer'); // Menampilkan bagian footer
	}

	// Fungsi untuk melakukan aksi simpan data
	public function create_action()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$id_thn_akad = $this->input->post('id_thn_akad', TRUE);
			$nama_kegiatan = $this->input->post('nama_kegiatan', TRUE);
			$tgl_mulai = $this->input->post('tgl_mulai', TRUE);
			$tgl_berakhir = $this->input->post('tgl_berakhir', TRUE);

			$exist = $this->Jadwal->get_checkExist($id_thn_akad, $nama_kegiatan)->exist;
			if ($exist == 0) {

				$data = array(
					'id_thn_akad' => $id_thn_akad,
					'nama_kegiatan' => $nama_kegiatan,
					'tgl_mulai' => $tgl_mulai,
					'tgl_berakhir' => $tgl_berakhir
				);

				$this->Jadwal->insert($data);

				$this->session->set_flashdata('message', 'Create Record Success');
			} else {
				$this->session->set_flashdata('message', 'Data Sudah Pernah Ditambahkan');
			}
			redirect(site_url('jadwal_control'));
		}
	}

	// Fungsi menampilkan form Update tahun akademik semester
	public function update($id)
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		// Menampilkan data berdasarkan id-nya yaitu kode_matakuliah
		$row = $this->Jadwal->get_by_id($id);
		//$row2 = $this->Jadwal->get_by_id($nama_kegiatan);

		// Jika id-nya dipilih maka data tahun akademik semester ditampilkan ke form edit tahun akademik semester
		if ($row) {
			$data = array(
				'button' => 'Update',
				'back'   => site_url('jadwal_control'),
				'action' => site_url('jadwal_control/update_action'),
				'id_jadwal' => set_value('id_jadwal', $row->id_jadwal),
				'id_thn_akad' => set_value('id_thn_akad', $row->id_thn_akad),
				'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
				'tgl_mulai' => set_value('tgl_mulai', date('Y-m-d', strtotime($row->tgl_mulai))),
				'tgl_berakhir' => set_value('tgl_berakhir', date('Y-m-d', strtotime($row->tgl_berakhir))),
				'thn_akademik' => $this->Jadwal->get_tahunAkademik(),
				'thn_akad' => set_value('thn_akad', $row->thn_akad),

				// 	'button' => 'Update',
				// 'back'   => site_url('jadwal'),
				//          'action' => site_url('jadwal/update_action'),
				// 'id_thn_akad' => set_value('id_thn_akad'),
				// 'thn_akad' => set_value('thn_akad'),
				// 'semester' => set_value('semester'),
			);
			//echo $row->nama_kegiatan;
			$this->load->view('header'); // Menampilkan bagian header dan object data users
			$this->load->view('sidebar'); // Menampilkan bagian header dan object data users
			$this->load->view('jadwal/update_jadwal_form', $data);  // Menampilkan form tahun akademik semester
			$this->load->view('footer'); // Menampilkan bagian footer
		}
		// Jika id-nya yang dipilih tidak ada maka akan menampilkan pesan 'Record Not Found'
		else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('jadwal_control'));
		}
	}

	// Fungsi untuk melakukan aksi update data
	public function update_action()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->_rules(); // Rules atau aturan bahwa setiap form harus diisi
		// $data = array();

		// Jika form tahun akademik semester belum diisi dengan benar 
		// maka sistem akan meminta user untuk menginput ulang
		// if ($this->form_validation->run() == FALSE) {
		// 	//echo 'TRUE';
		// 	$this->update($this->input->post('id_jadwal', TRUE));
		// }
		// // Jika form tahun akademik semester telah diisi dengan benar 
		// // maka sistem akan melakukan update data tahun akademik semester kedalam database
		// else {
		// echo 'FALSE';
		$data = array(
			// 'id_jadwal' => $this->input->post('id_jadwal', TRUE),
			// 'id_thn_akad' => $this->input->post('id_thn_akad', TRUE),
			// 'nama_kegiatan' => $this->input->post('nama_kegiatan', TRUE),
			'tgl_mulai' => $this->input->post('tgl_mulai', TRUE),
			'tgl_berakhir' => $this->input->post('tgl_berakhir', TRUE)

		);
		$this->Jadwal->update($this->input->post('id_jadwal', TRUE), $data);
		$this->session->set_flashdata('message', 'Update Record Success');
		redirect(site_url('jadwal_control'));
	}
	// echo $data->tgl_mulai;
	// echo $data->tgl_berakhir;
	// echo $this->input->post('id_jadwal');

	// $this->Jadwal->update($this->input->post('id_jadwal', TRUE), $data);
	// $this->session->set_flashdata('message', 'Update Record Success');
	// redirect(site_url('jadwal_control'));

	// echo $this->input->post('id_jadwal', TRUE);
	// echo $this->input->post('id_thn_akad', TRUE);
	// echo $this->input->post('nama_kegiatan', TRUE);
	// echo $this->input->post('tgl_mulai', TRUE);
	// echo $this->input->post('tgl_berakhir', TRUE);


	// Fungsi untuk melakukan aksi update data
	// public function aktif_action($id)
	// {
	// 	// Jika session data username tidak ada maka akan dialihkan kehalaman login			
	// 	if (!isset($this->session->userdata['username'])) {
	// 		redirect(base_url("login"));
	// 	}

	// 	$rows = $this->Thn_akad_semester_model->get_by_id($id);

	// 	//jika id tahun akademik semester yang dipilih tersedia maka akan diaktifkan
	// 	if ($rows) {

	// 		$this->Thn_akad_semester_model->update_tidakAktif($id);

	// 		$this->Thn_akad_semester_model->update_aktif($id);

	// 		$this->session->set_flashdata('message', 'Update Record Success');
	// 		redirect(site_url('thn_akad_semester_control'));
	// 	}
	// 	//jika id tahun akademik semester yang dipilih tidak tersedia maka akan muncul pesan 'Record Not Found'
	// 	else {

	// 		$this->session->set_flashdata('message', 'Record Not Found');
	// 		redirect(site_url('thn_akad_semester_control'));
	// 	}
	// }

	// Fungsi untuk melakukan aksi delete data berdasarkan id yang dipilih
	public function delete($id)
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Jadwal->get_by_id($id);

		//jika id tahun akademik semester yang dipilih tersedia maka akan dihapus
		if ($row) {
			$this->Jadwal->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('jadwal_control'));
		}
		//jika id tahun akademik semester yang dipilih tidak tersedia maka akan muncul pesan 'Record Not Found'
		else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('jadwal_control'));
		}
	}

	// Fungsi rules atau aturan untuk pengisian pada form (create/input dan update)
	public function _rules()
	{
		// $this->form_validation->set_rules('thn_akad', 'thn akad', 'trim|required');
		// $this->form_validation->set_rules('semester', 'semester', 'trim|required');
		$this->form_validation->set_rules('id_thn_akad', 'id_thn_akad', 'trim|required');
		$this->form_validation->set_rules('nama_kegiatan', 'nama_kegiatan', 'trim|required');
		$this->form_validation->set_rules('tgl_mulai', 'tgl_mulai', 'trim|required');
		$this->form_validation->set_rules('tgl_berakhir', 'tgl_berakhir', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
