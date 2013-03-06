<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Webs extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'web_webs';
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
		$this->load->model('web/web', 'web');
	}
	
	public function index() {
		$action = $this->input->get('action', TRUE);
		
		if($action=='modify') {
			$webUpdate = 'update';
			$webId = $this->input->get('id', TRUE);
			$row = $this->web->get($webId);
			$webName = $row->web_name;
			$webUrl = $row->web_url;
		}
		
		$result = $this->web->getAllResult();
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'result'			=>	$result,
			'web_update'		=>	$webUpdate,
			'web_id'			=>	$webId,
			'web_name'			=>	$webName,
			'web_url'			=>	$webUrl
		);
		$this->render->render('content_web', $data);
	}
	
	public function action() {
		$action = $this->input->get('action', TRUE);
		$webId = $this->input->get('id', TRUE);
		switch($action) {
			case 'set':
				$this->web->set($webId);
				$this->logs->write(array(
					'log_type'	=>	'CMS_WEB_SET'
				));
				break;
			case 'delete':
				$this->web->delete($webId);
				$this->logs->write(array(
					'log_type'	=>	'CMS_WEB_DELETE'
				));
				break;
		}
		redirect('/content/webs');
	}
	
	public function submit() {
		$webUpdate	= $this->input->post('webUpdate', TRUE);
		$webId		= $this->input->post('webId', TRUE);
		$webName	= $this->input->post('webName', TRUE);
		$webUrl		= $this->input->post('webUrl', TRUE);
		if($webUpdate=='update') {
			$parameter = array(
				'web_name'		=>	$webName,
				'web_url'		=>	$webUrl
			);
			if($this->web->update($parameter, $webId)) {
				
			}
		} else {
			$this->load->library('guid');
			$this->load->helper('security');
			$guid = do_hash($this->guid->toString());
			$parameter = array(
				'web_name'		=>	$webName,
				'web_url'		=>	$webUrl,
				'web_secretkey'	=>	$guid
			);
			if($this->web->insert($parameter)) {
				
			}
		}
		$this->logs->write(array(
			'log_type'	=>	'CMS_WEB_SUBMIT'
		));
		redirect('/content/webs');
	}
}
?>