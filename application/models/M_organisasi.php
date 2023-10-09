<?php
class M_organisasi extends CI_Model
{
    private $tbl_organisasi = "organisasi";


    function getData()
    {
        return $this->db->get($this->tbl_organisasi)->result();
    }
}
