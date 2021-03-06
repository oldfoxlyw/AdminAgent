<div id="content">
    <div id="main">
    
        <h1>分时段注册统计</h1>
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
                    	<label id="platform">平台</label>
                        <select id="platform" name="platform">
                        	<option value="0" <?php if(empty($platform)): ?>selected="selected"<?php endif; ?>>全部</option>
                            <option value="iphone" <?php if($platform=='iphone'): ?>selected="selected"<?php endif; ?>>iPhone</option>
                            <option value="ipad" <?php if($platform=='ipad'): ?>selected="selected"<?php endif; ?>>iPad</option>
                            <option value="web" <?php if($platform=='web'): ?>selected="selected"<?php endif; ?>>Web</option>
                        </select>
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
                    	<td>时间</td>
                    	<td>服务器</td>
                        <td>平台</td>
                        <td>总计</td>
                    	<td>00点</td>
                    	<td>01点</td>
                    	<td>02点</td>
                    	<td>03点</td>
                    	<td>04点</td>
                    	<td>05点</td>
                    	<td>06点</td>
                    	<td>07点</td>
                    	<td>08点</td>
                    	<td>09点</td>
                    	<td>10点</td>
                    	<td>11点</td>
                    	<td>12点</td>
                    	<td>13点</td>
                    	<td>14点</td>
                    	<td>15点</td>
                    	<td>16点</td>
                    	<td>17点</td>
                    	<td>18点</td>
                    	<td>19点</td>
                    	<td>20点</td>
                    	<td>21点</td>
                    	<td>22点</td>
                    	<td>23点</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $value): ?>
                    <tr>
                        <td><?php echo $value['cache_date']; ?></td>
                        <td><?php echo $value['server_id']; ?></td>
                        <td><?php echo $value['platform']; ?></td>
                        <td></td>
                    	<?php foreach($value['detail'] as $row): ?>
                        <td><?php echo $row; ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<script language="javascript" src="<?php echo $root_path; ?>resources/js/report/server_selectable.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>resources/js/datepicker.js"></script>