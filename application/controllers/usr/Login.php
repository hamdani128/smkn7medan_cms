<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }

    public function index()
    {
        $this->load->view('admin/auth/login');
    }

    public function cek_login()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $where = array(
            'username' => $username,
            'password' => md5($password)
        );
        $cek = $this->M_login->cek_login("users", $where)->num_rows();
        $value = $this->M_login->cek_login("users", $where)->row();
        if ($cek > 0) {
            $data_session = array(
                'nama' => $username,
                'fullname' => $value->fullname,
                'email' => $value->email,
                'level' => $value->level,
                'log_in' => "login",
                'user_id' => $value->id,
            );
            $this->session->set_userdata($data_session);
            $response = [
                'status' => 'success',
                'message' => 'Login successful',
            ];
            echo json_encode($response);
            // redirect(base_url("admin"));
        } else {
            // echo "Username dan password salah !";
            $response = [
                'status' => 'gagal',
                'message' => 'Username dan password salah !',
            ];
            echo json_encode($response);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('usr/login'));
    }
}
