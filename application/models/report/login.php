<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Model {
	private $tableName = 'log_login_count_per_date';
	private $tableDetailName = 'log_login_count_per_minutes';
	private $cachedb = null;
	private $logdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->cachedb = $this->load->database('logcachedb', TRUE);
		$this->logdb = $this->load->database('logdb', TRUE);
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
	
	public function getLoginCount($parameter = null) {
		$sql = "select count(distinct `log_GUID`) as `login_count`, count(*) as `login_time` from `log_account` where `log_action` = 'ACCOUNT_LOGIN_SUCCESS'";
		if(!empty($parameter['log_login_time_start']) && !empty($parameter['log_login_time_end'])) {
			$sql .= " and `log_time` >= {$parameter['log_login_time_start']} and `log_time` <= {$parameter['log_login_time_end']}";
		}
		if(!empty($parameter['game_id'])) {
			$sql .= " and `game_id` = '{$parameter['game_id']}'";
		}
		if(!empty($parameter['section_id'])) {
			$sql .= " and `section_id` = '{$parameter['section_id']}'";
		}
		if(!empty($parameter['server_id'])) {
			$sql .= " and `server_id` = '{$parameter['server_id']}'";
		}
		
		$query = $this->logdb->query($sql);
		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	
	public function getReloginCount($parameter = null) {
		$sql = "select count(distinct `log_GUID`) as `relogin_count`, count(*) as `relogin_time` from `log_account` where `log_action` = 'ACCOUNT_LOGIN_SUCCESS' and `log_GUID` in (select `log_GUID` from `log_account` where `log_action` = 'ACCOUNT_LOGIN_SUCCESS' {%where_login%} group by `log_GUID`) {%where_relogin%}";
		
		$whereLogin = '';
		$whereRelogin = '';
		if(!empty($parameter['log_login_time_start']) && !empty($parameter['log_login_time_end'])) {
			$whereLogin .= " and `log_time` >= {$parameter['log_login_time_start']} and `log_time` <= {$parameter['log_login_time_end']}";
		}
		if(!empty($parameter['log_relogin_time_start']) && !empty($parameter['log_relogin_time_end'])) {
			$whereRelogin .= " and `log_time` >= {$parameter['log_relogin_time_start']} and `log_time` <= {$parameter['log_relogin_time_end']}";
		}
		if(!empty($parameter['game_id'])) {
			$whereLogin .= " and `game_id` = '{$parameter['game_id']}'";
			$whereRelogin .= " and `game_id` = '{$parameter['game_id']}'";
		}
		if(!empty($parameter['section_id'])) {
			$whereLogin .= " and `section_id` = '{$parameter['section_id']}'";
			$whereRelogin .= " and `section_id` = '{$parameter['section_id']}'";
		}
		if(!empty($parameter['server_id'])) {
			$whereLogin .= " and `server_id` = '{$parameter['server_id']}'";
			$whereRelogin .= " and `server_id` = '{$parameter['server_id']}'";
		}
		
		$this->load->helper('template');
		$parser = array(
			'where_login'		=>	$whereLogin,
			'where_relogin'	=>	$whereRelogin
		);
		$sql = parseTemplate($sql, $parser);
		
		$query = $this->logdb->query($sql);
		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
}
?>