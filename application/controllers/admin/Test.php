<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_reg');
        $this->load->model('m_jawaban');
        is_logged_in();
    }
    public function index()
    {
        $data['hasil'] = $this->m_reg->getAll()->result();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/hasil/hasil', $data);
        $this->load->view('layouts/footer');
    }
    public function hasil()
    {
        $data['row']        = $this->m_reg->getById($this->input->post('id'));
        $data['jawaban']    = $this->m_jawaban->getNilai($this->input->post('id'));
        $data['nilai']    = $this->m_jawaban->cekNilai($this->input->post('id'));
        $this->load->view('admin/hasil/result', $data);
    }
}
