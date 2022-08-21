<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Gallery_model
class Jadwal extends CI_Model
{

    // Property yang bersifat public
    public $table = 'jadwal';
    public $id = 'id_jadwal';
    public $order = 'DESC';

    // Konstrutor
    function __construct()
    {
        parent::__construct();
    }

    // Tabel data dengan nama thn_akad_semester
    function json()
    {
        $this->datatables->select("id_jadwal, (SELECT CONCAT(thn_akad,' ',CASE WHEN semester = '1' THEN 'Ganjil' ELSE 'Genap' END) FROM thn_akad_semester WHERE id_thn_akad = jadwal.id_thn_akad) id_thn_akad, nama_kegiatan, tgl_mulai, tgl_berakhir");
        $this->datatables->from('jadwal');
        $this->datatables->add_column('action', anchor(site_url('jadwal_control/update/$1'), '<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>') . "  " . anchor(site_url('jadwal_control/delete/$1'), '<button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_jadwal');
        return $this->datatables->generate();
    }

    // Menampilkan semua data
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // Menampilkan semua data berdasrkan id-nya
    function get_by_id($id)
    {
        $this->db->select("a.*, (SELECT CONCAT(thn_akad,' ',CASE WHEN semester = '1' THEN 'Ganjil' ELSE 'Genap' END) FROM thn_akad_semester WHERE id_thn_akad = a.id_thn_akad) thn_akad");
        //$this->db->select("(SELECT CONCAT(thn_akad,' ',CASE WHEN semester = '1' THEN 'Ganjil' ELSE 'Genap' END) FROM thn_akad_semester WHERE id_thn_akad = a.id_thn_akad) thn_akad");
        $this->db->from('jadwal a');
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    // menampilkan jumlah data
    function total_rows($q = NULL)
    {
        $this->db->like('id_jadwal', $q);
        $this->db->or_like('id_thn_akad', $q);
        $this->db->or_like('nama_kegiatan', $q);
        $this->db->or_like('tgl_mulai', $q);
        $this->db->or_like('tgl_berakhir', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // Menampilkan data dengan jumlah limit
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_jadwal', $q);
        $this->db->or_like('id_thn_akad', $q);
        $this->db->or_like('nama_kegiatan', $q);
        $this->db->or_like('tgl_mulai', $q);
        $this->db->or_like('tgl_berakhir', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // Menambahkan data kedalam database
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // Merubah data kedalam database
    function update($id, $data)
    {

        $this->db->set($data);
        $this->db->where($this->id, $id);
        $this->db->update($this->table);
    }

    // Merubah aktif kedalam database
    public function update_aktif($id)
    {
        $query = $this->db->where('id_jadwal  =' . $id);
        $this->db->update($this->table, array('aktif' => 'Y'), $query);
        return true;
    }

    // Merubah tidak aktif kedalam database
    public function update_tidakAktif($id)
    {
        $query = $this->db->where('id_jadwal  !=' . $id);
        $this->db->update($this->table, array('aktif' => 'N'), $query);
        return true;
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_tahunAkademik()
    {
        $sql = "SELECT id_thn_akad, CONCAT(thn_akad,' ',CASE WHEN semester = '1' THEN 'Ganjil' ELSE 'Genap' END) thn_akad
        FROM thn_akad_semester
        WHERE id_thn_akad >= (SELECT id_thn_akad FROM thn_akad_semester WHERE aktif ='Y' LIMIT 1)";
        return $this->db->query($sql)->result();
    }

    function get_checkExist($id_thn_akad, $nama_kegiatan)
    {
        // $this->db->where($this->id, $id);
        // return $this->db->get($this->table)->row();

        $sql = "SELECT COUNT(id_thn_akad) exist FROM jadwal WHERE id_thn_akad = '" . $id_thn_akad . "' AND nama_kegiatan = '" . $nama_kegiatan . "'";
        return $this->db->query($sql)->row();
    }
}
