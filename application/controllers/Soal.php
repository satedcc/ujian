<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_soal');
        $this->load->model('m_jawaban');
        $this->load->model('m_jadwal');
        $this->load->model('m_reg');
        $this->load->model('m_log_img');
        is_logged_user();
    }
    public function index()
    {

        $data["jadwal"] = $this->m_jadwal->getUser($this->session->userdata('akun'))->result();
        $this->load->view('layouts/front_header');
        $this->load->view('soal', $data);
        $this->load->view('layouts/front_footer');
    }
    public function exam($id = 0, $ujian = 0, $sid = 0)
    {
        $cek = $this->m_jadwal->cekJadwal($this->session->userdata('akun'), $ujian)->num_rows();
        if ($cek > 0) {
            $soal = $this->m_jadwal->getById($ujian);
            $data["soal"]   = $this->m_soal->tampilSoal($id, $soal->soal_mudah, $soal->soal_medium, $soal->soal_susah)->result();
            $data["total"]  = $this->m_soal->tampilSoal($id, $soal->soal_mudah, $soal->soal_medium, $soal->soal_susah)->num_rows();
            $data["info"]   = $this->m_soal->info($ujian);
            $data["jadwal"] = $this->m_jadwal->getById($ujian);
            $this->load->view('layouts/front_header');
            $this->load->view('exam', $data);
            $this->load->view('layouts/front_footer');
        } else {
            redirect('../soal/');
        }
    }
    public function save()
    {
        $data = [
            'id_soal'   => $this->input->post('soal'),
            'jawab'     => $this->input->post('jawab'),
            'time'      => $this->input->post('time'),
            'jadwal'    => $this->input->post('jadwal'),
            'nomor'    => $this->input->post('nomor'),
        ];
        $_SESSION['jawaban'][] = $data;
    }
    public function jawab()
    {
        if (isset($_SESSION['jawaban'])) {
            foreach ($_SESSION['jawaban'] as $key => $value) {
                // echo $value['id_soal'] . "," . $value['jawab'] . "," . $value['time'] . "<br>";
                $data['id_soal']    = $value['id_soal'];
                $data['id_regis']   = $this->session->userdata('akun');
                $data['jawaban']    = $value['jawab'];
                $data['time']       = $value['time'];
                $data['id_jadwal']  = $value['jadwal'];
                $this->m_jawaban->save($data);

                $id = $value['jadwal'];
            }
        }
        $this->session->unset_userdata('jawaban');
        $datax['status_partisipant'] = "N";
        $this->m_jawaban->disabledJadwal($datax, $this->session->userdata('akun'), $id);
        redirect('../soal/finish/');
    }
    public function finish()
    {
        $this->load->view('layouts/front_header');
        $this->load->view('finish');
        $this->load->view('layouts/front_footer');
    }
    public function cekuser()
    {
        $id = session_id();
        $cek = $this->m_jadwal->cekPartisipant($this->input->post('id'), $this->session->userdata('akun'))->num_rows();
        if ($cek > 0) {
            $tanggal = $this->m_jadwal->cekTanggal($this->input->post('id'));
            if ($tanggal > 0) {
                echo '<div>
                    <i class="far fa-times"></i>
                    <i class="fal fa-check-circle fa-3x" style="margin-bottom: 10px;color:green;"></i>
                    <h3>Data found</h3>
                    <p>You are included in the stage of following this schedule</p>
                    <a href="' . base_url('soal/exam/' . $this->input->post('soal') . '/' . $this->input->post('id') . '/' . $id) . '" class="btn btn-main">Go to Exam</a>
                </div>';
            } else {
                echo '<div>
                    <i class="far fa-times"></i>
                    <i class="fal fa-times-circle fa-3x" style="margin-bottom: 10px;color:red;"></i>
                    <h3>Schedule Not Available</h3><span>Schedule still not available for today</span>
                </div>';
            }
        } else {
            echo '<div>
                <i class="far fa-times"></i>
                <i class="fal fa-times-circle fa-3x" style="margin-bottom: 10px;color:red;"></i>
                <h3>Data not found</h3><span>You are not included in this schedule</span>
            </div>';
        }
    }
    public function upload()
    {
        $data   = $this->input->post('image');
        $jadwal = $this->input->post('jadwal');
        $file = $this->session->userdata('akun') . '-' . $jadwal . '-' . date("YmdHis") . '.png';
        $uri =  substr($data, strpos($data, ",") + 1);
        $path = "exam-picture";
        $type = "img";
        $this->upload_now($file, $path, $type);
        file_put_contents('./dir/exam-picture/' . $file, base64_decode($uri));
    }
    private function upload_now($file, $path, $type)
    {
        $data['name_log'] = $file;
        $data['type_file'] = $type;
        $data['file_img'] = base_url() . 'dir/' . $path . '/' . $file;
        $data['id_regis'] = $this->session->userdata('akun');
        $save = $this->m_log_img->save($data);
    }
    public function uploadVideo()
    {
        if (isset($_FILES["video-blob"])) {

            echo 'dir/record/';

            $fileName = $this->session->userdata('akun') . '-' . $_POST["video-filename"];
            $uploadDirectory = 'dir/record/' . $fileName;

            if (!move_uploaded_file($_FILES["video-blob"]["tmp_name"], $uploadDirectory)) {
                echo (" problem moving uploaded file");
            }

            $path = "record";
            $type = "video";
            $this->upload_now($fileName, $path, $type);
        }
    }
}
