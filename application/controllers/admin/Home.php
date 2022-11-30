<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_reg');
        $this->load->model('m_qualified');
        is_logged_in();
    }
    public function index()
    {
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["peserta"] = $this->m_reg->get($user)->result();
        } else {
            $data["peserta"] = $this->m_reg->getAdmin()->result();
        }
        $data["row"] = $this->m_reg->total()->row();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/home', $data);
        $this->load->view('layouts/footer');
    }
}
