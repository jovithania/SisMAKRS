<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Matakuliah extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function json()
    {
        $this->datatables->select("m.kode_matakuliah, m.nama_matakuliah, p.nama_prodi, m.jenis, (CASE WHEN m.jenis ='U' THEN 'Umum' WHEN m.jenis ='W' THEN 'Wajib' ELSE 'Pilihan' END) as namaJenis");
        $this->datatables->from(' matakuliah as m');
        //add this line for join
        $this->datatables->join('prodi as p', 'm.id_prodi= p.id_prodi');
        $this->datatables->add_column(
            'action',
            anchor(site_url('matakuliah_control/read/$1'), '<button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button>') . "  " .
                anchor(site_url('matakuliah_control/update/$1'), '<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>') . "  " .
                anchor(site_url('matakuliah_control/delete/$1'), '<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'),
            'kode_matakuliah'
        );
        return $this->datatables->generate();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }


    function insert()
    {
        $this->kode_matakuliah =  $this->input->post('kode_matakuliah');
        $this->nama_matakuliah = $this->input->post('nama_matakuliah');
        $this->sks = $this->input->post('sks');
        $this->semester = $this->input->post('semester');
        $this->jenis = $this->input->post('jenis');
        $this->id_prodi = $this->input->post('id_prodi');
        $this->kode_prasyarat = $this->input->post('kode_prasyarat');

        $data = array(
            'kode_matakuliah' => $this->kode_matakuliah,
            'nama_matakuliah' => $this->nama_matakuliah,
            'sks' => $this->sks,
            'semester' => $this->semester,
            'jenis' => $this->jenis,
            'id_prodi' => $this->id_prodi,
            'kode_prasyarat' => $this->kode_prasyarat,
        );

        $this->db->insert($this->table, $data);
        return true;
        // return ($this->db->affected_rows() != 1) ? false : true;
    }

    // function update($id, $data)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->update($this->table, $data);
    // }

    function update($id, $data)
    {
        $this->kode_matakuliah =  $this->input->post('kode_matakuliah');
        $this->nama_matakuliah = $this->input->post('nama_matakuliah');
        $this->sks = $this->input->post('sks');
        $this->semester = $this->input->post('semester');
        $this->jenis = $this->input->post('jenis');
        $this->id_prodi = $this->input->post('id_prodi');
        $this->kode_prasyarat = $this->input->post('kode_prasyarat');

        $data = array(
            'kode_matakuliah' => $this->kode_matakuliah,
            'nama_matakuliah' => $this->nama_matakuliah,
            'sks' => $this->sks,
            'semester' => $this->semester,
            'jenis' => $this->jenis,
            'id_prodi' => $this->id_prodi,
            'kode_prasyarat' => $this->kode_prasyarat,
        );

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

    public $table = 'matakuliah';
    public $id = 'kode_matakuliah';
    public $order = 'DESC';
    // public $hasil = '';
}
