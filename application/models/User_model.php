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
}
