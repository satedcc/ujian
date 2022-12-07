<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Peserta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_reg');
        $this->load->model('m_qualified');
        $this->load->model('m_email');
        is_logged_in();
    }
    public function index()
    {
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["peserta"] = $this->m_reg->get($user)->result();
        } else {
            $data["peserta"] = $this->m_reg->getAdmin()->result();
        }
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/peserta/peserta', $data);
        $this->load->view('layouts/footer');
    }
    public function history($id)
    {
        $data["history"]    = $this->m_reg->history($id);
        $data["row"]        = $this->m_reg->getById($id);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/peserta/history', $data);
        $this->load->view('layouts/footer');
    }
    public function all()
    {
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["peserta"] = $this->m_reg->get($user)->result();
        } else {
            $data["peserta"] = $this->m_reg->getAdmin()->result();
        }
        $data["id"] = $this->input->post('id');
        $this->load->view('admin/peserta/all', $data);
    }
    public function tambah()
    {
        $data["qua"] = $this->m_qualified->get()->result();
        $data['reg']   = $this->m_reg->autonumber();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/peserta/form', $data);
        $this->load->view('layouts/footer');
    }
    public function edit($id)
    {
        $data["qua"] = $this->m_qualified->get()->result();
        $data["row"] = $this->m_reg->getById($id);
        $data['reg']   = $this->m_reg->autonumber();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/peserta/form', $data);
        $this->load->view('layouts/footer');
    }
    public function delete($id)
    {
        // $data["soft_delete"]   = "1";
        $this->m_reg->delete($id);
        redirect('../admin/peserta/');
    }
    public function detail($id)
    {
        $data["row"] = $this->m_reg->getById($id);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/peserta/detail', $data);
        $this->load->view('layouts/footer');
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

        $reg    = $this->m_reg->autonumber();
        $nourut = substr($reg->kodeTerbesar, 4, 6);
        $huruf = "EXAM";
        $noreg = $huruf . sprintf("%06s", $nourut + 1);


        $datax["id_qua"]         = $this->input->post('qualified');
        $datax["no_regist"]      = $noreg;
        $datax["nama_lengkap"]   = $this->input->post('nama');
        $datax["nik"]            = $this->input->post('nik');
        $datax["email_peserta"]  = $this->input->post('email');
        $datax["nomor_peserta"]  = $this->input->post('nomor');
        $datax["alamat_peserta"] = $this->input->post('alamat');
        $datax["tempat_lhr"]     = $this->input->post('tempat');
        $datax["tgl_lahir"]      = $this->input->post('tanggal');
        $datax["jk"]             = $this->input->post('jk');
        $datax["id_user"]        = $this->session->akun;

        $cek = $this->m_reg->cekRegis($this->input->post('email'));
        $nik = $this->m_reg->cekNik($this->input->post('nik'));

        $data["qua"]    = $this->m_qualified->get()->result();
        $data['reg']    = $this->m_reg->autonumber();

        if (empty($this->input->post('id'))) {
            if ($cek > 0) {
                $this->session->set_flashdata('notif', 'Email exist');
                $this->load->view('layouts/header');
                $this->load->view('layouts/sidebar');
                $this->load->view('admin/peserta/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $pass_status = strongPassword($this->input->post('password'));
                if ($pass_status == "strong") {
                    if ($this->input->post('password') != $this->input->post('confirm')) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password not same</div>');
                        $this->load->view('layouts/header');
                        $this->load->view('layouts/sidebar');
                        $this->load->view('admin/peserta/form', $data);
                        $this->load->view('layouts/footer');
                    } else {
                        if ($_FILES["file"]["name"] != '') {
                            if (!$this->upload->do_upload('file')) {
                                $data["error"] = $this->upload->display_errors();
                                $this->load->view('layouts/header');
                                $this->load->view('layouts/sidebar');
                                $this->load->view('admin/peserta/form', $data);
                                $this->load->view('layouts/footer');
                            } else {
                                if ($nik > 0) {
                                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIK Exist</div>');
                                    $this->load->view('layouts/header');
                                    $this->load->view('layouts/sidebar');
                                    $this->load->view('admin/peserta/form', $data);
                                    $this->load->view('layouts/footer');
                                } else {
                                    if (!preg_match("/^[a-zA-Z ]*$/", $this->input->post('nama'))) {
                                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Name cannot be letters and characters</div>');
                                        $this->load->view('layouts/header');
                                        $this->load->view('layouts/sidebar');
                                        $this->load->view('admin/peserta/form', $data);
                                        $this->load->view('layouts/footer');
                                    } else {
                                        $datax["password"]   = md5(md5($this->input->post('password')));
                                        $datax['file_photo']  = $filename;
                                        $this->session->set_flashdata('notif', 'Add Partisipant Successfully');
                                        $this->m_reg->save($datax);
                                        redirect('../admin/peserta/');
                                    }
                                }
                            }
                        } else {
                            if ($nik > 0) {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIK Exist</div>');
                                $this->load->view('layouts/header');
                                $this->load->view('layouts/sidebar');
                                $this->load->view('admin/peserta/form', $data);
                                $this->load->view('layouts/footer');
                            } else {
                                if (!preg_match("/^[a-zA-Z ]*$/", $this->input->post('nama'))) {
                                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Name cannot be letters and characters</div>');
                                    $this->load->view('layouts/header');
                                    $this->load->view('layouts/sidebar');
                                    $this->load->view('admin/peserta/form', $data);
                                    $this->load->view('layouts/footer');
                                } else {
                                    $datax["password"]   = md5(md5($this->input->post('password')));
                                    $datax['file_photo']  = $filename;
                                    $this->session->set_flashdata('notif', 'Add Partisipant Successfully');
                                    $this->m_reg->save($datax);
                                    redirect('../admin/peserta/');
                                }
                            }
                        }
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password must have uppercase, lowercase and numbers</div>');
                    $this->load->view('layouts/header');
                    $this->load->view('layouts/sidebar');
                    $this->load->view('admin/peserta/form', $data);
                    $this->load->view('layouts/footer');
                }
            }
        } else {
            if ($_FILES["file"]["name"] != '') {
                if (!$this->upload->do_upload('file')) {
                    $data["error"]  = $this->upload->display_errors();
                    $data["qua"]    = $this->m_qualified->get()->result();
                    $data["row"]    = $this->m_reg->getById($this->input->post('id'));
                    $data['reg']    = $this->m_reg->autonumber();
                    $this->load->view('layouts/header');
                    $this->load->view('layouts/sidebar');
                    $this->load->view('admin/peserta/form', $data);
                    $this->load->view('layouts/footer');
                } else {
                    $datax['file_photo']  = $filename;
                    if (!empty($this->input->post('password'))) {
                        $datax["password"]   = md5(md5($this->input->post('password')));
                    }
                    $this->session->set_flashdata('notif', 'Update Partisipant Successfully');
                    $this->m_reg->update($datax, $this->input->post('id'));
                    redirect('../admin/peserta/');
                }
            } else {
                if (!empty($this->input->post('password'))) {
                    $datax["password"]   = md5(md5($this->input->post('password')));
                }

                if (!empty($this->input->post('validasi_nik'))) {
                    $nikcek = $this->m_reg->cekNik($this->input->post('nik'));
                    if ($nikcek > 0) {
                        $data["qua"] = $this->m_qualified->get()->result();
                        $data["row"] = $this->m_reg->getById($this->input->post('id'));
                        $data['reg']   = $this->m_reg->autonumber();
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIK Exist</div>');
                        redirect('../admin/peserta/edit/' . $this->input->post('id'), $data);
                    } else {
                        if (!empty($this->input->post('validasi_email'))) {
                            if ($cek > 0) {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">EMAIL Exist</div>');
                                redirect('../admin/peserta/edit/' . $this->input->post('id'), $data);
                            } else {
                                if (!preg_match("/^[a-zA-Z ]*$/", $this->input->post('nama'))) {
                                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Name cannot be letters and characters</div>');
                                    redirect('../admin/peserta/edit/' . $this->input->post('id'), $data);
                                } else {
                                    $this->session->set_flashdata('notif', 'Update Partisipant Successfully');
                                    $this->m_reg->update($datax, $this->input->post('id'));
                                    redirect('../admin/peserta/');
                                }
                            }
                        } else {
                            if (!preg_match("/^[a-zA-Z ]*$/", $this->input->post('nama'))) {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Name cannot be letters and characters</div>');
                                redirect('../admin/peserta/edit/' . $this->input->post('id'), $data);
                            } else {
                                $this->session->set_flashdata('notif', 'Update Partisipant Successfully');
                                $this->m_reg->update($datax, $this->input->post('id'));
                                redirect('../admin/peserta/');
                            }
                        }
                    }
                } else {
                    if (!empty($this->input->post('validasi_email'))) {
                        if ($cek > 0) {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">EMAIL Exist</div>');
                            redirect('../admin/peserta/edit/' . $this->input->post('id'), $data);
                        } else {
                            if (!preg_match("/^[a-zA-Z ]*$/", $this->input->post('nama'))) {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Name cannot be letters and characters</div>');
                                redirect('../admin/peserta/edit/' . $this->input->post('id'), $data);
                            } else {
                                $this->session->set_flashdata('notif', 'Update Partisipant Successfully');
                                $this->m_reg->update($datax, $this->input->post('id'));
                                redirect('../admin/peserta/');
                            }
                        }
                    } else {
                        if (!preg_match("/^[a-zA-Z ]*$/", $this->input->post('nama'))) {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Name cannot be letters and characters</div>');
                            redirect('../admin/peserta/edit/' . $this->input->post('id'), $data);
                        } else {
                            $this->session->set_flashdata('notif', 'Update Partisipant Successfully');
                            $this->m_reg->update($datax, $this->input->post('id'));
                            redirect('../admin/peserta/');
                        }
                    }
                }
            }
        }
    }
    public function draf($id)
    {
        $data["status_peserta"]   = "0";
        $this->m_reg->update($data, $id);
        redirect('../admin/peserta/');
    }
    public function aktif($id)
    {
        $data["status_peserta"]   = "1";
        $data["failid"]           = "0";
        $this->m_reg->update($data, $id);

        $datax['id_regis'] = $id;
        $datax['time_login'] = date("Y-m-d H:i:s");
        $datax['status_login'] = 'activate';
        $this->m_reg->saveHistory($datax);
        redirect('../admin/peserta/');
    }
    public function noavaliable($id)
    {
        $data["avaliable"]   = "N";
        $this->m_reg->update($data, $id);
        redirect('../admin/peserta/');
    }
    public function avaliable($id)
    {
        $data["avaliable"]   = "Y";
        $this->m_reg->update($data, $id);
        redirect('../admin/peserta/');
    }
    public function import()
    {
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/peserta/import');
        $this->load->view('layouts/footer');
    }
    public function autonumber()
    {
        $auto   = $this->m_reg->autonumber();
        $urutan = (int) substr($auto->kodeTerbesar, 6, 6);
        $urutan++;
        $huruf  = "EXAM";
        $auto = $huruf . sprintf("%06s", $urutan);
        echo $auto;
    }
    public function upload()
    {
        // GET LAST ID
        error_reporting(0);
        $reg    = $this->m_reg->autonumber();
        $nourut = substr($reg->kodeTerbesar, 4, 6);
        $huruf = "EXAM";
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
            for ($i = 1; $i < count($sheetData); $i++) {

                $cek = $this->m_reg->cekRegis($sheetData[$i]['9']);
                $nik = $this->m_reg->cekNik($sheetData[$i]['1']);
                $error = '';
                if (!empty($sheetData[$i]['5'])) {
                    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $sheetData[$i]['5'])) {
                        $error .= 'Format DATE OF BIRTH is yyyy-mm-dd (Row ' . $i . ')<br>';
                    }
                }
                if (!empty($sheetData[$i]['9'])) {
                    // Validate e-mail
                    if (!filter_var($sheetData[$i]['9'], FILTER_VALIDATE_EMAIL)) {
                        $error .= 'Email not valid (Row ' . $i . ')<br>';
                    }
                }

                if ($cek > 0) {
                    $error .= 'Already exists (Row ' . $i . ')<br>';
                } elseif ($nik > 0) {
                    $error .= 'NIK exists (Row ' . $i . ')<br>';
                } elseif ($nik > 0) {
                    $error .= 'NIK exists (Row ' . $i . ')<br>';
                } elseif (empty($sheetData[$i]['1'])) {
                    $error .= 'Empty in column NIK (Row ' . $i . ')<br>';
                } elseif (empty($sheetData[$i]['2'])) {
                    $error .= 'Empty in the NAME column (Row ' . $i . ')<br>';
                } elseif (empty($sheetData[$i]['3'])) {
                    $error .= 'Empty in the QUALIFIED column (Row ' . $i . ')<br>';
                } elseif (empty($sheetData[$i]['4'])) {
                    $error .= 'Empty in the column for BIRTH (Row ' . $i . ')<br>';
                } elseif (empty($sheetData[$i]['5'])) {
                    $error .= 'Empty in the DATE OF BIRTH column (Row ' . $i . ')<br>';
                } elseif (empty($sheetData[$i]['6'])) {
                    $error .= 'Empty in the Address field (Row ' . $i . ')<br>';
                } elseif (empty($sheetData[$i]['7'])) {
                    $error .= 'Empty in the Gender column (Row ' . $i . ')<br>';
                } elseif (empty($sheetData[$i]['8'])) {
                    $error .= 'Empty in the telephone column (Row ' . $i . ')<br>';
                } elseif (empty($sheetData[$i]['9'])) {
                    $error .= 'Empty in the EMAIL column (Row ' . $i . ')<br>';
                }

                echo $error;
                if (empty($error)) {
                    $code = $this->m_qualified->code($sheetData[$i]['3']);
                    if (isset($code->id_qua)) {
                        $kode = $code->id_qua;;
                    } else {
                        $kode = 1;
                    }

                    if (empty($sheetData[$i]['1'] || $sheetData[$i]['2'] || $sheetData[$i]['3'] || $sheetData[$i]['4'] || $sheetData[$i]['5'])) {
                    } else {
                        $noreg = $huruf . sprintf("%06s", $nourut + $i);
                        $data['nik']            = $sheetData[$i]['1'];
                        $data['nama_lengkap']   = $sheetData[$i]['2'];
                        $data['no_regist']      = $noreg;
                        $data['id_qua']         = $kode;
                        $data['tempat_lhr']     = $sheetData[$i]['4'];
                        $data['tgl_lahir']      = $sheetData[$i]['5'];
                        $data['alamat_peserta'] = $sheetData[$i]['6'];
                        $data['jk']             = $sheetData[$i]['7'];
                        $data['nomor_peserta']  = $sheetData[$i]['8'];
                        $data['email_peserta']  = $sheetData[$i]['9'];
                        $data['password']       = md5(md5($sheetData[$i]['10']));
                        $data['status_peserta'] = "0";
                        $data['avaliable']      = "N";
                        $data['last_login']     = "0000-00-00 00:00:00";
                        $data['update_date']    = "0000-00-00 00:00:00";
                        $data['soft_delete']    = "0";
                        $data["id_user"]        = $this->session->akun;
                        $this->session->set_flashdata('notif', 'Participant has been added');
                        $this->m_reg->save($data);
                    }
                } else {
                    exit();
                }
            }
            // redirect('../admin/peserta/');
        }
    }
    public function checkcustom()
    {
        $user = count($this->input->post('cek_user'));
        for ($i = 0; $i < $user; $i++) {
            $status =  $this->input->post('status')[$i];
            if ($status == "delete") {
                $this->m_reg->delete($this->input->post('cek_user')[$i]);
            } elseif ($status == "aktif") {
                $data["status_peserta"]   = "1";
                $this->m_reg->update($data, $this->input->post('cek_user')[$i]);
            } elseif ($status == "disabled") {
                $data["status_peserta"]   = "0";
                $this->m_reg->update($data, $this->input->post('cek_user')[$i]);
            } elseif ($status == "available") {
                $data["avaliable"]   = "Y";
                $this->m_reg->update($data, $this->input->post('cek_user')[$i]);
            } elseif ($status == "notavailable") {
                $data["avaliable"]   = "N";
                $this->m_reg->update($data, $this->input->post('cek_user')[$i]);
            }
        }
        $this->session->set_flashdata('notif', 'Update Partisipant Successfully');
        // redirect('../admin/peserta/');
    }
}
