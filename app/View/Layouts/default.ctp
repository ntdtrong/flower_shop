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
		echo $this->Html->script('tinymce/tinymce.min');
		echo $this->fetch('script');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		
	?>
</head>
<body>
	<?php echo $this->element('navbar_admin'); ?>
	<div class="container">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
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
