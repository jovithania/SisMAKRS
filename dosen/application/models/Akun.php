<?php

/******************************************************/
/* File        : Akun.php                      */
/* Lokasi File : ./application/models/Akun.php */
/* Copyright   : Yosef Murya & Badiyanto              */
/* Publish     : Penerbit Langit Inspirasi            */
/*----------------------------------------------------*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Akun
class Akun extends CI_Model
{

    // Property yang bersifat public   
    public $table = 'users';
    public $id = 'username';
    public $order = 'DESC';

    // Konstrutor   
    function __construct()
    {
        parent::__construct();
    }

    // Menampilkan semua data berdasarkan id-nya
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
}
