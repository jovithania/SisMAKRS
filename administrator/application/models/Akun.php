<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Users
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

    // Tabel data dengan nama users
    function json()
    {
        $this->datatables->select('username,password,level,blokir,id_sessions');
        $this->datatables->from('users');
        $this->datatables->add_column('action', anchor(site_url('akun_control/update/$1'), '<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>') . "  " . anchor(site_url('users/delete/$1'), '<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'username');
        return $this->datatables->generate();
    }

    // Fungsi untuk melakukan cek username dan password pada database
    function cek($username, $password)
    {
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        return $this->db->get("users");
    }

    // Jika username dan password cocok 
    function getLoginData($user, $pass)
    {
        $u = $user;
        $p = md5($pass);
        $query_cekLogin = $this->db->get_where('users', array('username' => $u, 'password' => $p));
        if (count($query_cekLogin->result()) > 0) {
            foreach ($query_cekLogin->result() as $qck) {
                foreach ($query_cekLogin->result() as $qad) {
                    $sess_data['logged_in'] = TRUE;
                    $sess_data['username'] = $qad->username;
                    $sess_data['password'] = $qad->password;
                    $sess_data['level'] = $qad->level;
                    $this->session->set_userdata($sess_data);
                }
                redirect('admin');
            }
        } else {
            // Jika username dan password tidak cocok
            $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
            header('location:' . base_url() . 'login');
        }
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // menampilkan jumlah data	
    // function total_rows($q = NULL)
    // {
    //     $this->db->like('username', $q);
    //     $this->db->or_like('username', $q);
    //     $this->db->or_like('password', $q);
    //     $this->db->or_like('level', $q);
    //     $this->db->or_like('blokir', $q);
    //     $this->db->or_like('id_sessions', $q);
    //     $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }

    // Menampilkan data dengan jumlah limit
    // function get_limit_data($limit, $start = 0, $q = NULL)
    // {
    //     $this->db->order_by($this->id, $this->order);
    //     $this->db->like('username', $q);
    //     $this->db->or_like('username', $q);
    //     $this->db->or_like('password', $q);
    //     $this->db->or_like('level', $q);
    //     $this->db->or_like('blokir', $q);
    //     $this->db->or_like('id_sessions', $q);
    //     $this->db->limit($limit, $start);
    //     return $this->db->get($this->table)->result();
    // }

    // Menambahkan data kedalam database
    // function insert($data)
    // {
    //     $this->db->insert($this->table, $data);
    // }

    // Merubah data kedalam database
    // function update($id, $data)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->update($this->table, $data);
    // }

    // Menghapus data kedalam database
    // function delete($id)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->delete($this->table);
    // }
}
