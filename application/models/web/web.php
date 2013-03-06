<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Model {
	private $tableName = 'scc_web';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getTotal() {
		$sql = "select count(*) as count from scc_web";
		$query = $this->db->query($sql);
		$row = $query->row();
		if(!empty($row->count)) {
			return $row->count;
		} else {
			return 0;
		}
	}
	
	public function getAllResult() {
		$this->db->order_by('web_id');
		$query = $this->db->get($this->tableName);
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function get($id) {
		if(is_numeric($id)) {
			$this->db->where('web_id', $id);
			$query = $this->db->get($this->tableName);
			if($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}
	}
	
	public function insert($row) {
		if(!empty($row)) {
			return $this->db->insert($this->tableName, $row);
		} else {
			return false;
		}
	}

	public function update($row, $id) {
		if(!empty($row)) {
			$this->db->where('web_id', $id);
			return $this->db->update($this->tableName, $row);
		} else {
			return false;
		}
	}
	
	public function set($id) {
		if(is_numeric($id)) {
			$result = $this->get($id);
			if($result != FALSE) {
				$this->load->helper('cookie');
	            $cookie = array(
					'name'		=> 'default_web',
					'value'		=> $id,
					'expire'	=> $this->config->item('cookie_expire'),
					'domain'	=> $this->config->item('cookie_domain'),
					'path'		=> $this->config->item('cookie_path'),
					'prefix'	=> $this->config->item('cookie_prefix')
	            );
	            $this->input->set_cookie($cookie);
	            
	            $cookie = array(
					'name'		=> 'default_web_name',
					'value'		=> $result->web_name,
					'expire'	=> $this->config->item('cookie_expire'),
					'domain'	=> $this->config->item('cookie_domain'),
					'path'		=> $this->config->item('cookie_path'),
					'prefix'	=> $this->config->item('cookie_prefix')
	            );
	            $this->input->set_cookie($cookie);
	            
	            $cookie = array(
					'name'		=> 'default_web_url',
					'value'		=> $result->web_url,
					'expire'	=> $this->config->item('cookie_expire'),
					'domain'	=> $this->config->item('cookie_domain'),
					'path'		=> $this->config->item('cookie_path'),
					'prefix'	=> $this->config->item('cookie_prefix')
	            );
	            $this->input->set_cookie($cookie);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function delete($id) {
		if(is_numeric($id)) {
			$this->db->where('web_id', $id);
			return $this->db->delete($this->tableName);
		} else {
			return false;
		}
	}
}
?>