<?php 
class Halaman_Edit_Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Dosen");
        $this->load->library("form_validation");
    }

    public function index () {

        $data["judul"] = "Halaman Ubah Data Dosen";
        $this->load->view("Halaman_Edit_Dosen", $data);
    }

    public function Ubah($id) {

        $data["dosen"] = $this->Model_Dosen->DetailDosen($id);

        // form validation

        $this->form_validation->set_rules("nama_dosen", "NAMA DOSEN", "required", [
            "required" => "Field Nama Dosen Harus Diisi"
        ]);

        $this->form_validation->set_rules("tempat_lahir", "TEMPAT LAHIR", "required", [
            "required" => "Field Tempat Lahir Dosen Harus Diisi"
        ]);

        $this->form_validation->set_rules("tanggal_lahir", "TANGGAL LAHIR", "required", [
            "required" => "Field Tanggal Lahir Dosen Harus Diisi"
        ]);

        $this->form_validation->set_rules("alamat_dosen", "ALAMAT DOSEN", "required", [
            "required" => "Field Alamat Dosen Harus Diisi"
        ]);

        $this->form_validation->set_rules("nip_dosen", "NIP DOSEN", "required|integer", [
            "required" => "Field NIP Dosen Harus Diisi",
            "integer" => "Field NIP Dosen tidak boleh disi selain angka"
        ]);

        $this->form_validation->set_rules("mengajar", "ALAMAT DOSEN", "required", [
            "required" => "Field Mengajar Harus Diisi"
        ]);

        if($this->form_validation->run() == FALSE) {

            $data["judul"] = "Halaman Ubah Data Dosen";
            $this->load->view("Halaman_Edit_Dosen", $data);
        } else {

            $this->Model_Dosen->UbahData();
            $this->session->set_flashdata("flash", "Diubah");
            redirect("Halaman_Dosen");
        }
    }
}


?>