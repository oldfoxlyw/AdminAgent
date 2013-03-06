<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	private $root_path = null;
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'content_index';
	
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
	}
	
	public function index() {
		$data = array(
			'root_path'		=>	$this->root_path,
			'user'			=>	$this->user
		);
		$this->render->render('index', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */