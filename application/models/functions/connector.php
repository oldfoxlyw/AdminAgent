<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Connector extends CI_Model {
	private $userAgentPath = null;
	private $enableSSL = false;
	private $postPath = null;
	private $originPath = null;
	
	public function __construct() {
		parent::__construct();
		$this->userAgentPath = $this->config->item('user_agent_path');
		$lastChar = substr($this->userAgentPath, -1, 1);
		if($lastChar!='/' && $lastChar!="\\") {
			$this->userAgentPath .= '/';
		}
		$this->enableSSL = $this->config->item('enable_ssl');
		$this->originPath = $this->enableSSL ? 'https://' : 'http://';
		$this->originPath .= $this->userAgentPath;
	}
	
	public function post($controller, $parameter) {
		if(!empty($controller)) {
			$this->postPath = $this->originPath . $controller;
			
			$parameter['code'] = $this->hash($parameter);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->postPath);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);
			$ip = $this->input->ip_address();
			$header = array(
				'CLIENT-IP:' . $ip,
				'X-FORWARDED-FOR:' . $ip,
			);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			
			if($this->enableSSL) {
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			}
			
			$monfd = curl_exec($ch);
			
			curl_close($ch);
			
			return $monfd;
		} else {
			return false;
		}
	}
	
	public function hash($parameter) {
		if(!empty($parameter)) {
			$authKey = $this->config->item('auth_key');
			$this->load->helper('security');
			$code = do_hash(implode('|||', $parameter) . '|||' . $authKey);
			return $code;
		} else {
			return NULL;
		}
	}
}
?>