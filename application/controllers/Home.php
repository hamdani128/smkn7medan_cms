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
        $data = [
            'title' => 'SMK Negeri 7 Medan',
            'content' => "landing/index",
            'slider' => $this->M_slider->getData(),
            'profile' => $this->M_profile->getData(),
            'pimpinan' => $this->M_pimpinan->getData(),
            'jurusan' => $this->db->get('jurusan')->result(),
            // 'koleksigroup' => $this->M_koleksi->getkategori(),
            // 'koleksidata' => $this->M_koleksi->getData(),
            // 'zonadata' => $this->db->get("zona_integritas")->result(),
            // 'photo_kegiatan' => $this->db->select("*")->from("kegiatan_photo")->limit(3, 0)->get()->result(),
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
            'title' => 'SMK Negeri 7 Medan',
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

    public function getdata_berita()
    {
        $data = $this->M_berita->getData();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
