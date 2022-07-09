<?php
defined('BASEPATH') or exit('No direct script access allowed');


class modelcategory extends CI_Model
{
    public function getAllCategory()
    {
        return $this->db->get('menu')->result_array();
    }

    public function getCategoryByName($categoryname)
    {
        return $this->db->get_where('menu', ['category' => $categoryname])->row_array();
    }
    public function add($data)
    {
        $this->db->insert('menu', $data);
    }
}
