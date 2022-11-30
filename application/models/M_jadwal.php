<?php

class M_jadwal extends CI_Model
{
    private $table = "ex_jadwal";
    private $table2 = "ex_detail_jadwal";
    function get($id)
    {
        return $this->db->query("SELECT * FROM ex_jadwal AS a LEFT JOIN ex_ujian AS b ON a.id_kategori=b.id_ujian WHERE a.id_user='$id' ORDER BY a.id_jadwal DESC");
    }
    function getAdmin()
    {
        return $this->db->query("SELECT * FROM ex_jadwal AS a LEFT JOIN ex_ujian AS b ON a.id_kategori=b.id_ujian ORDER BY a.id_jadwal DESC");
    }
    function getUser($id)
    {
        return $this->db->query("SELECT * FROM ex_jadwal AS a 
                                            LEFT JOIN ex_ujian AS b ON a.id_kategori=b.id_ujian
                                            LEFT JOIN ex_detail_jadwal AS c ON a.id_jadwal=c.id_jadwal WHERE c.id_regis='$id' AND status_partisipant='Y'");
    }
    function getAll()
    {
        return $this->db->query("SELECT * FROM ex_jadwal AS a LEFT JOIN ex_register AS b ON a.id_regis=b.id_regis");
    }
    function getPartisipant($id)
    {
        return $this->db->query("SELECT * FROM ex_detail_jadwal AS a LEFT JOIN ex_register AS b ON a.id_regis=b.id_regis LEFT JOIN ex_qualified AS c ON b.id_qua=c.id_qua WHERE a.id_jadwal='$id'");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function savePartisipant($data)
    {
        return $this->db->insert($this->table2, $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_jadwal" => $id])->row();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_jadwal" => $id));
    }
    public function deleteDetail($id)
    {
        return $this->db->delete($this->table2, array("id_jadwal" => $id));
    }
    public function deletePartisipant($id)
    {
        return $this->db->delete($this->table2, array("id_detail_jadwal" => $id));
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_jadwal' => $id));
    }
    function cekPartisipant($id, $akun)
    {
        return $this->db->query("SELECT * FROM ex_detail_jadwal WHERE id_jadwal='$id' AND id_regis='$akun'");
    }
    function cekJadwal($id, $ujian)
    {
        return $this->db->query("SELECT * FROM ex_detail_jadwal WHERE id_regis='$id' AND id_jadwal='$ujian' AND status_partisipant='Y'");
    }
    public function updateDetail($data, $id)
    {
        return $this->db->update($this->table2, $data, array('id_detail_jadwal' => $id));
    }
    public function getID()
    {
        return $this->db->query("SELECT max(kode_jadwal) as kodeTerbesar FROM ex_jadwal")->row();
    }
    function cekJadwalAktif($ujian)
    {
        return $this->db->query("SELECT * FROM ex_detail_jadwal as a LEFT JOIN ex_register as b ON a.id_regis=b.id_regis WHERE a.id_jadwal='$ujian'");
    }
    function cekTanggal($id)
    {
        return $this->db->query("SELECT * FROM ex_jadwal WHERE ( NOW() BETWEEN mulai AND selesai AND id_jadwal='$id')")->num_rows();
    }
    public function cekId($id)
    {
        return $this->db->get_where($this->table, ["kode_jadwal" => $id])->num_rows();
    }
}
