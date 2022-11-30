<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_reg');
        is_logged_user();
    }
    public function index()
    {
        $this->load->view('layouts/front_header');
        $this->load->view('layouts/front_footer');
    }
}
