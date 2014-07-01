

	<div class="container">

		<ul class="products row">
			<?php 
			if(!empty($data['flowers'])){
					foreach($data['flowers'] as $item){
	
			?>
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
			
			<?php
					}
				}
			?>
		</ul>
		<div class="pagination-custom">
			<?php echo $this->Paging->render( $pagingObj, $this->Html->url(array("controller" => "homes", "action" => "all")), '/'.$data['category']); ?>
		</div>
	</div>
	
	 


<script type='text/javascript'>
        /*
        $(document).ready(function() {
            var listElement = $('#newStuff');
			var perPage = 9; 
			var numItems = listElement.children().size();
			var numPages = Math.ceil(numItems/perPage);

			$('.pagination').data("curr",0);

			var curr = 0;
			while(numPages > curr){
				if(curr == 0)
					$('<li class="paginate_button active"><a href="#" class="page_link ">'+(curr+1)+'</a></li>').appendTo('.pagination');
				else
					$('<li><a href="#" class="page_link ">'+(curr+1)+'</a></li>').appendTo('.pagination');
				curr++;
			}

			$('.pagination .page_link:first').addClass('active');

			listElement.children().css('display', 'none');
			listElement.children().slice(0, perPage).css('display', 'block');

			$('.pagination li a').click(function(){
			  var clickedPage = $(this).html().valueOf() - 1;
			  
			  goTo(clickedPage,perPage);
			});
			
			$('.pagination li').click(function(){
				$('.pagination li').attr( 'class', 'paginate_button' );
			  $(this).attr( 'class', 'paginate_button active' );
			});

			$('#categories_list a').click(function(){
				$('#categories_list a').attr( 'class', 'list-group-item' );
			  $(this).attr( 'class', 'list-group-item active' );
			});

			function previous(){
			  var goToPage = parseInt($('.pagination').data("curr")) - 1;
			  if($('.active').prev('.page_link').length==true){
				goTo(goToPage);
			  }
			}

			function next(){
			  goToPage = parseInt($('.pagination').data("curr")) + 1;
			  if($('.active_page').next('.page_link').length==true){
				goTo(goToPage);
			  }
			}

			function goTo(page){
			  var startAt = page * perPage,
				endOn = startAt + perPage;
			  
			  listElement.children().css('display','none').slice(startAt, endOn).css('display','block');
			  $('.pagination').attr("curr",page);
			}
        
        });
*/
        function delete_flower(url) {
  		  	var answer = confirm("Có chắc bạn muốn xóa giỏ hoa này?");
	  	    if (answer){
	  	    	window.location.replace(url);
	  	    }
	  	}
</script>
<!-- /.container -->

