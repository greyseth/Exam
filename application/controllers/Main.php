<?php 

class Main extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('book_model');
	}

	public function index() {
		$data['title'] = 'Travelpedia - Home';
		$data['customCSS'] = array('dashboard.css', 'table.css');
		
		if ($this->session->userdata('login_level') === '0')
			$data['userBookings'] = $this->book_model->getUser($this->session->userdata('login_id'));
		else if($this->session->userdata('login_level') === '1') 
			$data['bookings'] = $this->book_model->getAll();

		$this->load->view('prefab/header.php', $data);
		$this->load->view('main/dashboard.php', $data);
		$this->load->view('prefab/footer.php', $data);
	}

	public function re_filter() {
		$name = $this->input->post('nameFilter');
		$origin = $this->input->post('originFilter');
		$destination = $this->input->post('destinationFilter');
		$plane = $this->input->post('planeFilter');

		if (!$name) $name = 'all';
		if (!$origin) $origin = 'all';
		if (!$destination) $destination = 'all';
		if (!$plane) $plane = 'all';

		redirect(base_url().'index.php/main/all_filtered/'.$name.'/'.$origin.'/'.$destination.'/'.$plane);
	}

	public function re_filter_user() {
		$origin = $this->input->post('originFilter');
		$destination = $this->input->post('destinationFilter');
		$plane = $this->input->post('planeFilter');

		if (!$origin) $origin = 'all';
		if (!$destination) $destination = 'all';
		if (!$plane) $plane = 'all';


		redirect(base_url().'index.php/main/user_filtered/'.$origin.'/'.$destination.'/'.$plane);
	}

	public function all_filtered($name, $origin, $destination, $plane) {
		$data['title'] = 'Travelpedia - Home';
		$data['customCSS'] = array('dashboard.css', 'table.css');
		
		// if ($this->session->userdata('login_level') === '0')
		// 	$data['userBookings'] = $this->book_model->getUserFiltered($this->session->userdata('login_id'), $origin, $destination, $plane);
		// else if($this->session->userdata('login_level') === '1') 
		// 	$data['bookings'] = $this->book_model->getFiltered($name, $origin, $destination, $plane);
		$data['bookings'] = $this->book_model->getFiltered(str_replace('%20', ' ', $name), str_replace('%20', ' ', $origin), str_replace('%20', ' ', $destination), str_replace('%20', ' ', $plane));

		$this->load->view('prefab/header.php', $data);
		$this->load->view('main/dashboard.php', $data);
		$this->load->view('prefab/footer.php', $data);
	}

	public function user_filtered($origin, $destination, $plane) {
		$data['title'] = 'Travelpedia - Home';
		$data['customCSS'] = array('dashboard.css', 'table.css');
		
		// if ($this->session->userdata('login_level') === '0')
		// 	$data['userBookings'] = $this->book_model->getUserFiltered($this->session->userdata('login_id'), $origin, $destination, $plane);
		// else if($this->session->userdata('login_level') === '1') 
		// 	$data['bookings'] = $this->book_model->getFiltered($name, $origin, $destination, $plane);
		$data['userBookings'] = $this->book_model->getUserFiltered($this->session->userdata('login_id'), str_replace('%20', ' ', $origin), str_replace('%20', ' ', $destination), str_replace('%20', ' ', $plane));

		$this->load->view('prefab/header.php', $data);
		$this->load->view('main/dashboard.php', $data);
		$this->load->view('prefab/footer.php', $data);
	}	
}

?>