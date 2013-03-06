<div id="content">
    <div id="main">
        <h1>欢迎再次回来，<span><?php echo $user->user_name; ?></span>!</h1>
        <p>现在想做点什么？</p>
        <div class="pad20">
        <!-- Big buttons -->
            <ul class="dash">
                <li>
                    <a href="<?php echo $root_path; ?>content/webs" title="更改当前操作的网站" class="tooltip">
                        <img src="<?php echo $root_path; ?>resources/assets/icons/GiNUX_001.png" alt="" />
                        <span>网站列表</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $root_path; ?>/content/articles/add" title="添加一篇新的资料或新闻" class="tooltip">
                        <img src="<?php echo $root_path; ?>resources/assets/icons/8_48x48.png" alt="" />
                        <span>添加文章</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $root_path; ?>/content/articles/lists" title="查看最近添加的文章" class="tooltip">
                        <img src="<?php echo $root_path; ?>resources/assets/icons/GiNUX_021.png" alt="" />
                        <span>文章管理</span>
                    </a>
                </li>
                <li>
                    <a href="#" title="配置游戏区服信息" class="tooltip">
                        <img src="<?php echo $root_path; ?>resources/assets/icons/16_48x48.png" alt="" />
                        <span>区服信息</span>
                    </a>
                </li>
                <li>
                    <a href="#" title="战网点数管理" class="tooltip">
                        <img src="<?php echo $root_path; ?>resources/assets/icons/GiNUX_027.png" alt="" />
                        <span>战网点数</span>
                    </a>
                </li>
                <li>
                    <a href="#" title="GM游戏内公告快速通道" class="tooltip">
                        <img src="<?php echo $root_path; ?>resources/assets/icons/26_48x48.png" alt="" />
                        <span>GM聊天系统</span>
                    </a>
                </li>
            </ul>
            <!-- End of Big buttons -->
        </div>
        
    </div>
</div>