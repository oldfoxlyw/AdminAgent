<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Render extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function render($pageName = null, $data = null, $isPartner = false) {
		$header = $this->load->view('std_header', $data, true);
		if($isPartner) {
			$top = $this->load->view('partner_top', $data, true);
		} else {
			$top = $this->load->view('std_top', $data, true);
		}
		$content = $this->load->view("{$pageName}_view", $data, true);
		if($isPartner) {
			$left = $this->load->view('partner_left', $data, true);
		} else {
			$left = $this->load->view('std_left', $data, true);
		}
		$footer = $this->load->view('std_footer', $data, true);
		
		$value = array(
			'std_header'	=>	$header,
			'std_top'		=>	$top,
			'content'		=>	$content,
			'std_left'		=>	$left,
			'std_footer'	=>	$footer
		);
		$this->load->view('std_frame', $value);
	}
}
?>