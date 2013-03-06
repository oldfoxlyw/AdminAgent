<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Channels extends CI_Controller {
	
	private $user = null;
	private $_CONFIG = null;
	private $webId = 0;
	private $permissionName = 'web_channel';
	private $root_path = null;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('functions/check_user', 'check');
		$this->user = $this->check->validate();
		$this->check->permission($this->user, $this->permissionName);
		$this->check->ip();
		$this->webId = $this->check->checkDefaultWeb();
		$record = $this->check->configuration($this->user);
		$this->_CONFIG = $record['record'];
		if(!$record['state']) {
			$redirectUrl = urlencode($this->config->item('root_path') . 'login');
			redirect("/message?info=CMS_CLOSED&redirect={$redirectUrl}");
		}
		
		$this->root_path = $this->config->item('root_path');
		$this->load->model('web/channel', 'channel');
		$this->channel->__init($this->webId);
	}
	
	public function index() {
		$action = $this->input->get('action', TRUE);
		if($action=='modify') {
			$updateUpdate = 'update';
			$channelId = $this->input->get('id', TRUE);
			$row = $this->channel->get($channelId);
			$channelName = $row->channel_name;
			$channelUrl = $row->channel_url;
			$channelFatherId = $row->channel_father_id;
		}
		$result = $this->channel->getRootResult();
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'result'			=>	$result,
			'channel_update'	=>	$updateUpdate,
			'channel_id'		=>	$channelId,
			'channel_name'		=>	$channelName,
			'channel_url'		=>	$channelUrl,
			'channel_father_id'	=>	$channelFatherId
		);
		$this->render->render('content_channel', $data);
	}
	
	public function action() {
		$action = $this->input->get('action', TRUE);
		$channelId = $this->input->get('id', TRUE);
		switch($action) {
			case 'delete':
				$this->channel->delete($channelId);
				break;
		}
		redirect('/content/channels');
	}
	
	public function submit() {
		$channelUpdate	= $this->input->post('channelUpdate', TRUE);
		$channelId		= $this->input->post('channelId', TRUE);
		$channelName	= $this->input->post('channelName', TRUE);
		$channelUrl	= $this->input->post('channelUrl', TRUE);
		$channelFatherId= $this->input->post('channelFatherId', TRUE);
		if($channelUpdate=='update') {
			$parameter = array(
				'channel_name'		=>	$channelName,
				'channel_url'		=>	$channelUrl,
				'channel_father_id'	=>	$channelFatherId
			);
			if($this->channel->update($parameter, $channelId)) {
				
			}
		} else {
			$parameter = array(
				'channel_name'		=>	$channelName,
				'channel_url'		=>	$channelUrl,
				'channel_father_id'	=>	$channelFatherId,
				'channel_web_id'	=>	$this->webId
			);
			if($this->channel->insert($parameter)) {
				
			}
		}
		redirect('/content/channels');
	}
}
?>