<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_ujian');
        $this->load->model('m_soal');
        $this->load->model('m_user');
        is_logged_in();
    }
    public function index()
    {
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["ujian"] = $this->m_ujian->get($user)->result();
        } else {
            $data["ujian"] = $this->m_ujian->getAdmin()->result();
        }
        $data["soal"] = $this->m_soal->get()->result();
        $data["user"] = $this->m_user->get()->result();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/ujian/ujian', $data);
        $this->load->view('layouts/footer');
    }
    public function edit($id)
    {
        $data["row"] = $this->m_ujian->getById($id);

        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["ujian"] = $this->m_ujian->get($user)->result();
        } else {
            $data["ujian"] = $this->m_ujian->getAdmin()->result();
        }

        $data["user"] = $this->m_user->get()->result();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/ujian/ujian', $data);
        $this->load->view('layouts/footer');
    }
    public function save()
    {
        $data["nama_ujian"]     = $this->input->post('kategori');
        $data["jumlah_soal"]    = $this->input->post('soal');
        $data["status_ujian"]   = $this->input->post('status');
        $data["id_user"]        = $this->session->userdata('akun');
        if (empty($this->input->post('id'))) {
            $this->m_ujian->save($data);
            $this->session->set_flashdata('notif', 'Add Exam Successfully');

            $id = $this->db->insert_id();
            if ($this->session->userdata('level') == "superadmin") {
                if (!empty($this->input->post('user_create'))) {
                    $totaluser = count($this->input->post('user_create'));
                    for ($no = 0; $no < $totaluser; $no++) {
                        $datax["id_user"]   = $this->input->post('user_create')[$no];
                        $datax["id_ujian"]  = $id;
                        $this->m_ujian->saveUser($datax);
                    }
                }
            } else {
                $datax["id_user"]   = $this->session->userdata('akun');
                $datax["id_ujian"]  = $id;
                $this->m_ujian->saveUser($datax);
            }
        } else {
            $this->m_ujian->update($data, $this->input->post('id'));
            if (!empty($this->input->post('user_create'))) {
                $totaluser = count($this->input->post('user_create'));
                for ($no = 0; $no < $totaluser; $no++) {
                    $cek = $this->m_ujian->cekPatpel($this->input->post('user_create')[$no], $this->input->post('id'));
                    if ($cek > 0) {
                        false;
                    } else {
                        $datax["id_user"]   = $this->input->post('user_create')[$no];
                        $datax["id_ujian"]  = $this->input->post('id');
                        $this->m_ujian->saveUser($datax);
                    }
                }
                $this->session->set_flashdata('notif', 'Update Exam Successfully');
            }
        }

        redirect('../admin/ujian');
    }
    public function soal()
    {
        $jml = count($this->input->post('cek_soal'));
        for ($i = 0; $i < $jml; $i++) {
            $data['id_soal']    = $this->input->post('cek_soal')[$i];
            $data['id_ujian']   = $this->input->post('idsoal')[$i];
            $data['created_by'] = "1";
            $this->m_soal->saveDetail($data);
        }
        // var_dump($_POST);
    }
    public function soal_ujian()
    {
        $data["soal"] = $this->m_soal->get()->result();
        $data["id"] = $this->input->post('id');
        $this->load->view('admin/ujian/soal_ujian', $data);
    }
    public function view_soal()
    {
        $data["id"] = $this->input->post('id');
        $data["soal"] = $this->m_soal->getAll($this->input->post('id'))->result();
        $this->load->view('admin/ujian/all', $data);
    }
    public function deletedetail($id)
    {
        $this->m_soal->deleteDetail($id);

        redirect('../admin/ujian/');
    }
    public function delete($id)
    {
        $this->m_ujian->delete($id);
        $this->m_ujian->deleteUser($id);

        redirect('../admin/ujian/');
    }
    public function deletepatpel()
    {
        $id = explode(",", $this->input->post('id'));
        $this->m_ujian->deletePatpel($id[0], $id[1]);
    }
}
