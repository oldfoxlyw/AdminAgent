$(document).ready(function() {
	$("#tbl_channel").find("tr > td.channel_name").live("click", function() {
		if(!$(this).parent().hasClass("loading")) {
			var id = $(this).parent().find("td").eq(0).text();
			
			if(!$(this).parent().next().hasClass("loading") && !$(this).parent().next().hasClass("child")) {
				$(this).parent().after('<tr id="child-' + id + '" class="loading"><td colspan="4">載入中...</td></tr>');
				var parameter = {
					"id": id
				};
				$.post("general_api/getChildByChannel", parameter, childCallback);
			}
			
			if($(this).parent().next().hasClass("child")) {
				$(this).parent().next().toggle();
			}
		}
	});
	
	var childCallback = function(data) {
		if(data) {
			var json = eval('(' + data + ')');
			var target = $("#child-" + json.father).find("td");
			if(json.field.length > 0) {
				target.empty();
				target.append('<table class="fullwidth" cellpadding="0" cellspacing="0" border="0"></table>');
				target.find("table").append('<thead></thead>');
				var thead = target.find("table").find("thead");
				thead.append('<td colspan="4">父级频道：' + $("#child-" + json.father).prev().find("td").eq(1).text() + '</td>');
				target.find("table").append('<tbody></tbody>');
				for(var i=0; i<json.field.length; i++) {
					target.find("table").find("tbody").append('<tr></tr>');
					var container = target.find("table").find("tbody").find("tr").eq(i);
					container.append('<td width="20%">' + json.field[i].id + '</td>');
					container.append('<td style="cursor:pointer;" class="channel_name" width="20%">' + json.field[i].name + '</td>');
					container.append('<td width="40%">' + json.field[i].url + '</td>');
					container.append('<td width="20%"><a href="javascript:addNewChannel(' + json.field[i].id + ", '" + json.field[i].name + "')\">添加子頻道</a> | <a href=\"?action=modify&id=" + json.field[i].id + '">編輯</a> | <a href="channels/action?action=delete&id=' + json.field[i].id + '">刪除</a></td>');
				}
			} else {
				target.text("沒有子頻道");
			}
			$("#child-" + json.father).addClass("child");
		}
	}
});

function addNewChannel(father, name) {
	$("#add_channel").slideUp('normal', function() {
		$("#channelFatherId").val(father);
		$("#father_name").text(name);
		$("#channelName").val('');
		$("#channelUrl").val('');
		$("#add_channel").slideDown('normal', function() {
			$("#channelName").focus();
		});
	});
}