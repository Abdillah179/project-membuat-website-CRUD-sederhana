<?php 
class Tambah_Data_Mahasiswa extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Mahasiswa");
        $this->load->library("form_validation");
    }

    public function index () {

        $this->load->view("Tambah_Data_Mahasiswa/tambah");
    }

    public function tambah () 
    {
        $this->form_validation->set_rules("nama_mahasiswa", "NAMA", "required", [
            "required"=> "Field Nama Mahasiswa Baru Harus Diisi"
        ]);

        $this->form_validation->set_rules("tempat_lahir", "TEMPAT LAHIR", "required", [
            "required"=> "Field Tempat Lahir Mahasiswa Harus Diisi"
        ]);
        $this->form_validation->set_rules("tanggal_lahir", "TANGGAL LAHIR", "required", [
            "required"=> "Field Tanggal Lahir Mahasiswa Harus Diisi"
        ]);

        $this->form_validation->set_rules("alamat_mahasiswa", "ALAMAT", "required", [
            "required"=> "Field Alamat Mahasiswa Harus Diisi"
        ]);

        $this->form_validation->set_rules("jurusan", "JURUSAN", "required", [
            "required"=> "Field Jurusan Mahasiswa Harus Diisi"
        ]);

        $this->form_validation->set_rules("nim_mahasiswa", "NIM", "required|integer", [
            "required"=> "Field NIM Mahasiswa Harus Diisi",
            "integer"=> "Field NIM Mahasiswa Tidak Boleh Diinputkan Selain Angka" 
        ]);


        if($this->form_validation->run() == FALSE) 
        {
            $this->load->view("Tambah_Data_Mahasiswa");
        } else {
            $this->Model_Mahasiswa->Tambah();
            $this->session->set_flashdata("flash", "Ditambahkan");
            redirect("Tambah_Data_Mahasiswa/tambah");
        }
        
    }
}
?>