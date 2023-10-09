<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        // $this->load->model("M_berita");
        $this->session->sess_expiration = '60';
        $this->session->sess_expire_on_close = 'true';
        if ($this->session->userdata('log_in') != "login") {
            redirect(base_url("usr/login"));
        }
    }

    public function survei()
    {
        $data = [
            'title' => "Admin - Museum | Survei",
            'content' => 'admin/pages/survei',
            'surveidata' => $this->db->get("survei")->result(),
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function agenda()
    {
        $data = [
            'title' => "Admin - Museum | Agenda",
            'content' => 'admin/pages/agenda',
            'agendadata' => $this->db->get("agenda")->result(),
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function insert_survei()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $judul = $this->input->post('judul');
        $file_image = $_FILES["file_image"];
        $tanggal =  $this->input->post('tanggal');
        $new_name = time() . "-" . date('Ymd');
        $deskripsi = $this->input->post("summernoteValue");
        $penulis = $this->input->post("penulis");
        $user_id = $this->session->userdata("user_id");

        $config['upload_path']          = './public/upload/kegiatan/survei/';
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
                'judul' => $judul,
                'tanggal' => $tanggal,
                'deskripsi' => $deskripsi,
                'penulis' => $penulis,
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
                'updated_at' => $now
            );
            $query = $this->db->insert("survei", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        echo json_encode($response);
    }

    public function insert_agenda()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $judul = $this->input->post('judul');
        $file_image = $_FILES["file_image"];
        $tanggal =  $this->input->post('tanggal');
        $new_name = time() . "-" . date('Ymd');
        $deskripsi = $this->input->post("summernoteValue");
        $penulis = $this->input->post("penulis");
        $user_id = $this->session->userdata("user_id");

        $config['upload_path']          = './public/upload/kegiatan/agenda/';
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
                'judul' => $judul,
                'tanggal' => $tanggal,
                'deskripsi' => $deskripsi,
                'penulis' => $penulis,
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
                'updated_at' => $now
            );
            $query = $this->db->insert("agenda", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        echo json_encode($response);
    }
}
