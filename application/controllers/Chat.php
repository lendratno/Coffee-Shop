<?php

class Chat extends CI_Controller
{
    public $user;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('auth');
        }


        $this->load->library('session');
        $this->load->database();
        $this->load->helper(array('url', 'form'));
        $this->load->library('user_agent');
        $pesanan = $this->db->get_where('pesanan', ['lunas' => 0])->result_array();
        $this->data['notif_pesanan'] = 0;
        foreach ($pesanan as $p) {
            $this->data['notif_pesanan'] += $p['quantity'];
        }
    }

    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Chat';
        $teman = $this->db->get('user');
        //$teman = $this->db->where('id !=', $this->user->id)->get('users');
        $this->load->view('layouts/_header', $data);
        $this->load->view('chat_dashboard', array(
            'teman' => $teman
        ));
        $this->load->view('layouts/_footer');
    }

    public function getChats()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            // Find friend
            $friend = $this->db->get_where('user', array('id' => $this->input->post('chatWith')), 1)->row();

            // Get Chats
            $chats = $this->db
                ->select('chat.*, user.name')
                ->from('chat')
                ->join('user', 'chat.send_by = user.id')
                ->where('(send_by = ' . $this->db->user->id . ' AND send_to = ' . $friend->id . ')')
                ->or_where('(send_to = ' . $this->user->id . ' AND send_by = ' . $friend->id . ')')
                ->order_by('chat.time', 'desc')
                ->limit(100)
                ->get()
                ->result();

            $result = array(
                'name' => $friend->name,
                'chat' => $chats
            );
            echo json_encode($result);
        }
    }

    public function sendMessage()
    {
        $this->db->insert('chat', array(
            'message' => htmlentities($this->input->post('message', true)),
            'send_to' => $this->input->post('chatWith'),
            'send_by' => $this->user->id
        ));
    }
}
