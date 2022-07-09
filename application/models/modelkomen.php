<?php
defined('BASEPATH') or exit('No direct script access allowed');


class modelkomen extends CI_Model
{

    protected $table = 'feedback';
    protected $allowFields = ['nama', 'komentar', 'time'];


    public function komentar($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function getAllUser()
    {
        return $this->db->get('feedback')->result_array();
    }

    function totaluser()
    {
        return $this->db->get('feedback')->num_rows();
    }

    public function get($id = null)
    {
        $this->db->from('feedback');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
