<section class="content-header">
	  
	  <span >
	  	<span class="page-title">Giỏ Hoa</span>
	  	<small><i class="fa fa-angle-right"></i></small>
	  	<small class="dropdown page-title-sub" data-toggle="dropdown"><a href="#"><?php echo $data['category_name']; ?></a></small>
	  	<ul id="drop-category" class="dropdown-menu " role="menu">
	    <?php  
			if(!empty($data['categories'])){
                		foreach($data['categories'] as $cate){
						?>
			<li role="presentation">
				<a href="<?php echo $this->Html->url(array("controller" => "admin", "action" => "all", 1)).'/'.$cate['Category']['id']; ?>"
					role="menuitem" >
					<?php echo $cate['Category']['name'];?>
				</a>
			</li>
			<?php 
						}
                	}
            ?>
	  	</ul>
	</span>
	
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> Tạo giỏ hoa', array('controller' => 'flowers', 'action' => 'add'), array('escapeTitle' => false, 'class' => 'pull-right') ); ?>
</section>
<section class="content">

<div class="row">
	<div class="col-md-12">
		<div id="newStuff" class="row">
			<?php 
			if(!empty($data['flowers'])){
					foreach($data['flowers'] as $item){
	
			?>
			<div class="col-sm-3 col-lg-3 col-md-3">
				<div class="thumbnail" style="height: 415px;">
					<?php echo $this->Html->image('thumb/'. $item['Flower']['thumb'], array('alt' => '')); ?>
					<div class="caption">
						<p class="caption-header">
							<strong><?php echo $item['Flower']['name'];?> </strong>
						</p>
						<p style="display: none;" class="caption-money">
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
				else{
					echo '<div class="col-md-6"><h4>Chưa có giỏ hoa</h4></div>';
				}
			?>
		</div>
		
	</div>
	<div class="col-md-12">
		<div class="pagination">
			<?php echo $this->Paging->render( $pagingObj, $this->Html->url(array("controller" => "admin", "action" => "all")), '/'.$data['category']); ?>
		</div>
	</div>
	 
</div>
</section>
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

<style>
	#drop-category { margin-left: 120px;}
</style>

