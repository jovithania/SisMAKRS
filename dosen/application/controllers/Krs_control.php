<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Krs_control extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa');
        $this->load->model('Akun');
        $this->load->model('Krs');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->load->library('datatables');
    }

    public function index()
    {

        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }


        $rowAdm = $this->Akun->get_by_id($this->session->userdata['username']);

        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('mahasiswa/mahasiswa_list');
        $this->load->view('footer_list');
    }

    public function json($nidn)
    {
        header('Content-Type: application/json');
        echo $this->Krs->json($nidn);
    }

    public function lihatKrs()
    {
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $nim = $_POST['nim'];
        echo $this->Krs->get_krsMahasiswa($nim);
    }

    public function validasi($nim)
    {
        if (!isset($this->session->userdata['username'])) {
            redirect(base_url("login"));
        }

        $cekRow = $this->Krs->get_checkJadwal();
        $cek = 'T';
        $tahun = '1';
        if ($cekRow) {
            $cek = $cekRow->cek;
            $tahun = $cekRow->id_thn_akad;
        }
        if ($cek == 'T') {

            $this->session->set_flashdata('message', 'Validasi KRS Belum Aktif');
            redirect(site_url('krs_control'));
        } else {

            $this->Krs->updateValidasi($nim, $tahun, 'Y');
            redirect(site_url('krs_control'));
        }
    }

    public function batal_validasi($nim)
    {

        $cek = $this->Krs->get_checkJadwal()->cek;
        $tahun = $this->Krs->get_checkJadwal()->id_thn_akad;

        if ($cek == 'T') {

            $this->session->set_flashdata('message', 'Validasi KRS Belum Aktif');
            redirect(site_url('krs_control'));
        } else {
            $this->Krs->updateValidasi($nim, $tahun, 'T');
            redirect(site_url('krs_control'));
        }
    }
}
