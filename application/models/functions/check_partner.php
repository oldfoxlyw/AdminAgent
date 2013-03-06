<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Check_partner extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function validate() {
		$this->load->helper('security');
		$this->load->helper('cookie');
		$redirectUrl = urlencode($this->config->item('root_path') . 'partner/login');
		if(!$this->input->cookie('adminagent_partner', TRUE)) {
			redirect("/message?info=CMS_PARTNER_EXPIRED&redirect={$redirectUrl}&auto_redirect=1&auto_delay=5");
		} else {
			$cookie = $this->input->cookie('adminagent_partner', TRUE);
			$json = json_decode($cookie);
			$userName = $this->db->escape($json->user_name);
			$sql = "select * from scc_partner where user_name={$userName}";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				$row = $query->row();
				$checkCode = $json->user_name . '#' . $row->user_pass;
				$checkCode = strtoupper(do_hash($checkCode, 'md5'));
				if($checkCode != $json->check_code) {
					redirect("/message?info=CMS_PARTNER_CHECKCODE_INVALID&redirect={$redirectUrl}");
				} else {
					$this->load->model('web/partner_user', 'admin_user');
					if(!$this->admin_user->freezed(array('user_name'=>$row->user_name))) {
						 redirect("/message?info=CMS_PARTNER_FREEZED&redirect={$redirectUrl}");
					} else {
						return $row;
					}
				}
			} else {
				redirect("/message?info=SCC_PARTNER_INVALID&redirect={$redirectUrl}");
			}
		}
	}
	
	public function permission($user, $permissionName, $autoRedirect = true) {
		if(!empty($user->additional_permission)) {
			$permission = explode(',', $user->additional_permission);
		}
		if(in_array($permissionName, $permission)) {
			return true;
		} else {
			if($autoRedirect) {
				$redirectUrl = urlencode($this->config->item('root_path') . 'partner/login');
				redirect("/message?info=CMS_NO_PERMISSION&redirect={$redirectUrl}&auto_redirect=1&auto_delay=10");
			} else {
				return false;
			}
		}
	}
	
	public function configuration($user) {
		$temp = array();
		$sql = "select * from scc_config where config_selected=1";
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$rowConfig = $query->row();
			if($rowConfig->config_close_scc=='1') {
				$temp['state'] = false;
			} else {
				$temp['state'] = true;
			}
			$temp['record'] = $rowConfig;
		} else {
			$temp['state'] = false;
			$temp['record'] = array();
		}
		return $temp;
	}
}
?>