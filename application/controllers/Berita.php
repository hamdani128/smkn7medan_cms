<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_berita");
    }

    public function index()
    {
        $jumlahData = $this->M_berita->jumlahData();
        $this->load->library('pagination');
        $config['total_rows'] = $jumlahData;
        $config['per_page'] = 2;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<div class="styled-pagination"><ul class="clearfix">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a href="#" class="active">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $limit = $config['per_page'];
        $offset = html_escape($this->input->get('per_page'));
        $data['berita'] = $this->M_berita->get_published($limit, $offset);
        if (count($data['berita']) > 0) {
            $data = [
                'title' => 'Museum Negeri Sumatera Utara',
                'berita' => $this->M_berita->get_published($limit, $offset),
                'kategoriberita' => $this->M_berita->KategoriBerita(),
                'content' => "landing/berita/berita",
            ];
            $this->load->view('landing/layout/content', $data);
        } else {
            $data = [
                'title' => "SMK Negeri 7 Medan",
                'berita' => $this->M_berita->get_published($limit, $offset),
                'kategoriberita' => $this->M_berita->KategoriBerita(),
                'content' => "landing/berita/berita",
            ];
            $this->load->view('landing/layout/content', $data);
        }
    }


    public function reader($slug)
    {
        $datarow = $this->db->where('slug', $slug)->get('berita')->row();
        $code_berita = $datarow->kode_berita;
        $berita = $this->db->limit(5, 0)->order_by('created_at', 'DESC')->get('berita')->result();
        $datarowimg = $this->M_berita->getDetailImage($code_berita);
        $data = [
            'title' => 'Museum Negeri Sumatera Utara',
            'beritarow' => $datarow,
            'berita_img' => $datarowimg,
            'berita' => $berita,
            'kategoriberita' => $this->M_berita->KategoriBerita(),
            'content' => "landing/berita/berita_detail",
            'redirect_url' => base_url('home/berita_detail'), // or whatever URL you want to redirect to
        ];
        $this->load->view('landing/layout/content', $data);
    }
}
