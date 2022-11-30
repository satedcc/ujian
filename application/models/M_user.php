<?php

class M_user extends CI_Model
{
    private $table = "ex_users";
    function get()
    {
        return $this->db->query("SELECT * FROM ex_users WHERE soft_delete='0'");
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_user" => $id])->row();
    }
    public function cekUser($id)
    {
        return $this->db->get_where($this->table, ["email" => $id])->num_rows();
    }
    public function delete($id)
    {
        return $this->db->delete($this->table, array("id_user" => $id));
    }
    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_user' => $id));
    }
    public function updateOtp($data, $id)
    {
        return $this->db->query("UPDATE ex_users SET otp_user = '$data' WHERE email='$id'");
    }
    public function cekOtp($id)
    {
        return $this->db->get_where($this->table, ["otp_user" => $id])->num_rows();
    }
}
