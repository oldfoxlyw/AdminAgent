<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class logs extends CI_Model {
	private $webName = 'log_scc';
	private $logdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->logdb = $this->load->database('adminlog', true);
	}
	
	public function write($parameter) {
		if(!empty($parameter) && !empty($parameter['log_type'])) {
			$relativePage			=	$this->input->server('PHP_SELF');
			$relativeMethod			=	$this->input->server('REQUEST_METHOD');
			$relativeParameter = json_encode($_REQUEST);
			$currentTime		=	date("Y-m-d H:i:s", time());
			
			$logType = explode('_', $parameter['log_type']);
			switch($logType[0]) {
				case 'CMS':
					$currentUser = $parameter['user_name'];
					$row = array(
						'log_type'				=>	$parameter['log_type'],
						'log_user'				=>	$currentUser,
						'log_relative_page_url'	=>	$relativePage,
						'log_relative_parameter'=>	$relativeParameter,
						'log_relative_method'	=>	$relativeMethod,
						'log_time'				=>	$currentTime
					);
					$this->logdb->insert($this->webName, $row);
					break;
			}
		}
	}
}
?>