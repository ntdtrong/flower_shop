<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <strong><a class="navbar-brand" 
                	<?php if (!empty($current_user) && ($current_user['role'] == ROLE_ADMIN)){ echo 'href='.$this->Html->url(array('controller' => 'companies', 'action' => 'index'));}?> >
                		<?php if(!empty($company)) echo $company['name'];?>
                	</a></strong>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'index')); ?>"><strong>TRANG CHỦ</strong></a></li>
                    <?php if (!empty($current_user) && ($current_user['role'] == ROLE_ADMIN || $current_user['role'] == ROLE_MANAGER)){?>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'flowers', 'action' => 'index')); ?>"><strong>GIỎ HOA</strong></a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'blogs', 'action' => 'index')); ?>"><strong>BLOG</strong></a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'categories', 'action' => 'index')); ?>"><strong>DANH MỤC</strong></a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'banners', 'action' => 'index')); ?>"><strong>BANNER</strong></a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'changepwd')); ?>"><strong>ĐỔI MẬT KHẨU</strong></a></li>
                    <?php if ($current_user['role'] == ROLE_ADMIN){?>
					<li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index')); ?>"><strong>TÀI KHOẢN</strong></a></li>
					<?php }}?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                	<?php if (!empty($current_user)){?>
                	<li class="logout"><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>">THOÁT</a></li>
                	<?php } else { ?>
                	<li class="logout"><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>">ĐĂNG NHẬP</a></li>
                	<?php }?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
</nav>