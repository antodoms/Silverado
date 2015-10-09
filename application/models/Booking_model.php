<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {
    
        public function user_purchases($data){
            $condition = "userid='" . $data . "' order by timestamp desc";
            $this->db->select('data');
            $this->db->from('ticket');
            $this->db->where($condition);
            $query = $this->db->get();
            
            $var = array();
            //printf(json_encode($query));
            foreach ($query->result() as $row)
            {                
                //$vartemp = $row->data;
                $x = count($var);
                $vartemp = $row->data;
                $var = array_merge($var,json_decode($vartemp,TRUE));
            }
            return $var;
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
                return false;
            }
        }
        
        public function getemail($id) {
            $condition = "id='" . $id . "'";
            $this->db->select('email');
            $this->db->from('user');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            
            if ($query->num_rows() ==1) {
                return $query->row()->email;
            } 
            else {
                return false;
            }
        }
        
        public function showticket($data){
            
            $condition = "email='" . $data['email'] . "' AND token='". $data['token'] . "'";
            $this->db->select('*');
            $this->db->from('ticket');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            
            if ($query->num_rows() ==1) {
                return $query->result();
            } 
            else {
                return false;
            }
            
        }
        
        public function getseats($data) {
            $condition = "movie='" . $data['movie'] . "' AND day='". $data['day'] . "' AND time='". $data['time']  . "'";
            $this->db->select('seats');
            $this->db->from('seats');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            //$test = $query->row()->seats;
            
            if ($query->num_rows() ==1) {
                return $query->row()->seats;
            } 
            else {
                return false;
            }
            
        }
        
        public function add_seats($data) {
            $condition = "movie='" . $data['movie'] . "' AND day='". $data['day'] . "' AND time='". $data['time']  . "'";
            $this->db->select('id');
            $this->db->from('seats');
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            
            if ($query->num_rows() ==1) {
                
                $this->db->where('id', $query->row()->id);
                $this->db->update('seats', $data); 
            }
            else {
                $this->db->insert('seats', $data);
            }
        }
        
        public function getallseats(){
            
            $this->db->select('*');
            $this->db->from('seats');
            $query = $this->db->get();
            
            return $query->result();
            
            
        }
}
