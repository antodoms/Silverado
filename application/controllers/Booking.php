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
            $temp2 = array();
            $temptotalseats = array();
            for ($i=0; $i < count($data['cart']);$i++) {
                
                if($i != ($itemid-1)){
                    $temp[count($temp)] = $data['cart'][$i];
                }else{
                    $movie = $data['cart'][$i]['movie'];
                    $day = $data['cart'][$i]['day'];
                    $time = $data['cart'][$i]['time'];
                    $temp2 = $data['unseat'][$movie][$day][$time]['b'];
                    //printf(json_encode($temp2));
                    $test = $data['cart'][$i]['seats'];
                    foreach ($test as $seat){
                        $temptotalseats = array_merge($temptotalseats, $seat['seats']);
                    }
                    //printf(json_encode($temptotalseats));
                    $data['unseat'][$movie][$day][$time]['b']= array_diff($temptotalseats,$temp2);
                    
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
            
            $data = $this-> session -> all_userdata();
            $totalselectedseats=array();
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
                    $totalselectedseats=  array_merge($totalselectedseats, $a);
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
            
            $data['cart'] = $getcart;
            $total=0;
            foreach ($data['cart'] as $value) {
                $total=$total + $value['sub-total'];
            } 
            
            $data['total'] = $total;
            $data['unseat'][$this->input->post('movie')][$this->input->post('day')][$this->input->post('time')]['b']= $totalselectedseats;
            $this->session->set_userdata($data);
            
            //$data = $this->session->userdata();
            
            
            
            
            
            redirect('booking/cart/', 'refresh');         
	}
        
        public function ticket(){
            $email = $this->input->get('email');
            $token = $this->input->get('token');
            $data = array(
                'email' => $email,
                'token' => $token
                );
            $query= $this->Booking_model->showticket($data);
            
            if($query==false){
                redirect('movies/', 'refresh');
            }else{
                //var_dump(json_decode($query[0]->data,true));
                $this->load->view('Ticket_view', ['data' => json_decode($query[0]->data, true),'url'=> $query[0]->url]);
            }
        }
        public function confirm()
	{
            $sessiondata = $this->session->userdata();
            $this->load->helper('string');
            
            $data = array(
                'email' => $sessiondata['email'],
                'phone' => $sessiondata['phone']
                );
            
            
            $now = new DateTime ( NULL, new DateTimeZone('UTC'));
            $token = random_string('alnum',5);
            $userid = $this->Booking_model->getuserid($data); 
            $email = $this->Booking_model -> getemail($userid);
            $rootUrl = "https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=".base_url()."index.php/booking/ticket/?email=".$email."%26token=".$token;
      
            //printf(json_encode($sessiondata['cart']));
            $data = array(
                'userid' => $userid,
                'data' => json_encode($sessiondata['cart']),
                'timestamp' => $now->format('Y-m-d H:i:s'),
                'token' => $token,
                'email' => $email,
                'url' => $rootUrl
                );
            
            
            //4
            //echo '<img src="'.$rootUrl.'">';
            $this->Booking_model->add_bookings($data);
            
            $this->addseatstodb($sessiondata['cart']);
            
            $sessiondata['cart']= [];
            $this->session->set_userdata($sessiondata);
            $link = "booking/ticket/?email=".$email."&token=".$token;
            redirect($link, 'refresh');
        }
        
        public function addseatstodb($datas){
            
            foreach($datas as $data){
                
            $seatget = array(
                'movie' => $data['movie'],
                'day' => $data['day'],
                'time' => $data['time']
                );
            
            $query = $this->Booking_model->getseats($seatget);
            
            //printf($query[0]."   ooo   ");
            $totseats = [];
            if($query==false){
                
                foreach ($data['seats'] as $seat){
                
                    foreach ($seat['seats'] as $seatno){
                        $totseats[count($totseats)] = $seatno;
                    }
                }
                
                //printf("query is 0 ".json_encode($totseats));
                $tosend = array (
                    'movie' => $data['movie'],
                    'day' => $data['day'],
                    'time' => $data['time'],
                    'seats' => json_encode($totseats)
                );
                
             $this->Booking_model->add_seats($tosend);   
            }
            else{
                foreach (json_decode($query,true) as $seatno){
                        $totseats[count($totseats)] = $seatno;
                    }
                    
                foreach ($data['seats'] as $seat){
                
                    foreach ($seat['seats'] as $seatno){
                        $totseats[count($totseats)] = $seatno;
                    }
                }
            
                //printf("query is not 0 ".$totseats);
                $tosend = array (
                    'movie' => $data['movie'],
                    'day' => $data['day'],
                    'time' => $data['time'],
                    'seats' => json_encode($totseats)
                );
                
             $this->Booking_model->add_seats($tosend);
             
             
           } 
        }
        }
        
        public function notavailable(){
            
            $data = $this-> session -> all_userdata();
            $seats= $this-> Booking_model->getallseats();
            
            foreach($seats as $seat){
                
                
                $data['unseat'][$seat->movie][$seat->day][$seat->time]['a']=  json_decode($seat->seats,true);
                //printf(json_encode($seat->seats));
            }
            
           $this->session->set_userdata($data); 
           
           $text = $this-> session -> all_userdata();
           //$final= $text['unseat'][$this->input->get('movie')][$this->input->get('day')][$this->input->get('time')];
           printf(json_encode($text));
           //printf(json_encode($text['unseat']));
            
        }
}