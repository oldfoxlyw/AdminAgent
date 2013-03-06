<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Overview_model extends CI_Model {
	private $tableName = 'log_overview';
	private $tableGroupName = 'log_overview_group_by_type';
	private $cachedb = null;
	
	public function __construct() {
		parent::__construct();
		$this->cachedb = $this->load->database('logcachedb', TRUE);
	}
	
	public function getTotal() {
		return $this->cachedb->count_all_results($this->tableName);
	}
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0) {
		if(!empty($parameter['log_date_start']) && !empty($parameter['log_date_end'])) {
			$this->cachedb->where('log_date >=', $parameter['log_date_start']);
			$this->cachedb->where('log_date <=', $parameter['log_date_end']);
		}
		if(!empty($parameter['game_id'])) {
			$this->cachedb->where('game_id', $parameter['game_id']);
		}
		if(!empty($parameter['section_id'])) {
			$this->cachedb->where('section_id', $parameter['section_id']);
		}
		if(!empty($parameter['server_id'])) {
			$this->cachedb->where('server_id', $parameter['server_id']);
		}
		if(!empty($parameter['funds_type'])) {
			$this->cachedb->where('funds_type', intval($parameter['funds_type']));
			$this->tableName = $this->tableGroupName;
		}
		$this->cachedb->order_by('log_date', 'desc');
		if($limit==0 && $offset==0) {
			$query = $this->cachedb->get($this->tableName);
		} else {
			$query = $this->cachedb->get($this->tableName, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function get($id) {
		if(!empty($id)) {
			$this->cachedb->where('master_id', $id);
			$query = $this->cachedb->get($this->tableName);
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