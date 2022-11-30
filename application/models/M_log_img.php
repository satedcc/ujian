<?php

class M_log_img extends CI_Model
{
    private $table = "ex_log_img";
    function get()
    {
        return $this->db->query("SELECT * FROM ex_log_img");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function getByVid($id)
    {
        return $this->db->get_where($this->table, ["id_regis" => $id, "type_file" => "video"])->result();
    }
    public function getByImg($id)
    {
        return $this->db->get_where($this->table, ["id_regis" => $id, "type_file" => "img"])->result();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_img" => $id));
    }
}
