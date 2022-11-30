<?php

class M_jawaban extends CI_Model
{
    private $table = "ex_jawaban";
    function get()
    {
        return $this->db->query("SELECT * FROM ex_jawaban");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_jawab" => $id])->row();
    }
    function getNilai($id, $jadwal)
    {
        return $this->db->query("SELECT * FROM ex_detail_soal AS a 
                                LEFT JOIN ex_jawaban AS b ON a.id_soal=b.id_soal
                                LEFT JOIN ex_soal AS c ON a.id_soal=c.id_soal
                                LEFT JOIN ex_detail_jadwal AS d ON b.id_jadwal=d.id_jadwal
                                WHERE b.id_regis='$id' AND b.id_jadwal='$jadwal'")->result();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_jawab" => $id));
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_jawab' => $id));
    }
    public function disabledJadwal($data, $id, $x)
    {
        return $this->db->update("ex_detail_jadwal", $data, array('id_regis' => $id, 'id_jadwal' => $x));
    }
    public function cekNilai($id, $jadwal)
    {
        return $this->db->query("SELECT 
                                COUNT(CASE WHEN a.jawaban = b.soal_jawaban THEN 1 END ) AS benar,
                                COUNT(CASE WHEN a.jawaban = '0' THEN 1 END ) AS pass,
                                COUNT(CASE WHEN a.status_jawaban = 'true' THEN 1 END ) AS benar_essay,
                                COUNT(CASE WHEN a.status_jawaban = 'false' THEN 1 END ) AS salah_essay,
                                COUNT(*) as jml,
                                (COUNT(*) - COUNT(CASE WHEN a.jawaban = b.soal_jawaban THEN 1 END )) as salah
                                FROM ex_jawaban AS a LEFT JOIN ex_soal AS b ON b.id_soal = a.id_soal WHERE a.id_regis='$id' AND a.id_jadwal='$jadwal'")->row();
    }
}
