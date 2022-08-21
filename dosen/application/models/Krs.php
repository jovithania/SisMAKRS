<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Krs
class Krs extends CI_Model
{
    // Property yang bersifat public
    public $table = 'krs';
    public $id = 'id_krs';
    public $order = 'DESC';

    // Konstrutor    
    function __construct()
    {
        parent::__construct();
    }
    function json($nidn)
    {

        $this->datatables->select("
        mahasiswa.nim, nama_lengkap, alamat, email, telp, IF(jenis_kelamin = 'P', 'Perempuan', 'Laki-laki') as jenisKelamin, 
        CASE WHEN (SELECT `status` FROM validasi WHERE nim = mahasiswa.nim AND id_thn_akad= 
        (SELECT id_thn_akad FROM thn_akad_semester WHERE aktif ='Y')) = 'Y' THEN 'Sudah Disetujui' 
        ELSE 'Belum Disetujui' END AS `status`, validasi.id_thn_akad");
        $this->datatables->from('mahasiswa');
        $this->datatables->join('validasi', 'mahasiswa.nim=validasi.nim');
        $this->datatables->join('dospem', 'mahasiswa.nim = dospem.nim ');
        $this->datatables->where('dospem.nidn', $nidn);

        $this->datatables->add_column(
            'action',
            '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-id="$1">Lihat KRS</button>'
                . anchor(site_url('krs_control/validasi/$1'), '<button type="button" class="btn btn-success">Validasi</button>', 'onclick="javasciprt: return confirm(\'Apakah Anda yakin akan melakukan validasi ?\')"') . " 
            " . anchor(site_url('krs_control/batal_validasi/$1'), '<button type="button" class="btn btn-danger">Batal Validasi</button>', 'onclick="javasciprt: return confirm(\'Apakah Anda yakin akan membatalkan validasi ?\')"'),
            'nim'
        );

        return $this->datatables->generate();
    }

    function get_checkJadwal()
    {
        // $waktu='NOW()';
        // if ($tanggal = ''){

        // }
        // $this->db->where($this->id, $id);
        // return $this->db->get($this->table)->row();

        $sql = "SELECT a.id_thn_akad, CASE WHEN NOW() BETWEEN a.tgl_mulai AND a.tgl_berakhir THEN 'Y'
        ELSE 'T' END AS cek 
        FROM jadwal a WHERE id_thn_akad = (SELECT id_thn_akad FROM thn_akad_semester WHERE aktif = 'Y')
        AND nama_kegiatan = 'Validasi KRS'";
        return $this->db->query($sql)->row();
    }

    function updateValidasi($nim, $id_thn_akad, $status)
    {
        $update = array(
            'status' => $status,
        );
        if ($status == 'T') {
            $this->db->delete('khs', ['nim' => $nim, 'id_thn_akad' => $id_thn_akad]);
        } else {
            $this->db->delete('khs', ['nim' => $nim, 'id_thn_akad' => $id_thn_akad]);

            $sql = "SELECT A.kode_matakuliah,
            B.nama_matakuliah,
            B.sks,
            A.id_thn_akad,
            A.nim
            FROM krs A, matakuliah B
            WHERE A.kode_matakuliah = B.kode_matakuliah
            AND A.nim= '" . $nim . "'
            AND A.id_thn_akad = (SELECT id_thn_akad FROM thn_akad_semester WHERE aktif ='Y')";

            $data = $this->db->query($sql)->result();
            foreach ($data as $row) {
                $var = [
                    "id_thn_akad" => $row->id_thn_akad,
                    "nim" => $row->nim,
                    "kode_matkul" => $row->kode_matakuliah,
                    "nilai" => "0",
                    "konversi" => "null",
                    "sks" => $row->sks
                ];
                $this->db->insert('khs', $var);
            }
        }


        $this->db->where('nim', $nim);
        $this->db->update('validasi', $update);
    }

    function get_krsMahasiswa($nim)
    {
        $sql = "SELECT A.kode_matakuliah,
                B.nama_matakuliah,
                B.sks
                FROM krs A, matakuliah B
                WHERE A.kode_matakuliah = B.kode_matakuliah
                AND A.nim= '" . $nim . "'
                AND A.id_thn_akad = (SELECT id_thn_akad FROM thn_akad_semester WHERE aktif ='Y')";

        $data = $this->db->query($sql)->result();

        $list_data = $nim;

        $list_data .= '<table class="table">';

        foreach ($data as $row) {

            $list_data .= '<tr>
                    <td>Kode Mata Kuliah</td>
                    <td>:</td>
                    <td>' . $row->kode_matakuliah . '</td>
                    </tr>
                    <tr>
                    <td>Nama Mata Kuliah</td>
                    <td>:</td>
                    <td>' . $row->nama_matakuliah . '</td>
                    </tr>
                    <tr>
                    <td>SKS</td>
                    <td>:</td>
                    <td>' . $row->sks . '</td>
                    </tr>';
        }
        $list_data .= '</table>';
        return $list_data;
    }
}
