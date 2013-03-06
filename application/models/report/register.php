<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Model {
	private $tableName = 'log_register_count_per_date';
	private $tableDetailName = 'log_register_count_per_minutes';
	private $cachedb = null;
	
	public function __construct() {
		parent::__construct();
		$this->cachedb = $this->load->database('logcachedb', TRUE);
	}
	
	public function getDateTotal($parameter = null) {
		if(!empty($parameter['year_start']) && !empty($parameter['year_end'])) {
			$this->cachedb->where('cache_year >=', intval($parameter['year_start']));
			$this->cachedb->where('cache_year <=', intval($parameter['year_end']));
		}
		if(!empty($parameter['month_start']) && !empty($parameter['month_end'])) {
			$this->cachedb->where('cache_month >=', intval($parameter['month_start']));
			$this->cachedb->where('cache_month <=', intval($parameter['month_end']));
		}
		if(!empty($parameter['date_start']) && !empty($parameter['date_end'])) {
			$this->cachedb->where('cache_date >=', intval($parameter['date_start']));
			$this->cachedb->where('cache_date <=', intval($parameter['date_end']));
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
		if(!empty($parameter['platform'])) {
			$this->cachedb->where('platform', $parameter['platform']);
		}
		return $this->cachedb->count_all_results($this->tableName);
	}
	
	public function getTotal($parameter = null) {
		if(!empty($parameter['year_start']) && !empty($parameter['year_end'])) {
			$this->cachedb->where('cache_year >=', intval($parameter['year_start']));
			$this->cachedb->where('cache_year <=', intval($parameter['year_end']));
		}
		if(!empty($parameter['month_start']) && !empty($parameter['month_end'])) {
			$this->cachedb->where('cache_month >=', intval($parameter['month_start']));
			$this->cachedb->where('cache_month <=', intval($parameter['month_end']));
		}
		if(!empty($parameter['date_start']) && !empty($parameter['date_end'])) {
			$this->cachedb->where('cache_date >=', intval($parameter['date_start']));
			$this->cachedb->where('cache_date <=', intval($parameter['date_end']));
		}
		if(!empty($parameter['by_time'])) {
			$this->cachedb->select('`cache_year`, `cache_month`, `cache_date`, `cache_hour`, `game_id`, `section_id`, `server_id`, `platform`, SUM(`cache_count`) AS `cache_count`', FALSE);
			$this->cachedb->group_by(array(
				'cache_year',
				'cache_month',
				'cache_date',
				'cache_hour',
				'game_id',
				'section_id',
				'server_id'
			));
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
		if(!empty($parameter['platform'])) {
			$this->cachedb->where('platform', $parameter['platform']);
		}
		return $this->cachedb->count_all_results($this->tableDetailName);
	}
	
	public function getDateResult($parameter = null, $limit = 0, $offset = 0) {
		if(!empty($parameter['year_start']) && !empty($parameter['year_end'])) {
			$this->cachedb->where('cache_year >=', intval($parameter['year_start']));
			$this->cachedb->where('cache_year <=', intval($parameter['year_end']));
		}
		if(!empty($parameter['month_start']) && !empty($parameter['month_end'])) {
			$this->cachedb->where('cache_month >=', intval($parameter['month_start']));
			$this->cachedb->where('cache_month <=', intval($parameter['month_end']));
		}
		if(!empty($parameter['date_start']) && !empty($parameter['date_end'])) {
			$this->cachedb->where('cache_date >=', intval($parameter['date_start']));
			$this->cachedb->where('cache_date <=', intval($parameter['date_end']));
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
		if(!empty($parameter['platform'])) {
			$this->cachedb->where('platform', $parameter['platform']);
		}
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
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0) {
		if(!empty($parameter['year_start']) && !empty($parameter['year_end'])) {
			$this->cachedb->where('cache_year >=', intval($parameter['year_start']));
			$this->cachedb->where('cache_year <=', intval($parameter['year_end']));
		}
		if(!empty($parameter['month_start']) && !empty($parameter['month_end'])) {
			$this->cachedb->where('cache_month >=', intval($parameter['month_start']));
			$this->cachedb->where('cache_month <=', intval($parameter['month_end']));
		}
		if(!empty($parameter['date_start']) && !empty($parameter['date_end'])) {
			$this->cachedb->where('cache_date >=', intval($parameter['date_start']));
			$this->cachedb->where('cache_date <=', intval($parameter['date_end']));
		}
		if(!empty($parameter['by_time'])) {
			$this->cachedb->select('`cache_year`, `cache_month`, `cache_date`, `cache_hour`, `game_id`, `section_id`, `server_id`, `platform`, SUM(`cache_count`) AS `cache_count`', FALSE);
			$this->cachedb->group_by(array(
				'cache_year',
				'cache_month',
				'cache_date',
				'cache_hour',
				'game_id',
				'section_id',
				'server_id'
			));
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
		if(!empty($parameter['platform'])) {
			$this->cachedb->where('platform', $parameter['platform']);
		}
		if($limit==0 && $offset==0) {
			$query = $this->cachedb->get($this->tableDetailName);
		} else {
			$query = $this->cachedb->get($this->tableDetailName, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
}
?>