<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class General_api extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $root_path = null;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('functions/check_user', 'check');
		$this->user = $this->check->validate();
		$this->check->ip();
		$record = $this->check->configuration($this->user);
		$this->_CONFIG = $record['record'];
		if(!$record['state']) {
			$redirectUrl = urlencode($this->config->item('root_path') . 'login');
			redirect("/message?info=CMS_CLOSED&redirect={$redirectUrl}");
		}
		$this->root_path = $this->config->item('root_path');
	}
	
	public function getSectionByGame()
	{
		$gameId = $this->input->get_post('game_id', TRUE);
		if(!empty($gameId)) {
			$this->load->model('section');
			$parameter = array(
					'game_id'		=>	$gameId
			);
			$sectionResult = $this->section->getAllResult($parameter);
			echo json_encode($sectionResult);
		}
	}
	
	public function getServerByGameSection()
	{
		$gameId = $this->input->get_post('game_id', TRUE);
		$sectionId = $this->input->get_post('section_id', TRUE);
		if(!empty($gameId) && !empty($sectionId)) {
			$this->load->model('maintenance/server');
			$parameter = array(
					'game_id'		=>	$gameId,
					'account_server_section'	=>	$sectionId
			);
			$result = $this->server->getAllResult($parameter);
			echo json_encode($result);
		}
	}
}
?>