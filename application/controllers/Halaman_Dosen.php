<?php 
class Halaman_Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Dosen");
        $this->load->library("form_validation");
    }


    public function index () {

        // PAGINATION

        $this->load->library('pagination');

        // Ambil data Keyword 
        if($this->input->post("submit")) {
            $data["keyword"] = $this->input->post("keyword");
            $this->session->set_userdata('keyword', $data["keyword"]);
        } else {
            $data["keyword"] = $this->session->userdata["keyword"];
        }

        // SET PAGINATION
        $this->db->like("nama_dosen", $data["keyword"]);
        $this->db->or_like("tempat_lahir", $data["keyword"]);
        $this->db->or_like("tanggal_lahir", $data["keyword"]);
        $this->db->or_like("alamat_dosen", $data["keyword"]);
        $this->db->or_like("nip_dosen", $data["keyword"]);
        $this->db->or_like("mengajar", $data["keyword"]);
        $this->db->from("data_dosen");
        $config['base_url'] = 'http://localhost/CI/Halaman_Dosen/index';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize

        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center mt-5">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');




        $this->pagination->initialize($config);
        
        $data["start"] = $this->uri->segment(3);
        $data["dosen"] = $this->Model_Dosen->GetAllDosen($config['per_page'], $data["start"], $data["keyword"]);

        $this->load->view("Halaman_Dosen", $data);
    }


    public function Hapus($id) 
    {
        $this->Model_Dosen->HapusData($id);
        $this->session->set_flashdata("flash", "Dihapus");
        redirect("Halaman_Dosen");
    }

    public function DetailData($id) {

        $data["detaildosen"] = $this->Model_Dosen->DetailDosen($id);
        $this->load->view("Halaman_Detail_Dosen", $data);
    }

}

?> 