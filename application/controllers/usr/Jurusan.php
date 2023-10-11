<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
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
            'content' => 'admin/pages/jurusan',
        ];
        $this->load->view('admin/layout/content', $data);
    }


    public function getdata()
    {
        $query = $this->db->get('jurusan')->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }


    public function insert_data()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $jurusan = $this->input->post('nama_jurusan');
        $deskirpsi = $this->input->post('summernoteValue');
        $file_image = $_FILES["file_image"];
        $new_name = time() . "-" . date('Ymd');
        $config['upload_path']          = './public/upload/jurusan/';
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
                'nama_jurusan' => $jurusan,
                'deskripsi' => $deskirpsi,
                'file_img' => $data['upload_data']['file_name'],
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
                'updated_at' => $now
            );
            $this->db->insert("jurusan", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function delete_jurusan()
    {
        $id = $this->input->post('id');
        $row = $this->db->where('id', $id)->get('jurusan')->row();

        $videoPath = './public/upload/jurusan/' . $row->file_img;
        if (file_exists($videoPath)) {
            unlink($videoPath);
        }
        $query = $this->db->where('id', $id)->delete('jurusan');
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'Deleted successfully',
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
