<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Nilai_control extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('Akun');
		$this->load->library('form_validation');
		$this->load->helper('my_function');
	}

	public function index()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$rowAdm = $this->Akun->get_by_id($this->session->userdata['username']);
		$dataAdm = array(
			'wa'       => 'Web administrator',
			'univ'     => 'Sekolah Tinggi Teologi Tawangmangu',
			'username' => $rowAdm->username,
			'level'    => $rowAdm->level,
		);

		$data = array(
			'button' => 'Proses',
			'action' => site_url('nilai_control/nilaiKhs_action'),
			'nim' => set_value('nim'),
			'id_thn_akad' => set_value('id_thn_akad'),
		);

		$this->load->view('header', $dataAdm); // Menampilkan bagian header dan object data users 
		$this->load->view('sidebar'); // Menampilkan bagian header dan object data users 
		$this->load->view('nilai/nilaiKhs_form', $data); // Menampilkan halaman utama yaitu form nilai 
		$this->load->view('footer'); // Menampilkan bagian footer
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

			$sql = "SELECT id_thn_akad, kode_matkul kode_matakuliah,
(SELECT nama_matakuliah FROM matakuliah WHERE kode_matakuliah=A.kode_matkul) nama_matakuliah,
sks, nilai
FROM khs A WHERE id_thn_akad='" . $thn_akad . "' AND nim= '" . $nim . "'";
			$query = $this->db->query($sql)->result();

			$smt = $this->db->select('thn_akad, semester')
				->from('thn_akad_semester')
				->where(array('id_thn_akad' => $thn_akad))->get()->row();


			$query_str = "SELECT mahasiswa.nim
, mahasiswa.nama_lengkap
, prodi.nama_prodi
FROM mahasiswa INNER JOIN prodi 
ON (mahasiswa.id_prodi = prodi.id_prodi) 
WHERE nim='" . $nim . "'";
			$mhs = $this->db->query($query_str)->row();


			if ($smt->semester == 1) {
				$tampilSemester = "Ganjil";
			} else {
				$tampilSemester = "Genap";
			}
			$rowAdm = $this->Akun->get_by_id($this->session->userdata['username']);
			$dataAdm = array(
				'wa'       => 'Web administrator',
				'univ'     => 'Sekolah Tinggi Teologi Tawangmangu',
				'username' => $rowAdm->username,
				'level'    => $rowAdm->level,
			);

			$data = array(
				'button' => 'Detail',
				'back'   => site_url('nilai_control'),
				'mhs_data' => $query,
				'mhs_nim' => $nim,
				'mhs_nama' => $mhs->nama_lengkap,
				'mhs_prodi' => $mhs->nama_prodi,
				'thn_akad' => $smt->thn_akad . "(" . $tampilSemester . ")"
			);

			$this->load->view('header', $dataAdm);
			$this->load->view('sidebar');
			$this->load->view('nilai/khs', $data);
			$this->load->view('footer');
		}
	}

	public function _rulesKhs()
	{
		$this->form_validation->set_rules('nim', 'nim', 'trim|required|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('id_thn_akad', 'id_thn_akad', 'trim|required');
	}
}
