<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register_by_day extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'report_register_by_day';
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
		$page = $this->input->get_post('page', TRUE);
		$gameId = $this->input->get_post('game_id', TRUE);
		$sectionId = $this->input->get_post('section_id', TRUE);
		$serverId = $this->input->get_post('server_id', TRUE);
		$logTimeStart = $timeStart = $this->input->get_post('log_time_start', TRUE);
		$logTimeEnd = $timeEnd = $this->input->get_post('log_time_end', TRUE);
		$platform = $this->input->get_post('platform', TRUE);
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
			/**
			 *
			 * 分页程序
			 * @novar
			 */
			$rowTotal = $this->register->getDateTotal($parameter);
			$itemPerPage = $this->config->item('pagination_per_page');
			$pageTotal = intval($rowTotal/$itemPerPage);
			if($rowTotal%$itemPerPage) $pageTotal++;
			if($pageTotal > 0) {
				if(empty($page) || !is_numeric($page) || intval($page) < 1) {
					$page = 1;
				} elseif($page > $pageTotal) {
					$page = $pageTotal;
				} else {
					$page = intval($page);
				}
				$offset = $itemPerPage * ($page - 1);
			} else {
				$offset = 0;
			}
				
			$result = $this->register->getDateResult($parameter, $itemPerPage, $offset);
				
			$this->load->helper('pagination');
			$pagination = getPage($page, $pageTotal, getQueryString($parameter));
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
			'result'					=>	$result,
			'pagination'			=>	$pagination
		);
		$this->render->render('report_register_by_day', $data);
	}
}
?>