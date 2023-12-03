<?php 

class plane_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get($id) {
        $this->db->where('plane_id', $id);
        return $this->db->get('planes')->result();
    }

    public function getAll() {
        return $this->db->get('planes')->result();
    }

    public function insert() {
        $insertData = [];
        if ($this->input->post('nameInput')) 
            $insertData['name'] = $this->input->post('nameInput');
        //Type is either "business," "economy," or "first class"
        if ($this->input->post('typeInput'))
            $insertData['type'] = $this->input->post('typeInput');
        if ($this->input->post('capacityInput'))
            $insertData['type'] = $this->input->post('capacityInput');
        if (!empty($_FILES['planePicture']['name'])) {            
            //File upload handler
            $config['upload_path'] = 'uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
            $config['max_size'] = '25000';
            $config['file_name'] = $_FILES['planePicture']['name']; 

            // Load upload library 
            $this->load->library('upload', $config); 

            if ($this->upload->do_upload('planePicture')) {
                $insertData['img'] = $_FILES['planePicture']['name'];
            }else return array('msg' => 'An error occurred during file upload', 'type' => 'fail');
        }            

        $this->db->insert('users', $insertData);
        return ($this->db->affected_rows() != 1) ? 
        array("msg" => 'Unexpected error occurred', 'status' => "fail") : 
        array("msg" => "Added new plane '".$insertData['name']."'", 'status' => 'success');
    }

    public function update($id) {
        $updateData = [];
        if ($this->input->post('nameInput')) 
            $updateData['name'] = $this->input->post('nameInput');
        //Type is either "business," "economy," or "first class"
        if ($this->input->post('typeInput'))
            $updateData['type'] = $this->input->post('typeInput');
        if ($this->input->post('capacityInput'))
            $updateData['type'] = $this->input->post('capacityInput');
        if (!empty($_FILES['planePicture']['name'])) {            
            //File upload handler
            $config['upload_path'] = 'uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
            $config['max_size'] = '25000';
            $config['file_name'] = $_FILES['planePicture']['name']; 

            // Load upload library 
            $this->load->library('upload', $config); 

            if ($this->upload->do_upload('planePicture')) {
                $updateData['img'] = $_FILES['planePicture']['name'];
            }else return array('msg' => 'An error occurred during file upload', 'type' => 'fail');
        }            

        $this->db->where('plane_id', $id);
        $this->db->update('planes', $updateData);
        return ($this->db->affected_rows() != 1) ? 
        array("msg" => 'Unexpected error occurred', 'status' => "fail") : 
        array("msg" => "Updated data for '".$updateData['name']."'", 'status' => 'success');
    }

    public function delete($id) {
        $this->db->delete('planes', array('plane_id' => $id));
        return $this->db->affected_rows() !== 1 ? 
        array('msg' => 'An error occurred during deletion', 'status' => 'fail') : 
        array('msg' => 'Deleted user '.$id, 'status' => 'success');
    }

}

?>