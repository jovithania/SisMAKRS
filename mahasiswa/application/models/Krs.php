<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Krs extends CI_Model
{

    public $table = 'krs';
    public $id = 'id_krs';
    public $order = 'DESC';

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


    // function insert($data)
    // {
    //     $nim = $this->input->post('nim');
    //     $id_thn_akad = $this->input->post('id_thn_akad');
    //     $kode_matakuliah = $this->input->post('kode_matakuliah');
    //     $sisa_sks = $this->input->post('sisa_sks');

    //     $sks_matkul = $this->Matakuliah->get_by_id($kode_matakuliah)->sks;
    //     $sisa_sks2 = $sisa_sks - $sks_matkul;
    //     $exist = $this->Krs->get_checkExist($nim, $id_thn_akad, $kode_matakuliah)->exist;
    //     $prasyarat = $this->Krs->get_checkPrasyarat($nim, $kode_matakuliah)->prasyarat;


    //     if ($sisa_sks2 >= 0 && $exist == 0 && $prasyarat > 0) {

    //         $data = array(
    //             'id_thn_akad' => $id_thn_akad,
    //             'nim' => $nim,
    //             'kode_matakuliah' => $kode_matakuliah,
    //         );
    //         $this->db->insert($this->table, $data);
    //         echo "<script> alert('Mata Kuliah Berhasil ditambahkan!');</script>";
    //     } else if ($sisa_sks2 < 0) {
    //         echo "<script> alert('Limit SKS tidak mencukupi');</script>";
    //     } else if ($exist > 0) {
    //         echo "<script> alert('Mata Kuliah Sudah Pernah ditambahkan');</script>";
    //     } else if ($prasyarat == 0) {
    //         echo "<script> alert('Mata Kuliah Prasyarat belum diambil');</script>";
    //     } else {
    //         echo "<script> alert('Unknown Error');</script>";
    //     }
    // }


    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    //Memeriksa matakuliah yang telah ditambahkan ke KRS
    function get_checkExist($nim, $id_thn_akad, $id_matakuliah)
    {
        // $this->db->where($this->id, $id);
        // return $this->db->get($this->table)->row();

        $sql = "SELECT COUNT(kode_matakuliah)exist FROM (
        SELECT kode_matakuliah 
        FROM krs
        WHERE nim= '" . $nim . "'
        AND id_thn_akad = " . $id_thn_akad . ") A
        WHERE kode_matakuliah = '" . $id_matakuliah . "'";
        return $this->db->query($sql)->row();
    }

    //Memeriksa mata kuliah prasyarat telah terpenuhi
    function get_checkPrasyarat($nim, $id_matakuliah)
    {
        // $this->db->where($this->id, $id);
        // return $this->db->get($this->table)->row();

        $sql = "SELECT CASE WHEN kode_prasyarat IS NULL OR kode_prasyarat = '' THEN '1'
        ELSE kode_prasyarat END AS prasyarat
        FROM matakuliah WHERE kode_matakuliah = '" . $id_matakuliah . "'";

        $cek = $this->db->query($sql)->row();
        if ($cek->prasyarat == '1') {
            return $cek;
        } else {

            $sql2 = "SELECT COUNT(kode_matkul) prasyarat
            FROM khs 
            WHERE nim ='" . $nim . "' 
            AND kode_matkul=( SELECT kode_prasyarat 
            FROM matakuliah WHERE kode_matakuliah = '" . $id_matakuliah . "') ";
            return $this->db->query($sql2)->row();
        }
    }

    //Menampilkan mata kuliah yang aktif di semester tertentu
    function get_semesterMataKuliah()
    {
        $sql = "SELECT kode_matakuliah, nama_matakuliah
        FROM matakuliah 
        WHERE jenis =(SELECT CASE WHEN semester ='1' THEN 'Ganjil'
        ELSE 'Genap' END 
        FROM thn_akad_semester WHERE aktif='Y')";
        return $this->db->query($sql)->result();
    }

    function insertValidasi($nim)
    {
        // $this->db->where($this->id, $id);
        // return $this->db->get($this->table)->row();
        $sqlcek = "SELECT * FROM validasi WHERE nim= '" . $nim . "'";
        $cek1 = $this->db->query($sqlcek);

        if ($cek1->num_rows() == 0) {
            $sql = "SELECT nim, nidn,
            (SELECT id_thn_akad FROM thn_akad_semester WHERE aktif ='Y') AS id_thn_akad, 
            'T' AS `status` 
            FROM dospem WHERE nim = '" . $nim . "'";
            $cek = $this->db->query($sql)->row();

            $data = array(
                'nim' => $cek->nim,
                'nidn' => $cek->nidn,
                'id_thn_akad' => $cek->id_thn_akad,
                'status' => $cek->status,
            );
            // Melakukan penyimpanan data 
            $this->db->insert('validasi', $data);
        }
    }

    function get_checkJadwal()
    {
        // $waktu='NOW()';
        // if ($tanggal = ''){

        // }
        // $this->db->where($this->id, $id);
        // return $this->db->get($this->table)->row();

        $sql = "SELECT a.tgl_mulai, a.tgl_berakhir, CASE WHEN NOW() BETWEEN a.tgl_mulai AND a.tgl_berakhir THEN 'Y'
        ELSE 'T' END AS cek 
        FROM jadwal a WHERE id_thn_akad = (SELECT id_thn_akad FROM thn_akad_semester WHERE aktif = 'Y')
        AND nama_kegiatan = 'Pengisian KRS'";
        return $this->db->query($sql)->row();
    }
    // function get_checkJadwal()
    // {
    //     // $waktu='NOW()';
    //     // if ($tanggal = ''){

    //     // }
    //     // $this->db->where($this->id, $id);
    //     // return $this->db->get($this->table)->row();

    //     $sql = "SELECT CASE WHEN NOW() BETWEEN a.tgl_mulai AND a.tgl_berakhir THEN 'Y'
    //     ELSE 'T' END AS cek 
    //     FROM jadwal a WHERE id_thn_akad = (SELECT id_thn_akad FROM thn_akad_semester WHERE aktif = 'Y')
    //     AND nama_kegiatan = 'Pengisian KRS'";
    //     return $this->db->query($sql)->row();
    // }

    // function get_checkStatusValidasi($nim)
    // {
    //     $sql = "SELECT `status` FROM validasi WHERE nim = '" . $nim . "'";
    //     return $this->db->query($sql)->row();
    // }
}
