<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account_logs extends CI_Model {
	private $tableName = 'log_account';
	private $logdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->logdb = $this->load->database('logdb', TRUE);
	}
	
	public function getTotal($parameter = null) {
		if(!empty($parameter['log_guid'])) {
			$this->logdb->where('log_GUID', $parameter['log_guid']);
		}
		if(!empty($parameter['log_account_name'])) {
			$this->logdb->where('log_account_name', $parameter['log_account_name']);
		}
		if(!empty($parameter['log_action'])) {
			$this->logdb->where('log_action', $parameter['log_action']);
		}
		if(!empty($parameter['game_id'])) {
			$this->logdb->where('game_id', $parameter['game_id']);
		}
		if(!empty($parameter['section_id'])) {
			$this->logdb->where('section_id', $parameter['section_id']);
		}
		if(!empty($parameter['server_id'])) {
			$this->logdb->where('server_id', $parameter['server_id']);
		}
		if(!empty($parameter['platform'])) {
			$this->logdb->where('platform', $parameter['platform']);
		}
		if(!empty($parameter['log_ip'])) {
			$this->logdb->where('log_ip', $parameter['log_ip']);
		}
		if(!empty($parameter['log_time_start']) && !empty($parameter['log_time_end'])) {
			$this->logdb->where('log_time >= ', $parameter['log_time_start']);
			$this->logdb->where('log_time <= ', $parameter['log_time_end']);
		}
		return $this->logdb->count_all_results($this->tableName);
	}
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0) {
		if(!empty($parameter['log_guid'])) {
			$this->logdb->where('log_GUID', $parameter['log_guid']);
		}
		if(!empty($parameter['log_account_name'])) {
			$this->logdb->where('log_account_name', $parameter['log_account_name']);
		}
		if(!empty($parameter['log_action'])) {
			$this->logdb->where('log_action', $parameter['log_action']);
		}
		if(!empty($parameter['game_id'])) {
			$this->logdb->where('game_id', $parameter['game_id']);
		}
		if(!empty($parameter['section_id'])) {
			$this->logdb->where('section_id', $parameter['section_id']);
		}
		if(!empty($parameter['server_id'])) {
			$this->logdb->where('server_id', $parameter['server_id']);
		}
		if(!empty($parameter['platform'])) {
			$this->logdb->where('platform', $parameter['platform']);
		}
		if(!empty($parameter['log_ip'])) {
			$this->logdb->where('log_ip', $parameter['log_ip']);
		}
		if(!empty($parameter['log_time_start']) && !empty($parameter['log_time_end'])) {
			$this->logdb->where('log_time >= ', $parameter['log_time_start']);
			$this->logdb->where('log_time <= ', $parameter['log_time_end']);
		}
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
}
?>