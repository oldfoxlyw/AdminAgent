<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Daily_report extends CI_Model {
	private $tableName = 'log_daily_statistics';
	private $logcachedb = null;
	
	public function __construct() {
		parent::__construct();
		$this->logcachedb = $this->load->database('logcachedb', TRUE);
	}
	
	public function getTotal($parameter = null) {
		if(!empty($parameter['log_time_start'])) {
			$this->logcachedb->where('log_date >=', $parameter['log_time_start']);
		}
		if(!empty($parameter['log_time_end'])) {
			$this->logcachedb->where('log_date <=', $parameter['log_time_end']);
		}
		if(!empty($parameter['server_name'])) {
			$this->logcachedb->where('server_name', $parameter['server_name']);
		}
		if(!empty($parameter['partner_key'])) {
			$this->logcachedb->where('partner_key', $parameter['partner_key']);
		}
		return $this->logcachedb->count_all_results($this->tableName);
	}
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0) {
		if(!empty($parameter['log_time_start'])) {
			$this->logcachedb->where('log_date >=', $parameter['log_time_start']);
		}
		if(!empty($parameter['log_time_end'])) {
			$this->logcachedb->where('log_date <=', $parameter['log_time_end']);
		}
		if(!empty($parameter['server_name'])) {
			$this->logcachedb->where('server_name', $parameter['server_name']);
		}
		if(!empty($parameter['partner_key'])) {
			$this->logcachedb->where('partner_key', $parameter['partner_key']);
		}
		if(!empty($parameter['sum'])) {
			$this->logcachedb->select_sum($parameter['sum']);
		}
		$this->logcachedb->order_by('log_date', 'desc');
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