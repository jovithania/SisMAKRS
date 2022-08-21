<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

// Deklarasi pembuatan class Mahasiswa
class Mahasiswa extends CI_Model
{
  // Property yang bersifat public   
  public $table = 'mahasiswa';
  public $id = 'nim';
  public $order = 'DESC';

  // Konstrutor    
  function __construct()
  {
    parent::__construct();
  }

  // Tabel data dengan nama mahasiswa
  function json()
  {
    $username    = $this->session->userdata['username'];
    $this->datatables->select("nim, nama_lengkap, alamat, email, telp, IF(jenis_kelamin = 'P', 'Perempuan', 'Laki-laki') as jenisKelamin");
    $this->datatables->from('mahasiswa');
    $this->datatables->where('nim =' . $username);
    $this->datatables->add_column('action', anchor(site_url('mahasiswa/read/$1'), '<button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button>') . "  " . anchor(site_url('mahasiswa/update/$1'), '<button type="button" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></button>'), 'nim');
    return $this->datatables->generate();
  }

  // Menampilkan semua data 
  function get_all()
  {
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result();
  }

  function setNim($nim)
  {
    $this->nim = $nim;
  }
  function getNim()
  {
    return $this->nim;
  }

  // Menampilkan semua data berdasarkan id-nya
  function get_by_id($id)
  {
    // $this->db->where($this->id, $id);
    // return $this->db->get($this->table)->row();

    // $sql = "SELECT A.*,B.ips, CASE WHEN B.ips < 2 THEN 15 
    //         WHEN B.ips < 3 THEN 21
    //         WHEN B.ips >= 3 THEN 24
    //         END AS jumlah_sks_ambil
    //         FROM mahasiswa A, index_prestasi B
    //         WHERE A.nim = B.nim AND A.nim = ".$id;

    $sql = " SELECT A.*, IFNULL (B.ips,0)ips,
   IFNULL ((CASE WHEN B.ips < 2 THEN 15 
   WHEN B.ips < 3 THEN 21
   WHEN B.ips >= 3 THEN 24
   END),24)jumlah_sks_ambil
   FROM mahasiswa A LEFT JOIN (SELECT X.nim, (X.total_poin/X.total_sks)ips FROM (SELECT nim, SUM(konversi*sks)total_poin, SUM(sks)total_sks 
   FROM khs WHERE nim= '" . $id . "' AND id_thn_akad = (SELECT (id_thn_akad-1) FROM thn_akad_semester WHERE aktif='Y') 
   AND nilai != 'K' GROUP BY id_thn_akad, nim)X) B ON A.nim=B.nim 
   WHERE A.nim = '" . $id . "'";
    return $this->db->query($sql)->row();
  }



  // menampilkan jumlah data	
  function total_rows($q = NULL)
  {
    $this->db->like('nim', $q);
    $this->db->or_like('nim', $q);
    $this->db->or_like('nama_lengkap', $q);
    $this->db->or_like('alamat', $q);
    $this->db->or_like('email', $q);
    $this->db->or_like('telp', $q);
    $this->db->or_like('jenis_kelamin', $q);
    //$this->db->or_like('id_prodi', $q);
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  // Menampilkan data dengan jumlah limit
  function get_limit_data($limit, $start = 0, $q = NULL)
  {
    $this->db->order_by($this->id, $this->order);
    $this->db->like('nim', $q);
    $this->db->or_like('nim', $q);
    $this->db->or_like('nama_lengkap', $q);
    $this->db->or_like('alamat', $q);
    $this->db->or_like('email', $q);
    $this->db->or_like('telp', $q);
    $this->db->or_like('jenis_kelamin', $q);
    //$this->db->or_like('id_prodi', $q);
    $this->db->limit($limit, $start);
    return $this->db->get($this->table)->result();
  }

  // Merubah data kedalam database
  function update($id, $data)
  {
    $this->db->where($this->id, $id);
    $this->db->update($this->table, $data);
  }
}

/* End of file Mahasiswa.php */
/* Location: ./application/models/Mahasiswa.php */
/* Please DO NOT modify this information : */