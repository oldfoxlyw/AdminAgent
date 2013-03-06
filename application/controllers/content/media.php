<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_Controller {
	
	private $user = null;
	private $_CONFIG = null;
	private $webId = 0;
	private $root_path = null;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('functions/check_user', 'check');
		$this->user = $this->check->validate();
		$this->check->ip();
		$this->webId = $this->check->checkDefaultWeb();
		$record = $this->check->configuration($this->user);
		$this->_CONFIG = $record['record'];
		if(!$record['state']) {
			$redirectUrl = urlencode($this->config->item('root_path') . 'login');
			redirect("/message?info=CMS_CLOSED&redirect={$redirectUrl}");
		}
		
		$this->root_path = $this->config->item('root_path');
		$this->load->model('web/mmedia', 'mmedia');
		$this->mmedia->__init($this->webId);
	}
	
	public function lists() {
		$permissionName = 'web_media_list';
		$this->check->permission($this->user, $permissionName);
		
		$page = $this->input->get('page', TRUE);
		/**
		 * 
		 * 分页程序
		 * @novar
		 */
		$rowTotal = $this->mmedia->getTotalByWeb();
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
		$result = $this->mmedia->getAllResult($itemPerPage, $offset);
		
		$this->load->helper('pagination');
		$pagination = getPage($page, $pageTotal);
		
		$data = array(
			'permission_name'	=>	$permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'result'			=>	$result,
			'pagination'		=>	$pagination
		);
		$this->render->render('content_media_list', $data);
	}
	
	public function add_video() {
		$permissionName = 'web_media_video_add';
		$this->check->permission($this->user, $permissionName);
		
		$action = $this->input->get('action', TRUE);
		if($action=='modify') {
			$mediaUpdate = 'update';
			$mediaId = $this->input->get('id', TRUE);
			$row = $this->mmedia->get($mediaId);
			$mediaTitle = $row->media_title;
			$mediaComment = $row->media_comment;
			$mediaType = $row->media_type;
			$mediaUrl = $row->media_url;
		}
		
		$data = array(
			'permission_name'	=>	$permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'media_update'		=>	$mediaUpdate,
			'media_id'			=>	$mediaId,
			'media_title'		=>	$mediaTitle,
			'media_comment'		=>	$mediaComment,
			'media_type'		=>	$mediaType,
			'media_url'			=>	$mediaUrl
		);
		$this->render->render('content_media_video_add', $data);
	}
	
	public function add_pic() {
		$permissionName = 'web_media_pic_add';
		$this->check->permission($this->user, $permissionName);
		
		$action = $this->input->get('action', TRUE);
		if($action=='modify') {
			$mediaUpdate = 'update';
			$mediaId = $this->input->get('id', TRUE);
			$row = $this->mmedia->get($mediaId);
			$mediaTitle = $row->media_title;
			$mediaComment = $row->media_comment;
			$mediaType = $row->media_type;
			$mediaPicSmall = $row->media_pic_small;
			$mediaUrl = $row->media_url;
		}
		
		$data = array(
			'permission_name'	=>	$permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'media_update'		=>	$mediaUpdate,
			'media_id'			=>	$mediaId,
			'media_title'		=>	$mediaTitle,
			'media_comment'		=>	$mediaComment,
			'media_type'		=>	$mediaType,
			'media_pic_small'		=>	$mediaPicSmall,
			'media_url'			=>	$mediaUrl
		);
		$this->render->render('content_media_pic_add', $data);
	}
	
	public function action() {
		$action = $this->input->get('action', TRUE);
		$id = $this->input->get('id', TRUE);
		switch($action) {
			case 'delete':
				$this->mmedia->delete($id);
				break;
		}
		redirect('/content/media/lists');
	}
	
	public function submit() {
		$mediaUpdate	= $this->input->post('mediaUpdate', TRUE);
		$mediaId		= $this->input->post('mediaId', TRUE);
		$mediaTitle		= $this->input->post('mediaTitle', TRUE);
		$mediaComment	= $this->input->post('mediaComment');
		$mediaPicSmall	= $this->input->post('mediaPicSmallContainer', TRUE);
		$mediaUrl		= $this->input->post('mediaUrlContainer');
		$mediaType		= $this->input->post('mediaType', TRUE);
		
		if($mediaUpdate=='update') {
			$parameter = array(
				'media_title'		=>	$mediaTitle,
				'media_comment'		=>	$mediaComment,
				'media_pic_small'	=>	$mediaPicSmall,
				'media_url'	=>	$mediaUrl,
			);
			if($this->mmedia->update($parameter, $mediaId)) {
				
			}
		} else {
			$parameter = array(
				'media_title'		=>	$mediaTitle,
				'media_comment'		=>	$mediaComment,
				'media_type'		=>	$mediaType,
				'media_pic_small'	=>	$mediaPicSmall,
				'media_url'			=>	$mediaUrl,
				'media_posttime'	=>	time(),
				'media_web_id'		=>	$this->webId
			);
			if($this->mmedia->insert($parameter)) {
				
			}
		}
		redirect('/content/media/lists');
	}
}
?>