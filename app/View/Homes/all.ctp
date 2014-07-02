<div class="container">
	<div class="dropdown">
  		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
  			style="font-size: 1.2em;">
    		<span style="padding-left: 0.5em; padding-right: 0.6em;"><?php echo $data['categoryName']; ?></span> <span class="caret"></span>
  		</button>
  		<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    		<li role="presentation">
    			<a role="menuitem" tabindex="-1" href="<?php echo $this->Html->url(array("controller" => "homes", "action" => "all")); ?>">
    				Tất cả
    			</a>
    		</li>
    	<?php if(!empty($data['categories'])){
	        foreach($data['categories'] as $key => $value){ ?>
			<li role="presentation">
				<a role="menuitem" tabindex="-1" href="<?php echo $this->Html->url(array("controller" => "homes", "action" => "all", 1)).'/'.$key; ?>">
					<?php echo $value;?>
				</a>
			</li>
		<?php }} ?>
  		</ul>
	</div>
	<ul class="products row">
		<?php 
		if(!empty($data['flowers'])){
				foreach($data['flowers'] as $item){

		?>
		<li style="padding: 0 5px;" class="product type-product status-publish has-post-thumbnail first col-lg-4 col-md-4 col-sm-6 col-xs-12 featured purchasable product-type-simple product-cat-tea-blends product-tag-black-tea instock">
			<a href="#">
				<?php echo $this->Html->image('thumb/' . $item['Flower']['thumb'], array('alt' => $item['Flower']['name'], 'title' => $item['Flower']['name']));?>
			</a>
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
		
		<?php
				}
			}
		?>
	</ul>
	<div class="pagination-custom">
		<?php echo $this->Paging->render( $pagingObj, $this->Html->url(array("controller" => "homes", "action" => "all")), '/'.$data['category']); ?>
	</div>
</div>
<!-- /.container -->

