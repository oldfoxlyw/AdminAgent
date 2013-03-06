<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permissions_add extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'setting_permission_add';
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
		$this->load->model('setting/permission', 'permission');
	}
	
	public function index() {
		$action = $this->input->get('action', TRUE);
		$type = $this->input->get('type', TRUE);
		$permissionId = $this->input->get('id', TRUE);
		$guid = $this->input->get('guid', TRUE);
		if($action=='modify') {
			$permissionUpdate = 'update';
			if($type=='user') {
				$readOnly = 'readonly="readonly"';
				$this->load->model('web/admin_user', 'admin_user');
				$row = $this->admin_user->getPermission($guid);
				$permissionName = $row->permission_name;
				$permissionId = $row->permission_id;
				if(empty($row->additional_permission)) {
					$permissionList = $row->permission_list;
				} else {
					$permissionList = $row->additional_permission;
				}
			} else {
				$row = $this->permission->get($permissionId);
				$permissionName = $row->permission_name;
				$permissionList = $row->permission_list;
			}
			$permission = $this->config->item('permission');
			$permissionArray = array();
			if($permissionId=='999') {
				foreach($permission as $value) {
					$permissionArray[$value] = true;
				}
			} else {
				foreach($permission as $value) {
					$permissionArray[$value] = false;
				}
				$permissionListArray = explode(',', $permissionList);
				foreach($permissionListArray as $value) {
					$permissionArray[$value] = true;
				}
			}
		}

		$data = array(
				'permission_id'		=>	$permissionId,
				'permission_name'	=>	$permissionName,
				'read_only'				=>	$readOnly,
				'permission_type'	=>	$type,
				'permission_update'	=>$permissionUpdate,
				'guid'					=>	$guid,
				'user'						=>	$this->user,
				'root_path'				=>	$this->root_path,
		);
		foreach($permissionArray as $key=>$value) {
			if($value) {
				$data[$key] = "checked=\"checked\"";
			}
		}
		$this->render->render($this->permissionName, $data);
	}
	
	public function submit() {
		$postData = $this->input->post();
		$permission = $this->config->item('permission');
		foreach ($postData as $key=>$value) {
			if(in_array($value, $permission)) {
				$permissionList[] = $value;
			}
		}
		$permissionList = implode(',', $permissionList);
		$permissionId = $this->input->post('permissionId', TRUE);
		$permissionIdHidden = $this->input->post('permissionIdHidden', TRUE);
		$permissionName = $this->input->post('permissionName', TRUE);
		$permissionUpdate = $this->input->post('permissionUpdate', TRUE);
		$permissionType = $this->input->post('permissionType', TRUE);
		if($permissionType=='user') {
			$guid = $this->input->post('GUID', TRUE);
			$param = array(
				'additional_permission'	=>	$permissionList
			);
			$this->load->model('web/admin_user', 'admin_user');
			$this->admin_user->update($param, $guid);
		} else {
			if($permissionUpdate=='update') {
				$param = array(
					'permission_id'		=>	$permissionId,
					'permission_name'	=>	$permissionName,
					'permission_list'	=>	$permissionList
				);
				$this->permission->update($param, $permissionIdHidden);
			} else {
				$param = array(
					'permission_id'		=>	$permissionId,
					'permission_name'	=>	$permissionName,
					'permission_list'	=>	$permissionList
				);
				$this->permission->insert($param);
			}
		}
		if($permissionType=='user') {
			redirect('setting/administrators');
		} else {
			redirect('setting/permissions');
		}
	}
}
?>