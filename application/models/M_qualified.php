<?php

class M_qualified extends CI_Model
{
    private $table = "ex_qualified";
    function get()
    {
        return $this->db->query("SELECT * FROM ex_qualified WHERE soft_delete='0'");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_qua" => $id])->row();
    }
    public function code($id)
    {
        return $this->db->get_where($this->table, ["code_qualified" => $id])->row();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_qua" => $id));
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_qua' => $id));
    }
}
