<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Relogin_statistics extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'report_relogin_statistics';
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
		$this->load->model('report/login');
		$this->root_path = $this->config->item('root_path');
	}
	
	public function index() {
		$serverList = $this->input->get_post('serverContainerT', TRUE);
		$logLoginTimeStart = $this->input->get_post('log_login_time_start', TRUE);
		$logLoginTimeEnd = $this->input->get_post('log_login_time_end', TRUE);
		$logReloginTimeStart = $this->input->get_post('log_relogin_time_start', TRUE);
		$logReloginTimeEnd = $this->input->get_post('log_relogin_time_end', TRUE);
		$flag = $this->input->get_post('hiddenSubmitFlag', TRUE);
		
		if($flag=='1') {
			$parameter = array(
				'hiddenSubmitFlag'	=>	$flag
			);
			if(!empty($logLoginTimeStart) && !empty($logLoginTimeEnd) && !empty($logReloginTimeStart) && !empty($logReloginTimeEnd)) {
				$parameter['log_login_time_start'] = strtotime("{$logLoginTimeStart} 00:00:00");
				$parameter['log_login_time_end'] = strtotime("{$logLoginTimeEnd} 23:59:59");
				$parameter['log_relogin_time_start'] = strtotime("{$logReloginTimeStart} 00:00:00");
				$parameter['log_relogin_time_end'] = strtotime("{$logReloginTimeEnd} 23:59:59");
			}
			if(!empty($serverList)) {
				$table = array();
				$serverArray = explode('|||', $serverList);
				foreach($serverArray as $row) {
					$serverDetail = explode(',', $row);
					$parameter['game_id'] = $serverDetail[0];
					$parameter['section_id'] = $serverDetail[1];
					$parameter['server_id'] = $serverDetail[2];
					$resultLogin = $this->login->getLoginCount($parameter);
					$resultRelogin = $this->login->getReloginCount($parameter);
					
					$table[$parameter['game_id'] . '-' . $parameter['section_id'] . '-' . $parameter['server_id']] = array(
						'login_count'		=>	$resultLogin->login_count,
						'login_time'		=>	$resultLogin->login_time,
						'relogin_count'	=>	$resultRelogin->relogin_count,
						'relogin_time'		=>	$resultRelogin->relogin_time
					);
				}
			}
		}
		
		$this->load->model('game_product');
		$gameResult = $this->game_product->getAllResult();
		
		if(count($gameResult) == 1) {
			$this->load->model('section');
			$parameterServer = array(
				'game_id'		=>	$gameResult[0]->game_id
			);
			$sectionResult = $this->section->getAllResult($parameterServer);
		}
		if(count($sectionResult) == 1) {
			$this->load->model('maintenance/server');
			$parameterServer = array(
				'game_id'		=>	$gameResult[0]->game_id,
				'account_server_section'	=>	$sectionResult[0]->server_section_id
			);
			$serverResult = $this->server->getAllResult($parameterServer);
		}
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'						=>	$this->user,
			'root_path'				=>	$this->root_path,
			'game_result'			=>	$gameResult,
			'section_result'		=>	$sectionResult,
			'server_result'			=>	$serverResult,
			'log_login_time_start'		=>	$logLoginTimeStart,
			'log_login_time_end'		=>	$logLoginTimeEnd,
			'log_relogin_time_start'	=>	$logReloginTimeStart,
			'log_relogin_time_end'	=>	$logReloginTimeEnd,
			'submit_flag'			=>	$flag,
			'server_list'				=>	$serverList,
			'result'					=>	$table
		);
		$this->render->render('report_relogin_statistics', $data);
	}
}
?>