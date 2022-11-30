<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_reg');
        $this->load->model('m_jadwal');
        is_logged_user();
    }
    public function index()
    {
        $cek = $this->m_reg->cekAvailable($this->session->userdata('akun'));
        if ($cek > 0) {
            $data["jadwal"] = $this->m_jadwal->get()->result();
            $this->load->view('layouts/front_header');
            $this->load->view('soal', $data);
            $this->load->view('layouts/front_footer');
        } else {
            $this->session->set_flashdata('notif', 'Mohon maaf anda tidak di perbolehkan mengakses halaman tersebut');
            redirect('../dashboard/');
        }
    }
}
