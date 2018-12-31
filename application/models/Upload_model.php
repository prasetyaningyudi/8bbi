<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {
	
	private $_table1 = "pod";

    public function __construct(){
		parent::__construct();
    }

	public function get($filters=null){
		$sql = "SELECT * FROM " . $this->_table1;
		$sql .= " WHERE 1=1";
		if(isset($filters) and $filters != null){
			foreach ($filters as $filter) {
				$sql .= " AND " . $filter;
			}
		}
		$sql .= " ORDER BY ID ASC";
		
		//var_dump($sql);
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	public function insert($data){
		$result = $this->db->insert($this->_table1, $data);
		return $result;
	}
	
}