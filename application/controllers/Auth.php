<?php 

class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index() {
        redirect(base_url().'index.php/auth/login');
    }
    
    //Login page view
    public function login() {
        $data['title'] = 'Travelpedia - Login';
        $data['customCSS'] = array('auth.css');
        $data['customJS'] = array('auth.js');
        
        $this->load->view('prefab/header.php', $data);

        $this->load->view('auth/login_view.php', $data);

        $this->load->view('prefab/footer.php', $data);
    }

    //Signup page view
    public function signup() {
        $data['title'] = 'Travelpedia - Signup';
        $data['customCSS'] = array('auth.css');
        $data['customJS'] = array('auth.js');
        
        $this->load->view('prefab/header.php', $data);

        $this->load->view('auth/signup_view.php', $data);

        $this->load->view('prefab/footer.php', $data);
    }

    //Login form handler
    public function auth_login() {
        if ($this->input->post('login')) {
            //Performs login check
            $loginResult = $this->user_model->login();

            $this->session->set_flashdata(array('notif' => $loginResult['msg'], 'type' => $loginResult['status']));
            if ($loginResult['status'] === 'fail') redirect(base_url().'index.php/auth/login');
            else redirect(base_url().'index.php');

        }else redirect(base_url().'index.php/auth/login');
    }

    //Signup form handler
    public function auth_signup() {
        if ($this->input->post('signup')) {
            //Performs signup actions
            $signupResult = $this->user_model->signup();        

            $this->session->set_flashdata(array('notif' => $signupResult['msg'], 'type' => $signupResult['status']));
            if ($signupResult['status'] === 'fail') redirect(base_url().'index.php/auth/signup');
            else redirect(base_url().'index.php');            

        }else redirect(base_url().'index.php/auth/signup');
    }
}

?>