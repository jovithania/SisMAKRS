<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

// Deklarasi pembuatan class Krs
class Krs_control extends CI_Controller
{
	// Konstruktor	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Krs');
		$this->load->model('Mahasiswa');
		$this->load->model('Prodi');
		$this->load->model('Thn_akad_semester');
		$this->load->model('Akun');
		$this->load->library('form_validation');
	}

	// Fungsi untuk menampilkan halaman utama KRS
	public function index()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		// Menampung data yang diinputkan
		$data = array(
			'button' => 'Proses',
			'back'   => site_url('krs_control'),
			'action' => site_url('krs_control/krs_action'),
			'nim' => set_value('nim'),
			'id_thn_akad' => set_value('id_thn_akad'),
		);

		$this->load->view('header'); // Menampilkan bagian header dan object data users 	
		$this->load->view('sidebar'); // Menampilkan bagian header dan object data users 	
		$this->load->view('krs/mhs_form', $data); // Menampilkan halaman utama KRS
		$this->load->view('footer'); // Menampilkan bagian footer
	}

	// Fungsi untuk melakukan aksi KRS
	public function krs_action()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$nim = $this->input->post('nim', TRUE);
		$thn_akad = $this->input->post('id_thn_akad', TRUE);

		if ($this->Mahasiswa->get_by_id($nim) == null) {
			redirect(base_url('krs_control'));
		}

		$dataKrs = array(
			'button' => 'Create',
			'back'   => site_url('krs'),
			'krs_data' => $this->baca_krs($nim, $thn_akad),
			'nim' => $nim,
			'id_thn_akad' => $thn_akad,
			'thn_akad' => $this->Thn_akad_semester->get_by_id($thn_akad)->thn_akad,
			'semester' => $this->Thn_akad_semester->get_by_id($thn_akad)->semester == 1 ? 'Ganjil' : 'Genap',
			'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
			'prodi' => $this->Prodi->get_by_id(
				$this->Mahasiswa->get_by_id($nim)->id_prodi
			)->nama_prodi,
		);

		$this->load->view('header');	 // Menampilkan bagian header dan object data users 
		$this->load->view('sidebar');	 // Menampilkan bagian header dan object data users 
		$this->load->view('krs/krs_list', $dataKrs); // Menampilkan data KRS
		$this->load->view('footer'); // Menampilkan bagian footer

		// }
	}

	// Fungsi membaca KRS berdasarkan NIM dan Tahun Akademik
	public function baca_krs($nim, $thn_akad)
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->db->select('k.id_krs,k.kode_matakuliah,m.nama_matakuliah,m.sks');
		$this->db->from('krs as k');
		$this->db->where('k.nim', $nim);
		$this->db->where('k.id_thn_akad', $thn_akad);
		$this->db->join('matakuliah as m', 'm.kode_matakuliah = k.kode_matakuliah');
		$krs = $this->db->get()->result();
		return $krs;
	}

	// Fungsi menampilkan form Create KRS
	public function create($nim, $th)
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		// Menampung data yang diinputkan 
		$data = array(
			'button' => 'Create',
			'judul' => 'Tambah',
			'back'   => site_url('krs_control'),
			'action' => site_url('krs_control/create_action'),
			'id_krs' => set_value('id_krs'),
			'id_thn_akad' => $th, // set_value('id_thn_akad'),
			'thn_akad_smt' => $this->Thn_akad_semester->get_by_id($th)->thn_akad,
			'semester' => $this->Thn_akad_semester->get_by_id($th)->semester == 1 ? 'Ganjil' : 'Genap',
			'nim' => $nim, //set_value('nim'),
			'kode_matakuliah' => set_value('kode_matakuliah'),

		);
		$this->load->view('header'); // Menampilkan bagian header dan object data users 
		$this->load->view('sidebar'); // Menampilkan bagian header dan object data users 
		$this->load->view('krs/krs_form', $data); // Menampilkan form KRS
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

		// Jika form KRS belum diisi dengan benar 
		// maka sistem akan meminta user untuk menginput ulang
		if ($this->form_validation->run() == FALSE) {
			$this->create(
				$this->input->post('nim', TRUE),
				$this->input->post('id_thn_akad', TRUE)
			);
		}
		// Jika form KRS telah diisi dengan benar 
		// maka sistem akan menyimpan kedalam database
		else {
			$nim = $this->input->post('nim', TRUE);
			$id_thn_akad = $this->input->post('id_thn_akad', TRUE);
			$kode_matakuliah = $this->input->post('kode_matakuliah', TRUE);

			// Menampung data yang diinputkan 
			$data = array(
				'id_thn_akad' => $id_thn_akad,
				'nim' => $nim,
				'kode_matakuliah' => $kode_matakuliah,
			);
			// Melakukan penyimpanan data 
			$this->Krs->insert($data);

			// Menampilkan data KRS 
			$dataKrs = array(
				'button' => 'Create',
				'judul' => 'Tambah',
				'back'   => site_url('krs_control'),
				'krs_data' => $this->baca_krs($nim, $id_thn_akad),
				'nim' => $nim,
				'id_thn_akad' => $id_thn_akad,
				'thn_akad' => $this->Thn_akad_semester->get_by_id($id_thn_akad)->thn_akad,
				'semester' => $this->Thn_akad_semester->get_by_id($id_thn_akad)->semester == 1 ? 'Ganjil' : 'Genap',
				'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
				'prodi' => $this->Prodi->get_by_id(
					$this->Mahasiswa->get_by_id($nim)->id_prodi
				)->nama_prodi,
			);
			$this->session->set_flashdata('message', 'Create Record Success');

			$this->load->view('header'); // Menampilkan bagian header dan object data users 
			$this->load->view('sidebar'); // Menampilkan bagian header dan object data users 
			$this->load->view('krs/krs_list', $dataKrs); // Menampilkan data KRS
			$this->load->view('footer'); // Menampilkan bagian footer
		}
	}


	// Fungsi untuk melakukan aksi delete data berdasarkan id yang dipilih
	public function delete($id)
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Krs->get_by_id($id);
		$nim = $this->Krs->get_by_id($id)->nim;
		$id_thn_akad = $this->Krs->get_by_id($id)->id_thn_akad;

		//jika id krs (nim dan id_thn_akad) yang dipilih tersedia maka akan dihapus
		if ($row) {
			$this->Krs->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			//redirect(site_url('krs'));
		}
		//jika id  krs (nim dan id_thn_akad) yang dipilih tidak tersedia maka akan muncul pesan 'Record Not Found'
		else {
			$this->session->set_flashdata('message', 'Record Not Found');
		}

		// Menampilkan data KRS
		$dataKrs = array(
			'button' => 'Tambah',
			'back' => site_url('krs'),
			'krs_data' => $this->baca_krs($nim, $id_thn_akad),
			'nim' => $nim,
			'id_thn_akad' => $id_thn_akad,
			'thn_akad' => $this->Thn_akad_semester_model->get_by_id($id_thn_akad)->thn_akad,
			'semester' => $this->Thn_akad_semester_model->get_by_id($id_thn_akad)->semester == 1 ? 'Ganjil' : 'Genap',
			'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
			'prodi' => $this->Prodi->get_by_id(
				$this->Mahasiswa->get_by_id($nim)->id_prodi
			)->nama_prodi,
		);

		$this->load->view('header'); // Menampilkan bagian header dan object data users 
		$this->load->view('sidebar'); // Menampilkan bagian header dan object data users 
		$this->load->view('krs/krs_list', $dataKrs); // Menampilkan data KRS
		$this->load->view('footer'); // Menampilkan bagian footer
	}

	// Fungsi rules atau aturan untuk pengisian pada form KRS
	public function _rulesKrs()
	{
		$this->form_validation->set_rules('nim', 'nim', 'trim|required|');
		$this->form_validation->set_rules('id_thn_akad', 'id_thn_akad', 'trim|required');
	}

	// Fungsi rules atau aturan untuk pengisian pada form (create/input dan update)
	public function _rules()
	{
		$this->form_validation->set_rules('nim', 'nim', 'trim|required');
		$this->form_validation->set_rules('kode_matakuliah', 'kode matakuliah', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
