<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Props_sell extends CI_Model {
	private $tableName = 'log_props_sell';
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
		if(!empty($parameter['item_id'])) {
			$this->cachedb->where('item_id', $parameter['item_id']);
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
}
?>