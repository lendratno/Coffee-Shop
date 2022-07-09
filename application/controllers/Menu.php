<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		if (!$this->session->userdata('username')) {
			redirect('auth');
		}
		$this->load->model('modelmenu');
		$pesanan = $this->db->get_where('pesanan', ['lunas' => 0])->result_array();
		$this->data['notif_pesanan'] = 0;
		foreach ($pesanan as $p) {
			$this->data['notif_pesanan'] += $p['quantity'];
		}
	}



	public function index()
	{
		$data = $this->data;
		$data['title'] = 'Menu';


		//$totalMenu = $this->db->get('menu')->num_rows();
		//$jumlah_data = $this->modelmenu->jumlah_data();

		$this->load->library('pagination');
		$this->load->model('modelmenu');


		$config['base_url'] = 'http://localhost/ci-coffee-shop-master/menu/index/';
		$config['total_rows'] = $this->modelmenu->Rekomendasi();
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		//$jumlah_data; $totalMenu;
		//var_dump($config['total_rows']);
		//die;
		$config['per_page'] = 38;

		$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(3);
		$data['menu'] = $this->modelmenu->getMenu($config['per_page'], $data['start']);

		$data['menu'] = $this->db->get('menu', $config['per_page'])->result_array();
		$data['menu'] = $this->modelmenu->getMenu($config['per_page'], $data['start']);

		//var_dump($data['menu']);
		//die;

		$this->load->view('layouts/_header', $data);
		$this->load->view('menu/index');
		$this->load->view('layouts/_footer');
	}

	public function pesan($menu_id)
	{

		$menu = $this->db->get_where('menu', ['id' => $menu_id])->row_array();
		$harga = $menu['harga'];

		$this->db->order_by('no_pesanan', 'DESC');
		$this->db->limit(1);
		$pesanan = $this->db->get_where('pesanan', ['lunas' => 1])->row_array();
		$no_pesanan = $pesanan['no_pesanan'];

		$pesananSudahAda = $this->db->get_where('pesanan', ['menu_id' => $menu_id, 'lunas' => 0])->row_array();
		$menuIdSudahAda = $pesananSudahAda['menu_id'];

		if ($no_pesanan) {
			$no_pesanan = $no_pesanan + 1;
		} else {
			$no_pesanan = 1;
		}

		if ($menu_id == $menuIdSudahAda) {
			$data = [
				'no_pesanan' => $pesananSudahAda['no_pesanan'],
				'menu_id'		=> $pesananSudahAda['menu_id'],
				'quantity'	=> $pesananSudahAda['quantity'] + 1,
				'subtotal'	=> $pesananSudahAda['subtotal'] + $harga,
				'lunas'			=> 0
			];

			$this->db->where('menu_id', $menu_id);
			$this->db->where('lunas', 0);
			$this->db->update('pesanan', $data);
		} else {
			$data = [
				'no_pesanan' => $no_pesanan,
				'menu_id'		=> $menu_id,
				'quantity'	=> 1,
				'subtotal'	=> $harga,
				'lunas'			=> 0
			];

			$this->db->insert('pesanan', $data);
		}

		redirect('menu');
	}

	public function hapusmenu($id)
	{
		$this->db->delete('menu', array('id' => $id));
		redirect('menu');
	}
}
