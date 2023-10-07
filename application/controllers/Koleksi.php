<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koleksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_koleksi");
    }

    public function arkoelogi()
    {
        $data = [
            'title' => 'App Museum',
            'tital_halaman' => 'Arkoelogi',
            'content' => "landing/koleksi/arkeologi",
            'koleksidata' => $this->M_koleksi->getArkeologi(),
        ];
        $this->load->view('landing/layout/content', $data);
    }

    public function etnografi()
    {
        $data = [
            'title' => 'App Museum',
            'tital_halaman' => 'Etnografi',
            'content' => "landing/koleksi/etnografi",
            'koleksidata' => $this->M_koleksi->getEtnografi(),
        ];
        $this->load->view('landing/layout/content', $data);
    }

    public function geografi()
    {
        $data = [
            'title' => 'App Museum',
            'tital_halaman' => 'Geografi',
            'content' => "landing/koleksi/geografi",
            'koleksidata' => $this->M_koleksi->getGeografi(),
        ];
        $this->load->view('landing/layout/content', $data);
    }

    public function keramik()
    {
        $data = [
            'title' => 'App Museum',
            'tital_halaman' => 'Keramik',
            'content' => "landing/koleksi/keramik",
            'koleksidata' => $this->M_koleksi->getKeramik(),
        ];
        $this->load->view('landing/layout/content', $data);
    }


    public function numesmatik()
    {
        $data = [
            'title' => 'App Museum',
            'tital_halaman' => 'Numesmatik dan Heladrik',
            'content' => "landing/koleksi/numesmatik",
            'koleksidata' => $this->M_koleksi->getNumesmatik(),
        ];
        $this->load->view('landing/layout/content', $data);
    }

    public function prasejarah()
    {
        $data = [
            'title' => 'App Museum',
            'tital_halaman' => 'Prasejarah',
            'content' => "landing/koleksi/prasejarah",
            'koleksidata' => $this->M_koleksi->getPrasejarah(),
        ];
        $this->load->view('landing/layout/content', $data);
    }

    public function sejarah()
    {

        $data = [
            'title' => 'App Museum',
            'tital_halaman' => 'Sejarah',
            'content' => "landing/koleksi/sejarah",
            'koleksidata' => $this->M_koleksi->getSejarah(),
        ];
        $this->load->view('landing/layout/content', $data);
    }
}
