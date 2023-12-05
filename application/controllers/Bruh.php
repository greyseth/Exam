<?php 

class Bruh extends CI_Controller {
    public function index() {
        $data['title'] = 'Travelpedia - Not Found';

        $this->load->view('prefab/header.php', $data);
        $this->load->view('not-found.php');
        $this->load->view('prefab/footer.php', $data);
    }
}

?>