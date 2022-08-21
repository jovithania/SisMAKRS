<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dosen_control extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Dosen');
		$this->load->model('Jadwal');
		$this->load->model('Mahasiswa');
		$this->load->model('Dosen_pembimbing_model');
		$this->load->model('Akun');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->library('datatables');
	}

	public function index()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('dosen/dosen_list');
		$this->load->view('footer_list');
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Dosen->json();
	}

	public function create()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$data = array(
			'button' => 'Create',
			'action' => site_url('dosen_control/create_action'),
			'back'   => site_url('dosen_control'),
			'nidn' => set_value('nidn'),
			'nama' => set_value('nama'),
			'alamat' => set_value('alamat'),
			'jenis_kelamin' => set_value('jenis_kelamin'),
			'email' => set_value('email'),
			'telp' => set_value('telp'),
		);

		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('dosen/dosen_form', $data);
		$this->load->view('footer');
	}

	public function create_action()
	{

		$dosen = new Dosen();

		$dosen->setNidn($this->input->post('nidn'));
		$dosen->setNama($this->input->post('nama'));
		$dosen->setAlamat($this->input->post('alamat'));
		$dosen->setEmail($this->input->post('email'));
		$dosen->setTelp($this->input->post('telp'));
		$dosen->setJenisKelamin($this->input->post('jenis_kelamin'));

		$dosen->insert(
			$dosen->getNidn(),
			$dosen->getNama(),
			$dosen->getAlamat(),
			$dosen->getEmail(),
			$dosen->getTelp(),
			$dosen->getJenisKelamin()
		);

		$this->session->set_flashdata('message', 'Create Record Success');
		redirect(site_url('dosen_control'));
	}

	public function update($id)
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Dosen->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('dosen_control/update_action'),
				'back'   => site_url('dosen_control'),
				'nidn' => set_value('nidn', $row->nidn),
				'nama' => set_value('nama', $row->nama),
				'alamat' => set_value('alamat', $row->alamat),
				'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
				'email' => set_value('email', $row->email),
				'telp' => set_value('telp', $row->telp),
			);

			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('dosen/dosen_form', $data);
			$this->load->view('footer');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('dosen_control'));
		}
	}

	public function update_action()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('nidn', TRUE));
		} else {
			$data = array(
				'nidn' => $this->input->post('nidn', TRUE),
				'nama' => $this->input->post('nama', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
				'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
				'email' => $this->input->post('email', TRUE),
				'telp' => $this->input->post('telp', TRUE),
			);

			$this->Dosen->update($this->input->post('nidn', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('dosen_control'));
		}
	}

	public function delete($id)
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Dosen->get_by_id($id);

		if ($row) {


			$this->Dosen->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('dosen_control'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('dosen_control'));
		}
	}

	public function update_mahasiswaBA($id)
	{

		$input = $this->input->post('search', TRUE);

		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}
		$row = $this->Dosen->get_by_id_mahasiswaBA($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				//'action' => site_url('Dosen_control/update_action_mahasiswaBA/' . $nidn),
				'back'   => site_url('Dosen'),
				'nidn' => set_value('nidn', $row->nidn),
				'nama_dosen' => set_value('nama_dosen', $row->nama_dosen),

				'id_thn_akad' => set_value('id_thn_akad'),
				'thn_akad' => set_value('thn_akad'),
				'semester' => set_value('semester'),
				'thn_akademik' => $this->Jadwal->get_tahunAkademik(),

				'nim' => set_value('nim'),
				'nama_lengkap' => set_value('nama_lengkap'),
				'mahasiswa' => $this->Dosen->get_mahasiswa(),

				'mahasiswa_bimbingan' => $this->Dosen->get_mahasiswa_bimbingan($row->nidn),
				'mahasiswa_tanpa_dospem' => $this->Dosen->get_noDospem($input),
				'input' => $input,
			);

			$this->load->view('header');
			$this->load->view('sidebar');
			$this->load->view('dosen/update_mahasiswaBA', $data);
			$this->load->view('footer');
		} else {
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('dosen_control'));
		}
	}

	public function update_action_mahasiswaBA()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$data = array(
			// 'id_thn_akad' => $this->input->post('id_thn_akad', TRUE),
			'nidn' => $this->input->post('nidn', TRUE),
			'nim' => $this->input->post('nim', TRUE),
		);

		$this->Dosen->update_mahasiswaBA($this->input->post('nidn', TRUE), $data);
		$this->session->set_flashdata('message', 'Update Record Success');
		redirect(site_url('dosen_control'));
	}

	public function add_mahasiswaBA($nim, $nidn, $id_thn_akad)
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$this->Dosen->addMahasiswa($nim, $nidn, $id_thn_akad);
		$this->session->set_flashdata('message', 'Add Record Success');
		redirect(site_url('dosen_control/update_mahasiswaBA/' . $nidn));
	}

	public function delete_mahasiswaBA($nim, $nidn)
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url("login"));
		}

		$row = $this->Dosen->get_existBimbingan($nidn, $nim);

		if ($row) {
			$this->Dosen->delete_mahasiswaBA($nim, $nidn);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('dosen_control/update_mahasiswaBA/' . $nidn));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('dosen_control/update_mahasiswaBA/' . $nidn));
		}
	}
}
