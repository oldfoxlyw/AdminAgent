<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'maintenance_chat';
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
		$this->load->model('maintenance/master', 'master');
		$this->load->model('maintenance/server', 'server');
	}
	
	public function index() {
		$parameter = array(
			'game_id'	=>	'A'
		);
		$serverResult = $this->server->getAllResult($parameter);
		$result = $this->master->getAllResult();
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'server_result'		=>	$serverResult,
			'result'			=>	$result
		);
		$this->render->render('maintenance_chat', $data);
	}
	
	public function requestChatContent() {
		$channel = 1;
		$ip = $this->input->post('ip', TRUE);
		$port = $this->input->post('port', TRUE);
		$section = $this->input->post('server_section', TRUE);
		$server = $this->input->post('server_id', TRUE);
		
		$parameter = array(
			'channel'		=>	$channel,
			'server_section'=>	$section,
			'server_id'		=>	$server
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://' . $ip . ':' . $port . '/get_world_chat?' . http_build_query($parameter));
		$ip = $this->input->ip_address();
		$header = array(
			'CLIENT-IP:' . $ip,
			'X-FORWARDED-FOR:' . $ip,
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		
		$monfd = curl_exec($ch);
		curl_close($ch);
		echo $monfd;
	}
}
?>