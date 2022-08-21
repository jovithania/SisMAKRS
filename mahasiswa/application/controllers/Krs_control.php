<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Krs_control extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Krs');
		$this->load->model('Mahasiswa');
		$this->load->model('Prodi');
		$this->load->model('Thn_akad_semester');
		$this->load->model('Akun');
		$this->load->model('Matakuliah');
		$this->load->library('form_validation');
	}

	public function isi_krs()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$nim = $this->session->userdata['username'];
		$thn_akad = $this->Thn_akad_semester->get_aktif()->id_thn_akad;

		$dataKrs = array(
			'button' => 'Create',
			'back'   => site_url('krs_control/isi_krs'),
			'krs_data' => $this->baca_krs($nim, $thn_akad),
			'nim' => $nim,
			'id_thn_akad' => $thn_akad,
			'thn_akad' => $this->Thn_akad_semester->get_by_id($thn_akad)->thn_akad,
			'semester' => $this->Thn_akad_semester->get_by_id($thn_akad)->semester % 2 == 0 ? 'Genap' : 'Ganjil',
			'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
			'prodi' => $this->Prodi->get_by_id($this->Mahasiswa->get_by_id($nim)->id_prodi)->nama_prodi,
			'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
		);

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('krs/krs_list', $dataKrs);
		$this->load->view('footer');
	}
	// public function isi_krs()
	// {
	// 	if (!isset($this->session->userdata['username'])) {
	// 		redirect(base_url("login"));
	// 	}

	// 	$nim = $this->session->userdata['username'];
	// 	$thn_akad = $this->Thn_akad_semester->get_aktif()->id_thn_akad;

	// 	$dataKrs = array(
	// 		'button' => 'Create',
	// 		'back'   => site_url('krs_control'),
	// 		'krs_data' => $this->baca_krs($nim, $thn_akad),
	// 		'nim' => $nim,
	// 		'id_thn_akad' => $thn_akad,
	// 		'thn_akad' => $this->Thn_akad_semester->get_by_id($thn_akad)->thn_akad,
	// 		'semester' => $this->Thn_akad_semester->get_by_id($thn_akad)->semester % 2 == 0 ? 'Genap' : 'Ganjil',
	// 		'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
	// 		'prodi' => $this->Prodi->get_by_id($this->Mahasiswa->get_by_id($nim)->id_prodi)->nama_prodi,
	// 		'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
	// 	);

	// 	$this->load->view('header');
	// 	$this->load->view('sidebar');
	// 	$this->load->view('krs/krs_list', $dataKrs);
	// 	$this->load->view('footer');
	// }


	public function index()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$nim = $this->session->userdata['username'];
		$thn_akad = $this->Thn_akad_semester->get_aktif()->id_thn_akad;

		$dataKrs = array(
			// 'button' => 'Create',
			'back'   => site_url('krs_control'),
			'krs_data' => $this->baca_krs($nim, $thn_akad),
			'nim' => $nim,
			'id_thn_akad' => $thn_akad,
			'thn_akad' => $this->Thn_akad_semester->get_by_id($thn_akad)->thn_akad,
			'semester' => $this->Thn_akad_semester->get_by_id($thn_akad)->semester % 2 == 0 ? 'Genap' : 'Ganjil',
			'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
			'prodi' => $this->Prodi->get_by_id($this->Mahasiswa->get_by_id($nim)->id_prodi)->nama_prodi,
			'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
		);

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('krs/lihat_krs', $dataKrs);
		$this->load->view('footer');
	}

	public function baca_krs($nim, $thn_akad)
	{

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

	public function create($nim, $th, $sisa_sks)
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$cekRow = $this->Krs->get_checkJadwal();
		$cek = 'T';
		if ($cekRow) {
			$cek = $cekRow->cek;
		}
		if ($cek == 'T') {
			echo "<script> alert('Jadwal KRS belum aktif');</script>";

			$nim = $this->session->userdata['username'];
			$thn_akad = $this->Thn_akad_semester->get_aktif()->id_thn_akad;

			$dataKrs = array(
				'button' => 'Create',
				'back'   => site_url('krs_control'),
				'krs_data' => $this->baca_krs($nim, $thn_akad),
				'nim' => $nim,
				'id_thn_akad' => $thn_akad,
				'thn_akad' => $this->Thn_akad_semester->get_by_id($thn_akad)->thn_akad,
				'semester' => $this->Thn_akad_semester->get_by_id($thn_akad)->semester % 2 == 0 ? 'Genap' : 'Ganjil',
				'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
				'prodi' => $this->Prodi->get_by_id($this->Mahasiswa->get_by_id($nim)->id_prodi)->nama_prodi,
				'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
			);

			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('krs/krs_list', $dataKrs);
			$this->load->view('footer');
		} else {
			$data = array(
				'button' => 'Create',
				'judul' => 'Tambah',
				'back'   => site_url('krs_control'),
				'action' => site_url('krs_control/create_action'),
				'id_krs' => set_value('id_krs'),
				'id_thn_akad' => $th,
				'thn_akad_smt' => $this->Thn_akad_semester->get_by_id($th)->thn_akad,
				'semester' => $this->Thn_akad_semester->get_by_id($th)->semester == 1 ? 'Ganjil' : 'Genap',
				'nim' => $nim,
				'kode_matakuliah' => set_value('kode_matakuliah'),
				'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
				'sisa_sks' => $sisa_sks,
				'semester_matkul' => $this->Krs->get_semesterMataKuliah(),

			);

			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('krs/krs_form', $data);
			$this->load->view('footer');
		}
	}
	// public function create($nim, $th, $sisa_sks)
	// {
	// 	if (!isset($this->session->userdata['username'])) {
	// 		redirect(base_url("login"));
	// 	}

	// 	$cekRow = $this->Krs->get_checkJadwal();
	// 	$cek = 'T';
	// 	if ($cekRow) {
	// 		$cek = $cekRow->cek;
	// 	}
	// 	if ($cek == 'T') {
	// 		echo "<script> alert('Jadwal KRS belum aktif');</script>";

	// 		$nim = $this->session->userdata['username'];
	// 		$thn_akad = $this->Thn_akad_semester->get_aktif()->id_thn_akad;

	// 		$dataKrs = array(
	// 			'button' => 'Create',
	// 			'back'   => site_url('krs_control'),
	// 			'krs_data' => $this->baca_krs($nim, $thn_akad),
	// 			'nim' => $nim,
	// 			'id_thn_akad' => $thn_akad,
	// 			'thn_akad' => $this->Thn_akad_semester->get_by_id($thn_akad)->thn_akad,
	// 			'semester' => $this->Thn_akad_semester->get_by_id($thn_akad)->semester % 2 == 0 ? 'Genap' : 'Ganjil',
	// 			'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
	// 			'prodi' => $this->Prodi->get_by_id($this->Mahasiswa->get_by_id($nim)->id_prodi)->nama_prodi,
	// 			'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
	// 		);

	// 		$this->load->view('header');
	// 		$this->load->view('sidebar');
	// 		$this->load->view('krs/krs_list', $dataKrs);
	// 		$this->load->view('footer');
	// 	}

	// 	$data = array(
	// 		'button' => 'Create',
	// 		'judul' => 'Tambah',
	// 		'back'   => site_url('krs_control'),
	// 		'action' => site_url('krs_control/create_action'),
	// 		'id_krs' => set_value('id_krs'),
	// 		'id_thn_akad' => $th,
	// 		'thn_akad_smt' => $this->Thn_akad_semester->get_by_id($th)->thn_akad,
	// 		'semester' => $this->Thn_akad_semester->get_by_id($th)->semester == 1 ? 'Ganjil' : 'Genap',
	// 		'nim' => $nim,
	// 		'kode_matakuliah' => set_value('kode_matakuliah'),
	// 		'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
	// 		'sisa_sks' => $sisa_sks,
	// 		'semester_matkul' => $this->Krs->get_semesterMataKuliah(),

	// 	);
	// 	$this->load->view('header');
	// 	$this->load->view('sidebar');
	// 	$this->load->view('krs/krs_form', $data);
	// 	$this->load->view('footer');
	// }

	public function create_action()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$nim = $this->input->post('nim', TRUE);
		$id_thn_akad = $this->input->post('id_thn_akad', TRUE);
		$kode_matakuliah = $this->input->post('kode_matakuliah', TRUE);
		$sisa_sks = $this->input->post('sisa_sks', TRUE);

		$sks_matkul = $this->Matakuliah->get_by_id($kode_matakuliah)->sks;
		$sisa_sks2 = $sisa_sks - $sks_matkul;
		$exist = $this->Krs->get_checkExist($nim, $id_thn_akad, $kode_matakuliah)->exist;
		$prasyarat = $this->Krs->get_checkPrasyarat($nim, $kode_matakuliah)->prasyarat;
		// echo $prasyarat;

		// $validasi = $this->Krs->get_checkStatusValidasi($nim)->validasi;
		// if ($sisa_sks2 >= 0 && $exist == 0 && $prasyarat > 0 && $validasi == 'T') {

		if ($sisa_sks2 >= 0 && $exist == 0 && $prasyarat > 0) {

			$data = array(
				'id_thn_akad' => $id_thn_akad,
				'nim' => $nim,
				'kode_matakuliah' => $kode_matakuliah,
			);

			$this->Krs->insert($data);
			$this->Krs->insertValidasi($nim);

			echo "<script> alert('Mata Kuliah Berhasil ditambahkan!');</script>";
		} else if ($sisa_sks2 < 0) {
			echo "<script> alert('Limit SKS tidak mencukupi');</script>";
		} else if ($exist > 0) {
			echo "<script> alert('Mata Kuliah Sudah Pernah ditambahkan');</script>";
		} else if ($prasyarat == 0) {
			echo "<script> alert('Mata Kuliah Prasyarat belum diambil');</script>";
		}
		// } else if ($validasi == 'Y') {
		// 	echo "<script> alert('KRS Sudah Disetujui, tidak dapat melakukan perubahan');</script>";
		// }
		// else {
		// 	echo "<script> alert('Unknown Error');</script>";
		// }
		// redirect(site_url('krs_control'));

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
			'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
			'sisa_sks' => $sisa_sks,
		);

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('krs/krs_list', $dataKrs);
		$this->load->view('footer');
	}


	public function delete($id)
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$cekRow = $this->Krs->get_checkJadwal();
		$cek = 'T';
		if ($cekRow) {
			$cek = $cekRow->cek;
		}

		if ($cek == 'T') {
			echo "<script> alert('Jadwal KRS belum aktif');</script>";

			$nim = $this->session->userdata['username'];
			$thn_akad = $this->Thn_akad_semester->get_aktif()->id_thn_akad;

			$dataKrs = array(
				'button' => 'Create',
				'back'   => site_url('krs'),
				'krs_data' => $this->baca_krs($nim, $thn_akad),
				'nim' => $nim,
				'id_thn_akad' => $thn_akad,
				'thn_akad' => $this->Thn_akad_semester->get_by_id($thn_akad)->thn_akad,
				'semester' => $this->Thn_akad_semester->get_by_id($thn_akad)->semester % 2 == 0 ? 'Genap' : 'Ganjil',
				'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
				'prodi' => $this->Prodi->get_by_id(
					$this->Mahasiswa->get_by_id($nim)->id_prodi
				)->nama_prodi,
				'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
			);

			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('krs/krs_list', $dataKrs);
			$this->load->view('footer');
		} else {

			$row = $this->Krs->get_by_id($id);
			$nim = $this->Krs->get_by_id($id)->nim;
			$id_thn_akad = $this->Krs->get_by_id($id)->id_thn_akad;

			if ($row) {
				$this->Krs->delete($id);
				echo "<script> alert('Mata Kuliah Berhasil Dihapus!');</script>";
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
			}

			$dataKrs = array(
				'button' => 'Tambah',
				'back' => site_url('krs'),
				'krs_data' => $this->baca_krs($nim, $id_thn_akad),
				'nim' => $nim,
				'id_thn_akad' => $id_thn_akad,
				'thn_akad' => $this->Thn_akad_semester->get_by_id($id_thn_akad)->thn_akad,
				'semester' => $this->Thn_akad_semester->get_by_id($id_thn_akad)->semester == 1 ? 'Ganjil' : 'Genap',
				'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
				'prodi' => $this->Prodi->get_by_id(
					$this->Mahasiswa->get_by_id($nim)->id_prodi
				)->nama_prodi,
				'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
			);

			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('krs/krs_list', $dataKrs);
			$this->load->view('footer');
		}
	}

	// public function index()
	// {
	// 	if (!isset($this->session->userdata['username'])) {
	// 		redirect(base_url("login"));
	// 	}

	// 	$nim = $this->session->userdata['username'];
	// 	$thn_akad = $this->Thn_akad_semester->get_aktif()->id_thn_akad;

	// 	$dataKrs = array(
	// 		'button' => 'Create',
	// 		'back'   => site_url('krs_control'),
	// 		'krs_data' => $this->baca_krs($nim, $thn_akad),
	// 		'nim' => $nim,
	// 		'id_thn_akad' => $thn_akad,
	// 		'thn_akad' => $this->Thn_akad_semester->get_by_id($thn_akad)->thn_akad,
	// 		'semester' => $this->Thn_akad_semester->get_by_id($thn_akad)->semester % 2 == 0 ? 'Genap' : 'Ganjil',
	// 		'nama_lengkap' => $this->Mahasiswa->get_by_id($nim)->nama_lengkap,
	// 		'prodi' => $this->Prodi->get_by_id($this->Mahasiswa->get_by_id($nim)->id_prodi)->nama_prodi,
	// 		'limit_sks' => $this->Mahasiswa->get_by_id($nim)->jumlah_sks_ambil,
	// 	);

	// 	$this->load->view('header');
	// 	$this->load->view('sidebar');
	// 	$this->load->view('krs/krs_list', $dataKrs);
	// 	$this->load->view('footer');
	// }
}
