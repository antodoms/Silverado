<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
        
    public function __construct() {
        parent::__construct();

        // Load form helper library
        //$this->load->helper('form');

        // Load form validation library
        //$this->load->library('form_validation');

        // Load session library
        //$this->load->library('session');
        $this->load->model('Booking_model');
    }
    
        public function cart(){
           
            $data=$this->session->all_userdata();
            if(empty($data['email']) || empty($data['phone'])){   
                
               redirect('user/login/','refresh');      
            }
            else {
            
            $data = $this->session->all_userdata();
            
            //print "\n".json_encode($data);
            $this->load->view('Cart_view', ['data' => $data]);
        }}
        
        public function purchase(){
            
            $data=$this->session->all_userdata();
            if(empty($data['email']) || empty($data['phone'])){   
                
               redirect('user/login/','refresh');      
            }
            else {
            
                $datatemp = array(
                'email' => $data['email'],
                'phone' => $data['phone']
                );
                $user =$this->Booking_model->getuserid($datatemp);
                $final=$this->Booking_model->user_purchases($user);
                
                //print "\n". json_encode($final->row());
                $this->load->view('Purchase_view', ['data' => $final]);
                }
        }
        
        public function ifDiscount($day, $time) {

		/* Check to make sure user hasn't modified day/time */
		$validScreening = false;

		if ($day === "Monday" || $day === "Tuesday")
			return true;

		if ($day !== "Saturday" && $day !== "Sunday") {
			if ($time === "1pm")
				return true;
		}
		return false;
	}
        
        public function delete($itemid){
            
            $data = $this->session->all_userdata();
            $temp = array();
            for ($i=0; $i < count($data['cart']);$i++) {
                
                if($i != ($itemid-1)){
                    $temp[count($temp)] = $data['cart'][$i];
                }
            }
            
            $data['cart'] = $temp;
            
            $this->session->set_userdata($data);
            redirect('booking/cart/', 'refresh');
            
        }
        
	public function add()
	{
            //$this->load->library('session');
            $totseat = ['SA', 'SP', 'SC', 'FA', 'FC', 'B1', 'B2', 'B3'];
            $priceReg = ["18","15","12","30","25","30","30","30"];
            $priceDis = ["12","10","8","25","20","20","20","20"];
            $finalseats=array();
            $screening=array();
            $price=[];
            
            $discount= $this->ifDiscount($this->input->post('day'), $this->input->post('time'));
            
            if($discount == true){
                $price = $priceDis;
            }
            else{
                $price = $priceReg;
            }
            $subtotal =0;
            for ($i=0;$i< count($totseat);$i++) {
                $a=$this->input->post($totseat[$i]);
                if($a != '0')
                {
                    
                    $a=explode(',', $a);
                    $rate = $price[$i];
                    $seats = array('type' => $totseat[$i],'quantity' => count($a), 'price' => $rate, 'seats'  => $a);
                    $subtotal= $subtotal + ($rate * count($a));
                    if($finalseats== null){
                        $finalseats[0]=$seats;
                    }
                    else{
                        $finalseats[count($finalseats)]=$seats;
                    }
                    
                }
                
            }
            
            $seats = array('movie'=> $this->input->post('movie'),'day'=>$this->input->post('day'),'time'=>$this->input->post('time'),'seats' => $finalseats, 'sub-total'=>$subtotal);
            $screening = array('screening'=> $seats);
            
            if($this->session->userdata('cart')== null){
                $getcart[0]=$seats;
            }
            else{
                $getcart = $this->session->userdata('cart');
                $getcart[count($getcart)] = $seats;
            }
                
            $data = $this-> session -> all_userdata();
            $data['cart'] = $getcart;
            $total=0;
            foreach ($data['cart'] as $value) {
                $total=$total + $value['sub-total'];
            } 
            
            $data['total'] = $total;
            
            $this->session->set_userdata($data);
            redirect('booking/cart/', 'refresh');         
	}
        
        public function confirm()
	{
            $sessiondata = $this->session->userdata();
            
            $data = array(
                'email' => $sessiondata['email'],
                'phone' => $sessiondata['phone']
                );
            
            
            $now = new DateTime ( NULL, new DateTimeZone('UTC'));
            
            $userid = $this->Booking_model->getuserid($data); 
            //printf(json_encode($sessiondata['cart']));
            $data = array(
                'userid' => $userid,
                'data' => json_encode($sessiondata['cart']),
                'timestamp' => $now->format('Y-m-d H:i:s')
                );
            
            $this->Booking_model->add_bookings($data);
            
            
            
            $sessiondata['cart']= [];
            $this->session->set_userdata($sessiondata);
            
            redirect('booking/purchase/', 'refresh');
        }
}