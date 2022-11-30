<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        require APPPATH . 'libraries/phpmailer/src/Exception.php';
        require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'libraries/phpmailer/src/SMTP.php';
        $this->load->model('m_reg');
        $this->load->model('m_email');
    }
    public function index()
    {
        $data['reg']   = $this->m_reg->autonumber();
        $this->load->view('register', $data);
    }
    public function otp()
    {
        $this->load->view('otp');
    }
    public function save()
    {
        $reg    = $this->m_reg->autonumber();
        $nourut = substr($reg->kodeTerbesar, 4, 6);
        $huruf = "EXAM";
        $noreg = $huruf . sprintf("%06s", $nourut + 1);

        $cek = $this->m_reg->cekRegis($this->input->post('email'));
        if ($cek > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email has been registered</div>');
            $data['reg']   = $this->m_reg->autonumber();
            email_log($this->input->post('email'), 'Email has been registered', 'Fail', 'No');
            $this->load->view('register', $data);
        } else {
            $nik = $this->m_reg->cekNik($this->input->post('nik'));
            if ($nik > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIK has been registered</div>');
                $data['reg']   = $this->m_reg->autonumber();
                email_log($this->input->post('email'), '>NIK has been registered', 'Fail', 'No');
                $this->load->view('register', $data);
            } else {
                $pass_status = strongPassword($this->input->post('password'));
                if ($pass_status == "strong") { // Chek kekuatan password
                    if ($this->input->post('password') != $this->input->post('confirm')) { // Chek konfirimasi password
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password not same</div>');
                        $data['reg']   = $this->m_reg->autonumber();
                        email_log($this->input->post('email'), '>Password not same', 'Fail', 'No');
                        $this->load->view('register', $data);
                    } else {
                        if (strlen($this->input->post('nik') < 16)) {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your NIK format is wrong</div>');
                            $data['reg']   = $this->m_reg->autonumber();
                            email_log($this->input->post('email'), 'Format NIK is wrong', 'Fail', 'No');
                            $this->load->view('register', $data);
                        } else {
                            if (!preg_match("/^[a-zA-Z ]*$/", $this->input->post('nama'))) {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Name can only be letters</div>');
                                $data['reg']   = $this->m_reg->autonumber();
                                email_log($this->input->post('email'), '>Name can only be letter', 'Fail', 'No');
                                $this->load->view('register', $data);
                            } else {
                                $otp                    = angka(6);
                                $data["nama_lengkap"]   = htmlentities(htmlspecialchars($this->input->post('nama')));
                                $data["email_peserta"]  = htmlentities(htmlspecialchars($this->input->post('email')));
                                $data["nomor_peserta"]  = htmlentities(htmlspecialchars($this->input->post('nomor')));
                                $data["nik"]            = htmlentities(htmlspecialchars($this->input->post('nik')));
                                $data["password"]       = md5(md5($this->input->post('password')));
                                $data["no_regist"]      = $noreg;
                                $data["otp"]            = $otp;
                                $data["status_peserta"] = "0";
                                $data["id_user"]        = "1";
                                $this->m_reg->save($data);
                                // email($otp, htmlentities(htmlspecialchars($this->input->post('email'))), htmlentities(htmlspecialchars($this->input->post('nama'))));
                                email_test($otp, $this->input->post('email'), $this->input->post('nama'));
                                $this->session->set_flashdata('email', $this->input->post('email'));
                                email_log($this->input->post('email'), 'Registered Successfully', 'Success', 'Yes');
                                redirect('../register/otp/');
                            }
                        }
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password must have uppercase, lowercase and numbers</div>');
                    $data['reg']   = $this->m_reg->autonumber();
                    email_log($this->input->post('email'), 'Password must have uppercase, lowercase and numbers', 'Fail', 'No');
                    $this->load->view('register', $data);
                }
            }
        }
    }
    public function sending()
    {
        $cek = $this->m_reg->cekOtp($this->input->post('otp'), $this->input->post('email'));
        if ($cek > 0) {
            $d = $this->m_reg->getByOtp($this->input->post('otp'));
            $data['status_peserta']   = "1";
            $this->m_reg->update($data, $d->id_regis);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registration successful</div>');
            email_log($this->input->post('email'), 'Validation OTP Success', 'Success', 'Yes');
            redirect('../auth/');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The code you entered is wrong</div>');
            $this->session->set_flashdata('email', $this->input->post('email'));
            email_log($this->input->post('email'), 'Validation OTP fail', 'fail', 'No');
            redirect('../register/otp/');
        }
    }
}
