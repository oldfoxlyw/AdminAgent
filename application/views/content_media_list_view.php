<?php
$mediaType = array(
	'0'		=>	'截图',
	'1'		=>	'视频',
	'2'		=>	'原画'
);
?>
<div id="content">
    <div id="main">
    
        <h1>多媒体库</h1>
        <div class="pad20">
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td width="10%">编号</td>
                        <td width="15%">标题</td>
                        <td width="25%">内容</td>
                        <td width="10%">类型</td>
                        <td width="20%">发布时间</td>
                        <td width="20%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                    	<?php if($result[$i]->media_type=='0'): ?>
                        <td><?php echo $result[$i]->media_id; ?></td>
                        <td><?php echo $result[$i]->media_title; ?></td>
                        <td><?php echo $result[$i]->media_url; ?></td>
                        <td><?php echo $mediaType[$result[$i]->media_type]; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $result[$i]->media_posttime); ?></td>
                        <td><a href="<?php echo $root_path; ?>content/media/add_pic?action=modify&id=<?php echo $result[$i]->media_id; ?>">编辑</a> | <a href="<?php echo $root_path; ?>content/media/action?action=delete&id=<?php echo $result[$i]->media_id; ?>">删除</a></td>
                        <?php else: ?>
                        <td><?php echo $result[$i]->media_id; ?></td>
                        <td><?php echo $result[$i]->media_title; ?></td>
                        <td><?php echo $result[$i]->media_url; ?></td>
                        <td><?php echo $mediaType[$result[$i]->media_type]; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $result[$i]->media_posttime); ?></td>
                        <td><a href="<?php echo $root_path; ?>content/media/add_video?action=modify&id=<?php echo $result[$i]->media_id; ?>">编辑</a> | <a href="<?php echo $root_path; ?>content/media/action?action=delete&id=<?php echo $result[$i]->media_id; ?>">删除</a></td>
                        <?php endif; ?>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="6">没有多媒体文件</td>
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