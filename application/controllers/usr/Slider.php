<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model("M_slider");
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
            'content' => 'admin/pages/slider',
            'slider' => $this->M_slider->getData(),
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function simpan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $title_kecil = $this->input->post("title_kecil");
        $title_besar = $this->input->post("title_besar");
        $file_image = $_FILES['file_image'];
        $new_name = time() . "-" . date('Ymd');
        $config['upload_path']          = './public/upload/slider/';
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
                'title_kecil' => $title_kecil,
                'title_besar' => $title_besar,
                'file_img' => $data['upload_data']['file_name'],
                'user_id' => $this->session->userdata('user_id'),
                'created_at' => $now,
                'updated_at' => $now
            );
            $query = $this->db->insert("slider", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Slider updated successfully',
            );
        }
        echo json_encode($response);
    }

    public function delete_data()
    {
        $id = $this->input->post('id');
        $value = $this->db->where('id', $id)->get('slider')->row();
        $videoPath = './public/upload/slider/' . $value->file_img;
        if (file_exists($videoPath)) {
            unlink($videoPath);
        }
        $query = $this->db->where('id', $id)->delete('slider');
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

    public function edit_data_show()
    {
        $id = $this->input->post("id");
        $row = $this->db->where('id', $id)->get('slider')->row();
        $data = array(
            'file_img' => $row->file_img,
            'title_kecil' => $row->title_kecil,
            'title_besar' => $row->title_besar,
        );
        if (!empty($row)) {
            $response = [
                'data' => $data,
            ];
        } else {
            $response = [
                'data' => 'empty'
            ];
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function update_slider()
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $id = $this->input->post('id_update');
        $title_kecil = $this->input->post('title_kecil_update');
        $title_besar = $this->input->post('title_besar_update');
        $file_image = $_FILES["file_image_update"];
        $row = $this->db->where('id', $id)->get('slider')->row();
        if ($file_image['name'] == '') {
            $data2 = array(
                'title_kecil' => $title_kecil,
                'title_besar' => $title_besar,
                'user_id' => $this->session->userdata('id_user'),
                'updated_at' => $now,
            );
            $query =  $this->db->where('id', $id)->update("slider", $data2);
            $response = array(
                'status' => 'success',
                'message' => 'Updated successfully'
            );
        } else {
            $path = './public/upload/slider/' . $row->file_img;
            unlink($path);
            $new_name = time() . "-" . date('Ymd');
            $config['upload_path']          = './public/upload/slider/';
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
                    'title_kecil' => $title_kecil,
                    'title_besar' => $title_besar,
                    'user_id' => $this->session->userdata('id_user'),
                    'updated_at' => $now
                );
                $query = $this->db->where('id', $id)->update("slider", $data2);
                $response = array(
                    'status' => 'success',
                    'message' => 'Slider updated successfully',
                );
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }
}
