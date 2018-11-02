<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking_model extends CI_Model {
	
	private $_table1 = "tbl_bbihistory";
	private $_table2 = "tbl_childlocation";

    public function __construct(){
		parent::__construct();
    }

	public function get($filters=null){
		$sql = "SELECT A.*, B.LOCATION_NAME FROM " . $this->_table1 ." A";
		$sql .= " LEFT JOIN " . $this->_table2 ." B";
		$sql .= " ON A.LOCATION=B.IDX";
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
	}
	
}