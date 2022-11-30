<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_reg');
        $this->load->model('m_qualified');
    }
    public function index()
    {
        $data["akun"] = $this->m_reg->getById($this->session->userdata('akun'));
        $data["qua"] = $this->m_qualified->get()->result();
        $this->load->view('layouts/front_header');
        // $this->load->view('layouts/sidebar');
        $this->load->view('akun', $data);
        $this->load->view('layouts/front_footer');
    }
    public function save()
    {
        // FILE UPLOAD
        $config['upload_path']          = './profile/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|webp';
        $config['max_size']             = 1024;
        $config['max_width']            = 2400;
        $config['max_height']           = 2400;
        $filename                       = date("YmdHis") . "-" . $_FILES["file"]['name'];
        $config['file_name']            = $filename;
        $this->load->library('upload', $config);

        $data["nama_lengkap"]   = htmlentities(htmlspecialchars($this->input->post('nama')));
        // $data["email_peserta"]  = htmlentities(htmlspecialchars($this->input->post('email')));
        $data["nomor_peserta"]  = htmlentities(htmlspecialchars($this->input->post('nomor')));
        $data["tempat_lhr"]     = htmlentities(htmlspecialchars($this->input->post('tempat')));
        $data["tgl_lahir"]      = date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('tanggal'))));
        $data["alamat_peserta"] = htmlentities(htmlspecialchars($this->input->post('alamat')));
        $data["jk"]             = htmlentities(htmlspecialchars($this->input->post('jk')));
        $data["nik"]            = htmlentities(htmlspecialchars($this->input->post('nik')));
        $data["id_qua"]         = htmlentities(htmlspecialchars($this->input->post('qualified')));
        $nik = $this->m_reg->cekNik($this->input->post('nik'));
        $nik = $this->m_reg->cekRegis($this->input->post('email'));
        if ($_FILES["file"]["name"] != '') {
            if (!$this->upload->do_upload('file')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                $datax["akun"] = $this->m_reg->getById($this->session->userdata('akun'));
                redirect('../akun/', $datax);
            } else {
                $data['file_photo']  = str_replace(" ", "_", $filename);
            }
        }
        if (!empty($this->input->post('validasi_nik'))) {
            if ($nik > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIK Exist</div>');
                redirect('../akun/');
            } else {
                if (!preg_match("/^[a-zA-Z ]*$/", $this->input->post('nama'))) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Name can only be letters</div>');
                    redirect('../akun/');
                } else {
                    $this->m_reg->update($data, $this->input->post('id'));
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update data successfully</div>');
                    redirect('../akun/');
                }
            }
        } else {
            if (!preg_match("/^[a-zA-Z ]*$/", $this->input->post('nama'))) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Name can only be letters</div>');
                redirect('../akun/');
            } else {
                $this->m_reg->update($data, $this->input->post('id'));
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update data successfully</div>');
                redirect('../akun/');
            }
        }
    }
}
