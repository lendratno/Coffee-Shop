<?php
defined('BASEPATH') or exit('No direct script access allowed');


class modelmenu extends CI_Model
{

    protected $table = 'menu';
    protected $allowFields = ['id', 'kopi', 'harga'];


    public function cobamenu()
    {
        return $this->db->get('menu');
    }

    public function simpanmenubaru($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function getAllMenu()
    {
        return $this->db->get('menu')->result_array();
    }

    public function getMenu($limit, $start)
    {
        return $this->db->get('menu', $limit, $start)->result_array();
    }

    function jumlahdata()
    {
        return $this->db->get('menu')->num_rows();
    }

    public function menukopi()
    {
        $names = array('Coffee');
        $this->db->where_in('category', $names);
    }

    public function nonkopi()
    {
        $names = array('Non Coffee');
        $this->db->where_in('category', $names);
    }

    public function makanan()
    {
        $names = array('Makanan');
        $this->db->where_in('category', $names);
    }

    public function Rekomendasi()
    {
        $names = array('Rekomendasi');
        $this->db->where_in('rekomendasi', $names);
    }

    public function get($id = null)
    {
        $this->db->from('menu');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
