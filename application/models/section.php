<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Section extends CI_Model {
	private $accountTable = 'section_list';
	private $productdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->productdb = $this->load->database('productdb', true);
	}
	
	public function getTotal($parameter = null) {
		if(!empty($parameter['game_id'])) {
			$this->productdb->where('game_id', $parameter['game_id']);
		}
		return $this->productdb->count_all_results($this->accountTable);
	}
	
	public function getAllResult($parameter = null, $limit = 0, $offset = 0, $type = 'data') {
		if(!empty($parameter['game_id'])) {
			$this->productdb->where('game_id', $parameter['game_id']);
		}
		if($limit==0 && $offset==0) {
			$query = $this->productdb->get($this->accountTable);
		} else {
			$query = $this->productdb->get($this->accountTable, $limit, $offset);
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
	
	public function get($gameId, $sectionId) {
		if(!empty($gameId)) {
			$this->productdb->where('game_id', $gameId);
			$this->productdb->where('server_section_ud', $sectionId);
			$query = $this->productdb->get($this->accountTable);
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