<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'maintenance_product';
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
		$this->load->model('maintenance/product', 'product');
	}
	
	public function index() {
		$action = $this->input->get('action', TRUE);
		
		if($action=='modify') {
			$gameUpdate = 'update';
			$id = $this->input->get('id', TRUE);
			$row = $this->product->get($id);
			$gameName = $row->game_name;
			$gameVersion = $row->game_version;
			$gamePlatform = $row->game_platform;
			$gamePicSmall = $row->game_pic_small;
			$gamePicMiddium = $row->game_pic_middium;
			$gamePicBig = $row->game_pic_big;
			$gameDownIphone = $row->game_download_iphone;
			$gameDownIpad = $row->game_download_ipad;
		}
		
		$result = $this->product->getAllResult();
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'				=>	$this->user,
			'root_path'			=>	$this->root_path,
			'result'			=>	$result,
			'game_update'		=>	$gameUpdate,
			'game_id'			=>	$id,
			'game_name'			=>	$gameName,
			'game_version'		=>	$gameVersion,
			'game_platform'		=>	$gamePlatform,
			'game_pic_small'	=>	$gamePicSmall,
			'game_pic_middium'	=>	$gamePicMiddium,
			'game_pic_big'		=>	$gamePicBig,
			'game_download_iphone'=>$gameDownIphone,
			'game_download_ipad'=>	$gameDownIpad
		);
		$this->render->render('maintenance_product', $data);
	}
	
	public function action() {
		$action = $this->input->get('action', TRUE);
		$id = $this->input->get('id', TRUE);
		switch($action) {
			case 'set':
				$this->product->set($id);
				$this->logs->write(array(
					'log_type'	=>	'CMS_WEB_SET'
				));
				break;
			case 'delete':
				$this->product->delete($id);
				$this->logs->write(array(
					'log_type'	=>	'CMS_WEB_DELETE'
				));
				break;
		}
		redirect('/maintenance/products');
	}
	
	public function submit() {
		$gameUpdate			= $this->input->post('gameUpdate', TRUE);
		$id					= $this->input->post('gameId', TRUE);
		$idNew				= $this->input->post('gameIdNew', TRUE);
		$gameName			= $this->input->post('gameName', TRUE);
		$gameVersion		= $this->input->post('gameVersion', TRUE);
		$gamePlatform		= $this->input->post('gamePlatform', TRUE);
		$gamePicSmall		= $this->input->post('gamePicSmall', TRUE);
		$gamePicMiddium		= $this->input->post('gamePicMiddium', TRUE);
		$gamePicBig			= $this->input->post('gamePicBig', TRUE);
		$gameDownloadIphone	= $this->input->post('gameDownloadIphone', TRUE);
		$gameDownloadIpad	= $this->input->post('gameDownloadIpad', TRUE);
		if($gameUpdate=='update') {
			$parameter = array(
				'game_id'				=>	$idNew,
				'game_name'				=>	$gameName,
				'game_version'			=>	$gameVersion,
				'game_platform'			=>	$gamePlatform,
				'game_pic_small'		=>	$gamePicSmall,
				'game_pic_middium'		=>	$gamePicMiddium,
				'game_pic_big'			=>	$gamePicBig,
				'game_download_iphone'	=>	$gameDownloadIphone,
				'game_download_ipad'	=>	$gameDownloadIpad,
			);
			if($this->product->update($parameter, $id)) {
				
			}
		} else {
			$this->load->library('guid');
			$this->load->helper('security');
			$guid = do_hash($this->guid->toString());
			$parameter = array(
				'game_id'				=>	$idNew,
				'game_name'				=>	$gameName,
				'game_version'			=>	$gameVersion,
				'game_platform'			=>	$gamePlatform,
				'auth_key'				=>	$guid,
				'game_pic_small'		=>	$gamePicSmall,
				'game_pic_middium'		=>	$gamePicMiddium,
				'game_pic_big'			=>	$gamePicBig,
				'game_download_iphone'	=>	$gameDownloadIphone,
				'game_download_ipad'	=>	$gameDownloadIpad,
			);
			if($this->product->insert($parameter)) {
				
			}
		}
		$this->logs->write(array(
			'log_type'	=>	'CMS_PRODUCT_SUBMIT'
		));
		redirect('/maintenance/products');
	}
	
	public function change_status() {
		$gameStatusArray = array(
			'0'		=>	'正式运营',
			'1'		=>	'内测',
			'2'		=>	'公测'
		);
		$id			= $this->input->post('gameId', TRUE);
		$gameStatus	= $this->input->post('gameStatus', TRUE);
		
		if(!empty($id) && is_numeric($gameStatus)) {
			$parameter = array(
				'game_status'	=>	$gameStatus
			);
			$this->product->update($parameter, $id);
			$parameter = array(
				'result'	=>	'API_PRODUCT_CHANGE_STATUS_SUCCESS',
				'title'		=>	'更改产品开放状态',
				'msg'		=>	'更改产品开放状态为：' . $gameStatusArray[$gameStatus]
			);
		} else {
			$parameter = array(
				'result'	=>	'API_PRODUCT_CHANGE_STATUS_FAIL',
				'title'		=>	'更改产品开放状态',
				'msg'		=>	'更改产品开放状态失败'
			);
		}
		echo json_encode($parameter);
	}
}
?>