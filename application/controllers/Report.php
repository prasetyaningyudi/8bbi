<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	private $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('auth');						
		$this->load->helper('url');			
		$this->load->database();
		$this->load->model('report_model');
/* 		$this->load->model('menu_model');
		if(isset($this->session->userdata['is_logged_in'])){
			$this->data['menu'] = $this->menu_model->get_menu($this->session->userdata('ROLE_ID'));
			$this->data['sub_menu'] = $this->menu_model->get_sub_menu($this->session->userdata('ROLE_ID'));
		}else{
			$this->data['menu'] = $this->menu_model->get_menu($this->menu_model->get_guest_id('guest'));
			$this->data['sub_menu'] = $this->menu_model->get_sub_menu($this->menu_model->get_guest_id('guest'));			
		}
		$this->load->model('app_data_model');		
		$this->data['app_data'] = $this->app_data_model->get();	 */		
		$this->data['error'] = array();
		$this->data['title'] = 'Report POD';
	}

	public function index(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		$this->data['subtitle'] = 'Daftar';
		$this->data['class'] = __CLASS__;
		$this->load->view('section_header1', $this->data);
		$this->load->view('section_sidebar');
		$this->load->view('section_nav');
		$this->load->view('main_index');	
		$this->load->view('section_footer1');			
	}

	public function list(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		$filters = array();
		$limit = array('20', '0');
		$r_awb = '';
		$r_tgl_pickup = '';

		//var_dump($_POST['nama']);
		//var_dump($_POST['tgl_pickup']);
		if(isset($_POST['submit'])){
			if (isset($_POST['awb'])) {
				if ($_POST['awb'] != '' or $_POST['awb'] != null) {
					$filters[] = "AWB = '" . $_POST['awb'] . "'";
					$r_awb = $_POST['awb'];
				}
				if ($_POST['tgl_pickup'] != '' or $_POST['tgl_pickup'] != null) {
					$tgl_pickup = explode(' - ', $_POST['tgl_pickup']);
					$filters[] = "tgl_pickup between '" . $tgl_pickup[0] . "' and '" . $tgl_pickup[1] . "'";
					$r_tgl_pickup = $_POST['tgl_pickup'];
				}				
			}		
			if (isset($_POST['offset'])) {
				if ($_POST['offset'] != '' or $_POST['offset'] != null) {
					$limit[1] = $_POST['offset'];
				}
			}			
		}
		
		$data = $this->report_model->get($filters, $limit);
		//var_dump($data);
		$total_data = count($this->report_model->get($filters));
		$limit[] = $total_data;
		
		//var_dump($data);

		$no_body = 0;
		$body= array();
		if(isset($data)){
            if (empty($data)) {
                $body[$no_body] = array(
                    (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => 'No Data')
                );
			} else {
				foreach ($data as $value) {					
					$body[$no_body] = array(
						(object) array( 'classes' => ' bold align-center ', 'value' => $no_body+1 ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->AWB ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->TGL_UPDATE ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->TGL_PICKUP ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->TGL_BRGKT ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->SHIPPER ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->ORIGIN ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->DEST ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->PENERUSAN ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->COLLY ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->KETERANGAN_ISI ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->KG_VOL ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->KG_ACT ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->SERVICE ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->VIA ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->PENERIMA ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->TGL_TERIMA ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->KETERANGAN ),
					);
					$no_body++;
				}
			}
        } else {
            $body[$no_body] = array(
                (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => 'Filter First')
            );
        }
		
		$header = array(
			array (
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'No'),
				(object) array ('colspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'awb'),					
				(object) array ('tgl update' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'tgl update'),			
				(object) array ('tgl pickup' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'tgl pickup'),			
				(object) array ('tgl berangkat' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'tgl berangkat'),			
				(object) array ('shipper' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'shipper'),			
				(object) array ('origin' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'origin'),
				(object) array ('dest' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'dest'),	
				(object) array ('penerusan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'penerusan'),	
				(object) array ('colly' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'colly'),	
				(object) array ('isi' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'isi'),	
				(object) array ('kg vol' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'kg vol'),	
				(object) array ('kg act' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'kg act'),
				(object) array ('service' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'service'),
				(object) array ('via' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'via'),
				(object) array ('penerima' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'penerima'),
				(object) array ('tgl terima' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'tgl terima'),
				(object) array ('ket' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'ket'),				
			)		
		);
	
			
		$fields = array();
		$fields[] = (object) array(
			'type' 			=> 'text',
			'label' 		=> 'awb',
			'placeholder' 	=> 'awb',
			'name' 			=> 'awb',
			'value' 		=> $r_awb,
			'classes' 		=> 'full-width',
		);		
		$fields[] = (object) array(
			'type' 			=> 'daterange',
			'label' 		=> 'tgl_pickup',
			'format' 		=> 'YYYY-MM-DD',
			'name' 			=> 'tgl_pickup',
			'value' 		=> $r_tgl_pickup,
			'classes' 		=> 'full-width',
		);

		$this->data['list'] = (object) array (
			'type'  	=> 'table_default',
			'data'		=> (object) array (
				'classes'  	=> 'striped bordered hover',
				'insertable'=> false,
				'editable'	=> false,
				'deletable'	=> false,
				'statusable'=> false,
				'detailable'=> false,
				'pdf'		=> false,
				'xls'		=> true,
				'pagination'=> $limit,
				'filters'  	=> $fields,
				'toolbars'	=> null,
				'header'  	=> $header,
				'body'  	=> $body,
				'footer'  	=> null,
				'title'		=> 'POD Reporting'
			)
		);
		
		
		
		if((isset($_POST['expected_output']))){
			if($_POST['expected_output'] == 'pdf'){
				//pdf goes here
			}else if ($_POST['expected_output'] == 'xls') {
				//var_dump($this->data['list']);die;
				$parameter = array (
					$this->data['list']
				);				
				$this->load->library('generatexls', $parameter);
				$this->generatexls->generate_xls();
			}
		}else{
			echo json_encode($this->data['list']);
		}		
	}
	
	public function insert(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['submit'])){
			//var_dump($_FILES);
			//var_dump($_POST);
			//validation
			$error_info = array();
			$error_status = false;
			if($_POST['name'] == ''){
				$error_info[] = 'Menu Name can not be null';
				$error_status = true;
			}
			if($_POST['permalink'] == ''){
				$error_info[] = 'Permalink can not be null';
				$error_status = true;
			}
			if($_POST['order'] == ''){
				$error_info[] = 'Menu Order can not be null';
				$error_status = true;
			}
			if(strlen ($_POST['order']) > 2){
				$error_info[] = 'Menu Order maximum 2 digit number';
				$error_status = true;
			}			
			if(is_numeric($_POST['order']) == false){
				$error_info[] = 'Wrong Menu Order format';
				$error_status = true;
			}else{
				if(strpos($_POST['order'], '.') != false){
					$error_info[] = 'Wrong Menu Order format';
					$error_status = true;					
				}
				if (substr($_POST['order'], 0, 1) == '0' || substr($_POST['order'], 0, 2) == '00') {
					$error_info[] = 'Wrong Menu Order format';
					$error_status = true;	
				}
			}
		
			if($error_status == true){
				$this->data['error'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $error_info,
					)
				);				
				echo json_encode($this->data['error']);
			}else{
				
				if($_POST['parent'] != ''){
					$filters = array();
					$filters[] = "A.ID = '" . $_POST['parent'] . "'";
					$data = $this->menu_model->get($filters);
					$parent_menu_order = '';
					if (empty($data)) {
						//$parent[] = (object) array('label'=>'No Data', 'value'=>'nodata');
					} else {
						foreach ($data as $value) {
							$parent_menu_order = $value->MENU_ORDER;
						}
					}	
				}
				$order = '';
				if(strlen ($_POST['order']) == 1){
					$order =  '0'.$_POST['order'];
				}else{
					$order =  $_POST['order'];
				}
				
				if($_POST['icon'] == ''){
					if($_POST['parent'] == ''){
						$this->data['insert'] = array(
								'MENU_NAME' => $_POST['name'],
								'PERMALINK' => $_POST['permalink'],
								'MENU_ORDER' => $order,
								'MENU_ID' => null,
							);
					}else{
						$this->data['insert'] = array(
								'MENU_NAME' => $_POST['name'],
								'PERMALINK' => $_POST['permalink'],
								'MENU_ORDER' => $parent_menu_order.$order,
								'MENU_ID' => $_POST['parent'],
							);						
					}
				}else{
					if($_POST['parent'] == ''){
						$this->data['insert'] = array(
								'MENU_NAME' => $_POST['name'],
								'PERMALINK' => $_POST['permalink'],
								'MENU_ICON' => $_POST['icon'],
								'MENU_ORDER' => $order,
								'MENU_ID' => null,
							);
					}else{
						$this->data['insert'] = array(
								'MENU_NAME' => $_POST['name'],
								'PERMALINK' => $_POST['permalink'],
								'MENU_ICON' => $_POST['icon'],
								'MENU_ORDER' => $parent_menu_order.$order,
								'MENU_ID' => $_POST['parent'],
							);						
					}
				}
				//var_dump($this->data['insert']);die;
				$result = $this->menu_model->insert($this->data['insert']);
				if($result == true){
					$info = array();
					$info[] = 'Insert data successfully';						
					$this->data['info'] = (object) array (
						'type'  	=> 'success',
						'data'		=> (object) array (
							'info'	=> $info,
						)
					);
				}else{
					$info = array();
					$info[] = 'Insert data not successfull';
					$this->data['info'] = (object) array (
						'type'  	=> 'error',
						'data'		=> (object) array (
							'info'	=> $info,
						)
					);
				}				
				echo json_encode($this->data['info']);				
			}
		}else{
			$parent = array();
			$data = $this->menu_model->get_parent();
			
			if (empty($data)) {

			} else {
				foreach ($data as $value) {
					$parent[] = (object) array('label'=>$value->MENU_NAME, 'value'=>$value->ID);
				}
			}			
			
			$fields = array();
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Name',
				'name' 			=> 'name',
				'placeholder'	=> 'menu name',
				'value' 		=> '',
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Permalink',
				'name' 			=> 'permalink',
				'placeholder'	=> 'example : employee, #',
				'value' 		=> '',
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Icon',
				'name' 			=> 'icon',
				'placeholder'	=> 'use fontawesome, example : plus, minus',
				'value' 		=> '',
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Order',
				'name' 			=> 'order',
				'placeholder'	=> 'please input number (integer) start from 1',
				'value' 		=> '',
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Parent menu',
				'name' 			=> 'parent',
				'placeholder'	=> '--Select Parent--',
				'value' 		=> '',
				'options'		=> $parent,
				'classes' 		=> 'required full-width',
			);				

			$this->data['insert'] = (object) array (
				'type'  	=> 'insert_default',
				'data'		=> (object) array (
					'classes'  	=> '',
					'fields'  	=> $fields,
				)
			);	
			echo json_encode($this->data['insert']);				
		}
	}
	
	public function update(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['submit'])){
			//validation
			$error_info = array();
			$error_status = false;
			if($_POST['name'] == ''){
				$error_info[] = 'Menu Name can not be null';
				$error_status = true;
			}
			if($_POST['permalink'] == ''){
				$error_info[] = 'Permalink can not be null';
				$error_status = true;
			}
			if($_POST['order'] == ''){
				$error_info[] = 'Menu Order can not be null';
				$error_status = true;
			}
			if(strlen ($_POST['order']) > 2){
				$error_info[] = 'Menu Order maximum 2 digit number';
				$error_status = true;
			}			
			if(is_numeric($_POST['order']) == false){
				$error_info[] = 'Wrong Menu Order format';
				$error_status = true;
			}else{
				if(strpos($_POST['order'], '.') != false){
					$error_info[] = 'Wrong Menu Order format';
					$error_status = true;					
				}
				if (substr($_POST['order'], 0, 1) == '0' || substr($_POST['order'], 0, 2) == '00') {
					$error_info[] = 'Wrong Menu Order format';
					$error_status = true;	
				}
			}
			
			if($error_status == true){
				$this->data['error'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $error_info,
					)
				);				
				echo json_encode($this->data['error']);
			}else{
				if($_POST['parent'] != ''){
					$filters = array();
					$filters[] = "A.ID = '" . $_POST['parent'] . "'";
					$data = $this->menu_model->get($filters);
					$parent_menu_order = '';
					if (empty($data)) {
						//$parent[] = (object) array('label'=>'No Data', 'value'=>'nodata');
					} else {
						foreach ($data as $value) {
							$parent_menu_order = $value->MENU_ORDER;
						}
					}	
				}
				$order = '';
				if(strlen ($_POST['order']) == 1){
					$order =  '0'.$_POST['order'];
				}else{
					$order =  $_POST['order'];
				}				
				
				if($_POST['icon'] == ''){
					if($_POST['parent'] == ''){
						$this->data['update'] = array(
								'MENU_NAME' => $_POST['name'],
								'PERMALINK' => $_POST['permalink'],
								'MENU_ORDER' => $order,
								'MENU_ID' => null,
							);
					}else{
						$this->data['update'] = array(
								'MENU_NAME' => $_POST['name'],
								'PERMALINK' => $_POST['permalink'],
								'MENU_ORDER' => $parent_menu_order.$order,
								'MENU_ID' => $_POST['parent'],
							);						
					}
				}else{
					if($_POST['parent'] == ''){
						$this->data['update'] = array(
								'MENU_NAME' => $_POST['name'],
								'PERMALINK' => $_POST['permalink'],
								'MENU_ICON' => $_POST['icon'],
								'MENU_ORDER' => $order,
								'MENU_ID' => null,
							);
					}else{
						$this->data['update'] = array(
								'MENU_NAME' => $_POST['name'],
								'PERMALINK' => $_POST['permalink'],
								'MENU_ICON' => $_POST['icon'],
								'MENU_ORDER' => $parent_menu_order.$order,
								'MENU_ID' => $_POST['parent'],
							);						
					}
				}
				$result = $this->menu_model->update($this->data['update'], $_POST['id']);
				if($result == true){
					$info = array();
					$info[] = 'Update data successfully';						
					$this->data['info'] = (object) array (
						'type'  	=> 'success',
						'data'		=> (object) array (
							'info'	=> $info,
						)
					);
				}else{
					$info = array();
					$info[] = 'Update data not successfull';
					$this->data['info'] = (object) array (
						'type'  	=> 'error',
						'data'		=> (object) array (
							'info'	=> $info,
						)
					);
				}				
				echo json_encode($this->data['info']);			
			}			
		}else{
			$r_nama = '';
			$r_permalink = '';
			$r_icon = '';
			$r_order = '';
			$r_parent = '';
			
			$filter = array();
			$filter[] = "A.ID = ". $_POST['id'];
			$this->data['result'] = $this->menu_model->get($filter);
			foreach($this->data['result'] as $value){
				$r_id 	= $value->ID;
				$r_nama = $value->MENU_NAME;
				$r_permalink = $value->PERMALINK;
				$r_icon = $value->MENU_ICON;
				$r_parent = $value->MENU_ID;
				if(strlen($value->MENU_ORDER) == 2){
					$r_order = $value->MENU_ORDER;
				}else{
					$r_order = substr($value->MENU_ORDER, 2, 2);
				}
				
				if(substr($r_order, 0, 1) == '0'){
					$r_order = substr($r_order, 1, 1);
				}
			}
			
			$parent = array();
			$data = $this->menu_model->get_parent();
			
			if (empty($data)) {
				//$parent[] = (object) array('label'=>'No Data', 'value'=>'nodata');
			} else {
				foreach ($data as $value) {
					$parent[] = (object) array('label'=>$value->MENU_NAME, 'value'=>$value->ID);
				}
			}
			
			$fields = array();
			$fields[] = (object) array(
				'type' 		=> 'hidden',
				'label' 	=> 'id',
				'name' 		=> 'id',
				'value' 	=> $r_id,
				'classes' 	=> '',
			);				
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Name',
				'name' 			=> 'name',
				'placeholder'	=> 'menu name',
				'value' 		=> $r_nama,
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Permalink',
				'name' 			=> 'permalink',
				'placeholder'	=> 'example : employee, #',
				'value' 		=> $r_permalink,
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Icon',
				'name' 			=> 'icon',
				'placeholder'	=> 'use fontawesome, example : plus, minus',
				'value' 		=> $r_icon,
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'Order',
				'name' 			=> 'order',
				'placeholder'	=> 'please input number (integer) start from 1',
				'value' 		=> $r_order,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'Parent menu',
				'name' 			=> 'parent',
				'placeholder'	=> '--Select Parent--',
				'value' 		=> $r_parent,
				'options'		=> $parent,
				'classes' 		=> 'full-width',
			);		

			$this->data['update'] = (object) array (
				'type'  	=> 'update_default',
				'data'		=> (object) array (
					'classes'  	=> '',
					'fields'  	=> $fields,
				)
			);
			echo json_encode($this->data['update']);
		}
	}
	
	public function detail($id=null){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['id']) and $_POST['id'] != null){
			$filters = array();
			$filters[] = "A.ID = ". $_POST['id'];
			$data = $this->menu_model->get($filters);
			
			$body= array();			
			if (empty($data)) {
                $body[] = array(
                    (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => 'No Data')
                );
			} else {
				foreach($data as $value){
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Name' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->MENU_NAME ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Permalink' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->PERMALINK ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Icon' ),
						(object) array( 'classes' => ' align-left ', 'value' => '<i class="fa fa-'.$value->MENU_ICON.'"></i>' ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Order' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->MENU_ORDER ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Parent' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->BMENU_NAME ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Status' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->STATUS ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Create Date' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->CREATE_DATE ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Update Date' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->UPDATE_DATE ),
					);	
				}
			}
			
			$header = array(
				array (
					(object) array ('rowspan' => 1, 'classes' => 'bold align-left capitalize', 'value' => 'Label'),
					(object) array ('colspan' => 1, 'classes' => 'bold align-left capitalize', 'value' => 'Value'),	
				)		
			);			
			
			$this->data['detail'] = (object) array (
				'type'  	=> 'detail_default',
				'data'		=> (object) array (
					'classes'	=> 'striped bordered hover',
					'header'	=> $header,
					'body'		=> $body,
				)
			);			
			echo json_encode($this->data['detail']);
		}
	}
	
	public function update_status(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['id']) and $_POST['id'] != null){
			$filters = array();
			$filters[] = "A.ID = ". $_POST['id'];
			
			$result = $this->menu_model->get($filters);
			if($result != null){
				foreach($result as $item){
					$status = $item->STATUS;
				}
				if($status == '1'){
					$new_status = '0';
				}else if($status == '0'){
					$new_status = '1';
				}
			}
			
			$this->data['update'] = array(
					'STATUS' => $new_status,
				);	
				
			$result = $this->menu_model->update($this->data['update'], $_POST['id']);
			if($result == true){
				$info = array();
				$info[] = 'Update status data successfully';						
				$this->data['info'] = (object) array (
					'type'  	=> 'success',
					'data'		=> (object) array (
						'info'	=> $info,
					)
				);
			}else{
				$info = array();
				$info[] = 'Update status data not successfull';
				$this->data['info'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $info,
					)
				);
			}			
			echo json_encode($this->data['info']);	
		}
	}
	
	public function delete(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		$this->data['delete'] = array(
				'ID' => $_POST['id'],
			);		
		$result = $this->menu_model->delete($this->data['delete']);
		
		if($result == true){
			$info = array();
			$info[] = 'Delete data successfully';			
			$info[] = 'Have a nice day';			
			$this->data['info'] = (object) array (
				'type'  	=> 'success',
				'data'		=> (object) array (
					'info'	=> $info,
				)
			);
		}else{
			$info = array();
			$info[] = 'Delete data not successfull';
			$this->data['info'] = (object) array (
				'type'  	=> 'error',
				'data'		=> (object) array (
					'info'	=> $info,
				)
			);
		}
		echo json_encode($this->data['info']);			
	}
	
}

