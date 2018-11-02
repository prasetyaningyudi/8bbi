<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {
	private $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');		
		$this->load->helper('url');			
		$this->load->database();
		$this->load->model('tracking_model');
		$this->data['error'] = array();
		$this->data['title'] = 'BBI Cargo';
	}

	public function index(){	
		if(isset($_POST['submit'])){
			$filters = array();
			$filters[] = " BBI_NUMBER = '".$_POST['track_numb']."'";
			$this->data['data'] = $this->tracking_model->get($filters);
			//var_dump($this->data['data'] );
		}
		$this->data['subtitle'] = 'Tracking';
		$this->data['top_subtitle'] = 'BBI CARGO';
		$this->load->view('section_header', $this->data);
		$this->load->view('top');
		$this->load->view('header');
		$this->load->view('cover_nohome');
		$this->load->view('breadcurm');
		$this->load->view('content_tracking');
		$this->load->view('bottom');		
		$this->load->view('footer');
		$this->load->view('section_footer');		

	}
}

