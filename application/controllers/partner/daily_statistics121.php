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
		$result = $cachedb->get('log_daily_statistics');
		
		foreach($result as $value)
		{
			$rand = round($this->randomFloat(1, 3), 2);
			$cachedb->set('orders_sum', 'reg_account * ' . $rand, FALSE);
			echo $rand . ', ';
		}
	}
	
	private function randomFloat($min = 0, $max = 1) {  
    	return $min + mt_rand() / mt_getrandmax() * ($max - $min);  
	}
}
?>