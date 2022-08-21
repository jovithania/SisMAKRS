<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Thn_akad_semester_control extends CI_Controller
{
	// Konstruktor	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Thn_akad_semester');
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
		$this->load->view('thn_akad_semester/thn_akad_semester_list');
		$this->load->view('footer_list');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Thn_akad_semester->json();
	}


	public function create()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		$data = array(
			'button' => 'Create',
			'back'   => site_url('thn_akad_semester_control'),
			'action' => site_url('thn_akad_semester_control/create_action'),
			'id_thn_akad' => set_value('id_thn_akad'),
			'thn_akad' => set_value('thn_akad'),
			'semester' => set_value('semester'),
		);

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('thn_akad_semester/thn_akad_semester_form', $data);
		$this->load->view('footer');
	}


	public function create_action()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->create();
		$data = array(
			'thn_akad' => $this->input->post('thn_akad', TRUE),
			'semester' => $this->input->post('semester', TRUE),
		);

		$this->Thn_akad_semester->insert($data);
		$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('thn_akad_semester_control'));
	}



	public function update($id)
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		$row = $this->Thn_akad_semester->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'back'   => site_url('thn_akad_semester_control'),
				'action' => site_url('thn_akad_semester_control/update_action'),
				'id_thn_akad' => set_value('id_thn_akad', $row->id_thn_akad),
				'thn_akad' => set_value('thn_akad', $row->thn_akad),
				'semester' => set_value('semester', $row->semester),
			);
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('thn_akad_semester/thn_akad_semester_form', $data);
			$this->load->view('footer');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('thn_akad_semester'));
		}
	}

	public function update_action()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}


		$this->update($this->input->post('id_thn_akad', TRUE));

		$data = array(
			'thn_akad' => $this->input->post('thn_akad', TRUE),
			'semester' => $this->input->post('semester', TRUE),
		);

		$this->Thn_akad_semester->update($this->input->post('id_thn_akad', TRUE), $data);
		$this->session->set_flashdata('message', 'Update Record Success');
		redirect(site_url('thn_akad_semester_control'));
	}



	public function aktif_action($id)
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$rows = $this->Thn_akad_semester->get_by_id($id);


		if ($rows) {

			$this->Thn_akad_semester->update_tidakAktif($id);

			$this->Thn_akad_semester->update_aktif($id);

			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('thn_akad_semester_control'));
		} else {

			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('thn_akad_semester_control'));
		}
	}


	public function delete($id)
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Thn_akad_semester->get_by_id($id);

		if ($row) {
			$this->Thn_akad_semester->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('thn_akad_semester_control'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('thn_akad_semester_control'));
		}
	}
}
