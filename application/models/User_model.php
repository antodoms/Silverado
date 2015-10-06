<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


	public function getUserData()
	{
                return $this->db->get('user')->result();
	}
        
        public function login($data) {
            $condition = "email='" . $data['email'] . "' AND phone='". $data['phone'] . "'";
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();

            if ($query->num_rows() ==1) {
                return true;
            } 
            else {
                return false;
            }
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
}
