<div class="row">

	<div class="col-md-3">

		<div id="categories_list" class="list-group">
			<p class="list-group-item panel-heading-custom">
				<strong>Danh Mục</strong>
			</p>
			<?php  
			if(!empty($data['categories'])){
                		foreach($data['categories'] as $cate){
						?>
			<a href="<?php echo $this->Html->url(array("controller" => "admin", "action" => "all", 1)).'/'.$cate['Category']['id']; ?>"
				class="list-group-item <?php echo ($cate['Category']['id'] == $data['category'])?'active':''?>">
				<?php echo $cate['Category']['name'];?>
			</a>
			<?php 
						}
                	}
                	?>
		</div>
	</div>

	<div class="col-md-9">
		<div id="newStuff" class="row">
			<?php 
			if(!empty($data['flowers'])){
					foreach($data['flowers'] as $item){
	
			?>
			<div class="col-sm-4 col-lg-4 col-md-4">
				<div class="thumbnail">
					<?php echo $this->Html->image('thumb/'. $item['Flower']['thumb'], array('alt' => '')); ?>
					<div class="caption">
						<p class="caption-header">
							<strong><?php echo $item['Flower']['name'];?> </strong>
						</p>
						<p class="caption-money">
							<strong><?php echo number_format(floatval($item['Flower']['price'])); ?>
								VND</strong>
						</p>
						<p>
							<?php echo $item['Flower']['description'];?>
						</p>

					</div>
					<?php if (!empty($current_user) && ($current_user['role'] == ROLE_ADMIN || $current_user['role'] == ROLE_MANAGER)){?>
					<div class="flower-action">
						<a href="<?php echo $this->Html->url(array('controller' => 'flowers', 'action' => 'edit', $item['Flower']['id'])); ?>"><span
							class="glyphicon glyphicon-pencil"></span> </a> 
						<a href="javascript:delete_flower('<?php echo $this->Html->url(array('controller' => 'flowers', 'action' => 'delete', $item['Flower']['id']));?>')"><span
							class="glyphicon glyphicon-remove"></span> </a>
					</div>
					<?php }?>
				</div>
			</div>
			
			<?php
					}
				}
			?>
		</div>
		
	</div>
	
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
  		  	var answer = confirm("CÃ³ cháº¯c báº¡n muá»‘n xÃ³a giá»� hoa nÃ y?");
	  	    if (answer){
	  	    	window.location.replace(url);
	  	    }
	  	}
</script>
<!-- /.container -->
