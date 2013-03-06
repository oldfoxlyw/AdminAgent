<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Partner_user extends CI_Model {
	private $tableName = 'scc_partner';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function validate($userName, $userPass) {
		if(!empty($userName) && !empty($userPass)) {
			$this->load->helper('security');
			$userPass = strtoupper(do_hash(do_hash($userPass, 'md5')));
			$this->db->where('user_name', $userName);
			$this->db->where('user_pass', $userPass);
			$query = $this->db->get($this->tableName);
			if($query->num_rows() > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function freezed($param) {
		if(!empty($param['guid'])) {
			$this->db->where('GUID', $param['guid']);
		} elseif(!empty($param['user_name'])) {
			$this->db->where('user_name', $param['user_name']);
		}
		$query = $this->db->get($this->tableName);
		if($query->num_rows() > 0) {
			$row = $query->row();
			if($row->user_freezed=='1') {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
	
	public function getTotal() {
		$sql = "select count(*) as count from {$this->tableName}";
		$query = $this->db->query($sql);
		$row = $query->row();
		if(!empty($row->count)) {
			return $row->count;
		} else {
			return 0;
		}
	}
	
	public function getAllResult($limit = 0, $offset = 0, $type = 'data') {
		if($limit==0 && $offset==0) {
			$query = $this->db->get($this->tableName);
		} else {
			$query = $this->db->get($this->tableName, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			if($type=='data') {
				return $query->result();
			} elseif($type=='json') {
				
			}
		} else {
			return false;
		}
	}
	
	public function get($id) {
		if(!empty($id)) {
			$this->db->where('GUID', $id);
			$query = $this->db->get($this->tableName);
			if($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}
	}
	
	public function freeze($id, $flag = true) {
		if(!empty($id)) {
			if($flag) {
				$parameter = array(
					'user_freezed'	=>	1
				);
			} else {
				$parameter = array(
					'user_freezed'	=>	0
				);
			}
			$this->db->where('GUID', $id);
			return $this->db->update($this->tableName, $parameter);
		} else {
			return false;
		}
	}
	
	public function insert($row) {
		if(!empty($row)) {
			return $this->db->insert($this->tableName, $row);
		} else {
			return false;
		}
	}

	public function update($row, $id) {
		if(!empty($row)) {
			$this->db->where('GUID', $id);
			return $this->db->update($this->tableName, $row);
		} else {
			return false;
		}
	}
	
	public function delete($id) {
		if(!empty($id)) {
			$this->db->where('GUID', $id);
			return $this->db->delete($this->tableName);
		} else {
			return false;
		}
	}
}
?>