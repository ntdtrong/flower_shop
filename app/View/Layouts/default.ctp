<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta charset="utf-8">
	<title>Flower Shop</title>
	<?php
		// load css cua bootstrap
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('shop-homepage');
		echo $this->Html->css('colorbox');
		
		echo $this->Html->script('jquery-1.11.1.min');
		echo $this->Html->script('jquery.colorbox-min');
		echo $this->fetch('script');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		
	?>
</head>
<body>
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
	                	<?php if (!empty($current_user) && ($current_user['role'] == ROLE_ADMIN || $current_user['role'] == ROLE_MANAGER)){ echo 'href="/companies"';}?> >
	                		<?php if(!empty($company)) echo $company['name'];?>
	                	</a></strong>
	            </div>
	
	            <!-- Collect the nav links, forms, and other content for toggling -->
	            <div class="collapse navbar-collapse navbar-ex1-collapse">
	                <ul class="nav navbar-nav">
	                    <li><a href="/homes"><strong>TRANG CHỦ</strong></a></li>
	                    <?php if (!empty($current_user) && ($current_user['role'] == ROLE_ADMIN || $current_user['role'] == ROLE_MANAGER)){?>
	                    <li><a href="/flowers"><strong>GIỎ HOA</strong></a></li>
	                    <li><a href="/categories"><strong>DANH MỤC</strong></a></li>
	                    <li><a href="/users/changepwd"><strong>ĐỔI MẬT KHẨU</strong></a></li>
	                    <?php if ($current_user['role'] == ROLE_ADMIN){?>
						<li><a href="/users"><strong>TÀI KHOẢN</strong></a></li>
						<?php }}?>
	                    <li><a href="/homes/contact"><strong>LIÊN HỆ</strong></a></li>
	                    
	                </ul>
	                <ul class="nav navbar-nav navbar-right">
	                	<?php if (!empty($current_user)){?>
	                	<li class="logout"><a href="/users/logout">THOÁT</a></li>
	                	<?php } else { ?>
	                	<li class="logout"><a href="/users/login">ĐĂNG NHẬP</a></li>
	                	<?php }?>
	                </ul>
	            </div>
	            <!-- /.navbar-collapse -->
	        </div>
	        <!-- /.container -->
	</nav>

	<?php echo $this->fetch('content'); ?>
	
	<div class="container">

        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Company 2014
                    </p>
                </div>
            </div>
        </footer>

    </div>
	
	<?php 
		echo $this->Html->script('bootstrap.min');
	?>
</body>
</html>
