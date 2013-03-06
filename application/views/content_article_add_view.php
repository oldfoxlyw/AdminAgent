<div id="content">
    <div id="main">
    
        <h1>添加文章</h1>
        <div class="pad20">
        	<!-- Form -->
            <form method="post" action="<?php echo $root_path ?>content/articles/submit">
                <!-- Fieldset -->
                <fieldset>
                    <legend>添加/修改文章</legend>
                    <input type="hidden" id="newsUpdate" name="newsUpdate" value="<?php echo $news_update; ?>" />
                    <input type="hidden" id="newsId" name="newsId" value="<?php echo $news_id; ?>" />
                    <p>
                        <label for="newsTitle">标题</label>
                        <input class="lf" name="newsTitle" id="newsTitle" type="text" value="<?php echo $news_title; ?>" />
                    </p>
                    <p>
                        <label for="newsTitle">对外显示标题</label>
                        <input class="lf" name="newsDisplayTitle" id="newsDisplayTitle" type="text" value="<?php echo $news_display_title; ?>" />
                    </p>
                    <p<?php if($news_update!='update'): ?> style="display:none;"<?php endif; ?>>
                        <label>所属频道</label>
                        <input name="newsChannel" id="newsChannel" type="hidden" value="<?php echo $news_channel; ?>" />
                        <span class="input-notification attention png_bg"><?php echo $channel_name; ?><a id="btn_add_channel" href="javascript:void(0)">[我要修改所属频道]</a></span><br />
                    </p>
                    <div id="channel_container" <?php if($news_update=='update'): ?>style="display:none;"<?php endif; ?>>
                        <p>
                            <label for="channel1">1级频道</label>
                            <select id="channel1" name="channel1" class="channelSelect" title="1">
                                <option value="-1" selected="selected">未选择</option>
                            <?php foreach($channel_result as $row): ?>
                                <option value="<?php echo $row->channel_id; ?>"><?php echo $row->channel_name; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </p>
                    </div>
                    <p>
                        <label>标签</label>
                        <input name="newsTags" type="text" class="lf" id="newsTags" value="<?php echo $news_tags; ?>" />
                    </p>
                    <p>
                        <label>关键字(META)</label>
                        <input name="newsKeywords" type="text" class="lf" id="newsKeywords" value="<?php echo $news_keywords; ?>" />
                    </p>
                    <p>
                        <label>描述(META)</label>
                        <textarea name="newsDesc" id="newsDesc" class="lf" cols="80" rows="4"><?php echo $news_desc; ?></textarea>
                    </p>
                    <p>
                        <label>简讯</label>
                        <textarea name="newsIntro" id="newsIntro" class="lf" cols="80" rows="4"><?php echo $news_intro; ?></textarea>
                    </p>
                    <p>
                        <label>快速显示图片</label>
                        <input type="hidden" id="newsDisplayPic" name="newsDisplayPic" value="<?php echo $news_display_pic; ?>" />
                        <input name="displayPicUpload" type="file" id="displayPicUpload" size="20" class="text-input" />
                        <input type="button" name="btn_upload" id="btn_upload" value="上传" onclick="javascript:contentPicUpload('displayPicUpload')" class="button" />
                        <div id="displayPicUpload_display"></div>
                    </p>
                    <p>
                        <label>内容图片</label>
                        <input name="contentUpload" type="file" id="contentUpload" size="20" class="text-input" />
                        <input type="button" name="btn_upload" id="btn_upload" value="上传" onclick="javascript:contentPicUpload('contentUpload')" class="button" />
                        <div id="contentPic"></div>
                    </p>
                    <p>
                        <label>内容</label>
                        <textarea name="newsContent" id="newsContent" class="wysiwyg" cols="80" rows="6"><?php echo $news_content; ?></textarea>
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
<script language="javascript" src="<?php echo $root_path; ?>resources/js/ckeditor/ckeditor.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>resources/js/uploader/ajaxfileupload.js"></script>
<script language="javascript">
$(document).ready(function() {
	CKEDITOR.replace("newsContent", {
		width: 1000,
		height: 400
	});
});
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
						if(el=='contentUpload') {
							$("#contentPic").append("<p>" + data.data + "</p>");
						} else {
							$("#newsDisplayPic").val(data.data);
							$("#displayPicUpload_display").empty();
							$("#displayPicUpload_display").append('<img src="' + data.data + '" />');
						}
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