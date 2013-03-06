<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Model {
	private $tableName = 'master_account';
	private $accountdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->accountdb = $this->load->database('accountdb', TRUE);
	}
	
	public function getTotal() {
		return $this->accountdb->count_all_results($this->tableName);
	}
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0) {
		$query = $this->accountdb->get($this->tableName);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function get($id) {
		if(!empty($id)) {
			$this->accountdb->where('master_id', $id);
			$query = $this->accountdb->get($this->tableName);
			if($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function insert($row) {
		if(!empty($row)) {
			return $this->accountdb->insert($this->tableName, $row);
		} else {
			return false;
		}
	}

	public function update($row, $id) {
		if(!empty($row)) {
			$this->accountdb->where('master_id', $id);
			return $this->accountdb->update($this->tableName, $row);
		} else {
			return false;
		}
	}
	
	public function delete($id) {
		if(!empty($id)) {
			$this->accountdb->where('master_id', $id);
			return $this->accountdb->delete($this->tableName);
		} else {
			return false;
		}
	}
}
?>