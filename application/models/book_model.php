<?php 

class book_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get($id) {
        $this->db->select('books.*, users.name AS bookername, users.email, routes.*, planes.*');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id', 'left');
        $this->db->join('routes', 'routes.route_id = books.route_id', 'left');
        $this->db->join('planes', 'planes.plane_id = routes.plane_id', 'left');
        $this->db->where('book_id', $id);
        return $this->db->get()->result()[0];
    }

    public function getAll() {
        $this->db->select('books.*, users.name AS bookername, users.email, routes.*, planes.*');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id', 'left');
        $this->db->join('routes', 'routes.route_id = books.route_id', 'left');
        $this->db->join('planes', 'planes.plane_id = routes.plane_id', 'left');
        return $this->db->get()->result();
    }

    public function getFiltered($name, $origin, $destination, $plane) {
        $this->db->select('books.*, users.name AS bookername, users.email, routes.*, planes.*');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id', 'left');
        $this->db->join('routes', 'routes.route_id = books.route_id', 'left');
        $this->db->join('planes', 'planes.plane_id = routes.plane_id', 'left');

        //Filters
        if ($name !== 'all') $this->db->or_like('users.name', $name);
        if ($origin !== 'all') $this->db->or_like('routes.origin', $origin);
        if ($destination !== 'all') $this->db->or_like('routes.destination', $destination);
        if ($plane !== 'all') $this->db->or_like('planes.name', $plane);

        return $this->db->get()->result();
    }

    public function getUser($userId) {
        $this->db->select('books.*, users.name AS bookername, users.email, routes.*, planes.*');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id', 'left');
        $this->db->join('routes', 'routes.route_id = books.route_id', 'left');
        $this->db->join('planes', 'planes.plane_id = routes.plane_id', 'left');
        $this->db->where('books.user_id', $userId);
        return $this->db->get()->result();
    }

    public function getUserFiltered($userId, $origin, $destination, $plane) {
        $this->db->select('books.*, users.name AS bookername, users.email, routes.*, planes.*');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id', 'left');
        $this->db->join('routes', 'routes.route_id = books.route_id', 'left');
        $this->db->join('planes', 'planes.plane_id = routes.plane_id', 'left');
        $this->db->where('books.user_id', $userId);

        //Filters
        if ($origin !== 'all') $this->db->like('routes.origin', $origin);
        if ($destination !== 'all') $this->db->or_like('routes.destination', $destination);
        if ($plane !== 'all') $this->db->or_like('planes.name', $plane);

        return $this->db->get()->result();
    }
    
    public function getRoute($routeId) {
        $this->db->select('books.*, users.name AS bookername, users.email, routes.*, planes.*');
        $this->db->from('books');
        $this->db->join('users', 'users.user_id = books.user_id', 'left');
        $this->db->join('routes', 'routes.route_id = books.route_id', 'left');
        $this->db->join('planes', 'planes.plane_id = routes.plane_id', 'left');
        $this->db->where('books.route_id', $routeId);
        return $this->db->get()->result();
    }

    public function book() {
        $insertData = [];     
        $insertData['user_id'] = $this->session->userdata('login_id');
        $insertData['booking_date'] = date('Y/m/d');
        
        if (!$this->input->post('routeInput') ||
            !$this->input->post('seatCountInput') ||
            !$this->input->post('classInput') ||
            !$this->input->post('departDateInput'))
        return array('msg' => 'Incomplete booking details', 'status' => 'fail');

        $insertData['route_id'] = $this->input->post('routeInput');
        $insertData['depart_date'] = $this->input->post('departDateInput');
        $insertData['seat_count'] = $this->input->post('seatCountInput');
        $insertData['flight_class'] = $this->input->post('classInput');
        $insertData['seat_price'] = 
        (($this->input->post('classInput')==='first class')?$insertData['seat_count']*250:
        (($this->input->post('classInput')==='business')?$insertData['seat_count']*100:
        $insertData['seat_count']*50));

        $this->db->insert('books', $insertData);
        return ($this->db->affected_rows() != 1) ? 
        array("msg" => 'Unexpected error occurred', 'status' => "fail") : 
        array("msg" => "Booked a flight", 'status' => 'success');
    }

    public function update($id) {
        $updateData = [];
        if ($this->input->post('userInput')) 
            $updateData['user_id'] = $this->input->post('userInput');
        if ($this->input->post('routeInput')) 
            $updateData['route_id'] = $this->input->post('routeInput');
        if ($this->input->post('bookingDateInput')) 
            $updateData['booking_date'] = $this->input->post('bookingDateInput');
        if ($this->input->post('seatPriceInput')) 
            $updateData['seat_price'] = $this->input->post('seatPriceInput');

        $this->db->where('book_id', $id);
        $this->db->update('books', $updateData);
        return ($this->db->affected_rows() != 1) ? 
        array("msg" => 'Unexpected error occurred', 'status' => "fail") : 
        array("msg" => "Updated data for '".$updateData['name']."'", 'status' => 'success');
    }

    public function delete($id) {
        $this->db->delete('books', array('book_id' => $id));
        return $this->db->affected_rows() !== 1 ? 
        array('msg' => 'An error occurred during deletion', 'status' => 'fail') : 
        array('msg' => 'Deleted book '.$id, 'status' => 'success');
    }
}

?>