<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_slider");
        $this->load->model("M_profile");
        $this->load->model("M_visimisi");
        $this->load->model("M_pimpinan");
        $this->load->model("M_berita");
        $this->load->model("M_koleksi");
    }

    public function index()
    {
        // $url = "http://localhost/etiket/api/transaksi";
        // $data_url = file_get_contents($url);
        // $json = json_decode($data_url, true);
        $data = [
            'title' => 'Museum Negeri Sumatera Utara',
            'content' => "landing/index",
            // 'data_etiket' => $json,
            'slider' => $this->M_slider->getData(),
            'profile' => $this->M_profile->getData(),
            'berita' => $this->M_berita->getData_toHome(),
            'koleksigroup' => $this->M_koleksi->getkategori(),
            'koleksidata' => $this->M_koleksi->getData(),
            'zonadata' => $this->db->get("zona_integritas")->result(),
            'photo_kegiatan' => $this->db->select("*")->from("kegiatan_photo")->limit(3, 0)->get()->result(),
        ];
        $this->load->view('landing/layout/content', $data);
    }

    public function profile()
    {

        $data = [
            'title' => 'Museum Negeri Sumatera Utara',
            'profile' => $this->M_profile->getData(),
            'content' => "landing/tentang/profile",
        ];
        $this->load->view('landing/layout/content', $data);
    }

    public function visimisi()
    {
        $berita = $this->db->limit(5, 0)->order_by('created_at', 'DESC')->get('berita')->result();
        $data = [
            'title' => 'Museum Negeri Sumatera Utara',
            'visimisi' => $this->M_visimisi->getData(),
            'berita' => $berita,
            'kategoriberita' => $this->M_berita->KategoriBerita(),
            'content' => "landing/tentang/visimisi",
        ];
        $this->load->view('landing/layout/content', $data);
    }

    public function pimpinan()
    {
        $berita = $this->db->limit(5, 0)->order_by('created_at', 'DESC')->get('berita')->result();
        $data = [
            'title' => 'Museum Negeri Sumatera Utara',
            'pimpinan' => $this->M_pimpinan->getData(),
            'berita' => $berita,
            'kategoriberita' => $this->M_berita->KategoriBerita(),
            'content' => "landing/tentang/pimpinan",
        ];
        $this->load->view('landing/layout/content', $data);
    }


    public function berita_kategori($kategori)
    {
    }


    public function berita_detail()
    {
        $id = $this->input->get('id');
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

        $datarow = $this->M_berita->DetailBerita($id);
        $code_berita = $datarow->kode_berita;
        $datarowimg = $this->M_berita->getDetailImage($code_berita);
        $data = [
            'title' => 'Museum Negeri Sumatera Utara',
            'beritarow' => $datarow,
            'berita_img' => $datarowimg,
            'berita' => $this->M_berita->get_published($limit, $offset),
            'kategoriberita' => $this->M_berita->KategoriBerita(),
            'content' => "landing/berita/berita_detail",
            'redirect_url' => base_url('home/berita_detail?id=' . $id) // or whatever URL you want to redirect to
        ];
        $this->load->view('landing/layout/content', $data);
    }
}
