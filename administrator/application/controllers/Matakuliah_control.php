<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

// Deklarasi pembuatan class Matakuliah
class Matakuliah_control extends CI_Controller
{
	// Konstruktor	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Matakuliah');
		$this->load->model('Akun');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}


	public function index()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('matakuliah/matakuliah_list');
		$this->load->view('footer_list');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Matakuliah->json();
	}


	public function read($id)
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$sql   = "SELECT * FROM prodi, matakuliah 
		          WHERE prodi.id_prodi = matakuliah.id_prodi
				  AND matakuliah.kode_matakuliah = '$id'";
		$row = $this->db->query($sql)->row();


		if ($row) {

			$data = array(
				'button' => 'Read',
				'back'   => site_url('matakuliah'),
				'kode_matakuliah' => $row->kode_matakuliah,
				'nama_matakuliah' => $row->nama_matakuliah,
				'sks' => $row->sks,
				'semester' => $row->semester,
				'jenis' => $row->jenis,
				'nama_prodi' => $row->nama_prodi,
				'kode_prasyarat' => $row->kode_prasyarat,
			);

			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('matakuliah/matakuliah_read', $data);
			$this->load->view('footer');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('matakuliah_control'));
		}
	}


	public function create()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$data = array(
			'button' => 'Create',
			'back'   => site_url('matakuliah_control'),
			'action' => site_url('matakuliah_control/create_action'),
			'kode_matakuliah' => set_value('kode_matakuliah'),
			'nama_matakuliah' => set_value('nama_matakuliah'),
			'sks' => set_value('sks'),
			'semester' => set_value('semester'),
			'jenis' => set_value('jenis'),
			'id_prodi' => set_value('id_prodi'),
			'kode_prasyarat' => set_value('kode_prasyarat'),
		);

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('matakuliah/matakuliah_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{
		$this->Matakuliah->insert();
		$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('matakuliah_control'));
	}

	public function update($id)
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Matakuliah->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'back'   => site_url('matakuliah_control'),
				'action' => site_url('matakuliah_control/update_action'),
				'kode_matakuliah' => set_value('kode_matakuliah', $row->kode_matakuliah),
				'nama_matakuliah' => set_value('nama_matakuliah', $row->nama_matakuliah),
				'sks' => set_value('sks', $row->sks),
				'semester' => set_value('semester', $row->semester),
				'jenis' => set_value('jenis', $row->jenis),
				'id_prodi' => set_value('id_prodi', $row->id_prodi),
				'kode_prasyarat' => set_value('kode_prasyarat', $row->kode_prasyarat),
			);
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('matakuliah/matakuliah_form', $data);
			$this->load->view('footer');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('matakuliah_control'));
		}
	}

	// public function update_action()
	// {

	// 	$data = array(
	// 		'kode_matakuliah' => $this->input->post('kode_matakuliah', TRUE),
	// 		'nama_matakuliah' => $this->input->post('nama_matakuliah', TRUE),
	// 		'sks' => $this->input->post('sks', TRUE),
	// 		'semester' => $this->input->post('semester', TRUE),
	// 		'jenis' => $this->input->post('jenis', TRUE),
	// 		'id_prodi' => $this->input->post('id_prodi', TRUE),
	// 		'kode_prasyarat' => $this->input->post('kode_prasyarat', TRUE),
	// 	);

	// 	$this->Matakuliah->update($this->input->post('kode_matakuliah', TRUE), $data);
	// 	$this->session->set_flashdata('message', 'Update Record Success');
	// 	redirect(site_url('matakuliah_control'));
	// }
	public function update_action()
	{

		$this->Matakuliah->update($this->input->post('kode_matakuliah', TRUE));
		$this->session->set_flashdata('message', 'Update Record Success');
		redirect(site_url('matakuliah_control'));
	}

	public function delete($id)
	{
		$row = $this->Matakuliah->get_by_id($id);

		if ($row) {
			$this->Matakuliah->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('matakuliah_control'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('matakuliah_control'));
		}
	}
}
