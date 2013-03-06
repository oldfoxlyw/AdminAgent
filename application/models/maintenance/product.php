<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Model {
	private $tableName = 'game_product';
	private $productdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->productdb = $this->load->database('productdb', TRUE);
	}
	
	public function getTotal() {
		return $this->productdb->count_all_results($this->tableName);
	}
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0) {
		$query = $this->productdb->get($this->tableName);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function get($id) {
		if(!empty($id)) {
			$this->productdb->where('game_id', $id);
			$query = $this->productdb->get($this->tableName);
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
			return $this->productdb->insert($this->tableName, $row);
		} else {
			return false;
		}
	}

	public function update($row, $id) {
		if(!empty($row)) {
			$this->productdb->where('game_id', $id);
			return $this->productdb->update($this->tableName, $row);
		} else {
			return false;
		}
	}
	
	public function delete($id) {
		if(!empty($id)) {
			$this->productdb->where('game_id', $id);
			return $this->productdb->delete($this->tableName);
		} else {
			return false;
		}
	}
}
?>