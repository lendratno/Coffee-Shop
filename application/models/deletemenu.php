<?php
defined('BASEPATH') or exit('No direct script access allowed');


class deletemenu extends CI_Model
{
    public function delete($id)
    {
        $this->db->delete('user', array('id' => $id));
    }
}
