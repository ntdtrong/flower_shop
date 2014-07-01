<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta charset="utf-8">
		<title>Flower Shop</title>
		<?php
			// load css cua bootstrap
			echo $this->Html->css('vendors/AdminLTE/bootstrap.min');
			echo $this->Html->css('vendors/AdminLTE/font-awesome.min');
			echo $this->Html->css('vendors/AdminLTE/ionicons.min');
			echo $this->Html->css('vendors/AdminLTE/AdminLTE');
			echo $this->Html->css('vendors/AdminLTE/custom');
			
		?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<?php 
			echo $this->Html->script('tinymce/tinymce.min');
		?>
	</head>
	<body class="skin-blue">
		<?php echo $this->element('admin_header'); ?>
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<?php echo $this->element('admin_menu_left'); ?>
			<aside class="right-side">
				<?php echo $this->fetch('content'); ?>
			</aside>
		</div>
		 
		<?php 
		//	echo $this->Html->script('admin/jquery-ui-1.10.3.min');
			echo $this->Html->script('admin/bootstrap.min');
		//	echo $this->Html->script('admin/AdminLTE/app');
		//	echo $this->Html->script('admin/AdminLTE/dashboard');
		//	echo $this->Html->script('admin/AdminLTE/demo');
		?>
	</body>
</html>
