<div id="sidebar">
	
    <h2>正在操作的网站</h2>
    <?php
    if(!$this->input->cookie('adminagent_default_web', TRUE)) {
		$defaultWeb = '还没有选择操作的网站';
		$defaultWebUrl = '';
	} else {
		$defaultWeb = $this->input->cookie('adminagent_default_web_name', TRUE);
		$defaultWebUrl = $this->input->cookie('adminagent_default_web_url', TRUE);
	}
	?>
    <p><b><?php echo $defaultWeb; ?>[<a href="<?php echo $root_path; ?>content/webs">更改</a>]</b></p>
    <p><?php echo $defaultWebUrl; ?><b>[<a href="<?php echo $defaultWebUrl; ?>" target="_blank">立即前往</a>]</b></p>
    
    <!-- Lists -->
    <h2>用户平台管理系统</h2>
    <ul id="left_navigation">
        <li><a href="<?php echo $root_path; ?>index">管理首页</a></li>
        <li><a href="javascript:void(0)">平台设置</a>
        	<ul<?php if(in_array($permission_name, array('setting_partner', 'setting_admin', 'setting_permission'))): ?> class="current"<?php endif; ?>>
            	<li><a href="<?php echo $root_path; ?>setting/administrators">管理员设置</a></li>
            	<li class="last"><a href="<?php echo $root_path; ?>setting/permissions">权限设置</a></li>
            </ul>
        </li>
        <!--
        <li><a href="javascript:void(0)">网站内容管理</a>
        	<ul<?php if(in_array($permission_name, array('web_webs', 'web_channel', 'web_article_list', 'web_article_add', 'web_media_list', 'web_media_video_add', 'web_media_pic_add', 'web_slide'))): ?> class="current"<?php endif; ?>>
                <li><a href="<?php echo $root_path; ?>content/webs">网站列表</a></li>
                <li><a href="<?php echo $root_path; ?>content/channels">频道管理</a></li>
                <li><a href="<?php echo $root_path; ?>content/articles/lists">文章管理</a></li>
                <li><a href="<?php echo $root_path; ?>content/articles/add">添加文章</a></li>
                <li><a href="<?php echo $root_path; ?>content/media/lists">视频/图片管理</a></li>
                <li class="last"><a href="javascript:void(0)">上传视频/图片</a>
                	<ul<?php if(in_array($permission_name, array('web_media_video_add', 'web_media_pic_add', 'web_slide'))): ?> class="current"<?php endif; ?>>
                    	<li><a href="<?php echo $root_path; ?>content/media/add_video">上传视频</a></li>
                    	<li><a href="<?php echo $root_path; ?>content/media/add_pic">上传图片</a></li>
						<li class="last"><a href="<?php echo $root_path; ?>content/slides">幻灯管理</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        -->
        <li><a href="javascript:void(0)">市场数据分析</a>
        	<ul<?php if(in_array($permission_name, array('report_overview', 'report_recharge_log', 'report_recharge_daily_statistics', 'report_recharge_account', 'report_account_buy', 'report_item_statistics',
			'report_register_statistics', 'report_register_by_time', 'report_register_by_day', 'report_register_detail', 'report_login_detail', 'report_login_statistics', 'report_relogin_statistics', 
			'report_active_account', 'report_remain_account', 'report_lost_account', 'report_daily_statistics'))): ?> class="current"<?php endif; ?>>
                <li class="last"><a href="<?php echo $root_path; ?>report/daily_statistics">运营概况总览</a></li>
            </ul>
        </li>
        <li><a href="javascript:void(0)">GM管理</a>
        	<ul<?php if(in_array($permission_name, array('master_grant', 'master_ban'))): ?> class="current"<?php endif; ?>>
            	<li><a href="<?php echo $root_path; ?>master/grant">道具发放</a></li>
            	<li class="last"><a href="<?php echo $root_path; ?>master/ban">封停帐号</a></li>
            </ul>
        </li>
    </ul>
    <!-- End of Lists -->
    
    <!--
    <h2>统计信息</h2>
    <p><b>拥有文章总数：</b> 2201</p>
    <p><b>Comments:</b> 17092</p>
    <p><b>Users:</b> 3788</p>
    -->

</div>
