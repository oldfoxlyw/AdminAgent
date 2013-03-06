<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {
	
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
		$this->load->model('web/news', 'news');
		$this->news->__init($this->webId);
	}
	
	public function lists() {
		$permissionName = 'web_article_list';
		$this->check->permission($this->user, $permissionName);
		if($this->check->permission($this->user, 'web_article_check', FALSE)) {
			$checkPermission = TRUE;
		}
		
		$status = $this->input->get('status', TRUE);
		if($status==='0' || $status==='1') {
			$parameter = Array(
				'news_status'		=>	$status
			);
		} else {
			$status = '2';
		}
		$page = $this->input->get('page', TRUE);
		/**
		 * 
		 * 分页程序
		 * @novar
		 */
		$rowTotal = $this->news->getTotalByWeb();
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
		$result = $this->news->getAllResult($parameter, $itemPerPage, $offset);
		
		$topResult = $this->news->getAllResult(array(
			'news_top_show'		=>	1
		));
		
		$this->load->helper('pagination');
		$pagination = getPage($page, $pageTotal);
		
		$data = array(
			'permission_name'	=>	$permissionName,
			'user'						=>	$this->user,
			'root_path'				=>	$this->root_path,
			'current_status'		=>	$status,
			'check_permission'	=>	$checkPermission,
			'top_result'				=>	$topResult,
			'result'					=>	$result,
			'pagination'			=>	$pagination
		);
		$this->render->render('content_article_list', $data);
	}
	
	public function add() {
		$permissionName = 'web_article_add';
		$this->check->permission($this->user, $permissionName);
		
		$action = $this->input->get('action', TRUE);
		if($action=='modify') {
			$newsUpdate = 'update';
			$newsId = $this->input->get('id', TRUE);
			$row = $this->news->get($newsId);
			$channelId = $row->news_channel_id;
			$channelName = $row->channel_name;
			$newsTitle = $row->news_title;
			$newsDisplayTitle = $row->news_display_title;
			$newsTags = $row->news_tags;
			$newsKeywords = $row->news_keywords;
			$newsDesc = $row->news_description;
			$newsIntro = $row->news_intro;
			$newsContent = $row->news_content;
			$newsDisplayPic = $row->news_display_pic;
		}
		
		$this->load->model('web/channel', 'channel');
		$this->channel->__init($this->webId);
		$channelResult = $this->channel->getRootResult();
		
		$this->load->model('web/tag', 'tag');
		$tagResult = $this->tag->getAllResult();
		
		$data = array(
			'permission_name'	=>	$permissionName,
			'user'						=>	$this->user,
			'root_path'				=>	$this->root_path,
			'channel_result'		=>	$channelResult,
			'tag_result'				=>	$tagResult,
			'news_update'		=>	$newsUpdate,
			'news_id'				=>	$newsId,
			'news_channel'		=>	$channelId,
			'channel_name'		=>	$channelName,
			'news_title'				=>	$newsTitle,
			'news_display_title'	=>	$newsDisplayTitle,
			'news_tags'			=>	$newsTags,
			'news_keywords'	=>	$newsKeywords,
			'news_desc'			=>	$newsDesc,
			'news_intro'			=>	$newsIntro,
			'news_content'		=>	$newsContent,
			'news_display_pic'	=>	$newsDisplayPic
		);
		$this->render->render('content_article_add', $data);
	}
	
	public function action() {
		$action = $this->input->get('action', TRUE);
		$channelId = $this->input->get('id', TRUE);
		switch($action) {
			case 'set':
				$this->news->setToTop($channelId);
				break;
			case 'unset':
				$this->news->setToTop($channelId, FALSE);
				break;
			case 'check':
				$this->check->permission($this->user, 'web_article_check');
				$this->news->check($channelId);
				break;
			case 'uncheck':
				$this->check->permission($this->user, 'web_article_check');
				$this->news->check($channelId, FALSE);
				break;
			case 'delete':
				$this->news->delete($channelId);
				break;
		}
		redirect('/content/articles/lists');
	}
	
	public function preview() {
		$id = $this->input->get('id', TRUE);
		if(!empty($id)) {
			$news = $this->news->get($id);
		}

		$permissionName = 'web_article_list';
		$data = array(
			'permission_name'	=>	$permissionName,
			'user'						=>	$this->user,
			'root_path'				=>	$this->root_path,
			'result'					=>	$news
		);
		$this->render->render('content_article_preview', $data);
	}
	
	public function submit() {
		$newsUpdate	= $this->input->post('newsUpdate', TRUE);
		$newsId		= $this->input->post('newsId', TRUE);
		$newsTitle	= $this->input->post('newsTitle', TRUE);
		$newsDisplayTitle	= $this->input->post('newsDisplayTitle', TRUE);
		$newsChannel		= $this->input->post('newsChannel', TRUE);
		$newsTags	= $this->input->post('newsTags', TRUE);
		$newsKeywords		= $this->input->post('newsKeywords', TRUE);
		$newsDesc	= $this->input->post('newsDesc', TRUE);
		$newsIntro	= $this->input->post('newsIntro', TRUE);
		$newsContent		= $this->input->post('newsContent');
		$newsDisplayPic		= $this->input->post('newsDisplayPic');
		
		if($newsUpdate=='update') {
			$parameter = array(
				'news_title'				=>	$newsTitle,
				'news_channel_id'	=>	$newsChannel,
				'news_intro'			=>	$newsIntro,
				'news_content'		=>	$newsContent,
				'news_tags'			=>	$newsTags,
				'news_keywords'	=>	$newsKeywords,
				'news_description'	=>	$newsDesc,
				'news_display_title'	=>	$newsDisplayTitle,
				'news_display_pic'	=>	$newsDisplayPic
			);
			if($this->news->update($parameter, $newsId)) {
				
			}
		} else {
			$parameter = array(
				'news_title'				=>	$newsTitle,
				'news_channel_id'	=>	$newsChannel,
				'news_intro'			=>	$newsIntro,
				'news_content'		=>	$newsContent,
				'news_posttime'		=>	time(),
				'news_tags'			=>	$newsTags,
				'news_keywords'	=>	$newsKeywords,
				'news_description'	=>	$newsDesc,
				'news_display_title'	=>	$newsDisplayTitle,
				'news_display_pic'	=>	$newsDisplayPic
			);
			if($this->news->insert($parameter)) {
				
			}
		}
		$this->load->model('web/tag', 'tag');
		$tagArray = explode(',', $newsTags);
		for($i=0; $i<count($tagArray); $i++) {
			if(!$this->tag->getTagByName(trim($tagArray[$i]))) {
				$parameter = array(
					'tag_name'	=>	trim($tagArray[$i])
				);
				$this->tag->insert($parameter);
			} else {
				continue;
			}
		}
		redirect('/content/articles/lists');
	}
}
?>