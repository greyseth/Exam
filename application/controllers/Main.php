<?php 

class Main extends CI_Controller {
	public function index() {
		$data['title'] = 'Travelpedia - Home';
		
		$this->load->view('prefab/header.php', $data);
		$this->load->view('prefab/footer.php', $data);
	}
}

?>