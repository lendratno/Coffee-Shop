<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller
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
        $data['title'] = 'Feedback';
        $this->load->model('modelkomen');
        $data2['row'] = $this->modelkomen->get();

        $this->load->view('layouts/_header', $data);
        $this->load->view('feedback/index', $data2);
        $this->load->view('layouts/_footer');
    }

    public function komentar()
    {
        $tanggal = (date('Y-m-d'));

        $this->load->helper('tanggal');


        $nama = $this->input->post('nama');
        $komentar = $this->input->post('komentar');
        $data = array(
            'komentar' => $komentar,
            'nama' => $nama,
            'time' => format_indo($tanggal)
        );

        $this->modelkomen->komentar($data, 'feedback');
        redirect('feedback');
    }
}
