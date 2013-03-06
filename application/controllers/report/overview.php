<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Overview extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'report_overview';
	private $root_path = null;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('functions/check_user', 'check');
		$this->user = $this->check->validate();
		$this->check->permission($this->user, $this->permissionName);
		$this->check->ip();
		$record = $this->check->configuration($this->user);
		$this->_CONFIG = $record['record'];
		if(!$record['state']) {
			$redirectUrl = urlencode($this->config->item('root_path') . 'login');
			redirect("/message?info=CMS_CLOSED&redirect={$redirectUrl}");
		}
		
		$this->root_path = $this->config->item('root_path');
	}
	
	public function index() {
		$currentTimeStamp = time();
		$startDate = date('Y-m-d', $currentTimeStamp - 7 * 86400);
		$endDate = date('Y-m-d', $currentTimeStamp - 86400);
		
		$this->load->model('maintenance/server');
		$this->load->model('report/overview_model');
		$serverResult = $this->server->getAllResult();
		
		$result = array();
		foreach($serverResult as $value) {
			$parameter = array(
				'log_date_start'			=>	$startDate,
				'log_date_end'			=>	$endDate,
				'game_id'					=>	$value->game_id,
				'section_id'					=>	$value->account_server_section,
				'server_id'					=>	$value->account_server_id
			);
			$currentResult = $this->overview_model->getAllResult($parameter);
			
			$tempResult = array(
				'game_id'					=>	$value->game_id,
				'section_id'					=>	$value->account_server_section,
				'server_id'					=>	$value->account_server_id,
				'server_name'				=>	$value->server_name,
				'result'						=>	$currentResult
			);
			array_push($result, $tempResult);
		}
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'						=>	$this->user,
			'root_path'				=>	$this->root_path,
			'result'					=>	$result
		);
		$this->render->render('report_overview', $data);
	}
}
?>