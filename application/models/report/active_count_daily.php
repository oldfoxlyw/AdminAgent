<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Active_count_daily extends CI_Model {
	private $tableName = 'log_active_count_daily';
	private $logcachedb = null;
	
	public function __construct() {
		parent::__construct();
		$this->logcachedb = $this->load->database('logcachedb', TRUE);
	}
	
	public function getTotal($parameter = null) {
		if(!empty($parameter['game_id'])) {
			$this->logcachedb->where('game_id', $parameter['game_id']);
		}
		if(!empty($parameter['section_id'])) {
			$this->logcachedb->where('section_id', $parameter['section_id']);
		}
		if(!empty($parameter['server_id'])) {
			$this->logcachedb->where('server_id', $parameter['server_id']);
		}
		if(!empty($parameter['log_time_start']) && !empty($parameter['log_time_end'])) {
			$this->logcachedb->where('log_date >= ', $parameter['log_time_start']);
			$this->logcachedb->where('log_date <= ', $parameter['log_time_end']);
		}
		return $this->logcachedb->count_all_results($this->tableName);
	}
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0) {
		if(!empty($parameter['game_id'])) {
			$this->logcachedb->where('game_id', $parameter['game_id']);
		}
		if(!empty($parameter['section_id'])) {
			$this->logcachedb->where('section_id', $parameter['section_id']);
		}
		if(!empty($parameter['server_id'])) {
			$this->logcachedb->where('server_id', $parameter['server_id']);
		}
		if(!empty($parameter['log_time_start']) && !empty($parameter['log_time_end'])) {
			$this->logcachedb->where('log_date >= ', $parameter['log_time_start']);
			$this->logcachedb->where('log_date <= ', $parameter['log_time_end']);
		}
		if($limit==0 && $offset==0) {
			$query = $this->logcachedb->get($this->tableName);
		} else {
			$query = $this->logcachedb->get($this->tableName, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
}
?>