<?php
$config['permission'] = array (
	'content_index', 'web_webs', 'web_channel', 'web_article_list', 'web_article_add', 'func_upload',
	'web_slide', 'web_media_list', 'web_media_video_add', 'web_media_pic_add',

	'maintenance_product', 'maintenance_master', 'maintenance_server',
	
	'master_grant',
	
	'setting_admin', 'setting_permission', 'setting_permission_add',
	
	'report_account_buy', 'report_active_account', 'report_item_statistics', 'report_login_detail',
	'report_login_statistics', 'report_overview', 'report_recharge_account', 'report_recharge_daily_statistics',
	'report_recharge_log', 'report_register_by_day', 'report_register_by_time', 'report_register_detail',
	'report_register_statistics', 'report_relogin_statistics'
);

$config['permission_detail'] = array (
	'content_index'				=>	'content/index',
	'web_webs'				=>	'content/webs',
	'web_channel'			=>	'content/channels',
	'web_article_list'		=>	'content/articles/lists',
	'web_article_add'		=>	'content/articles/add',
	'web_slide'				=>	'content/slides',
	'web_media_list'		=>	'content/media/lists',
	'web_media_video_add'	=>	'content/media/add_video',
	'web_media_pic_add'		=>	'content/media/add_pic',
	'setting_admin'				=>	'setting/administrators',
	'setting_permission'		=>	'setting/permissions',
	'setting_permission_add'	=>	'setting/permissions_add',
	
	'maintenance_product'	=>	'maintenance/products',
	'maintenance_master'	=>	'maintenance/masters',
	'maintenance_server'	=>	'maintenance/servers',
	
	'master_grant'			=>	'master/grant',
	
	'report_account_buy'			=>	'report/account_buy',
	'report_active_account'			=>	'report/active_account',
	'report_item_statistics'			=>	'report/item_statistics',
	'report_login_detail'			=>	'report/login_detail',
	'report_login_statistics'			=>	'report/login_statistics',
	'report_overview'				=>	'report/overview',
	'report_recharge_account'			=>	'report/recharge_account',
	'report_recharge_daily_statistics'			=>	'report/recharge_daily_statistics',
	'report_recharge_log'			=>	'report/recharge_log',
	'report_register_by_day'			=>	'report/register_by_day',
	'report_register_by_time'			=>	'report/register_by_time',
	'report_register_detail'			=>	'report/register_detail',
	'report_register_statistics'			=>	'report/register_statistics',
	'report_relogin_statistics'			=>	'report/relogin_statistics',
);
?>