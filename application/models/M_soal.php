<?php

class M_soal extends CI_Model
{
    private $table = "ex_soal";
    private $table2 = "ex_detail_soal";
    function get()
    {
        return $this->db->query("SELECT * FROM ex_soal WHERE soft_delete='0' ORDER BY id_soal DESC");
    }
    function getAll($id)
    {
        return $this->db->query("SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal WHERE a.id_ujian='$id' ORDER BY a.id_soal DESC");
    }
    function info($id)
    {
        return $this->db->query("SELECT * FROM ex_ujian AS a LEFT JOIN ex_jadwal AS b ON a.id_ujian=b.id_kategori WHERE b.id_jadwal='$id'")->row();
    }
    function tampilSoal($id, $e, $m, $h, $r)
    {
        // return $this->db->query("(SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal LEFT JOIN ex_jadwal AS c ON a.id_ujian=c.id_kategori WHERE b.jenis_soal='E' AND a.id_ujian='$id' ORDER BY RAND() LIMIT $e) 
        // UNION 
        // (SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal LEFT JOIN ex_jadwal AS c ON a.id_ujian=c.id_kategori WHERE b.jenis_soal='M' AND a.id_ujian='$id' ORDER BY RAND() LIMIT $m) 
        // UNION 
        // (SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal LEFT JOIN ex_jadwal AS c ON a.id_ujian=c.id_kategori WHERE b.jenis_soal='H' AND a.id_ujian='$id' ORDER BY RAND() LIMIT $h)");

        return $this->db->query("(SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal WHERE b.jenis_soal='E' AND a.id_ujian='$id' ORDER BY $r LIMIT $e)
                                UNION 
                                (SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal WHERE b.jenis_soal='M' AND a.id_ujian='$id' ORDER BY $r LIMIT $m) 
                                UNION 
                                (SELECT * FROM ex_detail_soal AS a LEFT JOIN ex_soal AS b ON a.id_soal=b.id_soal WHERE b.jenis_soal='H' AND a.id_ujian='$id' ORDER BY $r LIMIT $h)");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function saveDetail($data)
    {
        return $this->db->insert($this->table2, $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_soal" => $id])->row();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_soal" => $id));
    }
    public function deleteDetail($id)
    {
        return $this->db->delete($this->table2, array("id_detail" => $id));
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_soal' => $id));
    }
    public function total($id)
    {
        return $this->db->query("SELECT
                                COUNT(IF(c.jenis_soal='E',1,NULL)) as mudah,
                                COUNT(IF(c.jenis_soal='M',1,NULL)) as sedang,
                                COUNT(IF(c.jenis_soal='H',1,NULL)) as susah,
                                COUNT(IF(c.type_soal='1',1,NULL)) as ganda,
                                COUNT(IF(c.type_soal='2',1,NULL)) as truefalse,
                                COUNT(IF(c.type_soal='3',1,NULL)) as esay,
                                b.id_ujian
                                FROM ex_detail_soal as a 
                                LEFT JOIN ex_ujian as b ON a.id_ujian=b.id_ujian
                                LEFT JOIN ex_soal as c ON a.id_soal=c.id_soal
                                WHERE a.id_ujian='$id'")->row();
    }
    public function getDetailSoal($id)
    {
        return $this->db->get_where($this->table2, ["id_ujian" => $id]);
    }
    public function cekSoal($id, $di)
    {
        return $this->db->get_where($this->table2, ["id_ujian" => $id, "id_soal" => $di]);
    }
}
