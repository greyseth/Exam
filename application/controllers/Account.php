<?php 

class Account extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('notifs');
        $this->load->model('user_model');
    }

    public function index() {
        if (!$this->session->userdata('login_id')) return redirect(base_url().'index.php/auth/login');
        
        $data['title'] = 'Travelpedia - Your Account';
        $data['customCSS'] = array('auth.css', 'account.css');

        $data['userdata'] = $this->user_model->get($this->session->userdata('login_id'));

        $this->load->view('prefab/header.php', $data);
        $this->load->view('account/account-self.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function admin() {
        if (!$this->session->userdata('login_id')) return redirect(base_url().'index.php/auth/login');
        if (!$this->session->userdata('login_level') === '1') return redirect(base_url().'index.php');
        
        $data['title'] = 'Travelpedia - All Users';
        $data['customCSS'] = array('account.css', 'table.css');

        $data['users'] = $this->user_model->getAll();

        $this->load->view('prefab/header.php', $data);
        $this->load->view('account/account-all.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function update($userId) {
        if (!$this->session->userdata('login_id')) return redirect(base_url().'index.php/auth/login');
        if (!$this->session->userdata('login_level') === '1') return redirect(base_url().'index.php');

        $data['title'] = 'Travelpedia - Update User Data';
        $data['customCSS'] = array('auth.css', 'account.css');

        $data['userdata'] = $this->user_model->get($userId);

        $this->load->view('prefab/header.php', $data);
        $this->load->view('account/account-edit.php', $data);
        $this->load->view('prefab/footer.php', $data);
    }

    public function auth_update($userId) {
        if (!$this->input->post('updAcc')) return redirect(base_url()."index.php/account");

        $updated = $this->user_model->update($userId);
        $this->session->set_flashdata(array('notif' => $updated['msg'], 'type' => $updated['status']));

        if ($updated['status'] === 'success')
            $this->notifs->send('Account Updated', 'Account with id '.$userId.' has been updated');

        if($this->input->post('adminEdit')) return redirect(base_url().'index.php/account/update/'.$this->input->post('adminEdit'));
        redirect(base_url().'index.php/account');
    }

    public function auth_delete($userId) {
        $deleted = $this->user_model->delete($userId);
        $this->session->set_flashdata(array('notif' => $deleted['msg'], 'type' => $deleted['status']));

        if ($deleted['status'] === 'success')
            $this->notifs->send('Deleted Account', 'Account with id '.$userId.' has been deleted');

        redirect(base_url().'index.php/account/admin');
    }
}

?>