<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking_model extends CI_Model {
	
	private $_table1 = "tbl_bbihistory";
	private $_table2 = "tbl_childlocation";
	private $_table3 = "pod";

    public function __construct(){
		parent::__construct();
    }

/* 	public function get($filters=null){
		$sql = "SELECT A.*, B.LOCATION_NAME FROM " . $this->_table3 ." A";
		$sql .= " WHERE 1=1";
		if(isset($filters) and $filters != null){
			foreach ($filters as $filter) {
				$sql .= " AND " . $filter;
			}
		}
		$sql .= " ORDER BY CREATED ASC";
		
		//var_dump($sql);
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	} */
	
		public function get($filters=null){
		$sql = "call TrackingByAwb ";
		$sql .= " ";
		if(isset($filters) and $filters != null){
			foreach ($filters as $filter) {
				$sql .= " " . $filter;
			}
		}
		
		//var_dump($sql);
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
}