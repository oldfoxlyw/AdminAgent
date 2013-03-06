<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register_by_time extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'report_register_by_time';
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
		$this->load->model('report/register');
		$this->root_path = $this->config->item('root_path');
	}
	
	public function index() {
		$gameId = $this->input->get_post('game_id', TRUE);
		$sectionId = $this->input->get_post('section_id', TRUE);
		$serverId = $this->input->get_post('server_id', TRUE);
		$logTimeStart = $timeStart = $this->input->get_post('log_time_start', TRUE);
		$logTimeEnd = $timeEnd = $this->input->get_post('log_time_end', TRUE);
		$platform = $this->input->get_post('platform', TRUE);
		$flag = $this->input->get_post('hiddenSubmitFlag', TRUE);
		
		if($flag=='1') {
			$parameter = array(
				'hiddenSubmitFlag'	=>	$flag,
				'by_time'				=>	1
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
			if(!empty($gameId)) {
				$parameter['game_id'] = $gameId;
			}
			if(!empty($sectionId)) {
				$parameter['section_id'] = $sectionId;
			}
			if(!empty($serverId)) {
				$parameter['server_id'] = $serverId;
			}
			if(!empty($platform)) {
				$parameter['platform'] = $platform;
			}
			
			$result = $this->register->getAllResult($parameter);
			$table = array();
			$currentDate = '';
			foreach($result as $row) {
				if($currentDate != $row->cache_year . '-' . $row->cache_month . '-' . $row->cache_date) {
					$table[$row->cache_year . '-' . $row->cache_month . '-' . $row->cache_date] = array(
						'cache_date'	=>	$row->cache_year . '-' . $row->cache_month . '-' . $row->cache_date,
						'game_id'		=>	$row->game_id,
						'section_id'		=>	$row->section_id,
						'server_id'		=>	$row->server_id,
						'platform'		=>	$row->platform,
						'detail'			=>	array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)
					);
					$currentDate = $row->cache_year . '-' . $row->cache_month . '-' . $row->cache_date;
				}
				$table[$row->cache_year . '-' . $row->cache_month . '-' . $row->cache_date]['detail'][intval($row->cache_hour)] = intval($row->cache_count);
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
		} elseif(!empty($gameId)) {
			$this->load->model('section');
			$parameterServer = array(
				'game_id'		=>	$gameId
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
		} elseif(!empty($sectionId)) {
			$this->load->model('maintenance/server');
			$parameterServer = array(
				'game_id'		=>	$gameId,
				'account_server_section'	=>	$sectionId
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
			'game_id'				=>	$gameId,
			'section_id'				=>	$sectionId,
			'server_id'				=>	$serverId,
			'platform'				=>	$platform,
			'log_time_start'		=>	$timeStart,
			'log_time_end'		=>	$timeEnd,
			'submit_flag'			=>	$flag,
			'result'					=>	$table
		);
		$this->render->render('report_register_by_time', $data);
	}
}
?>