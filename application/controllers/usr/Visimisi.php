<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visimisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model("M_visimisi");
        $this->session->sess_expiration = '60';
        $this->session->sess_expire_on_close = 'true';
        if ($this->session->userdata('log_in') != "login") {
            redirect(base_url("admin/login"));
        }
    }

    public function index()
    {
        $data = [
            'title' => "Admin - Museum",
            'content' => 'admin/pages/visimisi',
            'visimisi' => $this->M_visimisi->getData(),
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function insert()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $tahun_periode = $this->input->post("tahun_periode");
        $visi = $this->input->post("visi");
        $misi = $this->input->post("summernoteValue");
        $user_id = $this->session->userdata("user_id");

        $data = [
            'tahun_periode' => $tahun_periode,
            'visi' => $visi,
            'misi' => $misi,
            'user_id' => $user_id,
            'created_at' => $now,
            'updated_at' => $now,
        ];
        $query = $this->db->insert("visimisi", $data);

        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Data Inserted Successfully',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data Insert Failed',
            );
        }
        echo json_encode($response);
    }
}
