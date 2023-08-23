<?php 
class Halaman_Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Mahasiswa");
    }

    public function index () {
        
        // Ambil data Keyword 
        if($this->input->post("submit")) {
            $data["keyword"] = $this->input->post("keyword");
            $this->session->set_userdata('keyword', $data["keyword"]);
        } else {
            $data["keyword"] = $this->session->userdata["keyword"];
        }

        // PAGINATION 
        $this->db->like("nama_mahasiswa", $data["keyword"]);
        $this->db->from("data_mahasiswa");
        $config['base_url'] = 'http://localhost/CI/Halaman_Mahasiswa/index';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

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
        $data["mahasiswa"] = $this->Model_Mahasiswa->GetAllMahasiswa($config['per_page'], $data["start"], $data["keyword"]);

        $this->load->view("Halaman_Mahasiswa", $data);
    }


    public function HapusData($id) {

        $this->Model_Mahasiswa->Hapus($id);
        $this->session->set_flashdata("flash", "Dihapus");
        redirect("Halaman_Mahasiswa/index");
    }


    public function Detail($id) {

        $data["detail"] = $this->Model_Mahasiswa->DetailMahasiswa($id);
        $this->load->view("Halaman_Detail_Mahasiswa", $data);
    }

    

}


?>