<?php 

class route_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get($id) {
        $this->db->select('*');
        $this->db->from('routes');
        $this->db->join('planes', 'planes.plane_id = routes.plane_id', 'left');
        $this->db->where('route_id', $id);
        return $this->db->get()->result()[0];
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from('routes');
        $this->db->join('planes', 'planes.plane_id = routes.plane_id', 'left');
        return $this->db->get()->result();
    }

    public function getAvailable() {
        $this->db->select('*');
        $this->db->from('routes');
        $this->db->join('planes', 'planes.plane_id = routes.plane_id', 'left');
        $this->db->where('available', 'available');
        return $this->db->get()->result();
    }    

    public function insert() {
        $insertData = [];
        if ($this->input->post('originInput')) 
            $insertData['origin'] = $this->input->post('originInput');
        if ($this->input->post('destinationInput')) 
            $insertData['destination'] = $this->input->post('destinationInput');
        if ($this->input->post('distanceInput')) 
            $insertData['distance'] = $this->input->post('distanceInput');
        if ($this->input->post('planeInput')) 
            $insertData['plane_id'] = $this->input->post('planeInput');
        if ($this->input->post('availabilityInput'))
            $insertData['available'] = $this->input->post('availabilityInput');

        $this->db->insert('routes', $insertData);
        return ($this->db->affected_rows() != 1) ? 
        array("msg" => 'Unexpected error occurred', 'status' => "fail") : 
        array("msg" => "Added new route ".$insertData['origin']." to ".$insertData['destination']."", 'status' => 'success');
    }

    public function update($id) {
        $updateData = [];
        if ($this->input->post('originInput')) 
            $updateData['origin'] = $this->input->post('originInput');
        if ($this->input->post('destinationInput')) 
            $updateData['destination'] = $this->input->post('destinationInput');
        if ($this->input->post('distanceInput')) 
            $updateData['distance'] = $this->input->post('distanceInput');
        if ($this->input->post('planeInput')) 
            $updateData['plane_id'] = $this->input->post('planeInput');
        if ($this->input->post('availabilityInput'))
            $updateData['available'] = $this->input->post('availabilityInput');

        $this->db->where('route_id', $id);
        $this->db->update('routes', $updateData);
        return ($this->db->affected_rows() != 1) ? 
        array("msg" => 'Unexpected error occurred', 'status' => "fail") : 
        array("msg" => "Updated data for ".$updateData['origin']." to ".$updateData['destination']."", 'status' => 'success');
    }

    public function delete($id) {
        $this->db->delete('routes', array('route_id' => $id));
        return $this->db->affected_rows() !== 1 ? 
        array('msg' => 'An error occurred during deletion', 'status' => 'fail') : 
        array('msg' => 'Deleted plane '.$id, 'status' => 'success');
    }
}

?>