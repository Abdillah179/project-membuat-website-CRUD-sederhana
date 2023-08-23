<?php 
class Home extends CI_Controller {

    public function index () {

        $data["judul"] = "Halaman Admin";
        $this->load->view("Home", $data);
    }
}


?>