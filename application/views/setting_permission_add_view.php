<div id="content">
    <div id="main">
    
        <h1>新建/修改权限</h1>
        <div class="pad20">
        	<form action="permissions_add/submit" method="post" enctype="application/x-www-form-urlencoded" name="myForm">
                <fieldset>
                <p>
                    <label>权限等级</label>
                    <input name="permissionId" type="text" class="text-input small-input" id="permissionId" value="<?php echo $permission_id; ?>" <?php echo $read_only; ?> />
                    <input name="permissionIdHidden" type="hidden" id="permissionIdHidden" value="<?php echo $permission_id; ?>" />
                    <input name="permissionUpdate" type="hidden" id="permissionUpdate" value="<?php echo $permission_update; ?>" />
                    <input name="permissionType" type="hidden" id="permissionType" value="<?php echo $permission_type; ?>" />
                    <input name="GUID" type="hidden" id="GUID" value="<?php echo $guid; ?>" />
                    <span class="input-notification attention png_bg">0-1000以内的数字，不包括1000</span>
                    <br /><small>根据权限等级的高低，低等级的管理员不能管理高等级的管理员，高等级的管理员优先权高</small>
                </p>
                <p>
                    <label>权限等级</label>
                    <input name="permissionName" type="text" class="text-input small-input" id="permissionName" value="<?php echo $permission_name; ?>" <?php echo $read_only; ?> />
                    <span class="input-notification attention png_bg">3-10个中文或英文字符</span>
                    <br /><small>描述权限的名称</small>
                </p>
                <table class="fullwidth" border="0" cellspacing="0" cellpadding="0">
            	<thead>
                  <tr>
                    <td colspan="5" style="font-size:14px;font-weight:bold;">
                        <input name="web_all" type="checkbox" id="web_all" value="web_all" /> 
                        网站内容管理</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th width="20%" style="font-size:14px;font-weight:bold;">
                        <input name="global_control" type="checkbox" id="global_control" value="1" /> 全局功能
                    </th>
                    <td width="20%">
                      <input name="web_index" type="checkbox" id="content_index" value="content_index" <?php echo $content_index; ?> />
首页访问</td>
                    <td width="20%">
                      <input name="web_webs" type="checkbox" id="web_webs" value="web_webs" <?php echo $web_webs; ?> /> 选择当前操作网站
                    </td>
                    <td width="20%">
                      <input name="web_channel" type="checkbox" id="web_channel" value="web_channel" <?php echo $web_channel; ?> /> 频道管理
                    </td>
                    <td width="20%">
                    	<input name="func_upload" type="checkbox" id="func_upload" value="func_upload" <?php echo $func_upload; ?> /> 图片上传
                    </td>
                  </tr>
                  <tr> 
                    <th style="font-size:14px;font-weight:bold;">
                    	<input name="news_control" type="checkbox" id="news_control" value="1" /> 新闻管理
                    </th> 
                    <td>
                    	<input name="web_article_list" type="checkbox" id="web_article_list" value="web_article_list" <?php echo $web_article_list; ?> /> 新闻列表
                    </td> 
                    <td><input name="web_article_add" type="checkbox" id="web_article_add" value="web_article_add" <?php echo $web_article_add; ?> /> 添加新闻</td>
                    <td><input name="web_slides" type="checkbox" id="web_slides" value="web_slides" <?php echo $web_slides; ?> /> 
                      幻灯列表</td>
                    <td>&nbsp;</td> 
                  </tr>
                  <tr>
                    <th style="font-size:14px;font-weight:bold;"><input name="resource_control" type="checkbox" id="resource_control" value="1" />
                    资源管理</th>
                    <td><input name="web_media_list" type="checkbox" id="web_media_list" value="web_media_list" <?php echo $web_media_list; ?> />
                    资源列表</td>
                    <td><input name="web_media_video_add" type="checkbox" id="web_media_video_add" value="web_media_video_add" <?php echo $web_media_video_add; ?> />
                    上传视频</td>
                    <td><input name="web_media_pic_add" type="checkbox" id="web_media_pic_add" value="web_media_pic_add" <?php echo $web_media_pic_add; ?> />
                    上传图片</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr> 
                    <th style="font-size:14px;font-weight:bold;"><input name="system_control" type="checkbox" id="system_control" value="1" />
                    系统设置</th>
                    <td><input name="setting_admin" type="checkbox" id="setting_admin" value="setting_admin" <?php echo $setting_admin; ?> />
                      管理员设置</td>
                    <td><input name="setting_permission" type="checkbox" id="setting_permission" value="setting_permission" <?php echo $setting_permission; ?> />
                      权限列表</td>
                    <td><input name="setting_permission_add" type="checkbox" id="setting_permission_add" value="setting_permission_add" <?php echo $setting_permission_add; ?> />
                      添加权限</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
                <thead>
                  <tr> 
                    <td colspan="5" style="font-size:14px;font-weight:bold;"><input name="maintenance_all" type="checkbox" id="maintenance_all" value="maintenance_all" /> 
                    运维数据管理</td> 
                  </tr> 
                </thead>
                <tbody>
                  <tr> 
                    <th style="font-size:14px;font-weight:bold;"><input name="game_control" type="checkbox" id="game_control" value="1" />
                    游戏管理</th>
                    <td><input name="maintenance_product" type="checkbox" id="maintenance_product" value="maintenance_product" <?php echo $maintenance_product; ?> />
                      游戏列表</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
                <thead>
                  <tr> 
                    <td colspan="5" style="font-size:14px;font-weight:bold;"><input name="report_all" type="checkbox" id="report_all" value="report_all" /> 
                    报表分析中心</td> 
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th style="font-size:14px;font-weight:bold;"> <input name="report_overview_control" type="checkbox" id="report_overview_control" value="1" />
                    运营概况总览</th>
                    <td><input name="report_overview" type="checkbox" id="report_overview" value="report_overview" <?php echo $report_overview; ?> />
                    运营概况总览</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <th style="font-size:14px;font-weight:bold;"><input name="report_recharge_control" type="checkbox" id="report_recharge_control" value="1" />
                    充值情况</th>
                    <td><input name="report_recharge_log" type="checkbox" id="report_recharge_log" value="report_recharge_log" <?php echo $report_recharge_log; ?> />
                      玩家充值记录</td>
                    <td><input name="report_recharge_daily_statistics" type="checkbox" id="report_recharge_daily_statistics" value="report_recharge_daily_statistics" <?php echo $report_recharge_daily_statistics; ?> />
                      每日充值统计</td>
                    <td><input name="report_recharge_account" type="checkbox" id="report_recharge_account" value="report_recharge_account" <?php echo $report_recharge_account; ?> />
