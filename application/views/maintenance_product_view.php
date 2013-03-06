<?php
$gameStatus = array(
	'0'		=>	'正式运营',
	'1'		=>	'内测',
	'2'		=>	'公测'
);
?>
<div id="content">
    <div id="main">
        <h1>产品管理</h1>
        <div class="pad20">
        	<table class="fullwidth" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <td width="10%">编号</td>
                        <td width="20%">产品名称</td>
                        <td width="20%">版本号</td>
                        <td width="20%">运行平台</td>
                        <td width="10%">开放状态</td>
                        <td width="20%">操作</td>
                    </tr>
                </thead>
                <tbody>
                <?php if(!empty($result)): ?>
                	<?php for($i=0; $i<count($result); $i++): ?>
                    <tr<?php if($i%2==0): ?> class="odd"<?php endif; ?>>
                        <td><?php echo $result[$i]->game_id; ?></td>
                        <td><?php echo $result[$i]->game_name; ?></td>
                        <td><?php echo $result[$i]->game_version; ?></td>
                        <td><?php echo $result[$i]->game_platform; ?></td>
                        <td>
                        	<select id="gameStatus-<?php echo $result[$i]->game_id; ?>" title="<?php echo $result[$i]->game_id; ?>" class="change_game_status">
                            	<option value="0"<?php if($result[$i]->game_status=='0'): ?> selected="selected"<?php endif; ?>>正式运营</option>
                            	<option value="1"<?php if($result[$i]->game_status=='1'): ?> selected="selected"<?php endif; ?>>内测</option>
                            	<option value="2"<?php if($result[$i]->game_status=='2'): ?> selected="selected"<?php endif; ?>>公测</option>
                            </select>
                        </td>
                        <td><a href="?action=modify&id=<?php echo $result[$i]->game_id; ?>">编辑</a> | <a href="products/action?action=delete&id=<?php echo $result[$i]->game_id; ?>">删除</a></td>
                    </tr>
                    <?php endfor; ?>
                <?php else: ?>
                	<tr>
                    	<td colspan="3">没有产品</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="pad20">
            <!-- Form -->
            <form method="post" action="<?php echo $root_path ?>maintenance/products/submit">
                <!-- Fieldset -->
                <fieldset>
                    <legend>添加/修改产品</legend>
                    <input type="hidden" id="gameUpdate" name="gameUpdate" value="<?php echo $game_update; ?>" />
                    <input type="hidden" id="gameId" name="gameId" value="<?php echo $game_id; ?>" />
                    <p>
                        <label for="gameName">产品ID</label>
                        <input class="lf" name="gameIdNew" id="gameIdNew" type="text" value="<?php echo $game_id; ?>" />
                    </p>
                    <p>
                        <label for="gameName">产品名称</label>
                        <input class="lf" name="gameName" id="gameName" type="text" value="<?php echo $game_name; ?>" />
                    </p>
                    <p>
                        <label for="gameVersion">产品版本</label>
                        <input class="lf" name="gameVersion" id="gameVersion" type="text" value="<?php echo $game_version; ?>" />
                    </p>
                    <p>
                    	<label for="gamePlatform">运行平台</label>
                        <input class="lf" name="gamePlatform" id="gamePlatform" type="text" value="<?php echo $game_platform; ?>" />
                    </p>
                    <p>
                        <label for="PicSmall">上传LOGO(小)</label>
                        <input name="PicSmall" type="file" id="PicSmall" size="20" class="text-input" />
                        <input type="button" name="btn_upload" id="btn_upload" value="上传" onclick="javascript:contentPicUpload('PicSmall')" class="button" />
                        <input type="hidden" id="gamePicSmall" name="gamePicSmall" value="<?php echo $game_pic_small; ?>" />
                        <div id="gamePicSmall_displayer"></div>
                    </p>
                    <p>
                        <label for="PicMiddium">上传LOGO(中)</label>
                        <input name="PicMiddium" type="file" id="PicMiddium" size="20" class="text-input" />
                        <input type="button" name="btn_upload" id="btn_upload" value="上传" onclick="javascript:contentPicUpload('PicMiddium')" class="button" />
                        <input type="hidden" id="gamePicMiddium" name="gamePicMiddium" value="<?php echo $game_pic_middium; ?>" />
                        <div id="gamePicMiddium_displayer"></div>
                    </p>
                    <p>
                        <label for="PicBig">上传LOGO(大)</label>
                        <input name="PicBig" type="file" id="PicBig" size="20" class="text-input" />
                        <input type="button" name="btn_upload" id="btn_upload" value="上传" onclick="javascript:contentPicUpload('PicBig')" class="button" />
                        <input type="hidden" id="gamePicBig" name="gamePicBig" value="<?php echo $game_pic_big; ?>" />
                        <div id="gamePicBig_displayer"></div>
                    </p>
                    <p>
                    	<label for="gamePlatform">iPhone版下载地址</label>
                        <input class="lf" name="gameDownloadIphone" id="gameDownloadIphone" type="text" value="<?php echo $game_download_iphone; ?>" />
                    </p>
                    <p>
                    	<label for="gamePlatform">iPad版下载地址</label>
                        <input class="lf" name="gameDownloadIpad" id="gameDownloadIpad" type="text" value="<?php echo $game_download_ipad; ?>" />
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
<script language="javascript" src="<?php echo $root_path; ?>resources/js/uploader/ajaxfileupload.js"></script>
<script language="javascript">
$(function(){
	$("select.change_game_status").change(function() {
		var parameter = {
			"gameId":		$(this).attr("title"),
			"gameStatus":	$(this).val()
		};
		$.post("<?php echo $root_path ?>maintenance/products/change_status", parameter, onChangeCallback);
	});
});
function onChangeCallback(data) {
	if(data) {
		var json = eval("(" + data + ")");
		if(json.result=="API_PRODUCT_CHANGE_STATUS_SUCCESS") {
			showMessage("success", json.title, json.msg, true, 5000);
		} else {
			showMessage("error", json.title, json.msg, true, 5000);
		}
	}
}
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
						var notification = '<div style="display:none;" id="notification" class="message success close"><h2>' + data.msg + '</h2><p>已成功上传图片，路径为：' + data.data + '</p></div>';
						$("#main").prepend(notification);
						$("#notification").slideDown("normal");
						$("#game" + el).val(data.data);
						$("#game" + el + "_displayer").append('<img src="' + data.data + '" />');
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