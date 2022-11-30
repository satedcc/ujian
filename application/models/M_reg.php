<?php

class M_reg extends CI_Model
{
    private $table = "ex_register";
    private $table2 = "ex_history_login";
    function get($id)
    {
        return $this->db->query("SELECT * FROM ex_register AS a LEFT JOIN ex_qualified AS b ON a.id_qua=b.id_qua WHERE a.soft_delete='0' AND a.id_user='$id'");
    }
    function getAdmin()
    {
        return $this->db->query("SELECT * FROM ex_register AS a LEFT JOIN ex_qualified AS b ON a.id_qua=b.id_qua WHERE a.soft_delete='0'");
    }
    function getAll()
    {
        return $this->db->query("SELECT 
                                a.id_regis,
                                a.nama_lengkap,
                                a.no_regist,
                                a.email_peserta,
                                (SELECT COUNT(id_regis) FROM ex_jawaban WHERE id_regis=a.id_regis) as total_jawab,
                                (SELECT COUNT(id_regis) FROM ex_detail_jadwal WHERE id_regis=a.id_regis) as total_jadwal,
                                (SELECT COUNT(CASE WHEN b.jawaban = c.soal_jawaban THEN 1 END ) FROM ex_jawaban AS b LEFT JOIN ex_soal AS c ON b.id_soal = c.id_soal WHERE b.id_regis=a.id_regis) as benar
                                FROM ex_register as a");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function saveHistory($data)
    {
        return $this->db->insert($this->table2, $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_regis" => $id])->row();
    }
    public function getByOtp($id)
    {
        return $this->db->get_where($this->table, ["otp" => $id])->row();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_regis" => $id));
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_regis' => $id));
    }
    public function cekRegis($id)
    {
        return $this->db->get_where($this->table, ["email_peserta" => $id, "soft_delete" => "0"])->num_rows();
    }
    public function cekNik($id)
    {
        return $this->db->get_where($this->table, ["nik" => $id, "soft_delete" => "0"])->num_rows();
    }
    public function cekAvailable($id)
    {
        return $this->db->get_where($this->table, ["avaliable" => "Y", "id_regis" => $id])->num_rows();
    }
    public function cekOtp($id, $email)
    {
        return $this->db->get_where($this->table, ["otp" => $id, "email_peserta" => $email])->num_rows();
    }
    public function autonumber()
    {
        return $this->db->query("SELECT max(no_regist) as kodeTerbesar FROM ex_register")->row();
    }
    public function history($id)
    {
        return $this->db->get_where($this->table2, ["id_regis" => $id])->result();
    }
    public function updateOtp($data, $id)
    {
        return $this->db->query("UPDATE ex_register SET otp = '$data' WHERE email_peserta='$id'");
    }
    public function actived($id)
    {
        return $this->db->query("UPDATE ex_register SET status_peserta = '1' WHERE otp='$id'");
    }
    public function total()
    {
        return $this->db->query("SELECT
                                (SELECT COUNT(*) FROM ex_register) as total_regis,
                                (SELECT COUNT(*) FROM ex_soal) as total_soal,
                                (SELECT COUNT(*) FROM ex_ujian) as total_ujian,
                                (SELECT COUNT(*) FROM ex_jadwal) as total_jadwal");
    }
    public function cekRegId($id)
    {
        return $this->db->get_where($this->table, ["no_regist" => $id])->num_rows();
    }
}
