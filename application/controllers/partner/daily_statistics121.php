<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Daily_statistics121 extends CI_Controller {
	private $user = null;
	private $_CONFIG = null;
	private $permissionName = 'partner_daily_statistics';
	private $root_path = null;
	
	public function __construct() {
		parent::__construct();
		$this->root_path = $this->config->item('root_path');
	}
	
	public function index() {
		$cachedb = $this->load->database('logcachedb', TRUE);
		$cachedb->where('server_name', 'f1');
		$cachedb->where('partner_key', 'ptbus');
		$result = $cachedb->get('log_daily_statistics1');
		$result = $result->result();
		
		$lastOrder = 10560;
		for($i=1; $i<count($result); $i++)
		{
			$orders = $result[$i]->orders_sum - $lastOrder;
			$lastOrder = $result[$i]->orders_sum;
			
			$cachedb->set('orders_sum', $orders);
			$cachedb->where('id', $result[$i]->id);
			$cachedb->update('log_daily_statistics1');
		}
	}
}
?>