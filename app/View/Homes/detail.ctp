<div class="container">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-push-2">
			<li class="product type-product status-publish has-post-thumbnail first featured purchasable product-type-simple product-cat-tea-blends product-tag-black-tea instock">
				<a class='inline' href="#inline_content">
					<?php echo $this->Html->image('thumb/' . $item['Flower']['thumb'], array('alt' => $item['Flower']['name'], 'title' => $item['Flower']['name']));?>
				</a>
			</li>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-push-2">
			<li class="product">
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
				<div class="description-type"><?php echo $item['Flower']['description']; ?></div>
			</li>
		</div>
	
		<div style='display:none'>
			<div id='inline_content' style='padding:10px; background:#fff;'>
				<li class="product type-product status-publish has-post-thumbnail first featured purchasable product-type-simple product-cat-tea-blends product-tag-black-tea instock">
					<?php echo $this->Html->image('image/' . $item['Flower']['image'], array('alt' => $item['Flower']['name'], 'title' => $item['Flower']['name']));?>
				</li>
				<p style='padding:10px; text-align:center;'>
					<strong><?php echo $item['Flower']['name']; ?></strong>
				</p>
			</div>
		</div>
	</div>
</div>
<script>
			$(document).ready(function(){
				$(".inline").colorbox({inline:true, width:"50%"});
				
			});
		</script>
