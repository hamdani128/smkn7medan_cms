<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koleksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
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
            'content' => 'admin/pages/koleksi',
            'koleksidata' => $this->db->get("koleksi")->result(),
            // 'kategori_koleksi' => $this->db->get("koleksi_kategori")->result(),
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function insert()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $kategori = $this->input->post("cmb_kategori");
        $judul = $this->input->post("judul");
        $content = $this->input->post("summernoteValue");
        $sumber = $this->input->post("sumber");
        $penulis = $this->input->post("penulis");
        $tanggal = $this->input->post("tanggal");

        $file_img = $_FILES["file_img"];
        $new_name = time() . "-" . date('Ymd');
        $config['upload_path']          = './public/upload/koleksi/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']            = 2048;
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file_img')) {
            // $error = array('error' => $this->upload->display_errors());
            $response = array(
                'status' => 'img_error',
                'message' => $this->upload->display_errors . " Upload failed",
            );
        } else {
            $data = array('upload_data' => $this->upload->data());
            $data2 = array(
                'kategori' => $kategori,
                'penulis' => $penulis,
                'file_image' => $data['upload_data']['file_name'],
                'tanggal' => $tanggal,
                'judul' => $judul,
                'detail' => $content,
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
                'updated_at' => $now
            );
            $query = $this->db->insert("koleksi", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        echo json_encode($response);
    }

    public function delete_koleksi()
    {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $id = $input['id'];
        $value = $this->db->where('id', $id)->get('koleksi')->row();
        $file_img = $value->file_image;
        $folder_path = './public/upload/koleksi/';
        unlink($folder_path . $file_img);
        $query1 = $this->db->where("id", $id)->delete("koleksi");
        if ($query1) {
            $response = array(
                'status' => 'success',
                'message' => 'Deleted Successfully'
            );
            echo json_encode($response);
        }
    }


    public function get_datakategori()
    {
        $query = $this->db->get("koleksi_kategori")->result();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($query));
    }

    public function insert_katagori_koleksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $userid = $this->session->userdata('user_id');

        $kategori = $input['kategori'];
        $data = array(
            'kategori' => $kategori,
            'user_id' => $userid,
            'created_at' => $now,
            'updated_at' => $now,
        );
        $query = $this->db->insert("koleksi_kategori", $data);
        if ($query) {
            $response = array(
                'success' => 'Success',
                'message' => 'Successfully created !'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function kategori_delete()
    {
        $json = file_get_contents('php://input');
        $input = json_decode($json, true);
        $id = $input['id'];
        $query = $this->db->where('id', $id)->delete("koleksi_kategori");
        if ($query) {
            $response = array(
                'success' => 'Success',
                'message' => 'Successfully Deleted !'
            );
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
