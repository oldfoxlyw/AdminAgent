$(function() {
	$("#game_id").change(function() {
		if($(this).val() != "0") {
			var parameter = {
				"game_id": $(this).val()
			};
			$.post("/AdminAgent/report/general_api/getSectionByGame", parameter, onSectionCallback);
		} else {
			$("#section_id").empty().append('<option value="0">全部</option>');
			$("#server_id").empty().append('<option value="0">全部</option>');
		}
	});
	$("#section_id").change(function() {
		if($(this).val() != "0") {
			var parameter = {
				"game_id": $("#game_id").val(),
				"section_id": $(this).val()
			};
			$.post("/AdminAgent/report/general_api/getServerByGameSection", parameter, onServerCallback);
		} else {
			$("#server_id").empty().append('<option value="0">全部</option>');
		}
	});
});

function onSectionCallback(data) {
	if(data) {
		var json = eval("(" + data + ")");
		$("#section_id").empty();
		$("#section_id").append('<option value="0">全部</option>');
		for(var i in json) {
			$("#section_id").append('<option value="' + json[i].server_section_id + '">' + json[i].section_name + '</option>');
		}
	}
}

function onServerCallback(data) {
	if(data) {
		var json = eval("(" + data + ")");
		$("#server_id").empty();
		$("#server_id").append('<option value="0">全部</option>');
		for(var i in json) {
			$("#server_id").append('<option value="' + json[i].account_server_id + '">' + json[i].server_name + '</option>');
		}
	}
}