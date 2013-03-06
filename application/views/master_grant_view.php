<div id="content">
    <div id="main">
    
        <h1>发放道具</h1>
        <div class="pad20" id="chat_content">
        	
        </div>
        
        <div class="pad20">
            <!-- Form -->
            <form method="post" action="">
                <!-- Fieldset -->
                <fieldset>
                    <p>
                    	<label for="section_server">选择游戏区服</label>
                        <select id="section_server">
                        	<option value="0">请选择</option>
                        <?php foreach($server_result as $row): ?>
                        	<option value="<?php echo $row->account_server_id; ?>" title="<?php echo $row->account_server_section; ?>" ip="<?php echo $row->server_ip; ?>" port="<?php echo $row->server_port; ?>"><?php echo $row->section_name . ' - ' . $row->server_name; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </p>
                    <p>
                        <label for="accountId">玩家昵称</label>
                        <input class="mf" name="accountName" id="accountName" type="text" value="<?php echo $account_name; ?>" />
                    </p>
                    <p>
                    	<label for="itemType">物品类型</label>
                        <select id="itemType">
                        	<option value="1" <?php if($item_type=='1'): ?>selected="selected"<?php endif; ?>>资源</option>
                        </select>
                    </p>
                    <p>
                    	<label>物品</label>
                        <span>水晶：</span><input class="sf" name="crystal" id="crystal" type="text" value="0" />
                        <span>氚氢：</span><input class="sf" name="tritium" id="tritium" type="text" value="0" />
                        <span>暗物质：</span><input class="sf" name="broken_crystal" id="broken_crystal" type="text" value="0" />
                        <span>暗晶：</span><input class="sf" name="dark_crystal" id="dark_crystal" type="text" value="0" />
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
<script language="javascript">
var serverIP = "";
var serverPort = "";
$(function() {
	$("#btn_submit").click(function() {
		if($("#section_server").val()=='0') {
			showMessage("error", "错误", "请选择游戏区服", true, 5000);
		} else {
			var serverIP = $("#section_server").find("option:selected").attr("ip");
			var serverPort = $("#section_server").find("option:selected").attr("port");
			var accountName = $("#accountName").val();
			var sectionId = $("#section_server").find("option:selected").attr("title");
			var serverId = $("#section_server").val();
			var itemType = $("#itemType").val();
			var itemName = $("#itemName").val();
			var itemCount = $("#itemCount").val();
			var parameter = {
				"serverIp": serverIP,
				"serverPort": serverPort,
				"accountName": accountName,
				"sectionId": sectionId,
				"serverId": serverId,
				"itemType": itemType,
				"crystal": $("#crystal").val(),
				"tritium": $("#tritium").val(),
				"broken_crystal": $("#broken_crystal").val(),
				"dark_crystal": $("#dark_crystal").val(),
				"itemName": itemName,
				"itemCount": itemCount
			};
			$.post("<?php echo $root_path; ?>master/grant/submit", parameter, onRefreshCallback);
		}
	});
});

function onRefreshCallback(data) {
	if(data) {
		var json = eval("(" + data + ")");
		if(json.errors != '') {
			showMessage("error", "错误", '操作失败，' + json.errors, true, 5000);
		} else {
			showMessage("success", "成功", '操作成功', true, 5000);
		}
	}
}
</script>