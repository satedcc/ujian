<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Required extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_qualified');
        is_logged_in();
    }
    public function index()
    {
        $data["qualified"] = $this->m_qualified->get()->result();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/qualified/qualified', $data);
        $this->load->view('layouts/footer');
    }
    public function edit($id)
    {
        $data["qualified"] = $this->m_qualified->get()->result();
        $data["row"] = $this->m_qualified->getById($id);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/qualified/qualified', $data);
        $this->load->view('layouts/footer');
    }
    public function save()
    {
        $data["nama_qualified"]     = $this->input->post('qualified');
        $data["code_qualified"]     = $this->input->post('code');
        $data["status_qualified"]   = $this->input->post('status');
        $data["kuota"]              = $this->input->post('kuota');
        if (empty($this->input->post('id'))) {
            $this->m_qualified->save($data);
            $this->session->set_flashdata('notif', 'Update Qualified Success');
        } else {
            $this->m_qualified->update($data, $this->input->post('id'));
            $this->session->set_flashdata('notif', 'Add Qualified Success');
        }
        redirect('../admin/required/');
    }
    public function aktif($id)
    {
        $data["status_qualified"]   = "Y";
        $this->m_qualified->update($data, $id);
        $this->session->set_flashdata('notif', 'Qualified has been actived');
        redirect('../admin/required/');
    }
    public function draf($id)
    {
        $data["status_qualified"]   = "N";
        $this->m_qualified->update($data, $id);
        $this->session->set_flashdata('notif', 'Qualified not active');
        redirect('../admin/required/');
    }
    public function delete($id)
    {
        $this->m_qualified->delete($id);
        redirect('../admin/required/');
    }
}
