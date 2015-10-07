<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {


	public function getUserData()
	{
                return $this->db->get('user')->result();
	}
        
        public function add_bookings($data) {
            $this->db->insert('ticket', $data);
        }
        
        public function register_user($data){
            // Query to check whether username already exist or not
            $condition = "email =" . "'" . $data['email'] . "'";
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {

            // Query to insert data in database
            $this->db->insert('user', $data);
            if ($this->db->affected_rows() > 0) {
            return true;
            }
            } else {
            return false;
            }
        }
        
        public function getuserid($data) {
            $condition = "email='" . $data['email'] . "' AND phone='". $data['phone'] . "'";
            $this->db->select('id');
            $this->db->from('user');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            
            if ($query->num_rows() ==1) {
                return $query->row()->id;
            } 
            else {
                return 0;
            }
        }
}
