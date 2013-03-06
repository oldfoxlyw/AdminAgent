<div id="content">
    <div id="main">
    
        <h1>网站列表</h1>
        <div class="pad20">
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td width="20%">编号</td>
                        <td width="40%">网站名称</td>
                        <td width="40%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->web_id; ?></td>
                        <td><?php echo $result[$i]->web_name; ?></td>
                        <td><a href="webs/action?action=set&id=<?php echo $result[$i]->web_id; ?>">设为当前操作的网站</a> | <a href="?action=modify&id=<?php echo $result[$i]->web_id; ?>">编辑</a> | <a href="webs/action?action=delete&id=<?php echo $result[$i]->web_id; ?>">删除</a></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="3">没有添加网站，在进行其他操作之前，请先添加一个网站。</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="pad20">
            <!-- Form -->
            <form method="post" action="<?php echo $root_path ?>content/webs/submit">
                <!-- Fieldset -->
                <fieldset>
                    <legend>添加/修改网站</legend>
                    <input type="hidden" id="webUpdate" name="webUpdate" value="<?php echo $web_update; ?>" />
                    <input type="hidden" id="webId" name="webId" value="<?php echo $web_id; ?>" />
                    <p>
                        <label for="webName">网站名称</label>
                        <input class="lf" name="webName" id="webName" type="text" value="<?php echo $web_name; ?>" />
                    </p>
                    <p>
                        <label for="webUrl">网站地址</label>
                        <input class="lf" name="webUrl" id="webUrl" type="text" value="<?php echo $web_url; ?>" />
                    </p>
                    <p>
                        <input class="button" type="submit" value="提交" />
                        <input class="button" type="reset" value="重置" />
                    </p>
                </fieldset>
                <!-- End of fieldset -->
            </form>
            <!-- End of Form -->	
            <p>Proin vel ullamcorper purus. Pellentesque accumsan magna volutpat lacus volutpat quis lacinia metus vehicula. In hac habitasse platea dictumst. Aenean lorem mauris, iaculis sit amet condimentum luctus, volutpat ac nunc. Pellentesque cursus, eros ac lobortis dignissim, diam tortor malesuada lorem, cursus tempus dui sapien hendrerit mi. Nulla facilisi. Nulla facilisi. Fusce tincidunt dui sed eros interdum vel dignissim enim tempus. Vestibulum massa ipsum, volutpat eget blandit ac, semper eu dui. Nam eget mi sapien. </p>
        </div>
    </div>
</div>