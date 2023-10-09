<?php
class M_agenda extends CI_Model
{

    public function PaginateSurvei($limit, $offset, $search = null)
    {
        if ($search) {
            $this->db->like('judul', $search);
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get('survei');
        return $query->result();
    }
}
