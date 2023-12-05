<?php 

class Book extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('notifs');
        $this->load->model('book_model');
        $this->load->model('route_model');
    }

    function index() {
        if ($this->session->userdata('login_id')) 
            $data['books'] = $this->book_model->getUser($this->session->userdata('login_id'));
        else return redirect(base_url().'index.php/auth/login');
        
        $data['title'] = 'Book a Flight';
        $data['customCSS'] = array('book.css', 'routes.css');
        $data['customJS'] = array('book.js');

        $data['routes'] = $this->route_model->getAvailable();

        $this->load->view('prefab/header.php', $data);
        $this->load->view('books/books-add.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function add() {
        if ($this->input->post('newbook') && $this->session->userdata('login_id')) {
            $booked = $this->book_model->book();
            if ($booked['status'] === 'success') {
                $this->notifs->send('Order Booked', 'A new order has been booked');
                $this->load->view('peypel.php');
            }else {
                $this->session->set_flashdata(array('notif' => $booked['msg'], 'type' => $booked['status']));
                return redirect(base_url().'index.php/book');
            }
        }else return redirect(base_url().'index.php');            
    }

    public function success() {
        $data['title'] = 'Book a Flight';
        $data['customCSS'] = array('book.css');

        $this->load->view('prefab/header.php', $data);
        $this->load->view('books/book-success.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }
}

?>