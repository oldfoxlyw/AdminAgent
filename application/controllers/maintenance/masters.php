<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Masters extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'maintenance_master';
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
	}
	
	public function index() {
		$action = $this->input->get('action', TRUE);
		$page = $this->input->get('page', TRUE);
		/**
		 * 
		 * 分页程序
		 * @novar
		 */
		$rowTotal = $this->master->getTotal();
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
			$row = $this->master->get($id);
			$nickName = $row->master_name;
			$generationTime = $row->master_generationtime;
		}
		
		$result = $this->master->getAllResult($itemPerPage, $offset);
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'result'			=>	$result,
			'master_update'		=>	$update,
			'master_id'			=>	$id,
			'master_name'		=>	$nickName
		);
		$this->render->render('maintenance_master', $data);
	}
	
	public function action() {
		$action = $this->input->get('action', TRUE);
		$id = $this->input->get('id', TRUE);
		switch($action) {
			case 'delete':
				$this->master->delete($id);
				$this->logs->write(array(
					'log_type'	=>	'CMS_MASTER_DELETE'
				));
				break;
		}
		redirect('/maintenance/masters');
	}
	
	public function submit() {
		$update		= $this->input->post('masterUpdate', TRUE);
		$id			= $this->input->post('masterId', TRUE);
		$masterName	= $this->input->post('masterName', TRUE);
		if($update=='update') {
			$parameter = array(
				'master_name'	=>	$masterName
			);
			if($this->master->update($parameter, $id)) {
				
			}
		} else {
			$parameter = array(
				'master_name'			=>	$masterName,
				'master_generationtime'	=>	time()
			);
			if($this->master->insert($parameter)) {
				
			}
		}
		$this->logs->write(array(
			'log_type'	=>	'CMS_MASTER_SUBMIT'
		));
		redirect('/maintenance/masters');
	}
}
?>