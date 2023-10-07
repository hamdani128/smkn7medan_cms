<?php
class M_berita extends CI_Model
{
    private $table_berita = "berita";


    public function code_berita()
    {
        $SQL = "SELECT MAX(RIGHT(kode_berita,5)) as KD_MAX FROM berita";
        $query = $this->db->query($SQL);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int) $row->KD_MAX) + 1;
            $no = sprintf("%04s", $n);
        } else {
            $no = "00001";
        }
        $kode = '#B-' . date('ymd') . $no;
        return $kode;
    }

    function getData()
    {
        return $this->db->get($this->table_berita)->result();
    }

    function getData_toHome()
    {
        return $this->db->limit(3, 0)->get($this->table_berita)->result();
    }

    function getDataImage($kode_berita)
    {
        return $this->db->where('kode_berita', $kode_berita)->get("berita_img")->result();
    }

    public function getDataByid($id)
    {
        return $this->db->where('id', $id)->get($this->table_berita)->result();
    }

    public function jumlahData()
    {
        $query = $this->db->get($this->table_berita);
        return $query->num_rows();
    }

    public function get_published($limit = null, $offset = null)
    {
        if (!$limit && !$offset) {
            $query = $this->db
                ->get($this->table_berita);
        } else {
            $query =  $this->db
                ->get($this->table_berita, $limit, $offset);
        }
        return $query->result();
    }

    public function KategoriBerita()
    {
        $SQL = "SELECT kategori,COUNT(*) as jumlah FROM berita GROUP BY kategori";
        return $this->db->query($SQL)->result();
    }

    public function DetailBerita($id)
    {
        $SQL = "SELECT * FROM " . $this->table_berita . " WHERE id='" . $id . "'";
        return $this->db->query($SQL)->row();
    }

    public function getDetailImage($kode_berita)
    {
        $SQL = "SELECT * FROM berita_img WHERE kode_berita='" . $kode_berita . "'";
        return $this->db->query($SQL)->result();
    }

    public function DeleteBeritaImage($kode_berita)
    {
        $SQL = "DELETE FROM berita_img WHERE kode_berita='" . $kode_berita . "'";
        return $this->db->query($SQL);
    }

    public function DeleteBeritaByid($id)
    {
        $SQL = "DELETE FROM berita WHERE id='" . $id . "'";
        return $this->db->query($SQL);
    }
}
