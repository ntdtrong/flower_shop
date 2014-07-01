<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="underlined">Featured Flowers</h2>
		</div>
	</div>

	<ul class="products row">
	<?php if ( !empty($featured) && count($featured) > 0 ): ?>
	<?php foreach ($featured as $item): ?>
		<li class="product type-product status-publish has-post-thumbnail first col-lg-4 col-md-4 col-sm-6 col-xs-12 featured purchasable product-type-simple product-cat-tea-blends product-tag-black-tea instock">
			<a href="#"><img src="img/thumb/<?php echo $item['Flower']['thumb']; ?>" alt="" title="<?php echo $item['Flower']['name']; ?>"> </a>
			<div class="desc">
				<div class="desc-content">
					<div class="tea-type"><?php echo $item['Flower']['name']; ?></div>
					<a href="#" rel="nofollow" data-product_id="0" data-product_sku="" class="buy button add_to_cart_button product_type_simple">
						<!-- <i class="icon icon-cart"></i>
						<i class="icon hover icon-cart"></i>
						<i class="icon loading"></i> -->
						<span class="amount">
							<?php echo $this->Number->format($item['Flower']['price'],  array(
							    'places' => 0,
							    'before' => '$ ',
							    'escape' => false,
							    'decimals' => '',
							    'thousands' => '.'
							));?>
						</span>
					</a>
				</div>
			</div>
		</li>
	<?php endforeach; ?>
	<?php endif; ?>
	</ul><!-- END PRODUCTS -->
</div>

<div id="wrap_promo">
	<section id="promo" class="turquoise">
		<div id="inner-promo">
			<a href="#">
				<picture>
					<!--[if IE 9]><video style='display: none;'><![endif]-->
					<source srcset="img/banner/<?php echo $banner2['Banner']['image']?>" media="(min-width:768px)">
					<source srcset="img/banner_mobile.jpg" media="(max-width:767px)">
					<!--[if IE 9]></video><![endif]-->
					<img data-anchor-target="#wrap_promo" data-bottom-top="transform:scale(1.2) translate(0px, 36px);" data-top-bottom="transform:scale(1.2) translate(0px, -36px);" alt="Buy our new tea - Nuts for coco - today!" title="Buy our new tea - Nuts for coco - today!" src="img/banner/<?php echo $banner2['Banner']['image']?>" class="skrollable skrollable-before" style="-webkit-transform: scale(1.2) translate(0px, 36px);">
				</picture>
				<h2>Buy our new tea - Nuts for coco - today!</h2>
			</a>
		</div>
	</section>
</div>

