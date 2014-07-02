<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta charset="utf-8">
		<title>Flower Shop</title>
		<?php
			// load css cua bootstrap
			echo $this->Html->css('vendors/AdminLTE/bootstrap.min');
			echo $this->Html->css('vendors/AdminLTE/AdminLTE');
			
		?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	</head>
	<body class="skin-blue">
		<?php echo $this->fetch('content'); ?>
		<?php 
			echo $this->Html->script('admin/bootstrap.min');
		?>
	</body>
</html>
