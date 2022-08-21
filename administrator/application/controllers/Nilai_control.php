<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Nilai_control extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Akun'); // Memanggil Akun yang terdapat pada models
		$this->load->library('form_validation'); // Memanggil form_validation yang terdapat pada library
		$this->load->helper('my_function'); // Memanggil fungsi my_function yang terdapat pada helper	
	}

	public $table = 'nilai';

	// Fungsi untuk menampilkan halaman nilai 
	public function index()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		// Menampung data yang diberi nilai
		$data = array(
			'button' => 'Proses',
			'action' => site_url('nilai_control/nilaiKhs_action'),
			'nim' => set_value('nim'),
			'id_thn_akad' => set_value('id_thn_akad'),
		);

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('nilai/nilaiKhs_form', $data);
		$this->load->view('footer');
	}


	public function nilaiKhs_action()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->_rulesKhs();

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$nim = $this->input->post('nim', TRUE);
			$thn_akad = $this->input->post('id_thn_akad', TRUE);

			$sql = "SELECT krs.id_thn_akad
						 , krs.kode_matakuliah
						 , matakuliah.nama_matakuliah
						 , matakuliah.sks
						 , krs.nilai
					FROM
					   krs
					INNER JOIN matakuliah 
					ON (krs.kode_matakuliah = matakuliah.kode_matakuliah)
					WHERE krs.nim=$nim AND krs.id_thn_akad=$thn_akad";
			$query = $this->db->query($sql)->result();

			$smt = $this->db->select('thn_akad, semester')
				->from('thn_akad_semester')
				->where(array('id_thn_akad' => $thn_akad))->get()->row();

			$query_str = "SELECT mahasiswa.nim
							 , mahasiswa.nama_lengkap
							 , prodi.nama_prodi
						  FROM
							 mahasiswa
							INNER JOIN prodi 
							ON (mahasiswa.id_prodi = prodi.id_prodi);";
			$mhs = $this->db->query($query_str)->row();

			if ($smt->semester == 1) {
				$tampilSemester = "Ganjil";
			} else {
				$tampilSemester = "Genap";
			}
			$data = array(
				'button' => 'Detail',
				'back'   => site_url('nilai_control'),
				'mhs_data' => $query,
				'mhs_nim' => $nim,
				'mhs_nama' => $mhs->nama_lengkap,
				'mhs_prodi' => $mhs->nama_prodi,
				'thn_akad' => $smt->thn_akad . "(" . $tampilSemester . ")"
			);

			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('nilai/khs', $data);
			$this->load->view('footer');
		}
	}


	public function inputNilai()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		$data = array(
			'button' => 'Proses',
			'back'   => site_url('nilai_control/inputNilai'),
			'action' => site_url('nilai_control/inputNilai_action'),
			'kode_matakuliah' => set_value('kode_matakuliah'),
			'id_thn_akad' => set_value('id_thn_akad'),
		);

		$this->load->view('header'); // Menampilkan bagian header dan object data users	 
		$this->load->view('sidebar'); // Menampilkan bagian header dan object data users	 
		$this->load->view('nilai/inputNilai_form', $data); // Menampilkan halaman form input nilai
		$this->load->view('footer'); // Menampilkan bagian footer
	}

	public function inputNilai_action()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->_rulesInputNilai(); // Rules atau aturan bahwa setiap form harus diisi

		// Jika form nilai belum diisi dengan benar 
		// maka sistem akan meminta user untuk menginput ulang
		if ($this->form_validation->run() == FALSE) {
			$this->inputNilai();
		}
		// Jika form nilai telah diisi dengan benar 
		// maka sistem akan menyimpan kedalam database
		else {
			$kode_mk = $this->input->post('kode_matakuliah', TRUE);
			$id_thn_akad = $this->input->post('id_thn_akad', TRUE);

			$sql = "SELECT nim, (SELECT nama_lengkap FROM mahasiswa WHERE nim = a.nim) nama_lengkap,id_thn_akad, 
			kode_matkul,(SELECT nama_matakuliah FROM matakuliah WHERE kode_matakuliah= a.kode_matkul) nama_matakuliah, 
			nilai
			FROM khs a WHERE id_thn_akad = '" . $id_thn_akad . "' AND a.kode_matkul = '" . $kode_mk . "'";
			$query = $this->db->query($sql)->result();

			// $this->db->select('k.id_krs, k.nim, m.nama_lengkap, k.nilai, d.nama_matakuliah');
			// $this->db->from('krs as k');
			// $this->db->join('mahasiswa as m', 'm.nim = k.nim');
			// $this->db->join('matakuliah as d', 'k.kode_matakuliah = d.kode_matakuliah');
			// $this->db->where('k.id_thn_akad', $id_thn_akad);
			// $this->db->where('k.kode_matakuliah', $kode_mk);
			// $qry = $this->db->get()->result();
			// $qry = $this->db->result();
			//$this->db->query($sql)->result();

			// Menampung data yang diinputkan berdasarkan kode matakuliah dan id tahun akademik
			$data = array(
				'button' => 'Simpan',
				'back'   => site_url('nilai_control/inputNilai'),
				'list_nilai' => $query,
				'action' => site_url('nilai_control/simpan_action'),
				'kode_matakuliah' => $kode_mk,
				'id_thn_akad' => $id_thn_akad
			);

			$this->load->view('header'); // Menampilkan bagian header dan object data users
			$this->load->view('sidebar'); // Menampilkan bagian header dan object data users
			$this->load->view('nilai/listNilai', $data); // Menampilkan halaman list nilai
			$this->load->view('footer'); // Menampilkan bagian footer
		}
	}

	// Fungsi untuk melakukan aksi simpan data
	public function simpan_action()
	{
		// Jika session data username tidak ada maka akan dialihkan kehalaman login			
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		//$nilaiList = array();
		// $id_krs = $_POST['id_krs']; // input data berdasarkan id_krs
		$nim = $_POST['nim'];
		$id_thn_akad = $_POST['id_thn_akad'];
		$kode_matakuliah = $_POST['kode_matkul'];
		$nilai  = $_POST['nilai'];  // input data berdasarkan nilai

		for ($i = 0; $i < sizeof($nim); $i++) {
			$konversi = 0;
			if ($nilai[$i] == 'A') {
				$konversi = 4;
			} elseif ($nilai[$i] == 'AB') {
				$konversi = 3.5;
			} elseif ($nilai[$i] == 'B') {
				$konversi = 3;
			} elseif ($nilai[$i] == 'BC') {
				$konversi = 2.5;
			} elseif ($nilai[$i] == 'C') {
				$konversi = 2;
			} elseif ($nilai[$i] == 'CD') {
				$konversi = 1.5;
			} elseif ($nilai[$i] == 'D') {
				$konversi = 1;
			} else {
				$konversi = 0;
			}

			$set = array(
				'nilai' => $nilai[$i],
				'konversi' => $konversi
			);
			$array = array(
				'nim' => $nim[$i],
				'id_thn_akad' => $id_thn_akad[$i],
				'kode_matkul' => $kode_matakuliah[$i]
			);

			$this->db->set($set)->where($array)->update('khs');
		}

		// // Menampung data yang diinputkan	
		// $data = array(
		// 	// 'id_krs' => $id_krs,
		// 	'button' => 'Input',
		// 	'back'   => site_url('nilai_control/inputNilai'),
		// );


		// $this->load->view('header'); // Menampilkan bagian header dan object data users 	
		// $this->load->view('sidebar'); // Menampilkan bagian header dan object data users 	
		// $this->load->view('nilai/nilai', $data); // Menampilkan halaman form nilai
		// $this->load->view('footer'); // Menampilkan bagian footer

		$data = array(
			'button' => 'Simpan',
			'back'   => site_url('nilai_control/inputNilai'),
			'action' => site_url('nilai_control/inputNilai_action'),
			'kode_matakuliah' => set_value($kode_matakuliah[0]),
			'id_thn_akad' => set_value($id_thn_akad[0]),
		);

		$this->load->view('header'); // Menampilkan bagian header dan object data users	 
		$this->load->view('sidebar'); // Menampilkan bagian header dan object data users	 
		$this->load->view('nilai/inputNilai_form', $data); // Menampilkan halaman form input nilai
		// $this->load->view('nilai/nilai', $data); // Menampilkan halaman form input nilai
		$this->load->view('footer'); // Menampilkan bagian footer
	}

	public function _rulesInputNilai()
	{
		$this->form_validation->set_rules('kode_matakuliah', 'kode_matakuliah', 'trim|required');
		$this->form_validation->set_rules('id_thn_akad', 'id_thn_akad', 'trim|required');
	}

	// Fungsi rules atau aturan untuk pengisian pada form (create/input dan update) KHS
	public function _rulesKhs()
	{
		$this->form_validation->set_rules('nim', 'nim', 'trim|required|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('id_thn_akad', 'id_thn_akad', 'trim|required');
	}
}
