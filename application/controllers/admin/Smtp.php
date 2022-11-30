<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Smtp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_setting');
        require APPPATH . 'libraries/phpmailer/src/Exception.php';
        require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'libraries/phpmailer/src/SMTP.php';
        is_logged_in();
    }
    public function index()
    {
        $data['smtp'] = $this->m_setting->get()->row();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/smtp', $data);
        $this->load->view('layouts/footer');
    }
    public function save()
    {
        $data['set_smtp_username']  = $this->input->post('username');
        $data['webmail']            = $this->input->post('email');
        $data['set_smtp_port']      = $this->input->post('port');
        $data['set_smtp_host']      = $this->input->post('host');
        if (!empty($this->input->post('password'))) {
            $data['set_smtp_password']  = custom_encript($this->input->post('password'));
        }
        $this->m_setting->update($data, 1);
        $this->session->set_flashdata('notif', 'SMTP has been update');
        redirect('../admin/smtp');
    }

    public function send()
    {
        $c = $this->db->query("SELECT * FROM ex_setting WHERE id_setting='1'")->row();
        // PHPMailer object
        $response = false;
        $mail = new PHPMailer();


        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = $c->set_smtp_host; //sesuaikan sesuai nama domain hosting/server yang digunakan
        $mail->SMTPAuth = true;
        $mail->Username = $c->set_smtp_username; // user email
        $mail->Password = custom_decrypt($c->set_smtp_password); // password email
        $mail->SMTPSecure = 'tls';
        $mail->Port     = $c->set_smtp_port;

        $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        $mail->setFrom($c->webmail, 'Admin'); // user email
        $mail->addReplyTo($c->webmail, 'Admin'); //user email

        // Add a recipient
        $mail->addAddress($this->input->post('email')); //email tujuan pengiriman email

        // Email subject
        $mail->Subject = 'Testing Email Send'; //subject email

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mailContent = $this->input->post('message'); // isi email
        $mail->Body = $mailContent;

        // Send email
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    public function kirim()
    {
        email_cek('234213', 'satedcc@gmail.com', 'Satria Adiprdana');
    }
}
