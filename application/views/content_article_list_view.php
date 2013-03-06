<div id="content">
    <div id="main">
    
        <h1>文章列表</h1>
        <div class="pad20">
            <div class="message information close">
                <h2>操作提示</h2>
                <p>1.首页只能显示最新的一篇置顶文章，置顶文章将会显示在首页及文章列表页的显眼位置。</p>
                <p>3.发布的文章需要经过审核才会在网站显示，若要审核文章请先确定你拥有“审核文章”的权限。</p>
                <p>2.删除文章无法恢复，请谨慎操作。</p>
            </div>
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                	<tr>
                    	<td colspan="6">置顶文章</td>
                    </tr>
                    <tr>
                        <td width="10%">编号</td>
                        <td width="25%">标题</td>
                        <td width="15%">所属频道</td>
                        <td width="20%">发布时间</td>
                        <td width="10%">状态</td>
                        <td width="20%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($top_result)): ?>
                	<?php for($i=0; $i<count($top_result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $top_result[$i]->news_id; ?></td>
                        <td><a href="<?php echo $root_path; ?>content/articles/preview?id=<?php echo $result[$i]->news_id; ?>" target="_blank"><?php echo $top_result[$i]->news_title; ?></a></td>
                        <td><?php echo $top_result[$i]->channel_name; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $top_result[$i]->news_posttime); ?></td>
                        <td><?php if($top_result[$i]->news_status==='0'): ?><span class="color_red">未审核</span><?php else: ?><span class="color_green">已审核</span><?php endif; ?></td>
                        <td><?php if($check_permission===TRUE): ?><?php if($top_result[$i]->news_status==='0'): ?><a href="<?php echo $root_path; ?>content/articles/action?action=check&id=<?php echo $top_result[$i]->news_id; ?>">通过审核</a><?php else: ?><a href="<?php echo $root_path; ?>content/articles/action?action=uncheck&id=<?php echo $top_result[$i]->news_id; ?>">取消审核</a><?php endif; ?> | <?php endif; ?><?php if($top_result[$i]->news_top_show=='0'): ?><a href="<?php echo $root_path; ?>content/articles/action?action=set&id=<?php echo $top_result[$i]->news_id; ?>">置顶</a><?php else: ?><a href="<?php echo $root_path; ?>content/articles/action?action=unset&id=<?php echo $top_result[$i]->news_id; ?>">取消置顶</a><?php endif; ?> | <a href="<?php echo $root_path; ?>content/articles/add?action=modify&id=<?php echo $top_result[$i]->news_id; ?>">编辑</a> | <a href="<?php echo $root_path; ?>content/articles/action?action=delete&id=<?php echo $top_result[$i]->news_id; ?>">删除</a></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="6">没有置顶文章</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                	<tr>
                    	<td colspan="6">
                            查看
                            <select id="newsStatus" name="newsStatus">
                                <option value="2" <?php if($current_status=='2'): ?>selected="selected"<?php endif; ?>>全部</option>
                                <option value="0" <?php if($current_status=='0'): ?>selected="selected"<?php endif; ?>>未审核</option>
                                <option value="1" <?php if($current_status=='1'): ?>selected="selected"<?php endif; ?>>已审核</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="10%">编号</td>
                        <td width="25%">标题</td>
                        <td width="15%">所属频道</td>
                        <td width="20%">发布时间</td>
                        <td width="10%">状态</td>
                        <td width="20%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->news_id; ?></td>
                        <td><a href="<?php echo $root_path; ?>content/articles/preview?id=<?php echo $result[$i]->news_id; ?>" target="_blank"><?php echo $result[$i]->news_title; ?></a></td>
                        <td><?php echo $result[$i]->channel_name; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $result[$i]->news_posttime); ?></td>
                        <td><?php if($result[$i]->news_status==='0'): ?><span class="color_red">未审核</span><?php else: ?><span class="color_green">已审核</span><?php endif; ?></td>
                        <td><?php if($check_permission===TRUE): ?><?php if($result[$i]->news_status==='0'): ?><a href="<?php echo $root_path; ?>content/articles/action?action=check&id=<?php echo $result[$i]->news_id; ?>">通过审核</a><?php else: ?><a href="<?php echo $root_path; ?>content/articles/action?action=uncheck&id=<?php echo $result[$i]->news_id; ?>">取消审核</a><?php endif; ?> | <?php endif; ?><?php if($result[$i]->news_top_show=='0'): ?><a href="<?php echo $root_path; ?>content/articles/action?action=set&id=<?php echo $result[$i]->news_id; ?>">置顶</a><?php else: ?><a href="<?php echo $root_path; ?>content/articles/action?action=unset&id=<?php echo $result[$i]->news_id; ?>">取消置顶</a><?php endif; ?> | <a href="<?php echo $root_path; ?>content/articles/add?action=modify&id=<?php echo $result[$i]->news_id; ?>">编辑</a> | <a href="<?php echo $root_path; ?>content/articles/action?action=delete&id=<?php echo $result[$i]->news_id; ?>">删除</a></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="6">没有添加文章</td>
                    </tr>
                <?php endif; ?>
                </tbody>
                <tfoot>
                	<tr>
                		<td colspan="6"><?php echo $pagination; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
    </div>
</div>
<script language="javascript">
$(function() {
	$("#newsStatus").change(function() {
		window.location = '<?php echo $root_path; ?>content/articles/lists?status=' + $(this).val();
	});
});
</script>