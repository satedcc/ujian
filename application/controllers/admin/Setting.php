<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('m_user');
        is_logged_in();
    }
    public function index()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/setting');
        $this->load->view('layouts/footer');
    }
}
