<?php 

class user_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get($id) {
        $this->db->where('user_id', $id);
        return $this->db->get('users')->result()[0];
    }

    public function getAll() {
        return $this->db->get('users')->result();
    }

    public function insert() {
        $insertData = [];
        if ($this->input->post('usernameInput'))
            $insertData['username'] = $this->input->post('usernameInput');
        if ($this->input->post('emailInput'))
            $insertData['email'] = $this->input->post('emailInput');
        if ($this->input->post('nameInput')) 
            $insertData['name'] = $this->input->post('nameInput');
        if ($this->input->post('numberInput'))
            $insertData['number'] = $this->input->post('numberInput');

        if ($this->input->post('confirmPasswordInput')) {
            if ($this->input->post('passwordInput') === $this->input->post("confirmPasswordInput")) {
                $insertData['password'] = $this->input->post('passwordInput');
            }else return array('msg' => 'Password does not match', 'status' => 'fail');
        }else {
            if ($this->input->post('passwordInput'))
            $insertData['password'] = $this->input->post('passwordInput');
        }

        $this->db->insert('users', $insertData);
        return ($this->db->affected_rows() != 1) ? 
        array("msg" => 'Unexpected error occurred', 'status' => "fail") : 
        array("msg" => "Created new user '".$insertData['username']."'", 'status' => 'success');
    }

    public function login() {
        $email = $this->input->post('emailInput');
        $password = $this->input->post('passwordInput');

        $targetUser = $this->db->get_where('users', array('email' => $email, 'password' => $password))->result()[0];
        if ($targetUser) {
            $this->session->set_userdata('login_id', $targetUser->user_id);
            return array('msg' => 'Logged in as '.$targetUser->username, 'status' => "success");
        }else return array('msg' => 'Invalid credentials', 'status' => "fail");
    }

    public function update($id) {
        $updateData = [];
        if ($this->input->post('usernameInput'))
            $updateData['username'] = $this->input->post('usernameInput');
        if ($this->input->post('emailInput'))
            $updateData['email'] = $this->input->post('emailInput');
        if ($this->input->post('nameInput')) 
            $updateData['name'] = $this->input->post('nameInput');
        if ($this->input->post('numberInput'))
            $updateData['number'] = $this->input->post('numberInput');
        if ($this->input->post('passwordInput')) 
            $updateData['password'] = $this->input->post('passwordInput');
        if ($this->input->post('levelInput'))
            $updateData['levelInput'] = $this->input->post('levelInput');

        $this->db->where('user_id', $id);
        $this->db->update('users', $updateData);
        return ($this->db->affected_rows() != 1) ? 
        array("msg" => 'Unexpected error occurred', 'status' => "fail") : 
        array("msg" => "Updated data for '".$updateData['username']."'", 'status' => 'success');
    }

    public function delete($id) {
        $this->db->delete('users', array('user_id' => $id));
        return $this->db->affected_rows() !== 1 ? 
        array('msg' => 'An error occurred during deletion', 'status' => 'fail') : 
        array('msg' => 'Deleted user '.$id, 'status' => 'success');
    }
}

?>