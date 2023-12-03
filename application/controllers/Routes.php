<?php 

class Routes extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("route_model");
        $this->load->model('user_model');
        $this->load->model('plane_model');
    }

    public function index() {
        $data['title'] = 'Travelpedia - Routes';
        $data['customCSS'] = array('routes.css', 'planes.css');

        $loginData = $this->user_model->get($this->session->userdata('login_id'));
        $data['showAdd'] = (($loginData->level === '1') ? true : false);
        
        if (!$data['showAdd']) $data['routes'] = $this->route_model->getAvailable();
        else $data['routes'] = $this->route_model->getAll();

        $this->load->view('prefab/header.php', $data);
        $this->load->view('routes/routes-list.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function add() {
        if ($this->session->userdata('login_id')) {
            $loginId = $this->session->userdata('login_id');
            $userCheck = $this->user_model->get($loginId);

            if ($userCheck->level !== '1') return redirect(base_url().'index.php/planes');
        }else return redirect(base_url().'index.php/routes');
        
        $data['title'] = 'Travelpedia - Add Route';
        $data['customCSS'] = array('planes.css');

        $data['planes'] = $this->plane_model->getAll();

        $this->load->view('prefab/header.php', $data);
        $this->load->view('routes/routes-form.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function edit($editId) {
        if ($this->session->userdata('login_id')) {
            $loginId = $this->session->userdata('login_id');
            $userCheck = $this->user_model->get($loginId);

            if ($userCheck->level !== '1') return redirect(base_url().'index.php/planes');
        }else return redirect(base_url().'index.php/routes');
        
        $data['title'] = 'Travelpedia - Routes';
        $data['customCSS'] = array('planes.css');

        $data['planes'] = $this->plane_model->getAll();
        $data['ogData'] = $this->route_model->get($editId);
        if (!$data['ogData']) return redirect(base_url().'index.php/routes');
        //Temporary fallback solution
        //TODO: Make a not found dislay

        $this->load->view('prefab/header.php', $data);
        $this->load->view('routes/routes-update-form.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function auth_add() {
        $inserted = $this->route_model->insert();
        if ($inserted) {
            $this->session->set_flashdata(array('msg' => "Added new route", 'type' => 'success'));
            redirect(base_url().'index.php/routes');
        }
        else {
            $this->session->set_flashdata(array('msg' => "An error has occurred", 'type' => 'fail'));
            redirect(base_url().'index.php/routes/add');
        }
    }

    public function auth_edit($editId) {
        $updated = $this->route_model->update($editId);
        if ($updated) {
            $this->session->set_flashdata(array('msg' => "Updated route", 'type' => 'success'));
            redirect(base_url().'index.php/routes');
        }
        else {
            $this->session->set_flashdata(array('msg' => "An error has occurred", 'type' => 'fail'));
            redirect(base_url().'index.php/routes/add');
        }
    }

    public function auth_delete($delId) {
        $deleted = $this->route_model->delete($delId);
        $this->session->set_flashdata(array('notif' => $deleted['msg'], 'type' => $deleted['status']));
        redirect(base_url().'index.php/routes');
    }
}

?>