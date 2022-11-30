<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forget extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
    }
    public function index()
    {
        $this->load->view('admin/forget');
    }
    public function otp()
    {
        $this->load->view('admin/otp');
    }
    public function otproses()
    {
        $cek = $this->m_user->cekOtp($this->input->post('otp'));
        if ($cek > 0) {
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The code you entered is wrong</div>');
            redirect('../admin/forget/otp/');
        }
    }
    public function process()
    {
        $email = $this->input->post('email');
        $cek = $this->m_user->cekUser($email);
        if ($cek > 0) {
            $otp = angka(6);
            $this->m_user->updateOtp($otp, $email);
            email_forget($otp, htmlentities(htmlspecialchars($this->input->post('email'))), htmlentities(htmlspecialchars($this->input->post('email'))));
            redirect('../admin/forget/otp/');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not found</div>');
            redirect('../admin/forget/');
        }
    }
}
