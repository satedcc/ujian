<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_info');
        is_logged_in();
    }
    public function index()
    {
        $data["info"] = $this->m_info->get()->result();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/informasi/informasi', $data);
        $this->load->view('layouts/footer');
    }
    public function tambah()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/informasi/form');
        $this->load->view('layouts/footer');
    }
    public function edit($id)
    {
        $data["row"] = $this->m_info->getById($id);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/informasi/form', $data);
        $this->load->view('layouts/footer');
    }
    public function save()
    {
        $data["title_info"]   = $this->input->post('judul');
        $data["deskripsi"]    = $this->input->post('deskripsi');
        $data["id_user"]    = $this->session->userdata('akun');
        if (empty($this->input->post('id'))) {
            $this->session->set_flashdata('notif', 'Add Information Successfully');
            $this->m_info->save($data);
        } else {
            $this->session->set_flashdata('notif', 'Update Information Successfully');
            $this->m_info->update($data, $this->input->post('id'));
        }
        redirect('../admin/informasi');
    }
    public function delete($id)
    {
        $this->m_info->delete($id);
        redirect('../admin/informasi/');
    }
}
