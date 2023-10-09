<?php
class M_koleksi extends CI_Model
{
    private $table_koleksi = "koleksi";


    public function getkategori()
    {
        $SQL = "SELECT kategori FROM koleksi GROUP BY 1";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    function getData()
    {
        return $this->db->get($this->table_koleksi)->result();
    }

    public function getArkeologi()
    {
        $SQL = "SELECT * FROM koleksi WHERE kategori ='Arkeologi'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function getEtnografi()
    {
        $SQL = "SELECT * FROM koleksi WHERE kategori ='Etnografi'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function getGeografi()
    {
        $SQL = "SELECT * FROM koleksi WHERE kategori ='Geografi'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function getKeramik()
    {
        $SQL = "SELECT * FROM koleksi WHERE kategori ='Keramik'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function getNumesmatik()
    {
        $SQL = "SELECT * FROM koleksi WHERE kategori ='Numesmatik dan Heladrik'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function getPrasejarah()
    {
        $SQL = "SELECT * FROM koleksi WHERE kategori ='Prasejarah'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }

    public function getSejarah()
    {
        $SQL = "SELECT * FROM koleksi WHERE kategori ='Sejarah'";
        $query = $this->db->query($SQL)->result();
        return $query;
    }
}
