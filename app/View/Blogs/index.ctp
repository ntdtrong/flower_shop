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
	<ul class="pagination" >
		
	</ul>
	<div class="row">
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
			<textarea name="content"><?php echo @$data['blog']['content'];?></textarea>
		</div>
	    
	    <div class="form-group">
	    	<button type="submit" class="btn btn-default">Lưu lại</button>
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
			var perPage = 1; 
			// var numItems = $('#newStuff tr').size();//listElement.children().size();
			var numItems  = $listElement.find('tbody tr').length - 1;
			var numPages = Math.ceil(numItems/perPage);
			var currentPage = 0;
			$('.pagination').data("curr",currentPage);
			var curr = 0;
			while(numPages > curr){
				$('<li><a href="#" class="page_link ">'+(curr+1)+'</a></li>').appendTo('.pagination');
				curr++;
			}

			//$('.pagination .page_link:first').addClass('active');
			//$listElement.find('tbody tr').hide();
			//$listElement.find('tbody tr').slice(0, perPage + 1).show();
			
			goTo(currentPage);

			$('.pagination li a').click(function(){
			  var clickedPage = $(this).html().valueOf() - 1;
			  
			  goTo(clickedPage,perPage);
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

			var maxPageShow = 10;
			function goTo(page){
			  	var startAt = page * perPage + 1,
				endOn = startAt + perPage;
			  	$listElement.find('tbody tr').hide().slice(startAt, endOn).show();
			  	$listElement.find('tbody tr').slice(0, 1).show();
			  	$('.pagination').attr("curr",page);

				if(numPages > maxPageShow && Math.abs((page%maxPageShow) - maxPageShow) <2 ){
					var startPage = page - Math.floor(maxPageShow/2) , endPage = startPage + maxPageShow;
					if(startPage < 0){
						startPage = 0;
						endPage = startPage + maxPageShow
					}
					else if(endPage >= numPages){
						endPage = numPages;
						startPage = endPage - maxPageShow;
					}

					$('.pagination').children().hide();
				  	$('.pagination').children().slice(startPage, endPage).show();
				}
				
			  	
			  	$('.pagination li').attr( 'class', 'paginate_button' );
			  	$('.pagination li:nth-child('+(page+1)+')').attr( 'class', 'paginate_button active' );
			}
     
     });
</script>
