<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administrators extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'setting_admin';
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
		$this->load->model('web/admin_user', 'admin');
	}
	
	public function index() {
		$action = $this->input->get('action', TRUE);
		$page = $this->input->get('page', TRUE);
		/**
		 * 
		 * 分页程序
		 * @novar
		 */
		$rowTotal = $this->admin->getTotal();
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
		
		if($action=='modify') {
			$update = 'update';
			$id = $this->input->get('id', TRUE);
			$row = $this->admin->get($id);
			$userName = $row->user_name;
			$userPermission = $row->user_permisstion;
		}
		$result = $this->admin->getPermissionResult($itemPerPage, $offset);
		$this->load->model('setting/permission', 'permission');
		$permissionResult = $this->permission->getAllResult();
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'result'			=>	$result,
			'permission'		=>	$permissionResult,
			'admin_update'	=>	$update,
			'guid'				=>	$id,
			'user_name'		=>	$userName,
			'user_permission'	=>	$userPermission
		);
		$this->render->render('setting_admin', $data);
	}
	
	public function action() {
		$action = $this->input->get('action', TRUE);
		$id = $this->input->get('id', TRUE);
		switch($action) {
			case 'delete':
				$this->admin->delete($id);
				$this->logs->write(array(
					'log_type'	=>	'CMS_ADMIN_DELETE'
				));
				break;
		}
		redirect('/setting/administrators');
	}
	
	public function submit() {
		$userUpdate		= $this->input->post('adminUpdate', TRUE);
		$guid			= $this->input->post('guid', TRUE);
		$userName		= $this->input->post('userName', TRUE);
		$userPass		= $this->input->post('userPass', TRUE);
		$userPermission	= $this->input->post('userPermission', TRUE);
		$this->load->helper('security');
		if(!empty($userPass)) $userPass = strtoupper(do_hash(do_hash($userPass, 'md5')));
		if($userUpdate=='update') {
			if(!empty($userPass)) {
				$parameter = array(
					'user_name'			=>	$userName,
					'user_pass'			=>	$userPass,
					'user_permission'	=>	$userPermission
				);
			} else {
				$parameter = array(
					'user_name'			=>	$userName,
					'user_permission'	=>	$userPermission
				);
			}
			if($this->admin->update($parameter, $guid)) {
				
			}
		} else {
			$this->load->library('Guid');
			$guid = $this->guid->toString();
			$parameter = array(
				'GUID'				=>	$guid,
				'user_name'			=>	$userName,
				'user_pass'			=>	$userPass,
				'user_permission'	=>	$userPermission
			);
			if($this->admin->insert($parameter)) {
				
			}
		}
		$this->logs->write(array(
			'log_type'	=>	'CMS_ADMIN_SUBMIT'
		));
		redirect('/setting/administrators');
	}
}
?>