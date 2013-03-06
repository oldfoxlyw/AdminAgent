<div id="header">
    <!-- Top -->
    <div id="top">
        <!-- Logo -->
        <div class="logo"> 
            <a href="<?php echo $root_path; ?>" title="管理首页" class="tooltip"><img src="<?php echo $root_path; ?>resources/assets/logo.png" alt="Wide Admin" /></a> 
        </div>
        <!-- End of Logo -->
        
        <!-- Meta information -->
        <div class="meta">
            <p>欢迎，<?php echo $user->user_name; ?><!--，<a href="#" title="1 new private message from Elaine!" class="tooltip">1 new message!</a>--></p>
            <ul>
                <li><a href="<?php echo $root_path; ?>login/out" title="退出登录" class="tooltip"><span class="ui-icon ui-icon-power"></span>退出登录</a></li>
                <!--
                <li><a href="#" title="改变平台关键设置（慎用）" class="tooltip"><span class="ui-icon ui-icon-wrench"></span>设置</a></li>
                <li><a href="#" title="帐号设置" class="tooltip"><span class="ui-icon ui-icon-person"></span>我的帐号</a></li>
                -->
            </ul>	
        </div>
        <!-- End of Meta information -->
    </div>
    <!-- End of Top-->

    <!-- The navigation bar -->
    <!--
    <div id="navbar">
        <ul class="nav">
            <li><a href="">管理首页</a></li>
            <li><a href="">网站内容管理</a></li>
            <li><a href="">运维数据管理</a></li>
            <li><a href="">市场数据分析</a>
            	<ul>
                    <li><a href="">Menu Link 1</a></li>
                    <li><a href="">Menu Link 2</a></li>
                    <li><a href="">Menu Link 3</a>
                        <ul>
                            <li><a href="">Menu Link 1</a></li>
                            <li><a href="">Menu Link 2</a>
                                <ul>
                                    <li><a href="">Menu Link 1</a></li>
                                    <li><a href="">Menu Link 2</a></li>
                                    <li><a href="">Menu Link 3</a></li>
                                </ul>
                            </li>
                            <li><a href="">Menu Link 3</a></li>
                            <li><a href="">Menu Link 4</a></li>
                            <li><a href="">Menu Link 5</a></li>
                            <li><a href="">Menu Link 6</a></li>
                        </ul>
                    </li>
                    <li><a href="">Menu Link 4</a></li>
                    <li><a href="">Menu Link 5</a></li>
                    <li><a href="">Menu Link 6</a></li>
                </ul>
            </li>
        </ul>
    </div>
    -->
    <!-- End of navigation bar" -->
    <!-- Search bar -->
    <!--
    <div id="search">
        <form action="/search/" method="POST">
            <p>
                <input type="submit" value="" class="but" />
                <input type="text" name="q" value="功能搜索" onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" />
            </p>
        </form>
    </div>
    -->
    <!-- End of Search bar -->

</div>