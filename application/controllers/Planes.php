<?php 

class Planes extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('notifs');
        $this->load->model('user_model');
        $this->load->model('plane_model');
    }

    public function index() {
        $data['title'] = 'Travelpedia - Our planes';
        $data['customCSS'] = array('planes.css');

        $data['planeData'] = $this->plane_model->getAll();

        if ($this->session->userdata('login_id')) {
            $loginData = $this->user_model->get($this->session->userdata('login_id'));
            $data['showAdd'] = (($loginData->level === '1') ? true : false);
        }        

        $this->load->view('prefab/header.php', $data);
        $this->load->view('planes/plane-list.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function edit($editId) {
        if ($this->session->userdata('login_id')) {
            $loginId = $this->session->userdata('login_id');
            $userCheck = $this->user_model->get($loginId);

            if ($userCheck->level !== '1') return redirect(base_url().'index.php/planes');
        }else return redirect(base_url().'index.php/planes');
        
        $data['title'] = 'Travelpedia - Our planes';
        $data['customCSS'] = array('planes.css');

        $data['ogData'] = $this->plane_model->get($editId);
        if (!$data['ogData']) return redirect(base_url().'index.php/bruh');        

        $this->load->view('prefab/header.php', $data);
        $this->load->view('planes/plane-update-form.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function add() {        
        if ($this->session->userdata('login_id')) {
            $loginId = $this->session->userdata('login_id');
            $userCheck = $this->user_model->get($loginId);

            if ($userCheck->level !== '1') return redirect(base_url().'index.php/planes');
        }else return redirect(base_url().'index.php/planes');
        
        $data['title'] = 'Travelpedia - New Plane';
        $data['customCSS'] = array('planes.css');        

        $this->load->view('prefab/header.php', $data);
        $this->load->view('planes/plane-form.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function auth_edit($editId) {
        if ($this->input->post('editPlane')) {            
            if (!empty($_FILES['planePicture']['name'])) {            
                //File upload handler
                $config['upload_path'] = 'uploads/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                $config['max_size'] = '25000';
                $config['file_name'] = $_FILES['planePicture']['name']; 

                // Load upload library 
                $this->load->library('upload', $config); 

                if ($this->upload->do_upload('planePicture')) {
                    $uploaded = $this->upload->data();                    
                }else {
                    $this->session->set_flashdata(array('notif' => "Image failed to upload", 'type' => 'fail'));
                    redirect(base_url().'index.php/planes/edit/'.$editId);
                }
            } 

            $inserted = $this->plane_model->update($editId);
            if ($inserted) {
                $this->notifs->send('Plane Updated', 'Plane with id '.$editId.' has been modified');

                $this->session->set_flashdata(array('notif' => "Updated plane data", 'type' => 'success'));
                redirect(base_url().'index.php/planes');
            }
            else {
                $this->session->set_flashdata(array('notif' => "An error has occurred", 'type' => 'fail'));
                redirect(base_url().'index.php/planes/edit/'.$editId);
            }
        }else redirect(base_url().'index.php/planes/edit/'.$editId);
    }

    public function auth_add() {
        if ($this->input->post('addPlane')) {            
            if (!empty($_FILES['planePicture']['name'])) {            
                //File upload handler
                $config['upload_path'] = 'uploads/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                $config['max_size'] = '25000';
                $config['file_name'] = $_FILES['planePicture']['name']; 

                // Load upload library 
                $this->load->library('upload', $config); 

                if ($this->upload->do_upload('planePicture')) {
                    $uploaded = $this->upload->data();
                    $inserted = $this->plane_model->insert();

                    if ($inserted) {
                        $this->notifs->send('Plane added', 'New plane data has been added');
                        
                        $this->session->set_flashdata(array('notif' => "Added new plane", 'type' => 'success'));
                        redirect(base_url().'index.php/planes');
                    }
                    else {
                        $this->session->set_flashdata(array('notif' => "An error has occurred", 'type' => 'fail'));
                        redirect(base_url().'index.php/planes/add');
                    }
                }else {
                    $this->session->set_flashdata(array('notif' => "Image failed to upload", 'type' => 'fail'));
                    redirect(base_url().'index.php/planes/add');
                }
            } 
        }else redirect(base_url().'index.php/planes/add');
    }

    public function auth_delete($delId) {
        $operation = $this->plane_model->delete($delId);
        $this->session->set_flashdata(array('notif' => $operation['msg'], 'type' => $operation['status']));

        $this->notifs->send('Plane deleted', 'Plane '.$delId.' has been deleted');
        
        redirect(base_url().'index.php/planes');
    }
}

?>