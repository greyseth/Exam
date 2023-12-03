<?php 

class plane_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get($id) {
        $this->db->where('plane_id', $id);
        return $this->db->get('planes')->result()[0];
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
            $insertData['capacity'] = $this->input->post('capacityInput');
        if (!empty($_FILES['planePicture']['name']))
            $insertData['img'] = $_FILES['planePicture']['name'];

        $this->db->insert('planes', $insertData);
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
            $updateData['capacity'] = $this->input->post('capacityInput');
        if (!empty($_FILES['planePicture']['name'])) 
            $updateData['img'] = $_FILES['planePicture']['name'];

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