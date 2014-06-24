<div class="row">
	<h4 class="panel-heading">Chỉnh Sửa Blog</h4>
	<?php echo $this->Form->create('Blog', array('action' => 'edit/'.@$data['blog']['id'], 'type' => 'post', 'enctype' => 'multipart/form-data')); ?>
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
	<?php echo $this->Form->end(); ?>
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
</script>
