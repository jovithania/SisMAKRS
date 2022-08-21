<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Deklarasi pembuatan class Thn_akad_semester_model
class Thn_akad_semester extends CI_Model
{
    // Property yang bersifat public   
    public $table = 'thn_akad_semester';
    public $id = 'id_thn_akad';
    public $order = 'DESC';

    // Konstrutor   
    function __construct()
    {
        parent::__construct();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_aktif()
    {
        $this->db->where('aktif', 'Y');
        return $this->db->get($this->table)->row();
    }
}
