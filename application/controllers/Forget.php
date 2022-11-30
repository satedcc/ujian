<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forget extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        require APPPATH . 'libraries/phpmailer/src/Exception.php';
        require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'libraries/phpmailer/src/SMTP.php';
        $this->load->model('m_reg');
    }
    public function index()
    {
        $this->load->view('forget');
    }
    public function otp()
    {
        $this->load->view('otp_forget');
    }
    public function newpass()
    {
        $this->load->view('newpass');
    }
    public function sending()
    {
        $cek = $this->m_reg->cekRegis($this->input->post('email'));
        if ($cek > 0) {
            $otp = angka(6);
            $this->m_reg->updateOtp($otp, $this->input->post('email'));
            // email_forget($otp, htmlentities(htmlspecialchars($this->input->post('email'))), htmlentities(htmlspecialchars($this->input->post('email'))));
            email_cek($otp, $this->input->post('email'), $this->input->post('nama'));
            $this->session->set_flashdata('email', $this->input->post('email'));
            email_log($this->input->post('email'), 'Validation Email for reset Success', 'Success', 'Yes');
            redirect('../forget/otp/');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not found</div>');
            email_log($this->input->post('email'), 'Email not found', 'fail', 'No');
            redirect('../forget/');
        }
    }
    public function actived()
    {
        $cek = $this->m_reg->cekOtp($this->input->post('otp'), $this->input->post('email'));
        if ($cek > 0) {
            $this->m_reg->actived($this->input->post('otp'));
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Verification successful</div>');
            $data['otp'] = $this->input->post('otp');
            $data['email'] = $this->input->post('email');
            email_log($this->input->post('email'), 'Verification OTP for reset successful', 'Success', 'Yes');
            $this->load->view('newpass', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The code you entered is wrong</div>');
            email_log($this->input->post('email'), 'The code for reset entered is wrong', 'Fail', 'No');
            $this->session->set_flashdata('email', $this->input->post('email'));
            redirect('../forget/otp/');
        }
    }
    public function resetpassword()
    {
        $cek =  $this->m_reg->cekOtp($this->input->post('otp'), $this->input->post('email'));
        if ($cek > 0) {
            $d = $this->m_reg->getByOtp($this->input->post('otp'));
            $data['password']   = md5(md5($this->input->post('password')));
            $this->m_reg->update($data, $d->id_regis);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Reset password successful</div>');
            email_log($this->input->post('email'), 'Reset password successful', 'Success', 'Yes');
            redirect('/');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid for register</div>');
            email_log($this->input->post('email'), 'Invalid for register', 'Fail', 'No');
            redirect('../forget/newpass/');
        }
    }
}
