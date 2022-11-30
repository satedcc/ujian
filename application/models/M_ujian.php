<?php

class M_ujian extends CI_Model
{
    private $table = "ex_ujian";
    private $table2 = "ex_patpel";
    function get($id)
    {
        return $this->db->query("SELECT
                                (SELECT COUNT(*) FROM ex_detail_soal WHERE id_ujian=a.id_ujian) as total_soal,
                                a.id_ujian,
                                a.nama_ujian,
                                a.jumlah_soal,
                                a.durasi,
                                a.status_ujian,
                                a.update_by,
                                b.id_user,
                                a.created_date
                                FROM ex_ujian as a LEFT JOIN ex_patpel as b ON a.id_ujian=b.id_ujian WHERE b.id_user='$id'");
    }
    function getAdmin()
    {
        return $this->db->query("SELECT
                                (SELECT COUNT(*) FROM ex_detail_soal WHERE id_ujian=a.id_ujian) as total_soal,
                                a.id_ujian,
                                a.nama_ujian,
                                a.jumlah_soal,
                                a.durasi,
                                a.status_ujian,
                                a.update_by,
                                a.id_user,
                                a.created_date
                                FROM ex_ujian as a");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function saveUser($data)
    {
        return $this->db->insert($this->table2, $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_ujian" => $id])->row();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_ujian" => $id));
    }
    public function deletePatpel($id, $ujian)
    {
        return $this->db->delete($this->table2, array("id_user" => $id, "id_ujian" => $ujian));
    }
    public function deleteUser($id)
    {
        return $this->db->delete($this->table2, array("id_ujian" => $id));
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_ujian' => $id));
    }
    public function cekPatpel($id, $ujian)
    {
        return $this->db->get_where($this->table, ["id_user" => $id, "id_ujian" => $ujian])->num_rows();
    }
}
