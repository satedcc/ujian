<?php

class M_email extends CI_Model
{
    private $table = "ex_log_email";
    function get()
    {
        return $this->db->query("SELECT * FROM ex_log_email");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["email_log" => $id])->result();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_log" => $id));
    }
}
