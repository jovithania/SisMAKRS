<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends CI_Model
{

    public $table = 'mahasiswa';
    public $id = 'nim';
    public $order = 'DESC';


    function __construct()
    {
        parent::__construct();
    }
}