充值玩家列表</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <th style="font-size:14px;font-weight:bold;"><input name="report_consume_control" type="checkbox" id="report_consume_control" value="1" />
                    消费情况</th>
                    <td><input name="report_account_buy" type="checkbox" id="report_account_buy" value="report_account_buy" <?php echo $report_account_buy; ?> />
                    玩家消费记录</td>
                    <td><input name="report_item_statistics" type="checkbox" id="report_item_statistics" value="report_item_statistics" <?php echo $report_item_statistics; ?> />
                    道具销售统计</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <th rowspan="3" style="font-size:14px;font-weight:bold;"><input name="report_login_control" type="checkbox" id="report_login_control" value="1" />
                    注册登录情况</th>
                    <td><input name="report_register_statistics" type="checkbox" id="report_register_statistics" value="report_register_statistics" <?php echo $report_register_statistics; ?> />
                      用户注册统计</td>
                    <td><input name="report_register_by_time" type="checkbox" id="report_register_by_time" value="report_register_by_time" <?php echo $report_register_by_time; ?> />
                      分时段注册统计</td>
                    <td><input name="report_register_by_day" type="checkbox" id="report_register_by_day" value="report_register_by_day" <?php echo $report_register_by_day; ?> />
                      按天注册统计</td>
                    <td><input name="report_register_detail" type="checkbox" id="report_register_detail" value="report_register_detail" <?php echo $report_register_detail; ?> />
注册用户明细</td>
                  </tr>
                  <tr>
                    <td><input name="report_login_detail" type="checkbox" id="report_login_detail" value="report_login_detail" <?php echo $report_login_detail; ?> />
                    用户登录明细</td>
                    <td><input name="report_login_statistics" type="checkbox" id="report_login_statistics" value="report_login_statistics" <?php echo $report_login_statistics; ?> />
                      用户登录统计</td>
                    <td><input name="report_relogin_statistics" type="checkbox" id="report_relogin_statistics" value="report_relogin_statistics" <?php echo $report_relogin_statistics; ?> />
                      用户再登录统计</td>
                    <td><input name="report_active_account" type="checkbox" id="report_active_account" value="report_active_account" <?php echo $report_active_account; ?> />
活跃用户</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
                <thead>
                  <tr>
                    <td colspan="5" style="font-size:14px;font-weight:bold;"><input name="master_all" type="checkbox" id="master_all" value="master_all" />
                    GM管理功能</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th style="font-size:14px;font-weight:bold;"><input name="master_general_control" type="checkbox" id="master_general_control" value="1" />
                    常规管理</th>
                    <td><input name="master_grant" type="checkbox" id="master_grant" value="master_grant" <?php echo $master_grant; ?> />
                      道具发放</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
                </table>
                <p>
                    <input class="button" type="submit" value="提交" />
                </p>
              </fieldset>
            </form>
        </div>
    </div>
</div>