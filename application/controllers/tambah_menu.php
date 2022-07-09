<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tambah_menu extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }
        $this->load->model('modelmenu');
        $this->load->database();
    }

    public function index()
    {

        $data['title'] = 'Tambah Menu';

        $this->load->view('layouts/_header', $data);
        $this->load->view('menu/tambah_menu');
    }


    public function simpanmenubaru()
    {

        $menu = $this->input->post('kopi');
        $harga = $this->input->post('harga');
        $deskripsi = $this->input->post('deskrpsi');
        $rekomendasi = $this->input->post('rekomendasi');
        $category = $this->input->post('category');
        $image = $_FILES['image'];
        if ($image = '') {
        } else {
            $config['upload_path']        = './assets/img/menu';
            $config['allowed_types']    = 'jpg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                echo "Upload Gagal";
                die();
            } else {
                $image = $this->upload->data('file_name');
            }
        }

        $data = array(
            'kopi' => $menu,
            'harga' => $harga,
            'deskrpsi' => $deskripsi,
            'rekomendasi' => $rekomendasi,
            'category' => $category,
            'date_created' => time(),
            'image' => $image
        );

        $this->modelmenu->simpanmenubaru($data, 'menu');
        redirect('menu');
    }
}
