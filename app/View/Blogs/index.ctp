<div class="container">
	<p id="error_message">
		<?php 
			if(!empty($data['error'])){
		?>
			<h5><span class="label label-danger"><?php echo $data['error'];?></span><h5>
		<?php 
			}
		?>
		
		<?php 
			if(!empty($data['success'])){
		?>
			<h5><span class="label label-success"><?php echo $data['success'];?></span><h5>
		<?php 
			}
		?>
	</p>
	<div class="pagination-custom">
	<input id="current_page" name="current_page" type="hidden" value="0">
	<ul class="pagination" >
		
	</ul>
	</div>
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">Blog</div>
	
	  <!-- Table -->
	  <table id="table_blogs" class="table table-striped table-bordered table-condensed table-hover">
	  	<tr>
	  		<th width="5%">#</th>
	  		<th width="50%">Tiêu đề</th>
	  		<th width="30%">Danh mục</th>
	  		<th width="15%">Chỉnh sửa</th>
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
		  			<a href="/blogs/index/<?php echo $item['Blog']['id']?>" >Sửa</a> | 
		  			<a href="javascript:delete_blog(<?php echo $item['Blog']['id']?>)" >Xóa</a>
		  		</td>
		  	</tr>
	  	<?php }
			}?>
	  </table>
	  
	</div>
	
	<div class="row">
	<h4 class="panel-heading">Thêm\Chỉnh Sửa Blog</h4>
	<form id="post_blog" action="/blogs" method="post" role="form">
		<input name="id" type="hidden" class="form-control"	value="<?php echo @$data['blog']['id'];?>">
		<div class="form-group">
				<label for="title">Tiêu đề</label> 
				<input name="title" type="text" class="form-control" id="title" placeholder="Nhập tiêu đề"
						value="<?php echo @$data['blog']['title'];?>">
		</div>
		
		<div class="form-group">
			<label >Chọn danh mục</label>
			<select name="category_id" class="form-control">
				<?php 
				if(!empty($data['categories'])){
					$selectedCategory = @$data['blog']['category_id'];
					foreach ($data['categories'] as $cate){
						?>
						<option value="<?php echo $cate['Category']['id'];?>" 
							<?php if( $cate['Category']['id'] == $selectedCategory) echo 'selected="selected"'?>>
							<?php echo $cate['Category']['name'];?>
						</option>
						<?php 
					}
				}
				?>
			  	
			</select>
		</div>
		
		<div class="form-group">
			<textarea id="content" name="content"><?php echo @$data['blog']['content'];?></textarea>
		</div>
	    
	    <div class="form-group">
	    	<button type="submit" class="btn btn-default">Lưu lại</button>
	    	<button type="button" class="btn btn-default" onclick="reset()">Reset</button>
	    </div>
	    
	</form>
	</div>
</div>
<script type='text/javascript'>
	tinymce.init({
	    selector: "textarea",
	    theme: "modern",
	    height: 300,
	    plugins: [
	         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	         "save table contextmenu directionality emoticons template paste textcolor"
	   ],
	   content_css: "css/content.css",
	   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
	   /*style_formats: [
	        {title: 'Bold text', inline: 'b'},
	        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
	        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
	        {title: 'Example 1', inline: 'span', classes: 'example1'},
	        {title: 'Example 2', inline: 'span', classes: 'example2'},
	        {title: 'Table styles'},
	        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	    ]*/
	 });

	function reset(){
		$("#id").val('0');
		$('#title').val('');
		$("#category_id").val($("#category_id option:first").val());
		$('#content').val('');
		
	}
	 function get_content(){
		var content = tinyMCE.get('content').getContent();
		// var id = $("#id").value;
		// var title = $("#title").value; 
		 
		  var dataInput = { content: content };
		 
		 $.ajax({   
	        type: "POST",
	        data : dataInput,
	        cache: false,
	        url:  '/blogs/save',  
	    }).done(function( msg ) {
		    	if(msg == "OK"){
		    		$.colorbox.close();
		        }
		        else{
		        	alert(msg);
		        	// $.colorbox({html:msg});
		        }
			  });
		 
		 //alert(content);
	 }

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

	 function delete_blog(id) {
		  	var answer = confirm("Có chắc bạn muốn xóa blog này?");
		    if (answer){
		    	$.ajax({
		    		  type: "POST",
		    		  url: "/blogs/delete/"+id,
		    		  }).done(function( msg ) {
			    		  if(msg == "OK"){
			    			  location.reload();
			    			//  $("#error_message").html("<h5><span class='label label-danger'>Blog đã được xóa</span><h5>");
			    		  }
			    		  else{
				    		  $("#error_message").html("<h5><span class='label label-danger'>"+msg+"</span><h5>");
			    		  }
		    		  });
		    }
		}
</script>
