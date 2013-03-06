<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_detail extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'report_login_detail';
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
		$this->load->model('report/account_logs');
		$this->root_path = $this->config->item('root_path');
	}
	
	public function index() {
		$page = $this->input->get_post('page', TRUE);
		$accountName = $this->input->get_post('log_account_name', TRUE);
		$flag = $this->input->get_post('hiddenSubmitFlag', TRUE);
		
		if($flag=='1') {
			$parameter = array(
				'hiddenSubmitFlag'	=>	$flag
			);
			if(!empty($accountName)) {
				$parameter['log_account_name'] = $accountName;
			}
			/**
			 * 
			 * 分页程序
			 * @novar
			 */
			$rowTotal = $this->account_logs->getTotal($parameter);
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
			
			$result = $this->account_logs->getAllResult($parameter, $itemPerPage, $offset);
			
			$this->load->helper('pagination');
			$pagination = getPage($page, $pageTotal, getQueryString($parameter));
			
			$this->load->helper('language');
			$this->lang->load('log_action');
		}
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'						=>	$this->user,
			'root_path'				=>	$this->root_path,
			'submit_flag'			=>	$flag,
			'account_name'		=>	$accountName,
			'result'					=>	$result,
			'pagination'			=>	$pagination
		);
		$this->render->render('report_login_detail', $data);
	}
}
?>