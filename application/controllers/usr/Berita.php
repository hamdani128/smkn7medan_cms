<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model("M_berita");
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
            'content' => 'admin/pages/berita',
            'berita' => $this->M_berita->getData(),
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function insert()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $code_berita = $this->M_berita->code_berita();
        $judul_berita = $this->input->post('judul');
        $kategori = $this->input->post('cmb_kategori');
        $file_image = $_FILES["file_image"];
        $tanggal =  $this->input->post('tanggal');
        $new_name = time() . "-" . date('Ymd');
        $detail1 = $this->input->post("detail_1");
        $detail2 = $this->input->post("detail_2");
        $penulis = $this->input->post("penulis");
        $sumber = $this->input->post("sumber");
        $user_id = $this->session->userdata("user_id");
        $slug = url_title($judul_berita, 'dash', true);

        $config['upload_path']          = './public/upload/berita/';
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
                'kode_berita' => $code_berita,
                'file_img' => $data['upload_data']['file_name'],
                'kategori' => $kategori,
                'judul' => $judul_berita,
                'slug' => $slug,
                'tanggal' => $tanggal,
                'detail_1' => $detail1,
                'detail_2' => $detail2,
                'penulis' => $penulis,
                'sumber' => $sumber,
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
                'updated_at' => $now
            );
            $query = $this->db->insert("berita", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        echo json_encode($response);
    }


    public function insert_berita_detail()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $file_img = $_FILES['file_img'];
        $keterangan = $this->input->post("keterangan");
        $kodeberita = $this->M_berita->code_berita();
        $new_name = time() . "-" . date('Ymd');
        $config['upload_path']          = './public/upload/berita/detail/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']            = 2048;
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_img')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $data2 = array(
                'kode_berita' => $kodeberita,
                'file_img' => $data['upload_data']['file_name'],
                'deskripsi' => $keterangan,
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
                'updated_at' => $now
            );
            $query = $this->db->insert("berita_img", $data2);
        }
        // echo json_encode($response);
    }

    public function delete_berita()
    {
        $id = $this->input->post("id");
        $berita_value = $this->db->where("id", $id)->get("berita")->row();
        $kode_berita = $berita_value->kode_berita;
        $berita_detaiL_result = $this->db->where("kode_berita", $kode_berita)->get("berita_img")->result();
        $folder_path = './public/upload/berita/';
        $folder_path_detail = './public/upload/berita/detail/';
        if (empty($berita_detaiL_result)) {
            unlink($folder_path . $berita_value->file_img);
            $query1 = $this->db->where("id", $id)->delete("berita");
            if ($query1) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Deleted Successfully'
                );
                echo json_encode($response);
            }
        } else {
            unlink($folder_path . $berita_value->file_img);
            foreach ($berita_detaiL_result as $row) {
                unlink($folder_path_detail . $row->file_img);
            }
            $query1 = $this->db->where("id", $id)->delete("berita");
            $query2 = $this->db->where("kode_berita", $kode_berita)->delete("berita_img");
            if ($query1 && $query2) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Deleted Successfully'
                );
                echo json_encode($response);
            }
        }
    }
}
