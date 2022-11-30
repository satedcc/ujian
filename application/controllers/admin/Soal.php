<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Soal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_soal');
        $this->load->model('m_ujian');
        is_logged_in();
    }
    public function index()
    {
        $data["soal"] = $this->m_soal->get()->result();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/soal/soal', $data);
        $this->load->view('layouts/footer');
    }
    public function tambah()
    {
        $data["ujian"] = $this->m_ujian->getAdmin()->result();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/soal/form', $data);
        $this->load->view('layouts/footer');
    }
    public function edit($id)
    {
        $data["row"] = $this->m_soal->getById($id);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/soal/form', $data);
        $this->load->view('layouts/footer');
    }
    public function save()
    {
        $media                  = explode(".", $this->input->post('media'));
        $data["jenis_soal"]     = $this->input->post('jenis');
        $data["type_soal"]      = $this->input->post('type');
        $data["soal"]           = $this->input->post('soal');
        $data["hastag"]         = $this->input->post('hastag');
        $data["jawab_a"]        = $this->input->post('jawab_a');
        $data["jawab_b"]        = $this->input->post('jawab_b');
        $data["jawab_c"]        = $this->input->post('jawab_c');
        $data["jawab_d"]        = $this->input->post('jawab_d');
        $data["jawab_e"]        = $this->input->post('jawab_e');
        $data["created_by"]     = $this->session->userdata('akun');
        $data["update_by"]      = $this->session->userdata('akun');
        $data["soal_jawaban"]   = $this->input->post('kunci');
        $data["status_soal"]    = "aktif";
        $data["jenis_media"]    = $media[1];
        if (!empty($this->input->post('media'))) {
            $data["jenis_media"]    = $media[1];
            $data["media_file"]     = $this->input->post('media');
            $data["size_media"]     = $this->input->post('height') . "," . $this->input->post('width');
        } else {
            $data["jenis_media"]    = '';
            $data["media_file"]     = '';
            $data["size_media"]     = '100%,100%';
        }
        if (empty($this->input->post('id'))) {
            $this->session->set_flashdata('notif', 'Add Question Successfully');
            $this->m_soal->save($data);
        } else {
            $this->session->set_flashdata('notif', 'Update Question Successfully');
            $this->m_soal->update($data, $this->input->post('id'));
        }

        redirect('../admin/soal/');
    }
    public function icon()
    {
        $this->load->view('admin/icon');
    }
    public function import()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/soal/import');
        $this->load->view('layouts/footer');
    }
    public function draf($id)
    {
        $data["status_soal"]   = "draf";
        $this->m_soal->update($data, $id);
        redirect('../admin/soal/');
    }
    public function aktif($id)
    {
        $data["status_soal"]   = "aktif";
        $this->m_soal->update($data, $id);
        redirect('../admin/soal/');
    }
    public function delete($id)
    {
        $this->m_soal->delete($id);
        redirect('../admin/soal/');
    }
    public function upload()
    {
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else if ('xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $error = '';
            if ($sheetData[0][1] == "SOAL") {
                for ($i = 1; $i < count($sheetData); $i++) {
                    if (empty($sheetData[$i]['1'])) {
                        $error .= '<p class="m-0">there is a blank in the question column ' . $i . '</p>';
                    } elseif (empty($sheetData[$i]['8'])) {
                        $error .= '<p class="m-0">there is a blank in the answer key column ' . $i . '</p>';
                    } elseif (empty($sheetData[$i]['9'])) {
                        $error .= '<p class="m-0">something is empty in the hashtag column ' . $i . '</p>';
                    } elseif (empty($sheetData[$i]['10'])) {
                        $error .= '<p class="m-0">there is an empty in the question type column ' . $i . '</p>';
                    }

                    if (empty($error)) {
                        $data['soal']           = "<p>" . $sheetData[$i]['1'] . "</p>";
                        $data['jenis_soal']     = $sheetData[$i]['2'];
                        $data['jawab_a']        = $sheetData[$i]['3'];
                        $data['jawab_b']        = $sheetData[$i]['4'];
                        $data['jawab_c']        = $sheetData[$i]['5'];
                        $data['jawab_d']        = $sheetData[$i]['6'];
                        $data['jawab_e']        = $sheetData[$i]['7'];
                        $data['soal_jawaban']   = $sheetData[$i]['8'];
                        $data['hastag']         = $sheetData[$i]['9'];
                        $data['type_soal']      = $sheetData[$i]['10'];
                        $data['status_soal']    = "aktif";
                        $data["id_user"]        = $this->session->userdata('akun');
                        $this->session->set_flashdata('notif', 'Add Question Successfully');
                        $this->session->set_flashdata('message', $error);
                        $this->m_soal->save($data);
                    }
                }
            } else {
                $this->session->set_flashdata('message', 'Template is wrong');
            }
            redirect('../admin/soal/');
        }
    }
    public function ceksoal()
    {
        $total  = $this->input->post("no");
        $type   = $this->input->post("type");
        $c = $this->m_soal->total($this->input->post("ujian"));

        if ($type == "total_ganda") {
            if ($total > $c->ganda) {
                echo '<div class="alert alert-danger mt-2">The total input exceeds the current total multiple choice questions <strong>(total ' . $c->ganda . ')</strong></div>';
            }
        } elseif ($type == "total_pernyataan") {
            if ($total > $c->truefalse) {
                echo '<div class="alert alert-danger mt-2">The total input exceeds the total of the current statement questions <strong>(total ' . $c->truefalse . ')</strong></div>';
            }
        } elseif ($type == "total_easy") {
            if ($total > $c->esay) {
                echo '<div class="alert alert-danger mt-2">The total input exceeds the current total of essay questions <strong>(total ' . $c->esay . ')</strong></div>';
            }
        }
    }
    public function cektype()
    {
        $total  = $this->input->post("no");
        $type   = $this->input->post("type");
        $c = $this->m_soal->total($this->input->post("ujian"));

        if ($type == "mudah") {
            if ($total > $c->mudah) {
                echo '<div class="alert alert-danger mt-2">The total input exceeds the current total easy questions <strong>(total ' . $c->mudah . ')</strong></div>';
            }
        } elseif ($type == "medium") {
            if ($total > $c->sedang) {
                echo '<div class="alert alert-danger mt-2">The total input exceeds the total of the current medium questions <strong>(total ' . $c->sedang . ')</strong></div>';
            }
        } elseif ($type == "susah") {
            if ($total > $c->susah) {
                echo '<div class="alert alert-danger mt-2">The total input exceeds the current total of hard questions <strong>(total ' . $c->susah . ')</strong></div>';
            }
        }
    }
    public function media()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/soal/media');
        $this->load->view('layouts/footer');
    }
    public function imageUploadPost()
    {
        $config['upload_path']   = './dir/assets/img/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|mkv|mpeg|mp4';
        $config['max_size']      = 105024;


        $this->load->library('upload', $config);
        $this->upload->do_upload('file');


        print_r('Image Uploaded Successfully.');
        exit;
    }
    public function checkcustom()
    {
        $status = $this->input->post('status');
        $soal = count($this->input->post('cek_soal'));
        for ($i = 0; $i < $soal; $i++) {
            if ($status == "delete") {
                $this->m_soal->delete($this->input->post('cek_soal')[$i]);
            } elseif ($status == "publish") {
                $data["status_soal"]   = "aktif";
                $this->m_soal->update($data, $this->input->post('cek_soal')[$i]);
                redirect('../admin/soal/');
            } elseif ($status == "disabled") {
                $data["status_soal"]   = "draf";
                $this->m_soal->update($data, $this->input->post('cek_soal')[$i]);
                redirect('../admin/soal/');
            }
        }
        $this->session->set_flashdata('notif', 'Delete Question Successfully');
        redirect('../admin/soal/');
    }
    public function totalsoal()
    {
        $id = $this->input->post('id');
        $c = $this->m_soal->total($id);
        echo "$c->mudah,$c->sedang,$c->susah,$c->ganda,$c->truefalse,$c->esay";
    }
}
