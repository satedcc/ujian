<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function index()
    {
        $this->session->sess_destroy('username');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('akun');
        session_unset();
        session_destroy();
        redirect('/login');
    }
}
