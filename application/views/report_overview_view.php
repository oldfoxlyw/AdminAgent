<div id="content">
    <div id="main">
    
        <h1>运营概况汇总</h1>
        <p>统计7天以内所有服务器的概况</p>
        <?php if(!empty($result)): ?>
        <?php foreach($result as $value): ?>
        <div class="pad20">
        	<p>游戏ID：<?php echo $value['game_id']; ?> - 区ID：<?php echo $value['section_id']; ?> - 服务器：<?php echo $value['server_name']; ?></p>
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td>日期</td>
                        <td>注册数</td>
                        <td>登录数</td>
                        <td>付费人数</td>
                        <td>付费次数</td>
                        <td>总充值金额</td>
                        <td>消费暗能水晶数</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($value['result'])): ?>
                	<?php for($i=0; $i<count($value['result']); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $value['result'][$i]->log_date; ?></td>
                        <td><?php echo $value['result'][$i]->log_register_count; ?></td>
                        <td><?php echo $value['result'][$i]->log_login_count; ?></td>
                        <td><?php echo $value['result'][$i]->log_pay_count; ?></td>
                        <td><?php echo $value['result'][$i]->log_payment_count; ?></td>
                        <td><?php echo intval($value['result'][$i]->log_checkin_count) / 100; ?></td>
                        <td><?php echo $value['result'][$i]->log_checkout_count; ?></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="7">还没有统计信息</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
		<?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>