<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $pesanan = $this->db->get_where('pesanan', ['lunas' => 0])->result_array();
        $this->data['notif_pesanan'] = 0;
        foreach ($pesanan as $p) {
            $this->data['notif_pesanan'] += $p['quantity'];
        }
    }

    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Riwayat';
        $this->load->model('modelriwayat');
        //$data2['row'] = $this->modelriwayat->get();

        $data2['join_user_menu'] = $this->modelmenu->get()->result();
        //$data['pesanan'] = $this->db->get()->result_array();

        $this->load->view('layouts/_header', $data);
        $this->load->view('riwayat/index', $data2);
    }
}
