<div id="content">
    <div id="main">
    
        <h1>合作商户列表</h1>
        <div class="pad20">
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td width="40%">GUID</td>
                        <td width="20%">用户名</td>
                        <td width="20%">Partner Key</td>
                        <td width="20%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->GUID; ?></td>
                        <td><?php echo $result[$i]->user_name; ?></td>
                        <td><?php echo $result[$i]->partner_key; ?></td>
                        <td><a href="<?php echo $root_path ?>setting/partners?action=modify&id=<?php echo $result[$i]->GUID; ?>">编辑</a> | <a href="<?php echo $root_path ?>setting/partners/action?action=delete&id=<?php echo $result[$i]->GUID; ?>">删除</a></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="3">还没有帐号信息</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="pad20">
            <!-- Form -->
            <form method="post" action="<?php echo $root_path ?>setting/partners/submit">
                <!-- Fieldset -->
                <fieldset>
                    <legend>添加/修改商户</legend>
                    <input type="hidden" id="adminUpdate" name="adminUpdate" value="<?php echo $admin_update; ?>" />
                    <input type="hidden" id="guid" name="guid" value="<?php echo $guid; ?>" />
                    <p>
                        <label for="userName">用户名</label>
                        <input class="lf" name="userName" id="userName" type="text" value="<?php echo $user_name; ?>" />
                    </p>
                    <p>
                        <label for="userPass">密码</label>
                        <input class="lf" name="userPass" id="userPass" type="text" />
                    </p>
                    <p>
                        <label for="partnerKey">Partner Key</label>
                        <input class="lf" name="partnerKey" id="partnerKey" type="text" value="<?php echo $partner_key; ?>" />
                    </p>
                    <p>
                        <label for="userPermission">独立设置权限等级</label>
                        <input class="lf" name="userPermission" id="userPermission" type="text" value="<?php echo $additional_permission; ?>" />
                        </select>
                    </p>
                    <p>
                        <input class="button" type="submit" value="提交" />
                        <input class="button" type="reset" value="重置" />
                    </p>
                </fieldset>
                <!-- End of fieldset -->
            </form>
            <!-- End of Form -->
        </div>
    </div>
</div>