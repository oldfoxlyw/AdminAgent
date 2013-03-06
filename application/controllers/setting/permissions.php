<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permissions extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'setting_permission';
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
		$page = $this->input->get('page', TRUE);
		/**
		 * 
		 * 分页程序
		 * @novar
		 */
		$rowTotal = $this->permission->getTotal();
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
		$result = $this->permission->getAllResult($itemPerPage, $offset);
		$this->load->helper('pagination');
		$pagination = getPage($page, $pageTotal);

		$data = array(
				'permission_name'	=>	$this->permissionName,
				'user'						=>	$this->user,
				'root_path'				=>	$this->root_path,
				'result'					=>	$result,
				'pagination'			=>	$pagination
		);
		$this->render->render($this->permissionName, $data);
	}
	
	public function action() {
		$action = $this->input->get('action', TRUE);
		$permissionId = $this->input->get('id', TRUE);
		switch($action) {
			case 'delete':
				$this->permission->delete($permissionId);
				break;
		}
		redirect('/setting/permissions');
	}
}
?>