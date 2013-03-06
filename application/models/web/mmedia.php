<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mmedia extends CI_Model {
	private $tableName = 'scc_media';
	private $webId = null;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function __init($webId) {
		$this->webId = $webId;
	}
	
	public function getTotal() {
		return $this->db->count_all_results($this->tableName);
	}

	public function getTotalByWeb() {
		$this->db->where('media_web_id', $this->webId);
		return $this->db->count_all_results($this->tableName);
	}
	
	public function getAllResult($limit, $offset, $type = 'data') {
		$this->db->where('media_web_id', $this->webId);
		$this->db->order_by('media_id', 'desc');
		$query = $this->db->get($this->tableName, $limit, $offset);
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
		if(is_numeric($id)) {
			$this->db->where('media_id', $id);
			$query = $this->db->get($this->tableName);
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
			return $this->db->insert($this->tableName, $row);
		} else {
			return false;
		}
	}

	public function update($row, $id) {
		if(!empty($row)) {
			$this->db->where('media_id', $id);
			return $this->db->update($this->tableName, $row);
		} else {
			return false;
		}
	}
	
	public function delete($id) {
		if(is_numeric($id)) {
			$this->db->where('media_id', $id);
			return $this->db->delete($this->tableName);
		} else {
			return false;
		}
	}
}
?>