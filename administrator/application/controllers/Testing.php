<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testing extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('Matakuliah');
    }

    function test()
    {
        $sum = 1 + 1;
        $test = $sum;
        // $test = 1 + 1;

        $expected_result = 2;

        $test_name = 'Adds one plus one';

        echo $this->unit->run($test, $expected_result, $test_name);
    }

    // function testInsert()
    // {
    //     $data = $this->Matakuliah->insert(
    //         'TEST1234',
    //         'UJI COBA',
    //         '3',
    //         '6',
    //         'Genap',
    //         '1',
    //         'COBA1234'
    //     );
    //     $test = 1;
    //     $affectedRow = 1;
    //     if ($test == 1 && $affectedRow == 1) {
    //         $result = true;
    //     } else {
    //         $result = false;
    //     }
    //     $expected_result = $result;
    //     // $expected_result = true;
    //     $test_name = 'Input Data Mata Kuliah';
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

    function testUpdate()
    {
        $test = $this->Matakuliah->update(
            'TEST1431',
            'UJI COBA',
            '3',
            '6',
            'Genap',
            '1',
            'COBA1234'
        );
        $expected_result = true;
        $test_name = 'Update Data Mata Kuliah';
        echo $this->unit->run($test, $expected_result, $test_name);
    }

    function testDelete()
    {
        $test = $this->Matakuliah->delete(null);
        $expected_result = true;
        $test_name = 'Hapus Data Mata Kuliah';
        echo $this->unit->run($test, $expected_result, $test_name);
    }

    function testDeleteAction()
    {
        $row = null;

        if ($row == '1234567') {
            $this->Matakuliah->delete('1234567');
            echo 'Delete Record Success';
        } else {
            echo 'Delete Record Unsuccess';
        }
    }

    function testCreate_action()
    {
        echo $this->Matakuliah->insert();
        echo 'Create Record Success';
    }
}
