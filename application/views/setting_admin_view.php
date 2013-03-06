<div id="content">
    <div id="main">
    
        <h1>系统管理员列表</h1>
        <div class="pad20">
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td width="40%">GUID</td>
                        <td width="20%">用户名</td>
                        <td width="20%">权限等级</td>
                        <td width="20%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->GUID; ?></td>
                        <td><?php echo $result[$i]->user_name; ?></td>
                        <td><?php echo $result[$i]->permission_name; ?></td>
                        <td><a href="<?php echo $root_path ?>setting/administrators?action=modify&id=<?php echo $result[$i]->GUID; ?>">编辑</a> | <a href="<?php echo $root_path ?>setting/administrators/action?action=delete&id=<?php echo $result[$i]->GUID; ?>">删除</a></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="3">还没有GM帐号信息</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="pad20">
            <!-- Form -->
            <form method="post" action="<?php echo $root_path ?>setting/administrators/submit">
                <!-- Fieldset -->
                <fieldset>
                    <legend>添加/修改系统管理员</legend>
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
                        <label for="userPermission">权限等级</label>
                        <select id="userPermission" name="userPermission">
                        <?php foreach($permission as $row): ?>
                        	<option value="<?php echo $row->permission_id; ?>" <?php if($row->permission_id==$user_permission): ?>selected="selected"<?php endif; ?>><?php echo $row->permission_name; ?></option>
                        <?php endforeach; ?>
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