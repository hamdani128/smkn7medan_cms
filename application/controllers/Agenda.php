<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_agenda");
        $this->load->library('pagination');
    }

    public function survei()
    {
        $limit = 5;
        $offset = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $search = $this->input->get('search');
        $data = [
            'title' => "SMK Negeri 7 Medan",
            'tital_halaman' => 'Arkoelogi',
            'content' => "landing/agenda/survei",
            'surveidata' => $this->M_agenda->PaginateSurvei($limit, $offset, $search),
        ];
        $this->load->view('landing/layout/content', $data);
    }
}
