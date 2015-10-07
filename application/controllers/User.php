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
            
        $this->load->view('Login_form');
        }

        // Show registration page
        public function register() {
        $this->load->view('Registration_form');
        }

// Validate and store registration data in database
        public function registration_check(){

            
                $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone')
                );
                
                $result = $this->user_model->register_user($data);
                if ($result == TRUE) {
                    $data['message_display'] = 'Registration Successfully !';
                    $this->load->view('Login_form', ['data' => $data]);
                } else {
                    $data['message_display'] = 'User already exist!';
                    $this->load->view('Registration_form', ['data' => $data]);
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
                    
                redirect('booking/cart/', 'refresh');
                }
                else{
                $data = array(
                'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('login_form', ['data' => $data]);
                }
        }

        // Logout from admin page
        public function logout() {
            // Removing session data
            
            $this->session->unset_userdata('email', '');
            $this->session->unset_userdata('phone', '');
            $data['message_display'] = 'Successfully Logout';
            $this->load->view('Login_form');
        }
    }

?>