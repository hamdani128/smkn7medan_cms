<?php
class M_slider extends CI_Model
{
    private $tbl_slider = "slider";


    function getData()
    {
        return $this->db->get($this->tbl_slider)->result();
    }
}
