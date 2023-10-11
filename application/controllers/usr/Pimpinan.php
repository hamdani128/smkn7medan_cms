<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model("M_pimpinan");
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
            'content' => 'admin/pages/pimpinan',
            'pimpinan' => $this->M_pimpinan->getData(),
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function insert()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $nama = $this->input->post('pimpinan');
        $jabatan = $this->input->post('jabatan');
        $file_image = $_FILES["file_image"];
        $new_name = time() . "-" . date('Ymd');
        $config['upload_path']          = './public/upload/pimpinan/';
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
                'nama' => $nama,
                'jabatan' => $jabatan,
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
                'updated_at' => $now
            );
            $query = $this->db->insert("pimpinan", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        echo json_encode($response);
    }


    public function delete_pimpinan()
    {
        $id = $this->input->post('id');
        $row = $this->db->where('id', $id)->get('pimpinan')->row();
        $file_image = $row->file_img;
        $path = './public/upload/pimpinan/' . $file_image;
        if (file_exists($path)) {
            unlink($path);
            $query = $this->db->where('id', $id)->delete('pimpinan');
        } else {
            $query = $this->db->where('id', $id)->delete('pimpinan');
        }
        $response = array(
            'status' => 'success',
            'message' => 'success successfully',
        );
        echo json_encode($response);
    }


    public function edit_show()
    {
        $id = $this->input->post('id');
        $row = $this->db->where('id', $id)->get('pimpinan')->row();
        $data = array(
            'file_img' => $row->file_img,
            'nama' => $row->nama,
            'jabatan' => $row->jabatan,
        );
        echo json_encode($data);
    }

    public function update_pimpinan()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $id = $this->input->post('id_update');
        $nama = $this->input->post('pimpinan_update');
        $jabatan = $this->input->post('jabatan_update');
        $file_image = $_FILES["file_image_update"];
        $row = $this->db->where('id', $id)->get('pimpinan')->row();
        if ($file_image['name'] == '') {
            $data2 = array(
                'nama' => $nama,
                'jabatan' => $jabatan,
                'user_id' => $this->session->userdata('id_user'),
                'updated_at' => $now,
            );
            $query =  $this->db->where('id', $id)->update("pimpinan", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Updated successfully'
            );
        } else {
            $path = './public/upload/pimpinan/' . $row->file_img;
            unlink($path);
            $new_name = time() . "-" . date('Ymd');
            $config['upload_path']          = './public/upload/pimpinan/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']            = 2048;
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file_image_update')) {
                // $error = array('error' => $this->upload->display_errors());
                $response = array(
                    'status' => 'img_error',
                    'message' => $this->upload->display_errors . " Upload failed",
                );
            } else {
                $data = array('upload_data' => $this->upload->data());
                $data2 = array(
                    'file_img' => $data['upload_data']['file_name'],
                    'nama' => $nama,
                    'jabatan' => $jabatan,
                    'user_id' => $this->session->userdata('user_id'),
                    'updated_at' => $now
                );
                $query = $this->db->where('id', $id)->update("pimpinan", $data2);
                $response = array(
                    'status' => 'success',
                    'message' => 'Slider updated successfully',
                );
            }
        }
        echo json_encode($response);
    }
}
