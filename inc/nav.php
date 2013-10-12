<nav class="menu-wrapper">
    <ul class="menu-list">
        <li><a href="<?php echo MAIN_DOMAIN;?>">主页</a></li>
        <li><a href="<?php echo MAIN_DOMAIN;?>index_gaid.php">方格主页</a></li>
        <li><a href="<?php echo MAIN_DOMAIN;?>write.php">记下这一刻</a></li>
        <li><a href="<?php echo MAIN_DOMAIN;?>tag.php">标签</a></li>
        <li><a href="<?php echo MAIN_DOMAIN;?>aboutme.php">关于</a></li>
        <?php if(strcmp($admin,"record_admin") != 0){ ?>
        	<li><a href="<?php echo MAIN_DOMAIN;?>login.php">登录</a></li>
       <?php  }else{?>
            <li><a href="<?php echo MAIN_DOMAIN;?>logout.php">退出</a></li>
       <?php  } ?>
        
    </ul>
</nav>
