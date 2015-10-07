<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {
    
        public function user_purchases($data){
            
            $condition = "userid =" . "'" . $data . "'";
            $this->db->select('*');
            $this->db->from('ticket');
            $this->db->where($condition);
            $query = $this->db->get();
            
            $var = array();
            $k=0;
            foreach ($query->result() as $row)
            {   
                $vartemp = $row->data;
                $x = count($var);
                $var[$x] = substr($vartemp, 1, -1);
                //$var[$x] = $row->ticketid;
                $var[$x] = json_decode($var[$x],true);
                $var[$x]['ticket'] = $row -> ticketid;
              //$var[count($var)] = $row->data;  
                
              
            }
            //$var2 = array();
            //foreach ($var as $v){
                //$var2[count($var2)] = json_decode($v,true);
              // printf(json_encode($v)." <br><br> ");
            //}
            //printf(json_encode($var2)." <br><br> ");
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
                return 0;
            }
        }
}
