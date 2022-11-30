<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        is_logged_in();
    }
    public function index()
    {
        $data["user"] = $this->m_user->get()->result();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/user/user', $data);
        $this->load->view('layouts/footer');
    }
    public function tambah()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/user/form');
        $this->load->view('layouts/footer');
    }
    public function edit($id)
    {
        $data["row"] = $this->m_user->getById($id);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/user/form', $data);
        $this->load->view('layouts/footer');
    }
    public function save()
    {

        $data["nama_lengkap"]   = $this->input->post('nama');
        $data["telp"]           = $this->input->post('nomor');
        $data["email"]          = $this->input->post('email');
        $data["password"]       = md5($this->input->post('password'));
        $data["level_user"]     = $this->input->post('level');
        $data["status_user"]    = "aktif";
        if (empty($this->input->post('id'))) {
            $cek = $this->m_user->cekUser($this->input->post('email'));
            if ($cek > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email has been registered</div>');
                $this->load->view('layouts/header');
                $this->load->view('layouts/sidebar');
                $this->load->view('admin/user/form');
                $this->load->view('layouts/footer');
            } else {
                $pass_status = strongPassword($this->input->post('password'));
                if ($pass_status == "strong") {
                    if ($this->input->post('password') != $this->input->post('confirm')) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password not same</div>');
                        $this->load->view('layouts/header');
                        $this->load->view('layouts/sidebar');
                        $this->load->view('admin/user/form');
                        $this->load->view('layouts/footer');
                    } else {
                        $this->m_user->save($data);
                        $this->session->set_flashdata('notif', 'Add user successfully');
                        redirect('../admin/user/');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password must have uppercase, lowercase and numbers</div>');
                    $this->load->view('layouts/header');
                    $this->load->view('layouts/sidebar');
                    $this->load->view('admin/user/form');
                    $this->load->view('layouts/footer');
                }
            }
        } else {
            $this->m_user->update($data, $this->input->post('id'));
            $this->session->set_flashdata('notif', 'Update user successfully');
            redirect('../admin/user/');
        }
    }
    public function delete($id)
    {
        $this->m_user->delete($id);
        redirect('../admin/user/');
    }
    public function draf($id)
    {
        $data["status_user"]   = "disabled";
        $this->m_user->update($data, $id);
        redirect('../admin/user/');
    }
    public function aktif($id)
    {
        $data["status_user"]   = "aktif";
        $this->m_user->update($data, $id);
        redirect('../admin/user/');
    }
}
