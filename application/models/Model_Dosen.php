<?php 
class Model_Dosen extends CI_Model {

    public function GetAllDosen($limit, $start, $keyword = null) {

        if($keyword) {
            $this->db->like("nama_dosen", $keyword);
            $this->db->or_like("tempat_lahir", $keyword);
            $this->db->or_like("tanggal_lahir", $keyword);
            $this->db->or_like("alamat_dosen", $keyword);
            $this->db->or_like("nip_dosen", $keyword);
            $this->db->or_like("mengajar", $keyword);

        }
        return $this->db->get("data_dosen", $limit, $start)->result_array();
    }


    public function JumlahDosen() {

        return $this->db->get("data_dosen")->num_rows();
    }


    public function tambah() {

        $data = [
            "nama_dosen" => $this->input->post("nama_dosen", true),
            "tempat_lahir" => $this->input->post("tempat_lahir", true),
            "tanggal_lahir" => $this->input->post("tanggal_lahir", true),
            "alamat_dosen" => $this->input->post("alamat_dosen", true),
            "nip_dosen" => $this->input->post("nip_dosen", true),
            "mengajar" => $this->input->post("mengajar", true)
            
        ];

        $this->db->insert("data_dosen", $data);
    }

    public function HapusData($id) {

        return $this->db->delete("data_dosen", ["id" => $id]);
    }

    public function DetailDosen($id) {

        return $this->db->get_where("data_dosen", ["id" => $id])->row_array();
    }


    public function CariData() {

        $cari = $this->input->post("pencarian");
        $this->db->like("nama_dosen", $cari);
        $this->db->or_like("tempat_lahir", $cari);
        $this->db->like("tanggal_lahir", $cari);
        $this->db->like("alamat_dosen", $cari);
        $this->db->like("nip_dosen", $cari);
        $this->db->or_like("mengajar", $cari);

        return $this->db->get("data_dosen")->result_array();
    }

    public function UbahData() {

        $data = [
            "nama_dosen" => $this->input->post("nama_dosen", true),
            "tempat_lahir" => $this->input->post("tempat_lahir", true),
            "tanggal_lahir" => $this->input->post("tanggal_lahir", true),
            "alamat_dosen" => $this->input->post("alamat_dosen", true),
            "nip_dosen" => $this->input->post("nip_dosen", true),
            "mengajar" => $this->input->post("mengajar", true)
        ];

        $this->db->where("id", $this->input->post("id"));
        $this->db->update("data_dosen", $data);

    }
}


?>