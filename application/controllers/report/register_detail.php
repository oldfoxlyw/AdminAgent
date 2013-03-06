<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register_detail extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'report_register_detail';
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
		$this->load->model('game_account');
		$this->load->model('web_account');
		$this->root_path = $this->config->item('root_path');
	}
	
	public function index() {
		$accountId = $this->input->get_post('account_id', TRUE);
		$nickName = $this->input->get_post('nick_name', TRUE);
		$accountName = $this->input->get_post('account_name', TRUE);
		$flag = $this->input->get_post('hiddenSubmitFlag', TRUE);
		
		if($flag=='1') {
			$parameter = array(
				'hiddenSubmitFlag'	=>	$flag
			);
			if(!empty($accountId) || !empty($nickName) || !empty($accountName)) {
				if(!empty($accountId)) {
					$parameter['account_id'] = $accountId;
				}
				if(!empty($nickName)) {
					$parameter['nick_name'] = $nickName;
				}
				if(!empty($accountName)) {
					$parameter['account_name'] = $accountName;
				}
				
				$result = $this->game_account->getAllResult($parameter);
				$accountGuid = $result[0]->account_guid;
				
				$parameter = array(
					'guid'	=>	$accountGuid
				);
				$resultAccount = $this->web_account->get($parameter);
				
				$this->load->helper('language');
				$this->lang->load('account_status');
			}
		}
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'						=>	$this->user,
			'root_path'				=>	$this->root_path,
			'submit_flag'			=>	$flag,
			'account_id'			=>	$accountId,
			'nick_name'			=>	$nickName,
			'account_name'		=>	$accountName,
			'result'					=>	$result,
			'account'				=>	$resultAccount
		);
		$this->render->render('report_register_detail', $data);
	}
}
?>