<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Flowers in Love</title>

		<!-- Bootstrap -->
		<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
		<?php
		echo $this->Html->css('include');
		echo $this->Html->css('app');
		
		echo $this->Html->script('vendor/modernizr.min.js');
		?>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- All JavaScript at the bottom, except for Modernizr / Respond.
       	Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       	For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
		
	
	</head>
	<body>
		<?php echo $this->element('navbar'); ?>
		
		<div id="skrollr-body" class="main-wrapper">
			<main id="content" role="main">
				
				<?php echo $this->fetch('content'); ?>

				<footer id="footer" class="clearfix">
					<div id="top-footer">
						<div class="container">
							<div class="row">
								<div class="col-lg-6 col-md-6 instagram-block">
									<div class="top"></div>
									<h2 class="title-instagram">
										<i class="icon icon-instagram"></i>
										<span class="inner">Instagram <span class="rochester">Beauties</span></span>
									</h2>
									<div id="instagram-container">
										<a href="#" target="_blank" class="instagram-image">
											<?php echo $this->Html->image('thumb/1404138174.jpg', array());?>
										</a>
										<a href="#" target="_blank" class="instagram-image">
											<?php echo $this->Html->image('thumb/1404138187.jpg', array());?>
										</a>
										<a href="#" target="_blank" class="instagram-image">
											<?php echo $this->Html->image('thumb/1404138209.jpg', array());?>
										</a>
									</div>
									<a href="#" target="_blank" class="mbt-button primary">See more</a>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div id="talking-about-us">
										<h2>Talking about us</h2>
										<h3>Trinkets and Trends</h3>
										<p>
											I am such a tea fanatic …
										</p>
										<p>
											<a class="mbt-button" target="_blank" href="#">View article</a>
										</p>
										<h3>@jesssouthern Instagram</h3>
										<p>
											Absolutely in love with the tea from @mybeautytea …
										</p>
										<p>
											<a class="mbt-button" target="_blank" href="#">view Picture</a>
										</p>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div id="contact-us">
										<h2>Contact us</h2>
										<p>
											For questions or comments please do not hesitate to contact us !
										</p>
										<a href="mailto:info@mybeautytea.com" class="mbt-button primary">info@mybeautytea.com</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div id="bottom-footer" class="clearfix">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<div id="footer-nav">
										<ul id="menu-footer" class="menu">
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-name-teas">
												<a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'shop')); ?>">Hoa</a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-name-about">
												<a href="#">Giới thiệu</a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-name-contact">
												<a href="#">Tin Tức</a>
											</li>
											<li class="menu-item menu-item-type-post_type menu-item-object-page menu-name-faq">
												<a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'contact')); ?>">Liên Hệ</a>
											</li>
										</ul>
										<ul class="footer-meta-nav">
											<li class="active">
												<a href="#"><span>Tiếng Việt</span></a>
											</li>
											<li>
												<a href="#"><span>English</span></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="row credits">
								<div class="col-lg-12">
									<div id="credits">
										Flowersinlove © 2014
										<br>
										Made by <a target="_blank" href="#">Diep Nguyen</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</footer><!-- END FOOTER -->
				
			</main> <!-- END MAIN -->

		</div> <!-- END WRAPPER -->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<?php
		echo $this->Html->script('bootstrap.min.js');
		echo $this->Html->script('vendor/skrollr.min.js');
		echo $this->Html->script('include.js');
		echo $this->Html->script('app.js');
		?>
	</body>
</html>