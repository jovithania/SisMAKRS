<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Dosen
class Dosen extends CI_Model
{

    public $table = 'dosen';
    public $id = 'nidn';
    public $order = 'DESC';

    private  $nidn;
    private  $nama;
    private  $alamat;
    private  $email;
    private  $telp;
    private  $jenis_kelamin;


    function setNidn($nidn)
    {
        $this->nidn = $nidn;
    }

    function setNama($nama)
    {
        $this->nama = $nama;
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

    function getNidn()
    {
        return $this->nidn;
    }

    function getNama()
    {
        return $this->nama;
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

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('nidn, nama, alamat, jenis_kelamin, email, telp');
        $this->datatables->from('dosen');
        $this->datatables->add_column(
            'action',
            anchor(site_url('dosen_control/update/$1'), '<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>') . "  " .
                anchor(site_url('dosen_control/update_mahasiswaBA/$1'), '<button type="button" class="btn btn-primary"><i class="fa fa-users" aria-hidden="true"></i></button>') . "  " .
                anchor(site_url('dosen_control/delete/$1'), '<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'),
            'nidn'
        );
        return $this->datatables->generate();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function insert($nidn, $nama, $alamat, $email, $telp, $jenis_kelamin)
    {

        $data = array(
            'nidn' => $nidn,
            'nama' => $nama,
            'alamat' => $alamat,
            'email' => $email,
            'telp' => $telp,
            'jenis_kelamin' => $jenis_kelamin,
        );

        $this->db->insert($this->table, $data);

        $this->db->query("INSERT INTO users (username, password, level)
        VALUES ('" . $data['nidn'] . "','" . md5($data['nidn']) . "','dosen')");

        $this->db->query("INSERT INTO dospem (nidn)
        VALUES ('" . $data['nidn'] . "')");
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_mahasiswa_bimbingan($nidn)
    {
        $this->db->select('nim,(SELECT nama_lengkap FROM mahasiswa WHERE nim=a.nim) nama_mahasiswa');
        $this->db->from('dospem a');
        $this->db->where('a.nidn', $nidn);
        $mahasiswa_bimbingan = $this->db->get()->result();
        return $mahasiswa_bimbingan;
    }

    function get_by_id_mahasiswaBA($id)
    {
        $this->db->select("a.nidn, (SELECT nama FROM dosen WHERE nidn=a.nidn) nama_dosen");
        $this->db->from('dospem a');
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    function get_mahasiswa()
    {
        $sql = " SELECT nim, nama_lengkap FROM mahasiswa";
        return $this->db->query($sql)->result();
    }

    function get_existBimbingan($id, $nim)
    {
        $this->db->select("a.nidn, (SELECT nama FROM dosen WHERE nidn=a.nidn) nama_dosen");
        $this->db->from('dospem a');
        $this->db->where($this->id, $id);
        $this->db->where('nim', $nim);
        return $this->db->get()->row();
    }

    function addMahasiswa($nim, $nidn, $id_thn_akad)
    {
        $data = array(
            'nidn' => $nidn,
            'nim' => $nim,
            // 'id_thn_akad' => $id_thn_akad,
        );

        $this->db->insert('dospem', $data);
    }

    function update_mahasiswaBA($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update('dospem', $data);
    }

    function delete_mahasiswaBA($nim, $nidn)
    {
        $this->db->where('nim', $nim);
        $this->db->where($this->id, $nidn);
        $this->db->delete('dospem');
    }

    function get_noDospem($id)
    {
        $sql = "SELECT nim, nama_lengkap nama_mahasiswa FROM mahasiswa WHERE nim NOT IN (SELECT nim FROM dospem) ";
        if ($id != '') {
            $sql .= "AND nim LIKE '%" . $id . "%'";
        }

        return $this->db->query($sql)->result();
    }
}
