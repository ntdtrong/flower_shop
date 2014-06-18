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
	  <div class="panel-heading">Categories</div>
	
	  <!-- Table -->
	  <table class="table table-striped table-bordered table-condensed table-hover">
	  	<tr>
	  		<th>#</th>
	  		<th>Tên danh mục</th>
	  		<th>Làm banner</th>
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
		  		<td><?php echo ($item['Category']['is_banner'])?'Có':'Không'?></td>
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
		  	<form role="form" enctype='multipart/form-data' action="/categories/add" method="post">
		  		<input name="id" type="hidden" class="form-control" value="<?php echo @$data['category']['id'];?>">
		  		<div class="form-group">
				    <label for="txtName">Tên danh mục</label>
				    <input name="name" type="text" class="form-control" id="txtName" placeholder="Nhập tên danh mục" value="<?php echo @$data['category']['name'];?>">
				</div>
				<div class="form-group">
				<label >Chọn làm banner</label>
				<select class="form-control">
				  	<option value="0">Không</option>
				  	<option value="1">Có</option>
				</select>
				</div>
				
				<div class="form-group">
				    <label for="txtImage">Hình banner</label>
				    <input name="image" type="file" id="txtImage">
				    <p class="help-block">Chọn hình có độ phân giải 800x300.</p>
				 </div>
				
				<div class="form-group">
                	<img class="image-preview" src="/img/banner/banner_2.jpg" alt="">
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
</script>
    