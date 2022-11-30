<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
    }
    public function index()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->db->query("SELECT * FROM ex_users WHERE level_user='superadmin'")->row();
            $this->load->view('admin/login', $data);
        } else {
            $this->do_login();
        }
    }
    private function do_login()
    {
        $username =  $this->input->post('username');
        $password =  md5($this->input->post('password'));

        $user     =  $this->db->get_where('ex_users', [
            'email' => $username,
        ])->row_array();

        if ($user) {
            if ($user['status_user'] == "aktif") {
                if ($password == $user['password']) {

                    $data = [
                        'username'  => $user['email'],
                        'nama'      => $user['nama_lengkap'],
                        'akun'      => $user['id_user'],
                        'level'     => $user['level_user']
                    ];
                    $this->session->set_userdata($data);
                    date_default_timezone_set('Asia/Jakarta');
                    $now = date("Y-m-d H:i:s");
                    $this->db->query("UPDATE ex_users SET last_login='$now' WHERE email='$username' ");
                    redirect('../admin/peserta');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your password is wrong </div>');
                    redirect('../login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your account is not active/disabled</div>');
                redirect('../login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username/Password is wrong</div>');
            redirect('../login');
        }
    }
}
