<?php

class M_info extends CI_Model
{
    private $table = "ex_informasi";
    function get()
    {
        return $this->db->query("SELECT * FROM ex_informasi");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_info" => $id])->row();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_info" => $id));
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_info' => $id));
    }
}
