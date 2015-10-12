<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Load form helper library
        //$this->load->helper('form');

        // Load form validation library
        //$this->load->library('form_validation');

        // Load session library
        //$this->load->library('session');
        $this->load->model('user_model');
    }

	public function index()
	{
            
		
                $dataSet = $this->user_model->getUserData();
                $this->load->view('User_view',[
                    'dataSet' => $dataSet
                ]);
	}
        
        // Show login page
        public function login() {
        
            $data=$this->session->all_userdata();
            if(empty($data['email']) || empty($data['phone'])){  
                
                $this->load->view('login_form', ['data' => $data]);  
            }
            else{
                
                $data = array(
                'email' => $data['email'],
                'phone' => $data['phone']
                ); 
                
                $result = $this->user_model->login($data);
                
                if($result == TRUE){
                    
                redirect('booking/cart/', 'refresh');
                }
                else{
                $this->session->set_flashdata('flash', array('message' => 'Invalid Username and Password','class' => 'danger'));
                    
                redirect('User/login/', 'refresh');
                }
            }
        
        }

        // Show registration page
        public function register() {
        $this->load->view('Registration_form');
        }

// Validate and store registration data in database
        public function registration_check(){

                $this->form_validation->set_rules('email','email', 'trim|required|valid_email');
               // $this->form_validation->set_rules('name', 'name', 'required');
              //  $this->form_validation->set_rules('phone', 'phone', 'required');
  
                if($this->form_validation->run() !== false){
                
                $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone')
                );
                
                $result = $this->user_model->register_user($data);
                if ($result == TRUE) {
                    $this->session->set_flashdata('flash', array('message' => 'Thank You For Registering! Please Login','class' => 'success'));
                    
                    redirect('User/login/', 'refresh');
                } else {
                    $this->session->set_flashdata('flash', array('message' => 'User Email or Phone you entered Already Exist!','class' => 'warning'));
                    
                    redirect('User/register/', 'refresh');
                }
                }
                else{
                    $this->session->set_flashdata('flash', array('message' => 'Form Validation Failed !','class' => 'danger'));
                    
                    redirect('User/register/', 'refresh');
                    
                }
        }

// Check for user login process
        public function login_check() {
                
                $data = array(
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone')
                );
                
                $result = $this->user_model->login($data);
                if($result == TRUE){
                    
                    $this->session->set_userdata('email', $this->input->post('email'));
                    $this->session->set_userdata('phone', $this->input->post('phone'));
                
                    $this->session->set_flashdata('flash', array('message' => 'You Have Successfully Logged In!','class' => 'success'));
                        
                    redirect('booking/cart/', 'refresh');
                }
                else{
                $this->session->set_flashdata('flash', array('message' => 'Login Error ! Email or Phone you entered is Wrong. ','class' => 'danger'));
                    
                redirect('User/login/', 'refresh');
                }
        }

        // Logout from admin page
        public function logout() {
            // Removing session data
            
            $this->session->unset_userdata('email', '');
            $this->session->unset_userdata('phone', '');
            $this->session->set_flashdata('flash', array('message' => 'You Have Sucessfully Logged Out !','class' => 'success'));
                    
                redirect('User/login/', 'refresh');
        }
    }

?>