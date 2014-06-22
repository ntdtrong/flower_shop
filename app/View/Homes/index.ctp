
<div class="container">
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
				<a href="/homes/index/<?php echo $cate['Category']['id']?>"
					class="list-group-item <?php echo ($cate['Category']['id'] == $data['category'])?'active':''?>">
					<?php echo $cate['Category']['name'];?>
				</a>
				<?php 
							}
                		}
                		?>
			</div>


			<div id="categories_list" class="list-group">
				<p class="list-group-item panel-heading-custom">
					<strong>Liên Hệ Đặt Hoa</strong>
				</p>
				<?php  
				if(!empty($company) && !empty($company['phone'])){
							$listPhone = explode("-", $company['phone']);
							foreach ($listPhone as $phone){
								?>
				<p class="list-group-item-custom">
					<?php echo trim($phone);?>
				</p>
				<?php 
							}
						}
						?>
			</div>
		</div>

		<div class="col-md-9">
			<?php if(!empty($data['banners'])) {?>
			<div class="row carousel-holder">

				<div class="col-md-12">
					<div id="carousel-example-generic" class="carousel slide"
						data-ride="carousel">
						<!--  
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                             -->
						<div class="carousel-inner">
							<?php
							$isFirst = true;
                            	foreach ($data['banners'] as $banner) {?>
							<div class="item <?php if($isFirst) echo "active" ?>">
								<img class="slide-image"
									src="/img/banner/<?php echo $banner['Banner']['image'] ?>"
									alt="">
								<div class="carousel-caption-custom">
									<p><?php echo $banner['Banner']['title'] ?></p>
								</div>
							</div>
							<?php
							$isFirst = false;
								}?>
							<!--
                                <div class="item">
                                    <img class="slide-image" src="/img/banner/banner_2.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                 -->
						</div>
						<a class="left carousel-control" href="#carousel-example-generic"
							data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span>
						</a> <a class="right carousel-control"
							href="#carousel-example-generic" data-slide="next"> <span
							class="glyphicon glyphicon-chevron-right"></span>
						</a>
					</div>
				</div>

			</div>
			<?php } ?>

			<div id="newStuff" class="row">
		<!-- 			
			<div class="col-sm-4 col-lg-4 col-md-4">	
				<ul class="enlarge">
					<li>
						<img src="/img/thumb/1402988820.jpg" width="150px"	height="100px" alt="Dechairs" />
						<span><img src="/img/image/1402988820.jpg" alt="Deckchairs" />
						<br />
							Deckchairs on Blackpool beach
						</span>
					</li>
					
				</ul>
			</div>
			 -->
				<?php 
				if(!empty($data['flowers'])){
						foreach($data['flowers'] as $item){
		
							?>
				<div class="col-sm-4 col-lg-4 col-md-4">
					<div class="thumbnail">
						<img src="/img/thumb/<?php echo $item['Flower']['thumb'];?>" alt="">
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
							<a href="/flowers/add/<?php echo $item['Flower']['id'];?>"><span
								class="glyphicon glyphicon-pencil"></span> </a> <a
								href="javascript:delete_flower(<?php echo $item['Flower']['id'];?>)"><span
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
			<ul class="pagination">

			</ul>
		</div>

	</div>

</div>

<script type='text/javascript'>
        
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

        function delete_flower(id) {
  		  	var answer = confirm("Có chắc bạn muốn xóa giỏ hoa này?");
	  	    if (answer){
	  	    	$.ajax({
	  	    		  type: "POST",
	  	    		  url: "/flowers/delete/"+id,
	  	    		  }).done(function( msg ) {
	  		    		  if(msg == "OK"){
	  		    			  location.reload();  
	  		    		  }
	  		    		  else{
	  			    		  $("#error_message").html("<h5><span class='label label-danger'>"+msg+"</span><h5>");
	  		    		  }
	  	    		  });
	  	    }
	  	}
	  	
        function show_flower(url) {
        	//$.colorbox({href:"/img/image/"+url});
        	$.colorbox({html:"<h1>Welcome</h1>"});
	  	}
</script>
<!-- /.container -->

