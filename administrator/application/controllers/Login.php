<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

// Deklarasi pembuatan class Login
class Login extends CI_Controller
{

  // Konstruktor	
  function __construct()
  {
    parent::__construct();
    // Jika session data username dan password sesuai dengan yang ada didalam database 
    // maka halaman admin akan dibuka
    if ($this->session->userdata('username') and $this->session->userdata('password') and $this->session->userdata('level') == 'administrator') {
      redirect(base_url('admin'));
    }
    $this->load->model(array('Akun'));
  }

  // Fungsi untuk menampilkan halaman utama Login
  function index()
  {

    $this->load->view('login'); // Menampilkan halaman utama login
  }

  // Fungsi untuk melakukan proses login
  function proses()
  {
    // Melakukan validasi input username dan password
    $this->form_validation->set_rules('username', 'username', 'required|trim|xss_clean');
    $this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean');

    // Jika validasi input username dan password bernilai false 
    // maka user/admin diminta melakukan input ulang
    if ($this->form_validation->run() == FALSE) {

      $this->load->view('login'); // Menampilkan halaman utama login
    }
    // Jika validasi input username dan password bernilai false 
    // maka user/admin diminta melakukan input ulang
    else {
      // Input username dan password dengan fungsi POST	
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      // Memberi nama variabel baru untuk input username dan password
      $user   = $username;
      $pass   = md5($password);

      // Melakukan cek ke database, apakah username dan password yang diinputkan cocok atau tidak
      $cek    = $this->Akun->cek($user, $pass);

      // Jika username dan password yang diinputkan cocok 
      if ($cek->num_rows() > 0) {

        //Buat session username, email, dan level untuk nantinya ditampilkan
        foreach ($cek->result() as $qad) {
          $sess_data['username'] = $qad->username;
          $sess_data['level']    = $qad->level;
          $this->session->set_userdata($sess_data);
        }

        if ($sess_data['level'] == 'administrator') {
          $this->session->set_flashdata('success', 'Login Berhasil !');
          redirect(base_url('admin'));
        } else {
          $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
          redirect(base_url('login'));
        }
      }
      // Jika username dan password yang diinputkan tidak cocok 
      // maka akan muncul pesan 'Username atau Password yang anda masukkan salah'
      else {
        $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
        redirect(base_url('login'));
      }
    }
  }

  public function Login_berhasil()
  {
    // Menampilkan data berdasarkan id-nya yaitu username
    $row = $this->Akun->get_by_id($this->session->userdata['username']);
    $data = array(
      'univ'     => 'Sekolah Tinggi Teologi Tawangmangu',
      'username' => $row->username,
      'level'    => $row->level,
    );


    $this->load->view('beranda', $data); // Menampilkan halaman utama admin

  }
}
