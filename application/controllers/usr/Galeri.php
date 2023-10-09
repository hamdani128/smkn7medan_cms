<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galeri extends CI_Controller
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
        $kegiatan = $this->db->get("kegiatan_photo")->result();
        $data = [
            'title' => "Admin - Museum | Galeri Photo Kegiatan",
            'content' => 'admin/pages/kegiatan',
            'kegiatan' => $kegiatan,
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function video()
    {
        $video = $this->db->get("kegiatan_video")->result();
        $data = [
            'title' => "Admin - Museum | Galeri Photo Kegiatan",
            'content' => 'admin/pages/video',
            'video' => $video,
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function insert_kegiatan()
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

        $config['upload_path']          = './public/upload/galeri/photo/';
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
            $query = $this->db->insert("kegiatan_photo", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        echo json_encode($response);
    }


    public function delete_kegiatan()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $value = $this->db->get('kegiatan_photo')->row();
        //lokasi folder gambar
        $folder_path = './public/upload/galeri/photo/';
        //nama file gambar yang akan dihapus
        $row_image = $value->file_img;
        //hapus gambar
        if (file_exists($folder_path . $row_image)) {
            unlink($folder_path . $row_image);
            $this->db->delete('kegiatan_photo', array('id' => $id));
        } else {
            $this->db->delete('kegiatan_photo', array('id' => $id));
        }
        $data = array(
            'status' => 'success',
            'messages' => 'successfully',
        );
        echo json_encode($data);
    }


    public function insert_video()
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

        $config['upload_path']          = './public/upload/galeri/video/';
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
            $query = $this->db->insert("kegiatan_video", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        echo json_encode($response);
    }
}
