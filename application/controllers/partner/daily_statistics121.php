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
		
		$lastReg = 0;
		$lastOrder = 0;
		foreach($result as $value)
		{
			if($value->reg_account != $lastReg)
			{
				$rand = round($this->randomFloat(1, 3), 2);
				$ordersSum = $value->reg_account * ($rand * 100);
				$cachedb->set('orders_sum', $ordersSum);
				$lastReg = $value->reg_account;
				$lastOrder = $ordersSum;
			}
			else
			{
				$cachedb->set('orders_sum', $lastOrder);
			}
			$cachedb->update('log_daily_statistics1');
		}
	}
	
	private function randomFloat($min = 0, $max = 1) {  
    	return $min + mt_rand() / mt_getrandmax() * ($max - $min);  
	}
}
?>