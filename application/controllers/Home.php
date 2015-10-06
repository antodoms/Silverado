<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
        function __construct()
	{
		parent::__construct();
                
                $this->load->library('session');
                
	}
        
	public function index()
	{      // print "\n".json_encode($this->session->all_userdata());
		//$this->load->model('user_model');
                //$dataSet = $this->user_model->getUserData();
                $this->load->view('Home_view');
	}
        
        public function movies()
	{
		//$this->load->model('user_model');
                //$dataSet = $this->user_model->getUserData();
                $this->load->view('Movies_view');
	}
        public function price()
	{
		//$this->load->model('user_model');
                //$dataSet = $this->user_model->getUserData();
                $this->load->view('Price_view');
	}
        public function contact()
	{
		//$this->load->model('user_model');
                //$dataSet = $this->user_model->getUserData();
                $this->load->view('Contact_view');
	}
}