<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Prodi
class Prodi extends CI_Model
{
    // Property yang bersifat public  
    public $table = 'prodi';
    public $id = 'id_prodi';
    public $order = 'DESC';

    private $nama_prodi;

    function setNamaProdi($nama_prodi)
    {
        $this->nama_prodi = $nama_prodi;
    }

    function getNamaProdi()
    {
        $this->nama_prodi;
    }

    // Konstrutor   
    function __construct()
    {
        parent::__construct();
    }

    // Tabel data dengan nama prodi
    function json()
    {
        $this->datatables->select('id_prodi,nama_prodi');
        $this->datatables->from('prodi');
        $this->datatables->add_column(
            'action',
            anchor(site_url('prodi_control/delete/$1'), '<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'),
            'id_prodi'
        );
        return $this->datatables->generate();
    }

    // Menampilkan semua data 
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // Menampilkan semua data berdasarkan id-nya
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // menampilkan jumlah data	
    function total_rows($q = NULL)
    {
        $this->db->like('id_prodi', $q);
        //$this->db->or_like('kode_prodi', $q);
        $this->db->or_like('nama_prodi', $q);
        //$this->db->or_like('id_jurusan', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Menampilkan data dengan jumlah limit
    function get_limit_data($limit, $start = 0, $q = NULL)
    {

        $this->db->select('*');
        $this->db->from('prodi');
        //$this->db->join('jurusan', 'prodi.id_jurusan = jurusan.id_jurusan');
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    // Menambahkan data kedalam database
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // Merubah data kedalam database
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // Menghapus data kedalam database
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
