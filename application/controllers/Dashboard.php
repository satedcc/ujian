<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_reg');
        $this->load->model('m_jadwal');
        $this->load->model('m_info');
        is_logged_user();
    }
    public function index()
    {
        $data["akun"]   = $this->m_reg->getById($this->session->userdata('akun'));
        $data["jadwal"] = $this->m_jadwal->getUser($this->session->userdata('akun'))->result();
        $data["info"]   = $this->m_info->get()->result();
        $this->load->view('layouts/front_header');
        // $this->load->view('layouts/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('layouts/front_footer');
    }
    public function video()
    {
        $this->load->view('video');
    }
}
