<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_koleksi");
    }

    public function index()
    {
        $data = [
            'title' => 'App Museum | Kontak',
            // 'profile' => $this->M_profile->getData(),
            'content' => "landing/kontak",
        ];
        $this->load->view('landing/layout/content', $data);
    }
}
