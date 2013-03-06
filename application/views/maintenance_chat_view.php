<div id="content">
    <div id="main">
    
        <h1>聊天</h1>
        <div class="pad20" id="chat_content">
        	
        </div>
        
        <div class="pad20">
            <!-- Form -->
            <form method="post" action="">
                <!-- Fieldset -->
                <fieldset>
                    <legend>发送聊天信息</legend>
                    <p>
                    	<label for="section_server">选择游戏区服</label>
                        <select id="section_server">
                        	<option value="0">请选择</option>
                        <?php foreach($server_result as $row): ?>
                        	<option value="<?php echo $row->account_server_id; ?>" title="<?php echo $row->account_server_section; ?>" ip="<?php echo $row->server_ip; ?>" port="<?php echo $row->server_message_port; ?>"><?php echo $row->section_name . ' - ' . $row->server_name; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </p>
                    <p>
                        <label for="masterId">选择GM帐号</label>
                        <select id="masterId" name="masterId">
                        <?php foreach($result as $row): ?>
                        	<option value="<?php echo $row->master_id; ?>"><?php echo $row->master_name; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </p>
                    <p>
                    	<label for="chatContent">内容</label>
                        <textarea name="chatContent" id="chatContent" class="lf" cols="80" rows="4"></textarea>
                        <input id="btn_refresh" class="button" type="button" value="刷新" />
                    </p>
                    <p>
                        <input id="btn_submit" class="button" type="button" value="提交" />
                        <input class="button" type="reset" value="重置" />
                    </p>
                </fieldset>
                <!-- End of fieldset -->
            </form>
            <!-- End of Form -->
        </div>
    </div>
</div>
<script language="javascript" type="text/javascript" src="<?php echo $root_path; ?>resources/js/base64.js"></script>
<script language="javascript">
var serverIP = "";
var serverPort = "";
$(function() {
	$("#btn_refresh").click(function() {
		if($("#section_server").val()=='0') {
			showMessage("error", "错误", "请选择游戏区服", true, 5000);
		} else {
			var sectionId = $("#section_server").find("option:selected").attr("title");
			var serverId = $("#section_server").val();
			serverIP = $("#section_server").find("option:selected").attr("ip");
			serverPort = $("#section_server").find("option:selected").attr("port");
			var parameter = {
				"ip": serverIP,
				"port": serverPort,
				"server_section": sectionId,
				"server_id": serverId
			};
			$.post("<?php echo $root_path; ?>maintenance/chat/requestChatContent", parameter, onRefreshCallback);
		}
	});
});

function onRefreshCallback(data) {
	if(data) {
		var json = eval("(" + data + ")");
		var base64 = new Base64();
		for(var items in json.messages) {
			var content = base64.decode(json.messages[items].content);
			content = content.substr(0, content.indexOf("||^"));
			$("#chatContent").prepend(json.messages[items].from + ': ' + content + "\n\n");
		}
	}
}
</script>