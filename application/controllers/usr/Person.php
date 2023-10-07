<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Person extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->session->sess_expiration = '60';
        $this->session->sess_expire_on_close = 'true';
        if ($this->session->userdata('log_in') != "login") {
            redirect(base_url("admin/login"));
        }
    }

    public function index()
    {
        $data = [
            'title' => "Admin - Person",
            'person' => $this->db->where_not_in('level', 'Super Admin')->get('users')->result(),
            'content' => 'admin/pages/person',
        ];
        $this->load->view('admin/layout/content', $data);
    }

    public function insert()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $level = $this->input->post('cmb_level');

        $data1 = array(
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email,
            'password' => md5($password),
            'level' => $level,
            'inititated' => $level,
            'created_at' => $now,
            'updated_at' => $now,
        );
        $this->db->insert("users", $data1);
        $user_id = $this->db->insert_id();
        $data2 = array(
            'user_id' => $user_id,
            'password' => $password,
            'created_at' => $now,
            'updated_at' => $now,
        );
        $query = $this->db->insert('history_password', $data2);
        if ($query) {
            $response = array(
                'status' => 'success',
                'message' => 'successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'failed',
            );
        }
        echo json_encode($response);
    }
}
