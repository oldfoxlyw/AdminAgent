<div id="content">
    <div id="main">
    
        <h1>上传视频</h1>
        <div class="pad20">
        	<!-- Form -->
            <form method="post" action="<?php echo $root_path ?>content/media/submit">
                <!-- Fieldset -->
                <fieldset>
                    <legend>添加/修改视频</legend>
                    <input type="hidden" id="mediaUpdate" name="mediaUpdate" value="<?php echo $media_update; ?>" />
                    <input type="hidden" id="mediaId" name="mediaId" value="<?php echo $media_id; ?>" />
                    <input type="hidden" id="mediaType" name="mediaType" value="1" />
                    <p>
                        <label for="contentUpload">视频代码</label>
                        <textarea name="mediaUrlContainer" id="mediaUrlContainer" class="wysiwyg" cols="80" rows="4"><?php echo $media_url; ?></textarea>
                    </p>
                    <p>
                        <label for="mediaPicSmall">上传缩略图</label>
                        <input name="mediaPicSmall" type="file" id="mediaPicSmall" size="20" class="text-input" />
                        <input type="button" name="btn_upload" id="btn_upload" value="上传" onclick="javascript:contentPicUpload('mediaPicSmall')" class="button" />
                        <input type="hidden" id="mediaPicSmallContainer" name="mediaPicSmallContainer" value="<?php echo $media_pic_small; ?>" />
                        <div id="mediaPicSmall_displayer"></div>
                    </p>
                    <p>
                        <label for="mediaTitle">标题</label>
                        <input class="lf" name="mediaTitle" id="mediaTitle" type="text" value="<?php echo $media_title; ?>" />
                    </p>
                    <p>
                        <label>描述</label>
                        <textarea name="mediaComment" id="mediaComment" class="wysiwyg" cols="80" rows="4"><?php echo $media_comment; ?></textarea>
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
	CKEDITOR.replace("mediaComment", {
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
						$("#" + el + 'Container').val(data.data);
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