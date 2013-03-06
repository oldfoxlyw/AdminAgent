<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grant extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'master_grant';
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
		$this->load->model('maintenance/server', 'server');
		$parameter = array(
			'game_id'	=>	'A'
		);
		$serverResult = $this->server->getAllResult($parameter);
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'server_result'		=>	$serverResult
		);
		$this->render->render('master_grant', $data);
	}
	
	public function submit() {
 		$ip = $this->input->post('serverIp', TRUE);
 		$port = $this->input->post('serverPort', TRUE);
 		$accountName = $this->input->post('accountName', TRUE);
 		$section = $this->input->post('sectionId', TRUE);
 		$server = $this->input->post('serverId', TRUE);
 		$itemType = $this->input->post('itemType', TRUE);
 		$crystal = $this->input->post('crystal', TRUE);
 		$tritium = $this->input->post('tritium', TRUE);
 		$brokenCrystal = $this->input->post('broken_crystal', TRUE);
 		$darkCrystal = $this->input->post('dark_crystal', TRUE);
 		$itemName = $this->input->post('itemName', TRUE);
 		$itemCount = $this->input->post('itemCount', TRUE);
		
 		$parameter = array(
 			'nickname'			=>	$accountName,
 			'crystal'				=>	intval($crystal),
 			'tritium'				=>	intval($tritium),
 			'broken_crystal'	=>	intval($brokenCrystal),
 			'dark_crystal'		=>	intval($darkCrystal)
 		);
		
 		$ch = curl_init();
 		curl_setopt($ch, CURLOPT_URL, 'http://' . $ip . ':' . $port . '/add_resoures');
	 	curl_setopt($ch, CURLOPT_POST, 1);
	 	curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		
 		$monfd = curl_exec($ch);
 		curl_close($ch);
 		$result = json_decode($monfd);
 		$return = array();
 		if(!empty($result->errors)) {
 			$return['errors'] = $result->errors;
 		} else {
	 		$accountId = $result->officer_id;
	
			//记录日志
			if(is_numeric($darkCrystal) && intval($darkCrystal) > 0) {
				$parameter = array(
					'account_id'					=>	$accountId,
					'funds_amount'				=>	0,
					'funds_item_amount'		=>	intval($darkCrystal),
					'game_id'						=>	'A',
					'server_section'				=>	$section,
					'server_id'						=>	$server
				);
				$code = do_hash(implode('|||', $parameter) . '|||bbc904d185bb824e5ae5eebf5cc831cf49f44b2b');
				$parameter['funds_type'] = 0;
				$parameter['code'] = $code;
				
				$ch = curl_init();
		 		curl_setopt($ch, CURLOPT_URL, 'http://42.121.82.226/UserAgent/websrv/notify/recharge');
		 		curl_setopt($ch, CURLOPT_POST, 1);
		 		curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
		 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		 		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		 		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
				
		 		$monfd = curl_exec($ch);
		 		curl_close($ch);
			}
			$this->logs->write(array(
				'log_type'		=>	'CMS_MASTER_GRANT',
				'user_name'	=>	$this->user->user_name
			));
 			$return['errors'] = '';
 		}
 		echo json_encode($return);
	}
}
?>