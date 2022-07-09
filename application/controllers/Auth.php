<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/templates/auth_header');
            $this->load->view('auth/login');
            $this->load->view('auth/templates/auth_footer');
        } else {
            //Berhasil login
            $this->_login();
        }
    }

    public function registrasi()
    {

        $unique_id = substr(md5(microtime()), rand(0, 25), 6);
        $user_status = 'active';

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/templates/auth_header');
            $this->load->view('auth/registrasi');
            $this->load->view('auth/templates/auth_footer');
        } else {

            $email = $this->input->post('email', true);
            $data = [
                'unique_id' => $unique_id,
                'email' => htmlspecialchars($email),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'user_status' => $user_status,
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            $session_arr = array(
                'uniqueid' => $unique_id
            );

            $this->session->set_userdata($session_arr);

            //token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" > 
            Selamat Anda Berhasil Mendaftar. Silahkan Aktivasi Akun Anda Cek di spam Email anda!</div>');
            redirect('auth');
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');


        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {

            if ($user['is_active'] == 1) {
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" > 
                Akun anda belum diaktivasi!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert" > 
            Username belum terdaftar..</div>');
            redirect('auth');
        }


        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'unique_id' => $user['unique_id'],
                    'username' => $user['username'],

                    'role_id' => $user['role_id']
                ];


                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('home');
                }
            } else {

                $this->load->model('Messagemodel');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" > 
                Sepertinya ada salah dengan password atau username anda.</div>');
                redirect('auth');
            }
        }
    }

    public function lupapassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('auth/templates/auth_header');
            $this->load->view('auth/lupapassword', $data);
            $this->load->view('auth/templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'lupapassword');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" > 
                Silahkan cek email kamu untuk merubah password</div>');
                redirect('auth/lupapassword');
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" > 
                Email belum terdaftar atau belum aktivasi!</div>');
                redirect('auth/lupapassword');
            }
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'smtp_timeout' => '30',
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'nemucoffeeindo@gmail.com',
            'smtp_pass' => 'nemu12345678',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);


        $this->email->from('nemucoffeeindo@gmail.com', '.NEMU Coffee');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link berikut untuk mengaktifkan akun anda : 
            <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') .
                '&token=' . urlencode($token) . '">Active</a>');
        } else if ($type == 'lupapassword') {
            $this->email->subject('Reset Password');
            $this->email->message('Klik link berikut untuk menrubah password akun anda : 
            <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') .
                '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' 
            Berhasil Aktif. Silahkan Login!</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" > 
        Masa Aktivasi Anda Expired!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" > 
        Token Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" > 
        Email Salah!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" > 
        Kamu telah berhasil Log out.</div>');
        redirect('auth');
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->ubahpassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" > 
            Reset Password Gagal! Token Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" > 
            Reset Password Gagal! Email Salah!</div>');
            redirect('auth');
        }
    }

    public function ubahpassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Ulang Password', 'trim|required|min_length[8]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ubah Password';
            $this->load->view('auth/templates/auth_header');
            $this->load->view('auth/ubahpassword', $data);
            $this->load->view('auth/templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" > 
            Password berhasil diubah</div>');
            redirect('auth');
        }
    }
}
