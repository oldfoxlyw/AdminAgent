<div id="content">
    <div id="main">
    	<h1>幻灯列表</h1>
        <div class="pad20">
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
            	<thead>
                	<tr>
                    	<td width="10%">编号</td>
                    	<td width="30%">显示图片</td>
                    	<td width="50%">链接</td>
                    	<td width="10%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                    	<td><?php echo $result[$i]->slide_id ?></td>
                    	<td><img src="<?php echo $result[$i]->slide_pic_path; ?>" width="<?php echo $result[$i]->slide_pic_width; ?>" height="<?php echo $result[$i]->slide_pic_height; ?>" /></td>
                    	<td><?php echo $result[$i]->slide_link; ?></td>
                    	<td><a href="<?php echo $root_path; ?>content/slides?action=modify&id=<?php echo $result[$i]->slide_id; ?>">编辑</a> | <a href="<?php echo $root_path; ?>content/slides/action?action=delete&id=<?php echo $result[$i]->slide_id; ?>">删除</a></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="4">没有幻灯展示</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    
        <h1>上传图片</h1>
        <div class="pad20">
        	<!-- Form -->
            <form method="post" action="<?php echo $root_path ?>content/slides/submit">
                <!-- Fieldset -->
                <fieldset>
                    <legend>添加/修改幻灯</legend>
                    <input type="hidden" id="slideUpdate" name="slideUpdate" value="<?php echo $slide_update; ?>" />
                    <input type="hidden" id="slideId" name="slideId" value="<?php echo $slide_id; ?>" />
                    <p>
                        <label for="slidePic">上传图片</label>
                        <input name="slidePic" type="file" id="slidePic" size="20" class="text-input" />
                        <input type="button" name="btn_upload" id="btn_upload" value="上传" onclick="javascript:contentPicUpload('slidePic')" class="button" />
                        <input type="hidden" id="slidePicPath" name="slidePicPath" value="<?php echo $slide_pic_path; ?>" />
                        <div id="slidePic_displayer"><?php if(!empty($slide_pic_path)): ?><img src="<?php echo $slide_pic_path; ?>" /><?php endif; ?></div>
                    </p>
                    <p>
                        <label for="slidePicWidth">宽</label>
                        <input class="lf" name="slidePicWidth" id="slidePicWidth" type="text" value="<?php echo $slide_pic_width; ?>" />
                    </p>
                    <p>
                        <label for="slidePicHeight">高</label>
                        <input class="lf" name="slidePicHeight" id="slidePicHeight" type="text" value="<?php echo $slide_pic_height; ?>" />
                    </p>
                    <p>
                        <label for="slideLink">链接</label>
                        <input class="lf" name="slideLink" id="slideLink" type="text" value="<?php echo $slide_link; ?>" />
                    </p>
                    <p>
                        <input class="button" type="submit" id="newsSubmit" name="newsSubmit" value="提交" />
                        <input class="button" type="reset" value="重置" />
                    </p>
                </fieldset>
                <!-- End of fieldset -->
            </form>
            <!-- End of Form -->
        </div>
        
    </div>
</div>
<script language="javascript" src="<?php echo $root_path; ?>resources/js/web/articles.js"></script>
<script type="text/javascript" src="<?php echo $root_path; ?>resources/js/jquery.wysiwyg.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>resources/js/uploader/ajaxfileupload.js"></script>
<script language="javascript">
function contentPicUpload(el) {
	$.ajaxFileUpload
	(
		{
			url:'<?php echo $root_path; ?>content/general_api/doPicUpload?el=' + el,
			secureuri:false,
			fileElementId:el,
			dataType: 'json',
			data:{},
			success: function (data, status)
			{
				if(typeof(data.error) != 'undefined')
				{
					if(data.error != 'null')
					{
						alert(data.error);
					}
					else
					{
						alert(data.msg);
						$("#slidePicWidth").val(data.width);
						$("#slidePicHeight").val(data.height);
						$("#" + el + 'Path').val(data.data);
						$("#" + el + '_displayer').append('<img src="' + data.data + '" />');
					}
				}
			},
			error: function (data, status, e) {
				alert(e);
			}
		}
	)
	return false;
}
</script>