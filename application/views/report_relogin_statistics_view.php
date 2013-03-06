<div id="content">
    <div id="main">
    
        <h1>用户登录统计</h1>
        <div class="pad20">
            <div class="message information close">
                <h2>操作提示</h2>
                <p>1.首页只能显示最新的一篇置顶文章，置顶文章将会显示在首页及文章列表页的显眼位置。</p>
                <p>3.发布的文章需要经过审核才会在网站显示，若要审核文章请先确定你拥有"审核文章"的权限。</p>
                <p>2.删除文章无法恢复，请谨慎操作。</p>
            </div>
        	<form action="" method="post" enctype="application/x-www-form-urlencoded">
            	<fieldset>
                	<legend>搜索条件</legend>
                    <input type="hidden" id="hiddenSubmitFlag" name="hiddenSubmitFlag" value="1" />
                    <p>
                    	<span>游戏：</span>
                        <select id="game_id" name="game_id">
                        	<option value="0">全部</option>
                            <?php if(count($game_result)==1): ?>
                            <option value="<?php echo $game_result[0]->game_id; ?>" selected="selected"><?php echo $game_result[0]->game_name; ?></option>
                            <?php else: ?>
                            <?php foreach($game_result as $row): ?>
                            <option value="<?php echo $row->game_id; ?>"<?php if($game_id==$row->game_id): ?>selected="selected"<?php endif; ?>><?php echo $row->game_name; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    	<span>大区：</span>
                        <select id="section_id" name="section_id">
                        	<option value="0">全部</option>
                            <?php if(!empty($section_result)): ?>
                            <?php if(count($section_result)==1): ?>
                            <option value="<?php echo $section_result[0]->server_section_id; ?>" selected="selected"><?php echo $section_result[0]->section_name; ?></option>
                            <?php else: ?>
                            <?php foreach($section_result as $row): ?>
                            <option value="<?php echo $row->server_section_id; ?>"<?php if($section_id==$row->server_section_id): ?>selected="selected"<?php endif; ?>><?php echo $row->section_name; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </select>
                    	<span>服务器：</span>
                        <select id="server_id" name="server_id">
                        	<option value="0">全部</option>
                            <?php if(!empty($server_result)): ?>
                            <?php if(count($server_result)==1): ?>
                            <option value="<?php echo $server_result[0]->account_server_id; ?>" selected="selected"><?php echo $server_result[0]->server_name; ?></option>
                            <?php else: ?>
                            <?php foreach($server_result as $row): ?>
                            <option value="<?php echo $row->account_server_id; ?>"<?php if($server_id==$row->account_server_id): ?>selected="selected"<?php endif; ?>><?php echo $row->server_name; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </select>
                        <input class="button" type="button" id="btnAddServer" name="btnAddServer" value="添加" />
                    </p>
                    <p id="serverContainerP">
                    	<input type="hidden" id="serverContainerT" name="serverContainerT" value="<?php echo $server_list; ?>" />
                    </p>
                    <p>
                    	<span>登录时间：</span><input name="log_login_time_start" type="text" class="sf date_picker" id="log_login_time_start" value="<?php echo $log_login_time_start; ?>" />
                    	<span>- </span><input name="log_login_time_end" type="text" class="sf date_picker" id="log_login_time_end" value="<?php echo $log_login_time_end; ?>" />
                    </p>
                    <p>
                    	<span>再登录时间：</span><input name="log_relogin_time_start" type="text" class="sf date_picker" id="log_relogin_time_start" value="<?php echo $log_relogin_time_start; ?>" />
                    	<span>- </span><input name="log_relogin_time_end" type="text" class="sf date_picker" id="log_relogin_time_end" value="<?php echo $log_relogin_time_end; ?>" />
                    </p>
                    <p>
                        <input class="button" type="submit" id="btnSubmit" name="btnSubmit" value="提交" />
                        <input class="button" type="reset" value="重置" />
                    </p>
                </fieldset>
            </form>
        </div>
        <?php if($submit_flag == '1'): ?>
        <div class="pad20">
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                    	<td>服务器</td>
                        <td>登录人数</td>
                        <td>登录次数</td>
                        <td>再登录人数</td>
                        <td>再登录次数</td>
                        <td>再登录率</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php foreach($result as $key => $value): ?>
                    <tr>
                    	<td><?php echo $key; ?></td>
                        <td><?php echo $value['login_count']; ?></td>
                        <td><?php echo $value['login_time']; ?></td>
                        <td><?php echo $value['relogin_count']; ?></td>
                        <td><?php echo $value['relogin_time']; ?></td>
                        <td><?php printf('%.2f', intval($value['relogin_count']) / intval($value['login_count']) * 100); ?>%</td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="6">没有登录的记录</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<script language="javascript" src="<?php echo $root_path; ?>resources/js/report/server_selectable.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>resources/js/datepicker.js"></script>
<script language="javascript">
$(function() {
	$("#btnAddServer").click(function() {
		if($("#game_id").val() != '0' && $("#section").val() != '0' && $("#server_id").val() != '0') {
			var serverText = $("#game_id").find("option:selected").text() + '-' + $("#section_id").find("option:selected").text() + '-' + $("#server_id").find("option:selected").text();
			var serverId = $("#game_id").val() + ',' + $("#section_id").val() + ',' + $("#server_id").val();
			$("#serverContainerP").append(serverText + '<br>');
			if($("#serverContainerT").val() == "") {
				$("#serverContainerT").val(serverId);
			} else {
				$("#serverContainerT").val($("#serverContainerT").val() + '|||' + serverId);
			}
		}
	});
});
</script>