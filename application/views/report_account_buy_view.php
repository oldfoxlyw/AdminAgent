<div id="content">
    <div id="main">
    
        <h1>玩家消费记录</h1>
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
                    </p>
                    <p>
                    	<span>起始时间：</span><input name="log_time_start" type="text" class="sf date_picker" id="log_time_start" value="<?php echo $log_time_start; ?>" />
                    	<span>结束时间：</span><input name="log_time_end" type="text" class="sf date_picker" id="log_time_end" value="<?php echo $log_time_end; ?>" />
                    </p>
                    <p>
                    	<label for="type">消费类型</label>
                        <select id="type" name="type">
                        	<option value="0">全部</option>
                        	<option value="building_upgrade"<?php if($type=='building_upgrade'): ?> selected="selected"<?php endif; ?>>建筑升级</option>
                        	<option value="skill_upgrade"<?php if($type=='skill_upgrade'): ?> selected="selected"<?php endif; ?>>科技升级</option>
                        	<option value="construct_tower"<?php if($type=='construct_tower'): ?> selected="selected"<?php endif; ?>>建造炮塔</option>
                        	<option value="exchange_resource"<?php if($type=='exchange_resource'): ?> selected="selected"<?php endif; ?>>兑换资源</option>
                        	<option value="accelerate"<?php if($type=='accelerate'): ?> selected="selected"<?php endif; ?>>加速</option>
                        	<option value="output"<?php if($type=='output'): ?> selected="selected"<?php endif; ?>>制造</option>
                        	<option value="mall_props"<?php if($type=='mall_props'): ?> selected="selected"<?php endif; ?>>购买商城道具</option>
                        	<option value="vehicles_strengthen"<?php if($type=='vehicles_strengthen'): ?> selected="selected"<?php endif; ?>>强化战车</option>
                        	<option value="vehicles_repair"<?php if($type=='vehicles_repair'): ?> selected="selected"<?php endif; ?>>修理战车</option>
                        	<option value="vehicles_resurrection"<?php if($type=='vehicles_resurrection'): ?> selected="selected"<?php endif; ?>>复活战车</option>
                        </select>
                    </p>
                    <p>
                    	<label id="spend_item">消耗资源ID</label>
                        <input id="spend_item" name="spend_item" type="text" class="mf" value="<?php echo $spend_item ?>" />
                    </p>
                    <p>
                    	<label id="get_item">获取资源ID</label>
                        <input id="get_item" name="get_item" type="text" class="mf" value="<?php echo $get_item ?>" />
                    </p>
                    <p>
                    	<label id="account_id">军官证号</label>
                        <input id="account_id" name="account_id" type="text" class="mf" value="<?php echo $account_id ?>" />
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
                    	<td>游戏帐号</td>
                        <td>军官证号</td>
                        <td>昵称</td>
                        <td>消费类型</td>
                        <td>消耗物品</td>
                        <td>消耗数量</td>
                        <td>获得物品</td>
                        <td>获得数量</td>
                        <td>时间</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->log_account_name; ?></td>
                        <td><?php echo $result[$i]->log_account_id; ?></td>
                        <td><?php echo $result[$i]->log_account_nickname; ?></td>
                        <td><?php echo lang('log_type_' . $result[$i]->log_type); ?></td>
                        <td><?php echo $result[$i]->log_spend_item_name; ?></td>
                        <td><?php echo $result[$i]->log_spend_item_count; ?></td>
                        <td><?php echo $result[$i]->log_get_item_name; ?></td>
                        <td><?php echo $result[$i]->log_get_item_count; ?></td>
                        <td><?php echo $result[$i]->log_local_time; ?></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="9">没有玩家消费的记录</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                	<tr>
                		<td colspan="9"><?php echo $pagination; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<script language="javascript" src="<?php echo $root_path; ?>resources/js/report/server_selectable.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>resources/js/datepicker.js"></script>