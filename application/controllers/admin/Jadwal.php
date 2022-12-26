<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_ujian');
        $this->load->model('m_jadwal');
        $this->load->model('m_reg');
        $this->load->model('m_jawaban');
        $this->load->model('m_log_img');
        is_logged_in();
    }
    public function index()
    {
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["jadwal"] = $this->m_jadwal->get($user)->result();
        } else {
            $data["jadwal"] = $this->m_jadwal->getAdmin()->result();
        }
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/jadwal/jadwal', $data);
        $this->load->view('layouts/footer');
    }
    public function tambah()
    {
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["ujian"] = $this->m_ujian->get($user)->result();
        } else {
            $data["ujian"] = $this->m_ujian->getAdmin()->result();
        }
        $sku            = $this->m_jadwal->getID();
        $kodeBarang     = $sku->kodeTerbesar;
        $nourut         = substr($kodeBarang, 3, 6);
        $huruf          = "QCT";
        $data['kodeBarang'] = $huruf . sprintf("%06s", $nourut + 1);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/jadwal/form', $data);
        $this->load->view('layouts/footer');
    }
    public function edit($id)
    {
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["jadwal"] = $this->m_jadwal->get($user)->result();
        } else {
            $data["jadwal"] = $this->m_jadwal->getAdmin()->result();
        }
        $data["row"] = $this->m_jadwal->getById($id);
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["ujian"] = $this->m_ujian->get($user)->result();
        } else {
            $data["ujian"] = $this->m_ujian->getAdmin()->result();
        }
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/jadwal/form', $data);
        $this->load->view('layouts/footer');
    }
    public function view($id)
    {
        $user = $this->session->userdata('akun');
        if ($this->session->userdata('level') != "superadmin") {
            $data["jadwal"] = $this->m_jadwal->get($user)->result();
        } else {
            $data["jadwal"] = $this->m_jadwal->getAdmin()->result();
        }
        $data["row"] = $this->m_jadwal->getById($id);
        $data["ujian"] = $this->m_ujian->getAdmin()->result();
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/jadwal/view', $data);
        $this->load->view('layouts/footer');
    }
    public function save()
    {
        $data["id_kategori"]        = $this->input->post('kategori');
        $data["nama_jadwal"]        = $this->input->post('title');
        $data["mulai"]              = $this->input->post('mulai') . " " . $this->input->post('jam_mulai');
        $data["selesai"]            = $this->input->post('selesai') . " " . $this->input->post('jam_selesai');
        $data["jumlah_peserta"]     = $this->input->post('jumlah');
        $data["soal_mudah   "]      = $this->input->post('mudah');
        $data["soal_medium"]        = $this->input->post('medium');
        $data["soal_susah"]         = $this->input->post('susah');
        $data["record"]             = $this->input->post('record');
        $data["nilai_benar"]        = $this->input->post('nilai_benar');
        $data["nilai_salah"]        = $this->input->post('nilai_salah');
        $data["score"]              = $this->input->post('score');
        $data["timer"]              = $this->input->post('format_timer');
        $data["jenis_waktu"]        = $this->input->post('timer');
        $data["status_jadwal"]      = $this->input->post('status_jadwal');
        $data["interval_img"]       = $this->input->post('interval');
        $data["durasi"]             = $this->input->post('durasi');
        $data["random"]             = $this->input->post('random');

        $data["id_user"]            = $this->session->userdata('akun');
        if ($this->input->post('timer') == "S") {
            $data["set_ganda"]      = ($this->input->post('set_ganda') != "") ? timesecond($this->input->post('set_ganda')) : "00:00:00";
            $data["set_benar"]      = ($this->input->post('set_benar') != "") ? timesecond($this->input->post('set_benar')) : "00:00:00";
            $data["set_esay"]       = ($this->input->post('set_esay') != "") ? timesecond($this->input->post('set_esay')) : "00:00:00";
        }


        if (empty($this->input->post('id'))) {
            $cek = $this->m_jadwal->cekId($this->input->post('schedule_id'));
            if ($cek > 0) {
                $sku                = $this->m_jadwal->getID();
                $kodeBarang         = $sku->kodeTerbesar;
                $nourut             = substr($kodeBarang, 3, 6);
                $huruf              = "QCT";
                $reg                = $huruf . sprintf("%06s", $nourut + 1);
                $data["kode_jadwal"]   = $reg;
                $this->session->set_flashdata('notif', 'Add Schedule Successfully');
                $this->m_jadwal->save($data);
            } else {
                $data["kode_jadwal"] = $this->input->post('schedule_id');
                $this->session->set_flashdata('notif', 'Add Schedule Successfully');
                $this->m_jadwal->save($data);
            }
        } else {
            $data["update_date"] = date("Y-m-d H:i:s");
            $this->session->set_flashdata('notif', 'Update Schedule Successfully');
            $this->m_jadwal->update($data, $this->input->post('id'));
        }
        redirect('admin/jadwal/');
    }
    public function addpartisipant()
    {
        $jml = count($this->input->post('cek_regis'));
        for ($i = 0; $i < $jml; $i++) {
            $data['id_regis']    = $this->input->post('cek_regis')[$i];
            $data['id_jadwal']   = $this->input->post('idjadwal')[$i];
            $data['created_by'] = $this->session->userdata('akun');
            $data['id_user']    = $this->session->userdata('akun');
            $this->m_jadwal->savePartisipant($data);
        }
    }
    public function allpartisipant()
    {
        $data["id"]     = $this->input->post('id');
        $data["jadwal"] = $this->m_jadwal->getPartisipant($this->input->post('id'))->result();
        $this->load->view('admin/jadwal/allpartisipant', $data);
    }
    public function delete($id)
    {
        $this->m_jadwal->delete($id);
        $this->m_jadwal->deleteDetail($id);
        redirect('admin/jadwal/');
    }
    public function deletePartisipant($id)
    {
        $this->m_jadwal->deletePartisipant($id);
        redirect('admin/jadwal/');
    }
    public function true($id)
    {
        $data["status_jawaban"] = "true";
        $this->m_jawaban->update($data, $id);
?>
        <script>
            window.history.go(-1)
        </script>
    <?php
    }
    public function false($id)
    {
        $data["status_jawaban"] = "false";
        $this->m_jawaban->update($data, $id);
    ?>
        <script>
            window.history.go(-1)
        </script>
<?php
    }
    public function detailexam($reg = 0, $jadwal = 0)
    {
        $data['jadwal']     = $this->m_jadwal->getById($jadwal);
        $data['row']        = $this->m_reg->getById($reg);
        $data['jawaban']    = $this->m_jawaban->getNilai($reg, $jadwal);
        $data['nilai']      = $this->m_jawaban->cekNilai($reg, $jadwal);

        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/jadwal/detail_exam', $data);
        $this->load->view('layouts/footer');
    }
    public function draf($id)
    {
        $data['status_partisipant'] = "N";
        $this->m_jadwal->updateDetail($data, $id);
        redirect('admin/jadwal/');
    }
    public function aktif($id)
    {
        $data['status_partisipant'] = "Y";
        $this->m_jadwal->updateDetail($data, $id);
        redirect('admin/jadwal/');
    }

    public function log($id, $kode)
    {
        $data['id'] = $id;
        $data['jadwal'] = $this->m_jadwal->getById($kode);
        $data['log'] = $this->m_log_img->getByImg($id);
        $data['vid'] = $this->m_log_img->getByVid($id);
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('admin/jadwal/log', $data);
        $this->load->view('layouts/footer');
    }
    public function statuspartisipant()
    {
        $jml = count($this->input->post('cek_regis'));
        for ($i = 0; $i < $jml; $i++) {
            $data["status_partisipant"] = "N";
            if ($this->input->post('status')[$i] == "Y") {
                $data["status_partisipant"] = "N";
            } else {
                $data["status_partisipant"] = "Y";
            }
            $id           = $this->input->post('cek_regis')[$i];
            $this->m_jadwal->updateDetail($data, $id);
        }
        redirect('admin/jadwal/');
    }
    public function autonumber()
    {
        $sku        = $this->m_reg->autonumber();
        $kodeBarang = $sku->kodeTerbesar;
        $nourut     = substr($kodeBarang, 4, 6);
        $huruf      = "QCT";
        $x          = $huruf . sprintf("%06s", $nourut + 1);
        echo $x;
    }
}
