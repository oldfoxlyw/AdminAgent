<div id="content">
    <div id="main">
    
        <h1>注册用户明细</h1>
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
                    	<label id="account_id">帐号ID</label>
                        <input class="lf" id="account_id" name="account_id" value="<?php echo $account_id; ?>" />
                    </p>
                    <p>
                    	<label id="nick_name">昵称</label>
                        <input class="lf" id="nick_name" name="nick_name" value="<?php echo $nick_name; ?>" />
                    </p>
                    <p>
                    	<label id="account_name">用户名</label>
                        <input class="lf" id="account_name" name="account_name" value="<?php echo $account_name; ?>" />
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
                    	<td>用户名</td>
                    	<td>军官证</td>
                        <td>昵称</td>
                        <td>服务器</td>
                        <td>余额</td>
                        <td>注册时间</td>
                        <td>最后登录时间</td>
                        <td>最后登录IP</td>
                        <td>帐号状态</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->account_name; ?></td>
                        <td><?php echo $result[$i]->account_id; ?></td>
                        <td><?php echo $result[$i]->nick_name; ?></td>
                        <td><?php echo $result[$i]->account_server_id; ?></td>
                        <td><?php echo $result[$i]->account_cash; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $account->account_regtime); ?></td>
                        <td><?php echo empty($account->account_lastlogin) ? '没有登录' : date('Y-m-d H:i:s', $account->account_lastlogin); ?></td>
                        <td><?php echo empty($account->account_lastip) ? '没有登录' : $account->account_lastip; ?></td>
                        <td><?php echo lang('account_status_' . $account->account_status); ?></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="9">没有注册的记录</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>