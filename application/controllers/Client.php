<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
	private $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');		
		$this->load->helper('url');			
		$this->load->database();
		$this->data['error'] = array();
		$this->data['title'] = 'BBI Cargo';
	}

	public function index(){	
		$this->data['subtitle'] = 'Our Clients';
		$this->data['top_subtitle'] = 'BBI CARGO';
		$this->load->view('section_header', $this->data);
		$this->load->view('top');
		$this->load->view('header');
		$this->load->view('cover_nohome');
		$this->load->view('breadcurm');
		$this->load->view('content_client');
		$this->load->view('footer');
		$this->load->view('section_footer');
	}
}

