<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_reg');
        $this->load->model('m_jadwal');
        is_logged_in();
    }
    public function index()
    {
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["peserta"] = $this->m_reg->get($user)->result();
        } else {
            $data["peserta"] = $this->m_reg->cekJadwal()->result();
        }
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/laporan/laporan', $data);
        $this->load->view('layouts/footer');
    }
    public function detail($id)
    {
        $data["peserta"] = $this->m_jadwal->cekJadwalAktif($id)->result();
        $data["id"] = $id;
        $data["jadwal"] = $this->m_jadwal->getById($id);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/laporan/laporan', $data);
        $this->load->view('layouts/footer');
    }
}
