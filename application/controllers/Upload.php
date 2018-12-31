<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	private $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');		
		$this->load->library('PHPExcel');		
		$this->load->helper('url');			
		$this->load->database();
		$this->load->model('upload_model');	
		$this->data['error'] = array();
		$this->data['title'] = 'BBI Cargo';
	}

	public function index(){
		if(isset($_POST['submit'])){
			if (isset($_FILES['lampiran']) and file_exists($_FILES['lampiran']['tmp_name'])){
				$filename = $_FILES['lampiran']['name'];
				$target_dir = FCPATH."public/";
				
				$unik = date('YmdHis');
				$rename = $unik . '_' . $filename;
				$return = move_uploaded_file($_FILES["lampiran"]["tmp_name"], $target_dir . $rename);
				//unlink('././public/fpdf17/tmp/'.$rename);
				//insert table.
				
				if($return){
					$notif = 'Data sukses diupload';
					
					//read xlsx
					$inputFileType = 'Excel2007';
					$inputFileName = $target_dir.$rename;

					$objReader = PHPExcel_IOFactory::createReader($inputFileType); 
					$objPHPExcel = $objReader->load($inputFileName);

					$sheet = $objPHPExcel->getSheet(0); 
					$highestRow = $sheet->getHighestRow(); 
					$highestColumn = $sheet->getHighestColumn();
					$rowData = $sheet->rangeToArray('A2:'.$highestColumn.$highestRow,NULL,TRUE,FALSE);
					setlocale(LC_ALL, 'nl_NL.UTF-8@euro');
					
					$this->data['data'] = array();
					
					foreach($rowData as $value){
						$data_insert = array(
							'TGL_PICKUP'  => $this->retrive_date($value[0]),
							'TGL_BRGKT'  => $this->retrive_date($value[1]),
							'SHIPPER'  => $value[2],
							'ORIGIN'  => $value[3],
							'DEST'  => $value[4],
							'PENERUSAN'  => $value[5],
							'AWB'  => $value[6],
							'COLLY'  => $value[7],
							'KETERANGAN_ISI'  => $value[8],
							'KG_VOL'  => $value[9],
							'KG_ACT'  => $value[10],
							'SERVICE'  => $value[11],
							'VIA'  => $value[12],
							'PENERIMA'  => $value[13],
							'TGL_TERIMA'  => $this->retrive_date($value[14]),
							'KETERANGAN'  => $value[15],					
						);		
						$this->data['data'][] = $data_insert;
						$this->upload_model->insert($data_insert);
					}
					unlink($inputFileName);
					$this->data['redir'] = 'yes';
					$this->data['subtitle'] = 'Upload Data';
					$this->data['top_subtitle'] = 'BBI CARGO';
					$this->load->view('section_header', $this->data);
					$this->load->view('top');
					$this->load->view('header');
					$this->load->view('cover_nohome');
					$this->load->view('breadcurm');
					$this->load->view('content_upload');
					$this->load->view('footer');
					$this->load->view('section_footer');
				}else{
					$this->data['redir'] = 'yes';
					$this->data['notif'] = 'Upload Gagal';
					$this->data['subtitle'] = 'Upload Data';
					$this->data['top_subtitle'] = 'BBI CARGO';
					$this->load->view('section_header', $this->data);
					$this->load->view('top');
					$this->load->view('header');
					$this->load->view('cover_nohome');
					$this->load->view('breadcurm');
					$this->load->view('content_upload');
					$this->load->view('footer');
					$this->load->view('section_footer');
					//header('Refresh: 10; URL='.base_url().'/upload/');
				}				
			}else{
				$this->data['redir'] = 'yes';
				$this->data['notif'] = 'Upload Gagal';
				$this->data['subtitle'] = 'Upload Data';
				$this->data['top_subtitle'] = 'BBI CARGO';
				$this->load->view('section_header', $this->data);
				$this->load->view('top');
				$this->load->view('header');
				$this->load->view('cover_nohome');
				$this->load->view('breadcurm');
				$this->load->view('content_upload');
				$this->load->view('footer');
				$this->load->view('section_footer');				
			}
		}else{
			$this->data['notif'] = 'Upload data terlebih dahulu';
			$this->data['subtitle'] = 'Upload Data';
			$this->data['top_subtitle'] = 'BBI CARGO';
			$this->load->view('section_header', $this->data);
			$this->load->view('top');
			$this->load->view('header');
			$this->load->view('cover_nohome');
			$this->load->view('breadcurm');
			$this->load->view('content_upload');
			$this->load->view('footer');
			$this->load->view('section_footer');
		}
	}
	
	public function status($data=null){
		$this->data($data);
		$this->data['subtitle'] = 'Upload Data';
		$this->data['top_subtitle'] = 'BBI CARGO';
		$this->load->view('section_header', $this->data);
		$this->load->view('top');
		$this->load->view('header');
		$this->load->view('cover_nohome');
		$this->load->view('breadcurm');
		$this->load->view('content_upload');
		$this->load->view('footer');
		$this->load->view('section_footer');		
	}
	
	private function retrive_date($value){
		if(is_numeric (substr($value, 0, 1))){
			return date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($value));
		}else{
			return $value;
		}
	}
}

