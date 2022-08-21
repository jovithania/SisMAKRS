<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Mahasiswa_control extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa');
		$this->load->model('Akun');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->library('datatables');
	}

	public function index()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('mahasiswa/mahasiswa_list');
		$this->load->view('footer');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Mahasiswa->json();
	}

	public function create()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$data = array(
			'button' => 'Create',
			'back'   => site_url('mahasiswa_control'),
			'action' => site_url('mahasiswa_control/create_action'),
			'nim' => set_value('nim'),
			'nama_lengkap' => set_value('nama_lengkap'),
			'alamat' => set_value('alamat'),
			'email' => set_value('email'),
			'telp' => set_value('telp'),
			'jenis_kelamin' => set_value('jenis_kelamin'),
			'id_prodi' => set_value('id_prodi')
		);

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('mahasiswa/mahasiswa_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$mahasiswa = new Mahasiswa();

		$mahasiswa->setNim($this->input->post('nim'));
		$mahasiswa->setNamaLengkap($this->input->post('nama_lengkap'));
		$mahasiswa->setAlamat($this->input->post('alamat'));
		$mahasiswa->setEmail($this->input->post('email'));
		$mahasiswa->setTelp($this->input->post('telp'));
		$mahasiswa->setJenisKelamin($this->input->post('jenis_kelamin'));
		$mahasiswa->setProdi($this->input->post('id_prodi'));

		$mahasiswa->insert(
			$mahasiswa->getNim(),
			$mahasiswa->getNamaLengkap(),
			$mahasiswa->getAlamat(),
			$mahasiswa->getEmail(),
			$mahasiswa->getTelp(),
			$mahasiswa->getJenisKelamin(),
			$mahasiswa->getProdi()
		);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Create Record Success</strong></div>');
		redirect(site_url('mahasiswa_control'));
	}

	public function update($id)
	{

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Mahasiswa->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'back'   => site_url('mahasiswa_control'),
				'action' => site_url('mahasiswa_control/update_action'),
				'nim' => set_value('nim', $row->nim),
				'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
				'alamat' => set_value('alamat', $row->alamat),
				'email' => set_value('email', $row->email),
				'telp' => set_value('telp', $row->telp),
				'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
				'id_prodi' => set_value('id_prodi', $row->id_prodi),
			);
			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('mahasiswa/mahasiswa_form', $data);
			$this->load->view('footer');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('mahasiswa'));
		}
	}

	public function update_action()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		$data = array(
			'nim' => $this->input->post('nim', TRUE),
			'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
			'alamat' => $this->input->post('alamat', TRUE),
			'email' => $this->input->post('email', TRUE),
			'telp' => $this->input->post('telp', TRUE),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
			'id_prodi' => $this->input->post('id_prodi', TRUE),
		);

		$this->Mahasiswa->update($this->input->post('nimAwal', TRUE), $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Update Record Success</strong></div>');
		redirect(site_url('mahasiswa_control'));
	}

	public function delete($nim)
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Mahasiswa->get_by_id($nim);

		if ($row) {

			$this->Mahasiswa->setNim($nim);

			$this->Mahasiswa->delete($this->Mahasiswa->getNim());
			$this->Mahasiswa->delete_user($nim);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete Record Success</div>');
			redirect(site_url('mahasiswa_control'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('mahasiswa_control'));
		}
	}
}
