<?php

/*****************************************************/
/* File        : Login.php                           */
/* Lokasi File : ./application/controllers/Login.php */
/* Copyright   : Yosef Murya & Badiyanto             */
/* Publish     : Penerbit Langit Inspirasi           */
/*---------------------------------------------------*/
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
    if (
      $this->session->userdata('username') and $this->session->userdata('password')
      and $this->session->userdata('level')
    ) {

      redirect(site_url('mahasiswa'));
    }
    $this->load->model(array('Login_model'));
  }

  // Fungsi untuk menampilkan halaman utama Login
  function index()
  {

    $this->load->view('login'); // Menampilkan halaman utama login
  }

  // Fungsi untuk melakukan proses login
  function proses()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');


    $user   = $username;
    $pass   = md5($password);


    $cek    = $this->Login_model->cek($user, $pass);

    // Jika username dan password yang diinputkan cocok 
    if ($cek->num_rows() > 0) {

      //Buat session username, email, dan level untuk nantinya ditampilkan
      foreach ($cek->result() as $qad) {
        $sess_data['username'] = $qad->username;
        //$sess_data['email']    = $qad->email;
        $sess_data['level']    = $qad->level;
        $this->session->set_userdata($sess_data);
      }

      ///if($sess_data['level'] == 'user'){
      $this->session->set_flashdata('success', 'Login Berhasil !');
      //echo base_url('mahasiswa/admin');
      redirect(base_url($sess_data['level'] . '/admin'));
      // }
      // else{
      // 	$this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
      // 	redirect(base_url('login'));
      // }
    }
    // Jika username dan password yang diinputkan tidak cocok 
    // maka akan muncul pesan 'Username atau Password yang anda masukkan salah'
    else {
      $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
      //echo "gagal";
      redirect(base_url('login'));
    }
    //}
  }

  function lupa_password()
  {

    $this->load->view('/lupa_password');
  }
}
