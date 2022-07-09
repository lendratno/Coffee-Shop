<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
    }

    public function index()
    {
        //$data['user'] = $this->db->get_where('user', ['username' =>
        //$this->session->userdata('username')])->row_array();

        $data['title'] = '.NEMU';
        $this->load->view('layouts/_headeradmin', $data);
        $this->load->view('admin/index');
        $this->load->view('layouts/_footer');
    }
}
