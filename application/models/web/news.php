<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Model {
	private $tableName = 'scc_news';
	private $viewName = 'scc_news_view';
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
		$this->db->where('channel_web_id', $this->webId);
		$this->db->from($this->viewName);
		return $this->db->count_all_results();
	}
	
	public function getAllResult($parameter = null, $limit, $offset, $type = 'data') {
		if($parameter['news_status']=='0' || $parameter['news_status']=='1') {
			$this->db->where('news_status', $parameter['news_status']);
		}
		if($parameter['news_top_show']=='0' || $parameter['news_top_show']=='1') {
			$this->db->where('news_top_show', $parameter['news_top_show']);
		}
		$this->db->where('channel_web_id', $this->webId);
		$this->db->order_by('news_id', 'desc');
		$query = $this->db->get($this->viewName, $limit, $offset);
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
			$this->db->where('news_id', $id);
			$query = $this->db->get($this->viewName);
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
			$this->db->where('news_id', $id);
			return $this->db->update($this->tableName, $row);
		} else {
			return false;
		}
	}

	public function setToTop($id, $flag = true, $unique = false) {
		if(is_numeric($id)) {
			if($unique) {
				$parameter = array(
					'news_top_show'	=>	0
				);
				$this->db->update($this->tableName, $parameter);
			}
			if($flag) {
				$parameter = array(
					'news_top_show'	=>	1
				);
			} else {
				$parameter = array(
					'news_top_show'	=>	0
				);
			}
			$this->db->where('news_id', $id);
			return $this->db->update($this->tableName, $parameter);
		} else {
			return false;
		}
	}
	
	public function check($id, $flag = true) {
		if(is_numeric($id)) {
			if($flag) {
				$parameter = array(
					'news_status'	=>	1
				);
			} else {
				$parameter = array(
					'news_status'	=>	0
				);
			}
			$this->db->where('news_id', $id);
			return $this->db->update($this->tableName, $parameter);
		} else {
			return false;
		}
	}
	
	public function delete($id) {
		if(is_numeric($id)) {
			$this->db->where('news_id', $id);
			return $this->db->delete($this->tableName);
		} else {
			return false;
		}
	}
}
?>