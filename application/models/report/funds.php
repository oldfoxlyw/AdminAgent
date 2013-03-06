<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Funds extends CI_Model {
	private $tableName = 'funds_checkinout';
	private $fundsdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->fundsdb = $this->load->database('fundsdb', TRUE);
	}
	
	public function getTotal($parameter = null) {
		if(!empty($parameter['account_guid'])) {
			$this->fundsdb->where('account_guid', $parameter['account_guid']);
		}
		if(!empty($parameter['account_name'])) {
			$this->fundsdb->where('account_name', $parameter['account_name']);
		}
		if(!empty($parameter['account_id'])) {
			$this->fundsdb->where('account_id', $parameter['account_id']);
		}
		if(!empty($parameter['game_id'])) {
			$this->fundsdb->where('game_id', $parameter['game_id']);
		}
		if(!empty($parameter['server_id'])) {
			$this->fundsdb->where('server_id', $parameter['server_id']);
		}
		if(!empty($parameter['section_id'])) {
			$this->fundsdb->where('server_section', $parameter['section_id']);
		}
		if(!empty($parameter['funds_flow_dir'])) {
			$this->fundsdb->where('funds_flow_dir', $parameter['funds_flow_dir']);
		}
		if(!empty($parameter['funds_type'])) {
			$this->fundsdb->where('funds_type', $parameter['funds_type']);
		}
		if(!empty($parameter['log_time_start']) && !empty($parameter['log_time_end'])) {
			$this->fundsdb->where('funds_time >', strtotime("{$parameter['log_time_start']} 00:00:00"));
			$this->fundsdb->where('funds_time <=', strtotime("{$parameter['log_time_end']} 23:59:59"));
		}
		return $this->fundsdb->count_all_results($this->tableName);
	}
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0) {
		if(!empty($parameter['account_guid'])) {
			$this->fundsdb->where('account_guid', $parameter['account_guid']);
		}
		if(!empty($parameter['account_name'])) {
			$this->fundsdb->where('account_name', $parameter['account_name']);
		}
		if(!empty($parameter['account_id'])) {
			$this->fundsdb->where('account_id', $parameter['account_id']);
		}
		if(!empty($parameter['game_id'])) {
			$this->fundsdb->where('game_id', $parameter['game_id']);
		}
		if(!empty($parameter['server_id'])) {
			$this->fundsdb->where('server_id', $parameter['server_id']);
		}
		if(!empty($parameter['section_id'])) {
			$this->fundsdb->where('server_section', $parameter['section_id']);
		}
		if(!empty($parameter['funds_flow_dir'])) {
			$this->fundsdb->where('funds_flow_dir', $parameter['funds_flow_dir']);
		}
		if(!empty($parameter['funds_type'])) {
			$this->fundsdb->where('funds_type', $parameter['funds_type']);
		}
		if(!empty($parameter['log_time_start']) && !empty($parameter['log_time_end'])) {
			$this->fundsdb->where('funds_time >', strtotime("{$parameter['log_time_start']} 00:00:00"));
			$this->fundsdb->where('funds_time <=', strtotime("{$parameter['log_time_end']} 23:59:59"));
		}
		$this->fundsdb->order_by('funds_time', 'desc');
		if($limit==0 && $offset==0) {
			$query = $this->fundsdb->get($this->tableName);
		} else {
			$query = $this->fundsdb->get($this->tableName, $limit, $offset);
		}
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function get($id) {
		if(!empty($id)) {
			$this->fundsdb->where('funds_id', $id);
			$query = $this->fundsdb->get($this->tableName);
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