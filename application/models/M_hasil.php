<?php

class M_hasil extends CI_Model
{
    private $table = "ex_jawaban";
    function get()
    {
        return $this->db->query("SELECT * FROM ex_jawaban");
    }
}
