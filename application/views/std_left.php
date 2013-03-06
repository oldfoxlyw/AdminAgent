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
            	<li><a href="<?php echo $root_path; ?>setting/partners">渠道商管理</a></li>
            	<li><a href="<?php echo $root_path; ?>setting/administrators">管理员设置</a></li>
            	<li class="last"><a href="<?php echo $root_path; ?>setting/permissions">权限设置</a></li>
            </ul>
        </li>
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
        <!--
        <li><a href="javascript:void(0)">运维数据管理</a>
            <ul<?php if(in_array($permission_name, array('maintenance_product', 'maintenance_master', 'maintenance_chat'))): ?> class="current"<?php endif; ?>>
                <li><a href="<?php echo $root_path; ?>maintenance/products">游戏管理</a></li>
                <li><a href="<?php echo $root_path; ?>maintenance/servers">游戏区服信息</a></li>
                <li><a href="<?php echo $root_path; ?>maintenance/activation">内测游戏激活码</a></li>
                <li><a href="<?php echo $root_path; ?>maintenance/cdkeys">物品兑换码</a></li>
                <li><a href="<?php echo $root_path; ?>maintenance/funds">战网点数管理</a></li>
                <li class="last"><a href="javascript:void(0)">GM聊天系统</a>
                	<ul<?php if(in_array($permission_name, array('maintenance_master', 'maintenance_chat'))): ?> class="current"<?php endif; ?>>
                    	<li><a href="<?php echo $root_path; ?>maintenance/masters">配置GM帐号</a></li>
                    	<li class="last"><a href="<?php echo $root_path; ?>maintenance/chat">聊天</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        -->
        <li><a href="javascript:void(0)">市场数据分析</a>
        	<ul<?php if(in_array($permission_name, array('report_overview', 'report_recharge_log', 'report_recharge_daily_statistics', 'report_recharge_account', 'report_account_buy', 'report_item_statistics',
			'report_register_statistics', 'report_register_by_time', 'report_register_by_day', 'report_register_detail', 'report_login_detail', 'report_login_statistics', 'report_relogin_statistics', 
			'report_active_account', 'report_remain_account', 'report_lost_account', 'report_daily_statistics'))): ?> class="current"<?php endif; ?>>
                <li><a href="<?php echo $root_path; ?>report/daily_statistics">运营概况总览</a></li>
<!--
                <li><a href="javascript:void(0)">充值情况</a>
                	<ul<?php if(in_array($permission_name, array('report_recharge_log', 'report_recharge_daily_statistics', 'report_recharge_account', 'report_daily_statistics'))): ?> class="current"<?php endif; ?>>
                    	<li><a href="<?php echo $root_path; ?>report/recharge_log">玩家充值记录</a></li>
                    	<li><a href="<?php echo $root_path; ?>report/recharge_daily_statistics">每日充值统计</a></li>
                    	<li><a href="<?php echo $root_path; ?>report/recharge_account">充值玩家列表</a></li>
						<li class="last"><a href="<?php echo $root_path; ?>report/daily_statistics">各区充值情况统计</a></li>
					</ul>
                </li>
-->
                <li><a href="javascript:void(0)">消费情况</a>
                	<ul<?php if(in_array($permission_name, array('report_account_buy', 'report_item_statistics'))): ?> class="current"<?php endif; ?>>
                    	<li><a href="<?php echo $root_path; ?>report/account_buy">玩家消费记录</a></li>
                        <li class="last"><a href="<?php echo $root_path; ?>report/item_statistics">道具销售统计</a></li>
                    </ul>
                </li>
                <!--
                <li class="last"><a href="javascript:void(0)">注册登录情况</a>
                	<ul<?php if(in_array($permission_name, array('report_register_statistics', 'report_register_by_time', 'report_register_by_day', 'report_register_detail', 'report_login_detail',
					'report_login_statistics', 'report_relogin_statistics', 'report_active_account', 'report_remain_account', 'report_lost_account'))): ?> class="current"<?php endif; ?>>
                    	<li><a href="<?php echo $root_path; ?>report/register_statistics">用户注册统计</a></li>
                        <li><a href="<?php echo $root_path; ?>report/register_by_time">分时段注册统计</a></li>
                        <li><a href="<?php echo $root_path; ?>report/register_by_day">按天注册统计</a></li>
                        <li><a href="<?php echo $root_path; ?>report/register_detail">注册用户明细</a></li>
                        <li><a href="<?php echo $root_path; ?>report/login_detail">用户登录明细</a></li>
                        <li><a href="<?php echo $root_path; ?>report/login_statistics">用户登录统计</a></li>
                        <li><a href="<?php echo $root_path; ?>report/relogin_statistics">用户再登录统计</a></li>
                        <li class="last"><a href="<?php echo $root_path; ?>report/active_account">活跃用户</a></li>
                        <li><a href="<?php echo $root_path; ?>report/remain_account">用户存活情况</a></li>
                        <li><a href="<?php echo $root_path; ?>report/lost_account">流失用户</a></li>
                    </ul>
                </li>
                -->
            </ul>
        </li>
        <li><a href="javascript:void(0)">GM管理</a>
        	<ul<?php if(in_array($permission_name, array('master_grant', 'master_ban'))): ?> class="current"<?php endif; ?>>
            	<li><a href="<?php echo $root_path; ?>master/grant">道具发放</a></li>
            	<!--<li class="last"><a href="<?php echo $root_path; ?>master/ban">封停帐号</a></li>-->
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
