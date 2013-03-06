<div id="content">
    <div id="main">
    
        <h1>GM列表</h1>
        <div class="pad20">
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td width="20%">编号</td>
                        <td width="20%">昵称</td>
                        <td width="30%">建号时间</td>
                        <td width="30%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->master_id; ?></td>
                        <td><?php echo $result[$i]->master_name; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $result[$i]->master_generationtime); ?></td>
                        <td><a href="?action=modify&id=<?php echo $result[$i]->master_id; ?>">编辑</a> | <a href="masters/action?action=delete&id=<?php echo $result[$i]->master_id; ?>">删除</a></td>
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
            <form method="post" action="<?php echo $root_path ?>maintenance/masters/submit">
                <!-- Fieldset -->
                <fieldset>
                    <legend>添加/修改GM帐号</legend>
                    <input type="hidden" id="masterUpdate" name="masterUpdate" value="<?php echo $master_update; ?>" />
                    <input type="hidden" id="masterId" name="masterId" value="<?php echo $master_id; ?>" />
                    <p>
                        <label for="masterName">帐号昵称</label>
                        <input class="lf" name="masterName" id="masterName" type="text" value="<?php echo $master_name; ?>" />
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