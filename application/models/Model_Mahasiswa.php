<?php 
class Model_Mahasiswa extends CI_Model {

    public function GetAllMahasiswa ($limit, $start, $keyword = null) {

        if($keyword) {
            $this->db->like("nama_mahasiswa", $keyword);
        }
        return $this->db->get("data_mahasiswa", $limit, $start)->result_array();
    }


    public function JumlahMahasiswa() {

        return $this->db->get("data_mahasiswa")->num_rows();
    }


    public function Tambah () {

        $data = [
            "nama_mahasiswa" => $this->input->post("nama_mahasiswa", true),
            "tempat_lahir" => $this->input->post("tempat_lahir", true),
            "tanggal_lahir" => $this->input->post("tanggal_lahir", true),
            "alamat_mahasiswa" => $this->input->post("alamat_mahasiswa", true),
            "jurusan" =>$this->input->post("jurusan", true),
            "nim_mahasiswa" => $this->input->post("nim_mahasiswa", true)
        ];

        $this->db->insert("data_mahasiswa", $data);
    }


    public function Hapus($id) {

        return $this->db->delete("data_mahasiswa", ["id"=>$id]);
    }

    public function DetailMahasiswa($id) {

        return $this->db->get_where("data_mahasiswa", ["id" => $id])->row_array();
    }

    public function GetDetailMahasiswa($id) {

        return $this->db->get_where("data_mahasiswa", ["id" => $id])->row_array();
    }

    public function UbahData () {

        $data = [
            
            "nama_mahasiswa" => $this->input->post("nama_mahasiswa", true),
            "tempat_lahir" => $this->input->post("tempat_lahir", true),
            "tanggal_lahir" => $this->input->post("tanggal_lahir", true),
            "alamat_mahasiswa" => $this->input->post("alamat_mahasiswa", true),
            "jurusan" =>$this->input->post("jurusan", true),
            "nim_mahasiswa" => $this->input->post("nim_mahasiswa", true)
        ];

        $this->db->where('id', $this->input->post("id"));
        $this->db->update('data_mahasiswa', $data);
    }

    public function CariData() {

        $cari = $this->input->post("cari");
        $this->db->like("nama_mahasiswa", $cari);
        $this->db->or_like("alamat_mahasiswa", $cari);
        $this->db->or_like("tempat_lahir", $cari);
        $this->db->or_like("tanggal_lahir", $cari);
        $this->db->or_like("jurusan", $cari);
        $this->db->or_like("nim_mahasiswa", $cari);
        return $this->db->get("data_mahasiswa")->result_array();
    }
}

?>