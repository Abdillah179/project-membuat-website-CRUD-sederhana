<?php 
class Tambah_Data_Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Dosen");
        $this->load->library("form_validation");
    }


    public function index () {

        $this->load->view("Tambah_Data_Dosen");
    }

    public function tambah() {

        // form validation

        $this->form_validation->set_rules("nama_dosen", "NAMA", "required", [
            "required" => "Field Nama Dosen Harus Diisi"
        ]);

        $this->form_validation->set_rules("tempat_lahir", "TEMPAT LAHIR", "required", [
            "required" => "Field Tempat Lahir Harus Diisi"
        ]);

        $this->form_validation->set_rules("tanggal_lahir", "TANGGAL LAHIR", "required", [
            "required" => "Field Tanggal Lahir Harus Diisi"
        ]);

        $this->form_validation->set_rules("alamat_dosen", "ALAMAT DOSEN", "required", [
            "required" => "Field Alamat Dosen Harus Diisi"
        ]);

        $this->form_validation->set_rules("nip_dosen", "NIP DOSEN", "required|integer", [
            "required" => "Field NIP Harus Diisi",
            "integer" => "Field NIP Harus Diisi Berupa Angka"
        ]);

        $this->form_validation->set_rules("mengajar", "MENGAJAR", "required", [
            "required" => "Field Mengajar Harus Diisi"
        ]);


        if($this->form_validation->run() == FALSE) {

            $this->load->view("Tambah_Data_Dosen");
        } else {
            $this->Model_Dosen->tambah();
            $this->session->set_flashdata("flash", "Ditambahkan");
            redirect("Tambah_Data_Dosen/tambah");
        }
        
    }



}

?> 