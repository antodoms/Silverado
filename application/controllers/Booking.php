<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
        
        public function cart(){
           
            $data=$this->session->all_userdata();
            if(empty($data['email']) || empty($data['phone'])){   
               redirect('/index.php/User/user_login_show/','refresh');      
            }
            else{
            
            $data = $this->session->all_userdata();
            
            //print "\n".json_encode($data);
            $this->load->view('Cart_view',
                      ['data' => $data]);
        }}
        
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
            redirect('/booking/cart/', 'refresh');         
	}
        

}