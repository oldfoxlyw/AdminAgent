<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class General_api extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $webId = null;
	private $root_path = null;
	public function __construct() {
		parent::__construct();
		$this->load->model('functions/check_user', 'check');
		$this->user = $this->check->validate();
		$this->check->ip();
		$this->webId = $this->check->checkDefaultWeb();
		$record = $this->check->configuration($this->user);
		$this->_CONFIG = $record['record'];
		/*
		if(!$record['state']) {
			$redirectUrl = urlencode($this->config->item('root_path') . 'login');
			redirect("/message?info=SCC_CLOSED&redirect={$redirectUrl}");
		}
		*/
		$this->root_path = $this->config->item('root_path');
	}
	
	public function getChildByChannel() {
		//$this->check->permission($this->user, 'func_get_category');
		
		$cid = $this->input->post('id', TRUE);
		$clickObjId = $this->input->post('clickObjId', TRUE);
		$this->load->model('web/channel', 'channel');
		$this->channel->__init($this->webId);
		$result = $this->channel->getChildResult($cid);
		$retData = array(
			'father'	=>	$cid,
			'prev'		=>	$clickObjId,
			'field'		=>	array()
		);
		foreach($result as $i=>$row) {
			$retData['field'][$i] = array(
				'id'	=>	$row->channel_id,
				'name'	=>	$row->channel_name,
				'url'	=>	!empty($row->channel_url) ? $row->channel_url : ''
			);
		}
		$retData = json_encode($retData);
		echo $retData;
	}
	
	public function doPicUpload() {
		$this->check->permission($this->user, 'func_upload');
		$uploadDir = $this->config->item('upload_dir');
		$uploadStorePath = $uploadDir;
		$error = "";
		$msg = "";
		$fileElementName = 'fileUpload';
		$el = $this->input->get('el', TRUE);
		if($el) {
			$fileElementName = $el;
		}
		//$error = $uploadStorePath;
		
		$config['upload_path'] = $uploadStorePath;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name'] = TRUE;
		
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($fileElementName)) {
			$this->upload->display_errors('<stronng>', '</stronng>');
			$error = $this->upload->display_errors();
		} else {
			$data = $this->upload->data();
			$msg = '上传成功！';
			$error = 'null';
			$fileName = $this->root_path . $uploadDir . '/' . $data['file_name'];
		}
		
		$ret = '{';
		$ret .= "	error:\"{$error}\",";
		$ret .= "	msg:\"{$msg}\",";
		$ret .= "	data:\"{$fileName}\",";
		$ret .= "	width:{$data['image_width']},";
		$ret .= "	height:{$data['image_height']}";
		$ret .= '}';
		echo $ret;
	}
	
	public function getMailTemplate() {
		$this->check->permission($this->user, 'func_get_mailtemplate');
		$templateId = $this->input->post('tid', TRUE);
		$this->load->model('web/mail_template', 'mail_template');
		$row = $this->mail_template->get($templateId);
		echo html_entity_decode($row->template_content, ENT_QUOTES);
	}
}
?>