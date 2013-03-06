<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slides extends CI_Controller {
	
	private $user = null;
	private $_CONFIG = null;
	private $webId = 0;
	private $permissionName = 'web_slide';
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
		$this->load->model('web/slide', 'slide');
		$this->slide->__init($this->webId);
	}
	
	public function index() {
		$action = $this->input->get('action', TRUE);
		if($action=='modify') {
			$update = 'update';
			$id = $this->input->get('id', TRUE);
			$row = $this->slide->get($id);
			$slidePicPath = $row->slide_pic_path;
			$slidePicWidth = $row->slide_pic_width;
			$slidePicHeight = $row->slide_pic_height;
			$slideLink = $row->slide_link;
		}
		
		$page = $this->input->get('page', TRUE);
		/**
		 * 
		 * 分页程序
		 * @novar
		 */
		$rowTotal = $this->slide->getTotalByWeb();
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
		$result = $this->slide->getAllResult($itemPerPage, $offset);
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'						=>	$this->user,
			'root_path'				=>	$this->root_path,
			'result'					=>	$result,
			'slide_update'			=>	$update,
			'slide_id'				=>	$id,
			'slide_pic_path'		=>	$slidePicPath,
			'slide_pic_width'		=>	$slidePicWidth,
			'slide_pic_height'	=>	$slidePicHeight,
			'slide_link'				=>	$slideLink
		);
		$this->render->render('content_slide', $data);
	}
	
	public function action() {
		$action = $this->input->get('action', TRUE);
		$id = $this->input->get('id', TRUE);
		switch($action) {
			case 'delete':
				$this->slide->delete($id);
				break;
		}
		redirect('/content/slides');
	}
	
	public function submit() {
		$slideUpdate	= $this->input->post('slideUpdate', TRUE);
		$slideId		= $this->input->post('slideId', TRUE);
		$slidePicPath	= $this->input->post('slidePicPath', TRUE);
		$slidePicWidth	= $this->input->post('slidePicWidth', TRUE);
		$slidePicHeight	= $this->input->post('slidePicHeight', TRUE);
		$slideLink= $this->input->post('slideLink', TRUE);
		if($slideUpdate=='update') {
			$parameter = array(
				'slide_pic_path'		=>	$slidePicPath,
				'slide_pic_width'		=>	$slidePicWidth,
				'slide_pic_height'	=>	$slidePicHeight,
				'slide_link'				=>	$slideLink
			);
			if($this->slide->update($parameter, $slideId)) {
				
			}
		} else {
			$parameter = array(
				'slide_pic_path'		=>	$slidePicPath,
				'slide_pic_width'		=>	$slidePicWidth,
				'slide_pic_height'	=>	$slidePicHeight,
				'slide_link'				=>	$slideLink,
				'slide_web_id'			=>	$this->webId
			);
			if($this->slide->insert($parameter)) {
				
			}
		}
		redirect('/content/slides');
	}
}
?>