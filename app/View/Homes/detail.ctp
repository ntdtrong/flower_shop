<div class="container main-container headerOffset">
	
  	<div class="row transitionfx">
  
		<!-- left column -->
    	<div class="col-lg-6 col-md-6 col-sm-6">
    		<!-- product Image and Zoom -->
      		<div class="main-image sp-wrap col-lg-12 no-padding" style="display: inline-block;"> 
				<div class="sp-large" style="overflow: hidden; height: auto;">
					<a href="<?php echo $this->webroot; ?>img/image/<?php echo $item['Flower']['image']; ?>" class="" style="display: block;">
						<?php echo $this->Html->image('image/' . $item['Flower']['image'], array('class' => 'img-responsive', 'alt' => $item['Flower']['name'], 'title' => $item['Flower']['name']));?>
					</a>
				</div>
			</div>
   	 	</div><!--/ left column end -->
    
    
	    <!-- right column -->
	    <div class="col-lg-6 col-md-6 col-sm-5">
	    
			<h1 class="product-title"> <?php echo $item['Flower']['name']; ?></h1>
	      
	      	<div class="details-description">
	        	<p><?php echo $item['Flower']['description']; ?></p>
	      	</div>
	      
			<div class="clear"></div>
		
		</div><!--/ right column end -->
	    
	</div>
  	<!--/.row-->
	<div style="clear:both"></div>
	<style>
		.sp-large {max-width: 100%;}				
	</style>
</div>
