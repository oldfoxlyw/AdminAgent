<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_statistics extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'report_login_statistics';
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
		$logTimeStart = $timeStart = $this->input->get_post('log_time_start', TRUE);
		$logTimeEnd = $timeEnd = $this->input->get_post('log_time_end', TRUE);
		$flag = $this->input->get_post('hiddenSubmitFlag', TRUE);
		
		if($flag=='1') {
			$parameter = array(
				'hiddenSubmitFlag'	=>	$flag
			);
			if(!empty($logTimeStart) && !empty($logTimeEnd)) {
				$logTimeStart = explode('-', $logTimeStart);
				$logTimeEnd = explode('-', $logTimeEnd);
				$parameter['year_start'] = $logTimeStart[0];
				$parameter['year_end'] = $logTimeEnd[0];
				$parameter['month_start'] = $logTimeStart[1];
				$parameter['month_end'] = $logTimeEnd[1];
				$parameter['date_start'] = $logTimeStart[2];
				$parameter['date_end'] = $logTimeEnd[2];
			}
			if(!empty($serverList)) {
				$table = array();
				$serverArray = explode('|||', $serverList);
				foreach($serverArray as $row) {
					$serverDetail = explode(',', $row);
					$parameter['game_id'] = $serverDetail[0];
					$parameter['section_id'] = $serverDetail[1];
					$parameter['server_id'] = $serverDetail[2];
					$result = $this->login->getDateResult($parameter);
					foreach($result as $value) {
						$table[$value->cache_year . '-' . $value->cache_month . '-' . $value->cache_date] = array(
							$value->game_id . '-' . $value->section_id . '-' . $value->server_id	=>	$value->cache_count
						);
					}
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
			'submit_flag'			=>	$flag,
			'server_list'				=>	$serverList,
			'result'					=>	$table
		);
		$this->render->render('report_login_statistics', $data);
	}
}
?>