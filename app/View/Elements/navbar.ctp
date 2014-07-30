<nav id="mobile-nav" role="navigation">
	<ul>
		<!-- <li class="teas"><a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'index')); ?>">Home</a></li>
		<li class="teas"><a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'shop')); ?>">Hoa</a></li>
		<li class="about"><a href="#">Giới thiệu</a></li>
		<li class="press"><a href="#">Tin Tức</a></li> -->
		<li class="contact"><a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'contact')); ?>">Liên Hệ</a></li>
	</ul>
</nav>
	
<header id="header">
	<div id="top-header">
		<div class="container">
			<div class="row">
				<div id="free-shipping-pink" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="textwidget">
						<a href="#" id="btn_free_shipping"><span>Giao hàng miễn phí nội thành</span></a>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<ul id="menu-reseaux-sociaux" class="social-icons">
						<li class="instagram menu-item menu-item-type-custom menu-item-object-custom menu-name-instagram">
							<a target="_blank" href="#"><span>Instagram</span></a>
						</li>
						<li class="facebook menu-item menu-item-type-custom menu-item-object-custom menu-name-facebook">
							<a target="_blank" href="#"><span>Facebook</span></a>
						</li>
					</ul>
					<ul class="meta-nav langmenu">
						<li class="active">
							<a href="#"><span>Tiếng Việt</span></a>
						</li>
						<li>
							<a href="#"><span>English</span></a>
						</li>
					</ul>

				</div>
				<div id="free-shipping" class="col-lg-4 col-md-4">
					<div class="textwidget">
						<a href="#" id="btn_free_shipping"><span> Website hiện đang được nâng cấp... </span></a>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<!-- <ul class="meta-nav cart-menu" role="menu">
						<li class="cart">
							<a class="cart-contents" href="#"><span>0 items</span></a>
						</li>
						<li class="montant">
							<span class="amount">$0.00</span>
						</li>
					</ul> -->
				</div>
			</div>
		</div>
	</div>
	<div id="mid-header" role="navigation">
		<div class="container">
			<div class="row">
				<a id="mobile-logo" href="#" rel="home" class="visible-xs" title="Flowers in Love"
					style='font-family: "PlutoRegular","Lucida Grande","Lucida Sans Unicode","Lucida Sans",Geneva,Verdana,sans-serif;
						font-size: 1.2em;'>
					Flowers in Love
				</a>
				<a id="btn_open_nav" href="#header" class="mobile_toggle" title="Open main navigation">
					<span class="glyphicon glyphicon-th-list"></span>
				</a>
				<a id="btn_close_nav" href="#body" class="mobile_toggle" title="Close main navigation">
					<span class="glyphicon glyphicon-th-list"></span>
				</a>
				<nav id="main_nav" role="navigation">
					<ul id="menu-navigation-principale" class="menu">
						<!-- <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-name-shop skrollable skrollable-after" data-0="margin-top:85px;" data-300="margin-top:33px;" data-anchor-target="#mid-header" style="margin-top: 33px;">
							<a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'shop')); ?>">Hoa</a>
						</li>
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-name-about skrollable skrollable-after" data-0="margin-top:85px;" data-300="margin-top:33px;" data-anchor-target="#mid-header" style="margin-top: 33px;">
							<a href="#">Giới thiệu</a>
						</li> -->
						<li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item current_page_item menu-name-home skrollable skrollable-after" data-0="height:155px;" data-300="height:60px;" data-anchor-target="#mid-header" style="height: 60px;">
							<a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'contact')); ?>">Home</a>
						</li>
						<!-- <li class="menu-item menu-item-type-post_type menu-item-object-page menu-name-faq skrollable skrollable-after" data-0="margin-top:85px;" data-300="margin-top:33px;" data-anchor-target="#mid-header" style="margin-top: 33px;">
							<a href="#">Tin Tức</a>
						</li>
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-name-contact skrollable skrollable-after" data-0="margin-top:85px;" data-300="margin-top:33px;" data-anchor-target="#mid-header" style="margin-top: 33px;">
							<a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'contact')); ?>">Liên Hệ</a>
						</li> -->
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<?php if (isset($banner1)): ?>
	<div id="slider">
		<picture data-anchor-target="#slider" data-0="transform:translate(0px, 0px);" data-600="transform:translate(0px, 300px);" class="skrollable skrollable-between" style="-webkit-transform: translate(0px, 34px);">

			<!--[if IE 9]><video style='display: none;'><![endif]-->
			<source srcset="img/banner/<?php echo $banner1['Banner']['image']; ?>" media="(min-width:768px)">
			<source srcset="img/slide_home_mobile.jpg" media="(max-width:767px)">
			<!--[if IE 9]></video><![endif]-->
			
			<?php echo $this->Html->image('banner/' . $banner1['Banner']['image'], array('alt' => 'slide_home', 'title' => 'slide_home'));?>
		</picture>
	</div>
	<?php endif; ?>
</header>
<!-- END HEADER -->