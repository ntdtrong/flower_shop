<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="underlined">Hoa nổi bật</h2>
		</div>
	</div>

	<ul class="products row">
	<?php if ( !empty($featured) && count($featured) > 0 ): ?>
	<?php foreach ($featured as $item): ?>
		<li style="padding: 0 5px;" class="product type-product status-publish has-post-thumbnail first col-lg-4 col-md-4 col-sm-4 col-xs-12 featured purchasable product-type-simple product-cat-tea-blends product-tag-black-tea instock">
			<a href="<?php echo $this->Html->url(array("controller" => "homes", "action" => "detail", $item['Flower']['id']));?>">
				<?php echo $this->Html->image('thumb/' . $item['Flower']['thumb'], array('alt' => $item['Flower']['name'], 'title' => $item['Flower']['name']));?>
			</a>
			<div class="desc">
				<div class="desc-content">
					<div class="tea-type"><?php echo $item['Flower']['name']; ?></div>
					<a style="display: none;" href="<?php echo $this->Html->url(array("controller" => "homes", "action" => "detail", $item['Flower']['id']));?>" rel="nofollow" data-product_id="0" data-product_sku="" class="buy button add_to_cart_button product_type_simple">
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
					<?php echo $this->Html->image('banner/' . $banner2['Banner']['image'], array(
						'data-anchor-target' => '#wrap_promo',
						'class' => "skrollable skrollable-before",
						'alt' => 'Buy flowers today, get back 5%',
						'title' => 'Buy flowers today, get back 5%'));?>
				</picture>
				<h2>Buy flowers today, get back 5%!</h2>
			</a>
		</div>
	</section>
</div>

