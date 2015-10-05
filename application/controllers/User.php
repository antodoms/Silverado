<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
	public function index()
	{
		$this->load->model('user_model');
                $dataSet = $this->user_model->getUserData();
                $this->load->view('User_view',[
                    'dataSet' => $dataSet
                ]);
	}
}
