<!-- 
<div class="pagination-custom">
	<input id="current_page" name="current_page" type="hidden" value="0">
	<ul class="pagination" ></ul>
</div>
 -->
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
  	<strong>Blogs</strong>
	<?php echo $this->Html->link('Tạo blogs', array('controller' => 'blogs', 'action' => 'add'), array('escapeTitle' => false, 'class' => 'pull-right') ); ?>
  </div>

  <!-- Table -->
  <table id="table_blogs" class="table table-striped table-bordered table-condensed table-hover">
  	<tr>
  		<th width="5%">#</th>
  		<th width="50%">Tiêu đề</th>
  		<th width="30%">Danh mục</th>
  		<th width="15%">Tùy chọn</th>
  	</tr>
	<?php 
		if(!empty($data['blogs'])){
		$i = 0;
		foreach($data['blogs'] as $item){
			$i++;
	?>
		<tr>
	  		<td><?php echo $i;?></td>
	  		<td><?php echo $item['Blog']['title']?></td>
	  		<td><?php echo $item['Category']['name']?></td>
	  		<td>
	  			<a href="<?php echo $this->Html->url(array('controller' => 'blogs', 'action' => 'edit', $item['Blog']['id'])); ?>" >Chỉnh sửa</a> | 
	  			<a href="javascript:delete_blog('<?php echo $this->Html->url(array('controller' => 'blogs', 'action' => 'delete', $item['Blog']['id'])); ?>')" >Xóa</a>
	  		</td>
	  	</tr>
  	<?php }
		}?>
  </table>

</div>
<div class="pagination-custom">
	<?php echo $this->Paging->render( $pagingObj, $this->Html->url(array("controller" => "blogs", "action" => "all")),'' ); ?>
</div> 
 
<script type='text/javascript'>
/*
	 $(document).ready(function() {
         var $listElement = $('#table_blogs');
			var perPage = 10; 
			var maxPageShow = 5;
			var numItems  = $listElement.find('tbody tr').length - 1;
			var numPages = Math.ceil(numItems/perPage);
			var currentPage = $('#current_page').val();
			$('.pagination').attr("curr",currentPage);
			var curr = 0;
			$('<li id="paging_pre"><a href="#" class="page_link ">Pre</a></li>').appendTo('.pagination');
			while(numPages > curr){
				$('<li><a href="#" class="page_link ">'+(curr+1)+'</a></li>').appendTo('.pagination');
				curr++;
			}
			$('<li id="paging_next"><a href="#" class="page_link ">Next</a></li>').appendTo('.pagination');
			//$('.pagination .page_link:first').addClass('active');
			//$listElement.find('tbody tr').hide();
			//$listElement.find('tbody tr').slice(0, perPage + 1).show();
			
			goTo(currentPage);
			$('.pagination').children().hide();
			$('.pagination').children().slice(0, maxPageShow + 1).show();
			$('.pagination').children().slice(numPages + 1, numPages + 2).show();

			$('.pagination li a').click(function(){
				var value = $(this).html().valueOf();
				if(value == "Pre"){
					previous();
				}
				else if(value == "Next"){
					next();
				}
				else{
					 var clickedPage = value - 1;
					 goTo(clickedPage);
				} 
			});
			
			

			function previous(){
				var goToPage = (parseInt($('#current_page').val()) - 1)|0;
			  	if(goToPage <= 0){
			  		goToPage = 0;
			  		$('#paging_pre').attr('class', 'disabled');
			  		
				}
			  	$('#current_page').val(goToPage);
			 	goTo(goToPage);

			 	if(numPages > maxPageShow && (goToPage % maxPageShow) == (maxPageShow - 1) && goToPage >= (maxPageShow - 1)){
					var endPage = goToPage + 2, startPage = endPage - maxPageShow;
					$('.pagination').children().hide();
					$('.pagination').children().slice(0, 1).show();
					$('.pagination').children().slice(numPages + 1, numPages + 2).show();
				  	$('.pagination').children().slice(startPage, endPage).show();
				}
			}

			function next(){
			  	var goToPage = (parseInt($('#current_page').val()) + 1)|0;
			  	if(goToPage >= numPages - 1){
			  		goToPage = numPages - 1;
			  		$('#paging_next').attr('class', 'disabled');
			  		
				}
			  	$('#current_page').val(goToPage);
			 	goTo(goToPage);

//			 	.pagination : index from 0 -> numPager + 1;
//				goToPage = 0 => page show is page 1
			 	if(numPages > maxPageShow && (goToPage % maxPageShow) == 0 && goToPage < numPages){
					var startPage = goToPage + 1 , endPage = startPage + maxPageShow;
					if(endPage > numPages)
						endPage = numPages + 1;
					$('.pagination').children().hide();
					$('.pagination').children().slice(0, 1).show();
					$('.pagination').children().slice(numPages + 1, numPages + 2).show();
				  	$('.pagination').children().slice(startPage, endPage).show();
				}
			 	
			}

			
			function goTo(page){
			  	var startAt = page * perPage + 1,
				endOn = startAt + perPage;
			  	$listElement.find('tbody tr').hide().slice(startAt, endOn).show();
			  	$listElement.find('tbody tr').slice(0, 1).show();
			  	$('.pagination').attr("curr",page);
			  	$('#current_page').val(page);
			  	$('.pagination li').attr( 'class', 'paginate_button' );
			  	$('.pagination li:nth-child('+(page+2)+')').attr( 'class', 'paginate_button active' );
			}
     
     });
*/
	 function delete_blog(url) {
		  	var answer = confirm("Có chắc bạn muốn xóa blog này?");
		    if (answer){
		    	window.location.replace(url);
		    }
	}
</script>
