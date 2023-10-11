<?php
class M_pimpinan extends CI_Model
{
    private $tbl_pimpinan = "pimpinan";


    function getData()
    {
        return $this->db->order_by('id', 'asc')->get($this->tbl_pimpinan)->row();
    }
}
