<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CI_Model {
	private $tableName = 'scc_channels';
	private $webId = null;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function __init($webId) {
		$this->webId = $webId;
	}
	
	public function getTotal() {
		$sql = "select count(*) as count from wms_channels";
		$query = $this->db->query($sql);
		$row = $query->row();
		if(!empty($row->count)) {
			return $row->count;
		} else {
			return 0;
		}
	}

	public function getAllResult($parameter = null, $limit = 0, $offset = 0, $type = 'data') {
		if($parameter['web_id'] === 0) {
			$this->db->where('channel_web_id', $this->webId);
		} elseif(is_numeric($parameter['web_id']) && $parameter['web_id'] > 0) {
			$this->db->where('channel_web_id', $parameter['web_id']);
		} else {
			$this->db->where('channel_web_id', $this->webId);
		}
		$this->db->order_by('channel_id');
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

	public function getChildResult($channelId = 0, $type = 'data') {
		$this->db->where('channel_father_id', $channelId);
		$this->db->order_by('channel_id');
		$query = $this->db->get($this->tableName);
		if($query->num_rows() > 0) {
			if($type=='data') {
				return $query->result();
			} elseif($type=='json') {
				
			}
		} else {
			return false;
		}
	}
	
	public function getRootResult($type = 'data') {
		$this->db->where('channel_father_id', 0);
		$this->db->where('channel_web_id', $this->webId);
		$this->db->order_by('channel_id');
		$query = $this->db->get($this->tableName);
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
			$this->db->where('channel_id', $id);
			$query = $this->db->get($this->tableName);
			if($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
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
			$this->db->where('channel_id', $id);
			return $this->db->update($this->tableName, $row);
		} else {
			return false;
		}
	}

	public function delete($id) {
		if(is_numeric($id)) {
			$this->db->where('channel_id', $id);
			return $this->db->delete($this->tableName);
		} else {
			return false;
		}
	}
}
?>