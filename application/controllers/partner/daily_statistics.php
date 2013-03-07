<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Daily_statistics extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'partner_daily_statistics';
	private $root_path = null;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('functions/check_partner', 'check');
		$this->user = $this->check->validate();
		$this->check->permission($this->user, $this->permissionName);
		$record = $this->check->configuration($this->user);
		$this->_CONFIG = $record['record'];
		if(!$record['state']) {
			$redirectUrl = urlencode($this->config->item('root_path') . 'partner/login');
			redirect("/message?info=CMS_CLOSED&redirect={$redirectUrl}");
		}
		$this->load->model('report/daily_report');
		$this->root_path = $this->config->item('root_path');
	}
	
	public function index() {
		$page = $this->input->get_post('page', TRUE);
		$dateStart = $this->input->post('log_time_start', TRUE);
		$dateEnd = $this->input->post('log_time_end', TRUE);
		$submitFlag = $this->input->post('hiddenSubmitFlag', TRUE);
		
		if(!empty($submitFlag)) {
			if(!empty($dateStart)) {
				$parameter['log_date_start'] = $dateStart;
			}
			if(!empty($dateEnd)) {
				$parameter['log_date_end'] = $dateEnd;
			}
			$parameter['partner_key'] = $this->user->partner_key;
			/**
			 * 
			 * 分页程序
			 * @novar
			 */
			$rowTotal = $this->daily_report->getTotal($parameter);
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
			
			$result = $this->daily_report->getAllResult($parameter, $itemPerPage, $offset);
			$parameter['sum'] = 'orders_sum';
			$ordersSum = $this->daily_report->getAllResult($parameter);
			$this->load->helper('pagination');
			$pagination = getPage($page, $pageTotal, getQueryString($parameter));
		}
		
		$data = array(
			'permission_name'	=>	$this->permissionName,
			'user'						=>	$this->user,
			'root_path'				=>	$this->root_path,
			'log_time_start'		=>	$dateStart,
			'log_time_end'		=>	$dateEnd,
			'submit_flag'			=>	$submitFlag,
			'orders_sum'			=>	$ordersSum,
			'result'					=>	$result,
			'pagination'			=>	$pagination
		);
		$this->render->render('partner_daily_report', $data, true);
	}
}
?>