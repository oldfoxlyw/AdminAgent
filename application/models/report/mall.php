<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mall extends CI_Model {
	private $tableName = 'log_mall';
	private $logdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->logdb = $this->load->database('logdb', TRUE);
	}
	
	public function getTotal($parameter = null) {
		if(!empty($parameter['account_id'])) {
			$this->logdb->where('log_account_id', $parameter['account_id']);
		}
		if(!empty($parameter['log_type'])) {
			$this->logdb->where('log_type', $parameter['log_type']);
		}
		if(!empty($parameter['log_spend_item_id'])) {
			$this->logdb->where('log_spend_item_id', $parameter['log_spend_item_id']);
		}
		if(!empty($parameter['log_get_item_id'])) {
			$this->logdb->where('log_get_item_id', $parameter['log_get_item_id']);
		}
		if(!empty($parameter['game_id'])) {
			$this->logdb->where('game_id', $parameter['game_id']);
		}
		if(!empty($parameter['section_id'])) {
			$this->logdb->where('server_section', $parameter['section_id']);
		}
		if(!empty($parameter['server_id'])) {
			$this->logdb->where('server_id', $parameter['server_id']);
		}
		if(!empty($parameter['log_time_start']) && !empty($parameter['log_time_end'])) {
			$this->logdb->where('log_time >', strtotime("{$parameter['log_time_start']} 00:00:00"));
			$this->logdb->where('log_time <=', strtotime("{$parameter['log_time_end']} 23:59:59"));
		}
		return $this->logdb->count_all_results($this->tableName);
	}
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0) {
		if(!empty($parameter['account_id'])) {
			$this->logdb->where('log_account_id', $parameter['account_id']);
		}
		if(!empty($parameter['log_type'])) {
			$this->logdb->where('log_type', $parameter['log_type']);
		}
		if(!empty($parameter['log_spend_item_id'])) {
			$this->logdb->where('log_spend_item_id', $parameter['log_spend_item_id']);
		}
		if(!empty($parameter['log_get_item_id'])) {
			$this->logdb->where('log_get_item_id', $parameter['log_get_item_id']);
		}
		if(!empty($parameter['game_id'])) {
			$this->logdb->where('game_id', $parameter['game_id']);
		}
		if(!empty($parameter['section_id'])) {
			$this->logdb->where('server_section', $parameter['section_id']);
		}
		if(!empty($parameter['server_id'])) {
			$this->logdb->where('server_id', $parameter['server_id']);
		}
		if(!empty($parameter['log_time_start']) && !empty($parameter['log_time_end'])) {
			$this->logdb->where('log_time >', strtotime("{$parameter['log_time_start']} 00:00:00"));
			$this->logdb->where('log_time <=', strtotime("{$parameter['log_time_end']} 23:59:59"));
		}
		$this->logdb->order_by('log_time', 'desc');
		if($limit==0 && $offset==0) {
			$query = $this->logdb->get($this->tableName);
		} else {
			$query = $this->logdb->get($this->tableName, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function get($id) {
		if(!empty($id)) {
			$this->logdb->where('log_id', $id);
			$query = $this->logdb->get($this->tableName);
			if($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
?>