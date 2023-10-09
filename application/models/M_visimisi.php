<?php
class M_visimisi extends CI_Model
{
    private $tbl_visimisi = "visimisi";


    function getData()
    {
        $this->db->select('*');
        $this->db->from($this->tbl_visimisi);
        $this->db->limit(1); // Metode limit() dipanggil pada objek kelas database
        $query = $this->db->get();
        return $query->row();
    }
}
