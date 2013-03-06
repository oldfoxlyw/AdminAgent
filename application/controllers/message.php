<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
	private $root_path = null;
	
	public function __construct() {
		parent::__construct();
		$this->root_path = $this->config->item('root_path');
	}
	
	public function index() {
		$info			= $this->input->get('info', TRUE);
		$redirect		= urldecode($this->input->get('redirect', TRUE));
		$autoRedirect	= $this->input->get('auto_redirect', TRUE);
		$autoDelay		= $this->input->get('auto_delay', TRUE);
		if($autoRedirect=='1') {
			$metaData = "<meta http-equiv=\"refresh\" content=\"{$autoDelay}; url=$redirect\" />";
			$returnContent = "系统将在{$autoDelay}秒内自动跳转，或者您也可以点<a href=\"$redirect\">这里</a>\n";
		} else {
			$metaData = '';
			$returnContent = "<a href=\"$redirect\">点击这里返回</a>\n";
		}
		switch($info) {
			case 'CMS_CLOSED':
				$sql = "select `config_close_reason` from `scc_config` where `config_selected`=1";
				$query = $this->db->query($sql);
				$row = $query->row();
				$messageContent = $row->config_close_reason;
				break;
			case 'CMS_NO_PERMISSION':
				$messageContent = "您没有被授权此项功能";
				break;
			case 'CMS_USER_INVALID':
				$messageContent = "用户登录信息错误，请重新登录";
				break;
			case 'CMS_USER_CHECKCODE_INVALID':
				$messageContent = "用户登录信息异常，请检查网络环境的安全状况";
				break;
			case 'CMS_USER_EXPIRED':
				$messageContent = "由于您长时间没有操作，为了您帐号的安全考虑，请重新登录";
				break;
			case 'CMS_DEFAULT_WEB_INVALID':
				$messageContent = "请首先选择要操作的网站";
				break;
		}
		$data = array(
			'root_path'	=>		$this->root_path,
			'meta_data'	=>		$metaData,
			'message'	=>		$messageContent,
			'returned'	=>		$returnContent
		);
		$this->load->view('message_view', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */