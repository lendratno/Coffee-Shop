<?php
defined('BASEPATH') or exit('No direct script access allowed');


class modelriwayat extends CI_Model
{

    protected $table = 'pesanan';
    protected $allowFields = ['no_pesanan', 'quantity', 'subtotal', 'order'];

    public function simpanorder($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function riwayat($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function getAllUser()
    {
        return $this->db->get('pesanan')->result_array();
    }

    function totaluser()
    {
        return $this->db->get('pesanan')->num_rows();
    }

    public function get($id)
    {
        //$this->db->select('pesanan.id as pesanan_id, menu.id as menu_id,pesanan.*, menu.*');
        $this->db->select('*');
        $this->db->from('pesanan');
        $this->db->join('menu', 'menu.id = pesanan.id', 'left');
        $this->db->join('user', 'pesanan.id = user.id', 'left');
        $this->db->where($id);

        $query = $this->db->get();
        return $query;
    }
}
