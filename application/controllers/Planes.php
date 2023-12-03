<?php 

class Planes extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('plane_model');
    }

    public function index() {
        $data['title'] = 'Travelpedia - Our planes';
        $data['customCSS'] = array('planes.css');
        $data['customJS'] = array('planes.js');

        $this->load->view('prefab/header.php', $data);
        $this->load->view('planes/plane-list.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function edit($editId) {

    }

    public function add() {
        // $loginId = $this->session->userdata('login_id');
        //     $userCheck = $this->user_model->get($loginId);
        //     var_dump($userCheck->level);
        //     return;
        
        if ($this->session->userdata('login_id')) {
            $loginId = $this->session->userdata('login_id');
            $userCheck = $this->user_model->get($loginId);

            if ($userCheck->level !== '1') return redirect(base_url().'index.php/planes');
        }else return redirect(base_url().'index.php/planes');
        
        $data['title'] = 'Travelpedia - New Plane';
        $data['customCSS'] = array('planes.css');
        $data['customJS'] = array('planes.js');

        $this->load->view('prefab/header.php', $data);
        $this->load->view('planes/plane-form.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function auth_edit() {

    }

    public function auth_add() {

    }

    public function auth_delete() {

    }
}

?>