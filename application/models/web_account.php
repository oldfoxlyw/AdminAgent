<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Web_account extends CI_Model {
	private $accountTable = 'web_account';
	private $accountdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->accountdb = $this->load->database('accountdb', true);
	}
	
	public function get($parameter = null) {
		if(!empty($parameter['guid'])) {
			$this->accountdb->where('GUID', $parameter['guid']);
		}
		if(!empty($parameter['account_name'])) {
			$this->accountdb->where('account_name', $parameter['account_name']);
		}
		$query = $this->accountdb->get($this->accountTable);
		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
}
?>