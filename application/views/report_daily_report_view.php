<div id="content">
    <div id="main">
    
        <h1>各区付费情况统计</h1>
        <div class="pad20">
        	<form action="" method="post" enctype="application/x-www-form-urlencoded">
            	<fieldset>
                	<legend>搜索条件</legend>
                    <input type="hidden" id="hiddenSubmitFlag" name="hiddenSubmitFlag" value="1" />
                    <p>
                    	<span>起始时间：</span><input name="log_time_start" type="text" class="sf date_picker" id="log_time_start" value="<?php echo $log_time_start; ?>" />
                    	<span>结束时间：</span><input name="log_time_end" type="text" class="sf date_picker" id="log_time_end" value="<?php echo $log_time_end; ?>" />
                    </p>
                    <p>
                    	<label id="serverName">服务器名</label>
                        <input class="lf" id="serverName" name="serverName" value="<?php echo $server_name; ?>" />
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
                    	<td>日期</td>
                    	<td>服务器名</td>
                        <td>注册数</td>
                        <td>改名用户数</td>
                        <td>登录用户数</td>
                        <td>订单数量</td>
                        <td>订单总额</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->log_date; ?></td>
                        <td><?php echo $result[$i]->server_name; ?></td>
                        <td><?php echo $result[$i]->reg_account; ?></td>
                        <td><?php echo $result[$i]->modify_account; ?></td>
                        <td><?php echo $result[$i]->login_account; ?></td>
                        <td><?php echo $result[$i]->orders_num; ?></td>
                        <td><?php echo $result[$i]->orders_sum; ?></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="9">没有日志记录</td>
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
<script language="javascript" src="<?php echo $root_path; ?>resources/js/datepicker.js"></script>