<div class="container">
	<p  id="error_message">
	<?php 
		if(!empty($data['error'])){
	?>
		<h5><span class="label label-danger"><?php echo $data['error'];?></span><h5>
	<?php 
		}
	?>
	</p>
	
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">Danh mục</div>
	
	  <!-- Table -->
	  <table class="table table-striped table-bordered table-condensed table-hover">
	  	<tr>
	  		<th>#</th>
	  		<th>Tên danh mục</th>
	  		<th>Loại</th>
	  		<th>Hiển thị</th>
	  		<th>Chỉnh sửa</th>
	  	</tr>
		<?php 
			if(!empty($data['categories'])){
			$i = 0;
			foreach($data['categories'] as $item){
				$i++;
		?>
			<tr>
		  		<td><?php echo $i;?></td>
		  		<td><?php echo $item['Category']['name']?></td>
		  		<td><?php echo ( CATEGORY_TYPE_FLOWER == $item['Category']['type'])?'Giỏ hoa':'Blog'?></td>
		  		<td><?php echo ($item['Category']['is_active'])?'Có':'Không'?></td>
		  		<td>
		  			<a href="/categories/index/<?php echo $item['Category']['id']?>" >Sửa</a> | 
		  			<a href="javascript:delete_category(<?php echo $item['Category']['id']?>)" >Xóa</a>
		  		</td>
		  	</tr>
	  	<?php }
			}?>
	  </table>
	</div>
	

		
		<div class="row">
		  <div class="col-md-8 col-md-push-2">
		  	<h4 class="panel-heading">Thêm\Chỉnh Sửa Danh Mục</h4>
		  	<form role="form" enctype='multipart/form-data' action="/categories" method="post">
		  		<input name="id" type="hidden" class="form-control" value="<?php echo @$data['category']['id'];?>">
		  		<div class="form-group">
				    <label for="txtName">Tên danh mục</label>
				    <input name="name" type="text" class="form-control" id="txtName" placeholder="Nhập tên danh mục" value="<?php echo @$data['category']['name'];?>">
				</div>
				
				<div class="form-group">
					<label >Chọn loại danh mục</label>
					<select id="selector_type" name="type" class="form-control">
					  	<option value="<?php echo CATEGORY_TYPE_FLOWER;?>"
					  		<?php if( CATEGORY_TYPE_FLOWER == @$data['category']['type']) echo 'selected="selected"'?>>
					  		GIỎ HOA
					  	</option>
					  	<option value="<?php echo CATEGORY_TYPE_BLOG;?>" 
					  		<?php if(CATEGORY_TYPE_BLOG == @$data['category']['type']) echo 'selected="selected"'?>>
					  		BLOG
					  	</option>
					</select>
				</div>
				<div class="form-group">
					<label >Hiển thị</label>
					<select name="is_active" class="form-control">
					  	<option value="0" <?php if(empty($data['category']['is_active'])) echo 'selected="selected"'?>>Không</option>
					  	<option value="1" <?php if(!empty($data['category']['is_active'])) echo 'selected="selected"'?>>Có</option>
					</select>
				</div>
				
				<div class="form-group">
					<button class="btn btn-primary" type="submit" >Save!</button>
				</div>
		  	</form>
		  </div><!-- /.col-md-6 -->
		</div>

	
	
</div>
<script type='text/javascript'>
	function delete_category(id) {
		  var answer = confirm("Có chắc bạn muốn xóa danh mục này?");
	    if (answer){
	    	$.ajax({
	    		  type: "POST",
	    		  url: "/categories/delete/"+id,
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
/*
	$( "#selector_type" ).change(function() {
		var type = $(this).val();
		if(parseInt(type) == 1){
			$('#image_banner_panel').css('display', 'block');
		}
		else{
			$('#image_banner_panel').css('display', 'none');
		}
	});
*/
	
</script>
    