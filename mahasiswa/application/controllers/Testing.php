<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('Krs');
        // $this->load->controller('Krs_control');
    }

    // function test()
    // {
    //     $test = 1 + 1;

    //     $expected_result = 2;

    //     $test_name = 'Adds one plus one';

    //     echo $this->unit->run($test, $expected_result, $test_name);
    // }

    function testInsert()
    {
        $test = $this->Matakuliah->insert(
            'TEST1234',
            'UJI COBA',
            '3',
            '6',
            'Genap',
            '1',
            'COBA1234'
        );
        $expected_result = true;
        $test_name = 'Input Data Mata Kuliah';
        echo $this->unit->run($test, $expected_result, $test_name);
    }

    function testDelete()
    {
        $test = $this->Matakuliah->delete(null);
        $expected_result = true;
        $test_name = 'Hapus Data Mata Kuliah';
        echo $this->unit->run($test, $expected_result, $test_name);
    }

    function testCreate_action()
    {

        $nim = '123456789';
        $id_thn_akad = 14;
        $kode_matakuliah = 'TEST1234';

        $sisa_sks2 = 18;
        $exist = 0;
        $prasyarat = 0;


        if ($sisa_sks2 >= 0 && $exist == 0 && $prasyarat > 0) {

            $data = array(
                'id_thn_akad' => $id_thn_akad,
                'nim' => $nim,
                'kode_matakuliah' => $kode_matakuliah,
            );

            $this->Krs->insert($data);
            $this->Krs->insertValidasi($nim);
            echo "<script> alert('Mata Kuliah Berhasil ditambahkan!');</script>";
        } else if ($sisa_sks2 < 0) {
            echo "<script> alert('Limit SKS tidak mencukupi');</script>";
        } else if ($exist > 0) {
            echo "<script> alert('Mata Kuliah Sudah Pernah ditambahkan');</script>";
        }
        // else if ($prasyarat == 0) {
        //     echo "<script> alert('Mata Kuliah Prasyarat belum diambil');</script>";
        // }
    }

    function test()
    {

        $nim = '123456789';
        $id_thn_akad = 14;
        $kode_matakuliah = 'TEST1234';
        $sisa_sks = 3;

        $sisa_sks2 = 10;
        $exist = 0;
        $hasil = $sisa_sks2 - $exist;
        $prasyarat = 0;


        if ($sisa_sks2 >= 0 && $exist == 0 && $prasyarat > 0) {

            $data = array(
                'id_thn_akad' => $id_thn_akad,
                'nim' => $nim,
                'kode_matakuliah' => $kode_matakuliah,
            );

            $this->Krs->insert($data);
            $this->Krs->insertValidasi($nim);
            echo "<script> alert('Mata Kuliah Berhasil ditambahkan!');</script>";
        } else if ($sisa_sks2 < 0) {
            echo "<script> alert('Limit SKS tidak mencukupi');</script>";
        } else if ($exist > 0) {
            echo "<script> alert('Mata Kuliah Sudah Pernah ditambahkan');</script>";
        } else if ($prasyarat == 0) {
            echo "<script> alert('Mata Kuliah Prasyarat belum diambil');</script>";
        }
    }
}
