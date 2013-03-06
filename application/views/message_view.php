<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <!-- Meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php echo $meta_data; ?>
        <!-- End of Meta -->
        
        <!-- Page title -->
        <title>Wide Admin</title>
        <!-- End of Page title -->
        
        <!-- Libraries -->
        <link type="text/css" href="<?php echo $root_path; ?>resources/css/layout.css" rel="stylesheet" />
        <!-- End of Libraries -->
	</head>
	<body>
		<!-- Container -->
		<div id="container">
            <!-- Header -->
            <div id="header">
                <!-- Top -->
                <div id="top">
                    <!-- Logo -->
                    <div class="logo"> 
                        <a href="#" title="Administration Home" class="tooltip"><img src="<?php echo $root_path; ?>resources/assets/logo.png" alt="Wide Admin" /></a> 
                    </div>
                    <!-- End of Logo -->
                </div>
                <!-- End of Top-->
            </div>
            <!-- End of Header -->
            
            <!-- Background wrapper -->
            <div id="bgwrap">
                <!-- Main Content -->
                <div style="width:100%;padding-bottom:100px;">
                    <div style="margin:0 30px;padding-top:50px;">
                    	<div class="pad20" style="margin:0 auto;">
                        	<div class="message warning close">
                                <h2>信息</h2>
                                <p><?php echo $message; ?></p>
                                <p><?php echo $returned; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
                
            </div>
            <!-- End of bgwrap -->
		</div>
		<!-- End of Container -->
		
		<!-- Footer -->
		<div id="footer">
            <p class="mid">
                <a href="#" title="回到顶部" class="tooltip">回顶部</a>&middot;<a href="#" title="管理首页" class="tooltip">管理首页</a>&middot;<a href="#" title="更改当前设置" class="tooltip">设置</a>&middot;<a href="<?php echo $root_path; ?>login/out" title="退出登录" class="tooltip">退出登录</a>
            </p>
            <p class="mid">
                <!-- Change this to your own once purchased -->
                &copy; Digiarty 2012. All rights reserved.
                <!-- -->
            </p>
        </div>
		<!-- End of Footer -->
	</body>
</html>


