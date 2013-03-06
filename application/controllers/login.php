<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	private $root_path = null;
	
	public function __construct() {
		parent::__construct();
		$this->root_path = $this->config->item('root_path');
	}
	
	public function index() {
		$data = array(
			'root_path'		=>	$this->root_path
		);
		$this->load->view('login_view', $data);
	}
	
	public function validate() {
		$userName = $this->input->post('userName', TRUE);
		$userPass = $this->input->post('userPass', TRUE);
		$isRemember = $this->input->post('isRemember', TRUE);
		$isFromAjax = $this->input->post('isFromAjax', TRUE);
		
		$this->load->model('web/admin_user', 'user');
		
		if(!$this->user->validate($userName, $userPass)) {
			$this->logs->write(array(
				'log_type'	=>	'CMS_USER_INVALID'
			));
			$redirectUrl = urlencode($this->root_path . 'login');
			redirect("/message?info=CMS_USER_INVALID&redirect={$redirectUrl}");
		} elseif(!$this->user->freezed(array('user_name'=>$userName))) {
			$this->logs->write(array(
				'log_type'	=>	'CMS_USER_FREEZED'
			));
			$redirectUrl = urlencode($this->root_path . 'login');
			redirect("/message?info=CMS_USER_FREEZED&redirect={$redirectUrl}");
		} else {
			$checkCode = $userName . '#' . strtoupper(do_hash(do_hash($userPass, 'md5')));
			$checkCode = strtoupper(do_hash($checkCode, 'md5'));
			$cookie = array(
				'user_name'		=>		$userName,
				'check_code'	=>		$checkCode
			);
			$cookieStr = json_encode($cookie);
			
            $this->load->helper('cookie');
            $cookie = array(
				'name'		=> 'user',
				'value'		=> $cookieStr,
				'expire'	=> 0,
				'domain'	=> $this->config->item('cookie_domain'),
				'path'		=> $this->config->item('cookie_path'),
				'prefix'	=> $this->config->item('cookie_prefix')
            );
            if($isRemember=='1') {
            	$cookie['expire'] = $this->config->item('cookie_expire');
            }
            $this->input->set_cookie($cookie);
			$this->logs->write(array(
				'log_type'	=>	'CMS_USER_LOGIN'
			));
			if($isFromAjax == '1') {
				echo 'CMS_USER_LOGIN';
			} else {
            	redirect('/index');
			}
		}
	}
	
	public function out() {
		$this->load->helper('cookie');
		$cookie = array(
			'name'		=> 'user',
			'domain'	=> $this->config->item('cookie_domain'),
			'path'		=> $this->config->item('cookie_path'),
			'prefix'	=> $this->config->item('cookie_prefix')
		);
		delete_cookie($cookie);
		redirect('/login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */