<div id="content">
    <div id="main">
    
        <h1>权限列表</h1>
        <div class="pad20">
        	<input class="button" type="button" value="新建权限" onclick="location.href='<?php echo $root_path ?>setting/permissions_add'" />
        </div>
        <div class="pad20">
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td width="20%">权限等级</td>
                        <td width="50%">名称</td>
                        <td width="30%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->permission_id; ?></td>
                        <td><?php echo $result[$i]->permission_name; ?></td>
                        <td><a href="<?php echo $root_path ?>setting/permissions_add?action=modify&id=<?php echo $result[$i]->permission_id; ?>">编辑</a> | <a href="<?php echo $root_path ?>setting/permissions/action?action=delete&id=<?php echo $result[$i]->permission_id; ?>">删除</a></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="3">还没配置权限信息</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>