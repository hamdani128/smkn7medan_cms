<?php
class M_profile extends CI_Model
{
    private $tbl_profile = "profile";


    function getData()
    {
        $this->db->select('*');
        $this->db->from($this->tbl_profile);
        $this->db->limit(1); // Metode limit() dipanggil pada objek kelas database
        $query = $this->db->get();
        return $query->row();
    }
}
