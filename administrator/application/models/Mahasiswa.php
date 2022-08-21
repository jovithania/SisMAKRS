<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mahasiswa extends CI_Model
{
    public $table = 'mahasiswa';
    public $id = 'nim';
    public $order = 'DESC';


    private  $nim;
    private  $nama_lengkap;
    private  $alamat;
    private  $email;
    private  $telp;
    private  $jenis_kelamin;
    private  $id_prodi;

    function __construct()
    {
        parent::__construct();
    }

    function setNim($nim)
    {
        $this->nim = $nim;
    }

    function setNamaLengkap($nama_lengkap)
    {
        $this->nama_lengkap = $nama_lengkap;
    }

    function setAlamat($alamat)
    {
        $this->alamat = $alamat;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setTelp($telp)
    {
        $this->telp = $telp;
    }

    function setJenisKelamin($jenis_kelamin)
    {
        $this->jenis_kelamin = $jenis_kelamin;
    }

    function setProdi($id_prodi)
    {
        $this->id_prodi = $id_prodi;
    }

    function getNim()
    {
        return $this->nim;
    }

    function getNamaLengkap()
    {
        return $this->nama_lengkap;
    }

    function getAlamat()
    {
        return $this->alamat;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getTelp()
    {
        return $this->telp;
    }

    function getJenisKelamin()
    {
        return $this->jenis_kelamin;
    }

    function getProdi()
    {
        return $this->id_prodi;
    }

    function json()
    {
        $this->datatables->select("nim, nama_lengkap, alamat, email, telp, IF(jenis_kelamin = 'P', 'Perempuan', 'Laki-laki') as jenisKelamin", "id_prodi");
        $this->datatables->from('mahasiswa');
        $this->datatables->add_column('action', anchor(site_url('mahasiswa_control/update/$1'), '<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>') . "  " . anchor(site_url('mahasiswa_control/delete/$1'), '<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'nim');
        return $this->datatables->generate();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_mahasiswa($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // function get_by_id($nim)
    // {
    //     $this->db->where('mahasiswa', $nim);
    //     // return $this->db->get('mahasiswa')->row();
    //     return $this->db->get('mahasiswa');
    // }


    function insert($nim, $nama_lengkap, $alamat, $email, $telp, $jenis_kelamin, $id_prodi)
    {
        $data = array(
            'nim' => $nim,
            'nama_lengkap' => $nama_lengkap,
            'alamat' => $alamat,
            'email' => $email,
            'telp' => $telp,
            'jenis_kelamin' => $jenis_kelamin,
            'id_prodi' => $id_prodi,
        );

        $this->db->insert($this->table, $data);
        $this->db->query("INSERT INTO users (username, password, level)
        VALUES ('" . $data['nim'] . "','" . md5($data['nim']) . "','mahasiswa')");
        return true;
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        return true;
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return true;
    }

    function delete_user($id)
    {
        $this->db->where('username', $id);
        $this->db->delete('users');
        return true;
    }
}
