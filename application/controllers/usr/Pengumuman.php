<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengumuman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model("M_profile");
        $this->session->sess_expiration = '60';
        $this->session->sess_expire_on_close = 'true';
        if ($this->session->userdata('log_in') != "login") {
            redirect(base_url("usr/login"));
        }
    }

    public function index()
    {
        $data = [
            'title' => "SMK Negeri 7 Medan",
            'content' => 'admin/pages/pengumuman',
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function insert()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $deskripsi = $this->input->post('summernoteValue');
        $file_image = $_FILES["file_image"];
        $tanggal = $this->input->post('tanggal');
        $judul = $this->input->post('judul');
        $penulis = $this->input->post('penulis');


        $new_name = time() . "-" . date('Ymd');
        $config['upload_path']          = './public/upload/pengumuman/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']            = 2048;
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file_image')) {
            // $error = array('error' => $this->upload->display_errors());
            $response = array(
                'status' => 'img_error',
                'message' => $this->upload->display_errors . " Upload failed",
            );
        } else {
            $data = array('upload_data' => $this->upload->data());
            $data2 = array(
                'file_img' => $data['upload_data']['file_name'],
                'deskripsi' => $deskripsi,
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
                'updated_at' => $now
            );
            $query = $this->db->insert("profile", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        echo json_encode($response);
    }
}
