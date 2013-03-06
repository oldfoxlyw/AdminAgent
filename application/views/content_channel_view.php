<div id="content">
    <div id="main">
    
        <h1>频道管理</h1>
        <div class="pad20">
        	<table id="tbl_channel" class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td width="20%">编号</td>
                        <td width="20%">名称</td>
                        <td width="40%">自定义链接</td>
                        <td width="20%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
					<?php foreach($result as $row): ?>
                    <tr>
                        <td><?php echo $row->channel_id; ?></td>
                        <td style="cursor:pointer;" class="channel_name"><?php echo $row->channel_name; ?></td>
                        <td><?php echo $row->channel_url; ?></td>
                        <td><a href="javascript:addNewChannel(<?php echo $row->channel_id; ?>, '<?php echo $row->channel_name; ?>')">添加子频道</a> | <a href="?action=modify&id=<?php echo $row->channel_id; ?>">修改</a> | <a href="channels/action?action=delete&id=<?php echo $row->channel_id; ?>">删除</a></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="4">没有频道</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                	<tr>
                    	<td colspan="4"><input class="button" type="button" value="添加一级频道" onclick="addNewChannel(0, '没有父级频道')" /></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div id="add_channel" class="pad20">
            <!-- Form -->
            <form method="post" action="<?php echo $root_path ?>content/channels/submit">
                <!-- Fieldset -->
                <fieldset>
                    <legend>添加/修改频道</legend>
                    <input type="hidden" id="channelUpdate" name="channelUpdate" value="<?php echo $channel_update; ?>" />
                    <input type="hidden" id="channelId" name="channelId" value="<?php echo $channel_id; ?>" />
                    <input name="channelFatherId" type="hidden" id="channelFatherId" value="<?php echo $channel_father_id; ?>" />
                    <p>
                        <label for="father_name">父级频道</label><span id="father_name">没有父级频道</span>
                    </p>
                    <p>
                        <label for="channelName">频道名称</label>
                        <input class="lf" name="channelName" id="channelName" type="text" value="<?php echo $channel_name; ?>" />
                    </p>
                    <p>
                        <label for="channelUrl">自定义链接</label>
                        <input class="lf" name="channelUrl" id="channelUrl" type="text" value="<?php echo $channel_url; ?>" />
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
<script language="javascript" src="<?php echo $root_path ?>resources/js/web/channels.js"></script>