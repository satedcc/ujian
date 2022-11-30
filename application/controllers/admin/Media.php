<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Media extends CI_Controller
{

    public function index()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/media/media');
        $this->load->view('layouts/footer');
    }
}
