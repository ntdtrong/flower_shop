<div class="container main-container headerOffset" style="padding-top: 50px !important;"> 
	<!-- Main component call to action -->
	  
	<div class="row">
    	<div class="breadcrumbDiv col-lg-12">
      		<ul class="breadcrumb">
        		<li> <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'index')); ?>">Home</a> </li>
        	<?php foreach ($categories as $item): ?>
        		<?php if ($item['Category']['id'] == $data['category']): ?>
        		<li> <span><?php echo Utils::getRootCategoriesDisplay($item['Category']['parent']) ?></span> </li>
        		<li class="active"> <?php echo $item['Category']['name']; ?> </li>
        		<?php endif; ?>
        	<?php endforeach; ?>
      		</ul>
    	</div>
	</div>  <!-- /.row  --> 
  
	<div class="row">
	
		<!--right column-->
    	<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="row  categoryProduct xsResponse clearfix">
        
        	<?php if(!empty($data['flowers'])): ?>
				<?php foreach($data['flowers'] as $item): ?>
				<div class="item col-sm-4 col-lg-4 col-md-4 col-xs-6">
          			<div class="product">
						<div class="image">  
          					<a href="<?php echo $this->Html->url(array("controller" => "homes", "action" => "detail", $item['Flower']['id']));?>">
          						<?php echo $this->Html->image('thumb/' . $item['Flower']['thumb'], array('class' => 'img-responsive', 'alt' => $item['Flower']['name'], 'title' => $item['Flower']['name']));?>
          					</a>
            			</div>
            			<div class="description">
              				<h4><a href="<?php echo $this->Html->url(array("controller" => "homes", "action" => "detail", $item['Flower']['id']));?>"><?php echo $item['Flower']['name']; ?></a></h4>             
          				</div>
        			</div>
        		</div>
        		<!--/.item-->
        		<?php endforeach; ?>
			<?php endif; ?>
			</div> <!--/.categoryProduct || product content end-->
      		
      		<div class="pagination-custom">
				<?php echo $this->Paging->render( $pagingObj, $this->Html->url(array("controller" => "homes", "action" => "all")), '/'.$data['category']); ?>
			</div>
      	</div>
		</div> <!--/.categoryFooter-->
	</div><!--/right column end-->
	<style>
		.item {height: 370px;}
		.product {border: none;}
		.product:hover {border: none; border-bottom: 2px solid #9b59b6;}
		.image {max-height: 300px;}
		.image img {max-height: 300px;}
		.item h4 {margin: 20px 0 0; max-height: 80px; min-height: 25px;}
		.item h4 a {color: #601f6a;}
		.description {min-height: 25px;}
	</style>
</div>

