<?php 
class Halaman_Edit_Mahasiswa extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Mahasiswa");
        $this->load->library("form_validation");
    }

    public function index () {

        $this->load->view("Halaman_Edit_Mahasiswa");
    }
        
    public function Ubah($id) 
    {
        $data["mhs"] = $this->Model_Mahasiswa->GetDetailMahasiswa($id);

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
            $this->load->view("Halaman_Edit_Mahasiswa", $data);
        } else {
            $this->Model_Mahasiswa->UbahData();
            $this->session->set_flashdata("flash", "Diubah");
            redirect("Halaman_Mahasiswa");
        }
        
    }
}
?>