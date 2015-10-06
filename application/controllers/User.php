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
        public function user_login_show() {
            
        $this->load->view('login_form');
        }

        // Show registration page
        public function user_registration_show() {
        $this->load->view('registration_form');
        }

// Validate and store registration data in database
        public function user_reg_check(){

            // Check validation for user input in SignUp form
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('registration_form');
            } else {
                $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email_value'),
                'phone' => $this->input->post('password')
                );
                $result = $this->login_database->registration_insert($data) ;
                if ($result == TRUE) {
                    $data['message_display'] = 'Registration Successfully !';
                    $this->load->view('login_form', $data);
                } else {
                    $data['message_display'] = 'Username already exist!';
                    $this->load->view('registration_form', $data);
                }
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
            $sess_array = array(
            'username' => ''
            );
            $this->session->unset_userdata('logged_in', $sess_array);
            $data['message_display'] = 'Successfully Logout';
            $this->load->view('login_form', ['data' => $data]);
        }
    }

?>