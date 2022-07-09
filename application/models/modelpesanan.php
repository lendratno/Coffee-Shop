<?php
defined('BASEPATH') or exit('No direct script access allowed');


class modelpesanan extends CI_Model
{

    protected $table = 'pesanan';
    protected $allowFields = ['order'];


    public function simpanorder($data, $table)
    {
        $this->db->insert($table, $data);
    }
}
