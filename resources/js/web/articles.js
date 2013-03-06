$(document).ready(function() {
	$("#newsSubmit").click(function() {
		var newsTitle = $("#newsTitle").val();
		var newsChannel = $("#newsChannel").val();
		var newsCategory = $("#newsCategory").val();
		var newsContent = CKEDITOR.instances.newsContent.getData();
		if(!newsTitle) {
			alert("请填写新闻标题");
			return false;
		}
		if(newsChannel=="0" || newsChannel=="") {
			alert("请选择频道");
			return false;
		}
		if(!newsContent) {
			alert("请填写内容");
			return false;
		}
	});
	$("select.channelSelect").live("change", function() {
		var keyValue = $(this).val();
		if(keyValue!="-1" && keyValue!="") {
			$("#newsChannel").val(keyValue);
			$.post("../general_api/getChildByChannel", {
				id: keyValue,
				clickObjId: $(this).attr("title")
			}, channelCallback);
		}
	});
	$("#btn_add_channel").click(function() {
		$("#channel_container").slideDown('normal');
	});
});

function channelCallback (data) {
	var jsonData = eval("(" + data + ")");
	if(jsonData.field.length > 0) {
		var prevObj = parseInt(jsonData.prev);
		var prevP = $("#channel" + prevObj).parent();
		prevP.after("<p style='display:none;'></p>");
		var nextP = prevP.next("p");
		nextP.append('<label for="channel' + (prevObj+1) + '">' + (prevObj+1) + '级频道</label>');
		nextP.append('<select id="channel' + (prevObj+1) + '" name="channel' + (prevObj+1) + '" class="channelSelect" title="' + (prevObj+1) + '"></select>');
		
		$("#channel" + (prevObj+1)).empty();
		$("#channel" + (prevObj+1)).append("<option value=\"0\">未选择</option>");
		for(var i=0; i<jsonData.field.length; i++) {
			$("#channel" + (prevObj+1)).append("<option value=\"" + jsonData.field[i].id + "\">" + jsonData.field[i].name + "</option>");
		}
		nextP.slideDown("normal");
	}
}