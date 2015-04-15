<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->webroot; ?>ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->webroot; ?>ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->webroot; ?>ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="<?php echo $this->webroot; ?>apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="<?php echo $this->webroot; ?>ico/favicon.png">
		<title>Flowers in Love</title>
		<!-- Bootstrap core CSS -->
		<?php echo $this->Html->css('bootstrap'); ?>
		
		<!-- Custom styles for this template -->
		<?php echo $this->Html->css('style'); ?>
		
		<!-- css3 animation effect for this template -->
		<?php echo $this->Html->css('animate.min'); ?>
		
		<!-- styles needed by carousel slider -->
		<?php echo $this->Html->css('owl.carousel'); ?>
		<?php echo $this->Html->css('owl.theme'); ?>
		
		<!-- styles needed by checkRadio -->
		<?php echo $this->Html->css('ion.checkRadio'); ?>
		<?php echo $this->Html->css('ion.checkRadio.cloudy'); ?>
		
		<!-- styles needed by mCustomScrollbar -->
		<?php echo $this->Html->css('jquery.mCustomScrollbar'); ?>
		
		<!-- Just for debugging purposes. -->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<style>
			.footer {background-color: #9b59b6; border-bottom: none;}
			.footer h3 {border-bottom: 1px solid #f2f2f2;}
			.footer h3, .footer h4, .footer h5, .footer a {color: #f2f2f2;}
			.footer a:hover {color: #601782;}
			.social li {background: none repeat scroll 0 0 #f2f2f2; border: 2px solid #f2f2f2;}
			.social li a i {color: #9b59b6 !important;}
			.social li a:hover i {color: #f2f2f2 !important;}
			.footer-bottom {background-color: #9b59b6; border-top: none;}
			.footer-bottom p {color: #f2f2f2;}
			.breadcrumb li a, .breadcrumb li span {color: #9b59b6 !important;}
		</style>
	</head>
	<body>
		<?php echo $this->element('navbar'); ?>
		
		<?php echo $this->fetch('content'); ?>
				
		<footer>
		  <div class="footer" id="footer">
		    <div class="container">
		      <div class="row">
		        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
		          <h3> Liên Hệ </h3>
		          <ul>
		            <li class="supportLi">
		              <h5> 16 Nguyễn Quý Cảnh, P. An Phú, Quận 2, TP.HCM </h5>
		              <h5> <a class="inline" href="callto:0862810328"> <strong> <i class="fa fa-phone"> </i> (08) 6281.0328 - 0909.781.099 - 0903.749.989</strong> </a> </h5>
		              <h4> <a class="inline" href="mailto:flowersinlove.info@gmail.com"> <i class="fa fa-envelope-o"> </i> flowersinlove.info@gmail.com </a> </h4>
		            </li>
		          </ul>
		        </div>
		        <div class="col-lg-4  col-md-4 col-sm-6 col-xs-6">
		          <h3> Trang Chính </h3>
		          <ul>
		            <li> <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'index')); ?>"> Trang Chủ </a> </li>
		            <li> <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'shop')); ?>"> Sản Phẩm </a> </li>
		            <li> <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'about')); ?>"> Giới thiệu </a> </li>
     				<li> <a href="#">Tin Tức</a> </li>
					<li> <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'contact')); ?>">Liên Hệ</a> </li>
		          </ul>
		        </div>
		        <div class="col-lg-3  col-md-3 col-sm-12 col-xs-12 ">
		          <h3> Kết Nối </h3>
		          <ul class="social">
		            <li> <a href="https://www.facebook.com/profile.php?id=100007818017096&fref=ts" target="_blank"> <i class=" fa fa-facebook"> &nbsp; </i> </a> </li>
		          </ul>
		        </div>
		      </div>
		      <!--/.row--> 
		    </div>
		    <!--/.container--> 
		  </div>
		  <!--/.footer-->
  
		  <div class="footer-bottom">
		    <div class="container">
		      <p class="pull-left"> &copy; Flowers in Love 2054. All right reserved. </p>
		    </div>
		  </div>
		  <!--/.footer-bottom--> 
		</footer>
		
		<!-- Placed at the end of the document so the pages load faster -->
		<?php echo $this->Html->script('jquery/1.8.3/jquery.js');?>
		<?php echo $this->Html->script('bootstrap.min.js');?>
		
		<!-- include jqueryCycle plugin --> 
		<?php echo $this->Html->script('jquery.cycle2.min.js');?>
		
		<!-- include easing plugin -->
		<?php echo $this->Html->script('jquery.easing.1.3.js');?>
		
		<!-- include  parallax plugin --> 
		<?php echo $this->Html->script('jquery.parallax-1.1.js');?>
		
		<!-- optionally include helper plugins -->
		<?php echo $this->Html->script('helper-plugins/jquery.mousewheel.min.js');?>
		
		<!-- include mCustomScrollbar plugin //Custom Scrollbar  --> 
		<?php echo $this->Html->script('jquery.mCustomScrollbar.js');?> 
		
		<!-- include checkRadio plugin //Custom check & Radio  --> 
		<?php echo $this->Html->script('ion.checkRadio.min.js');?>
		
		<!-- include grid.js // for equal Div height  -->
		<?php echo $this->Html->script('grids.js');?> 
		
		<!-- include carousel slider plugin  --> 
		<?php echo $this->Html->script('owl.carousel.min.js');?>
		
		<!-- jQuery minimalect // custom select   -->
		<?php echo $this->Html->script('jquery.minimalect.min.js');?>
		
		<!-- include touchspin.js // touch friendly input spinner component   -->
		<?php echo $this->Html->script('bootstrap.touchspin.js');?>
		
		<!-- include custom script for only homepage  --> 
		<?php echo $this->Html->script('home.js');?>
		<!-- include custom script for site  --> 
		<?php echo $this->Html->script('script.js');?>

		<!-- Google Tag Manager -->
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5W84WJ"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-5W84WJ');</script>
		<!-- End Google Tag Manager -->
	</body>
</html>