<?php

class M_setting extends CI_Model
{
    private $table = "ex_setting";
    function get()
    {
        return $this->db->query("SELECT * FROM ex_setting WHERE id_setting='1'");
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_setting" => $id])->row();
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_setting' => $id));
    }
}
