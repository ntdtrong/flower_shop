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
	  <div class="panel-heading">Banners</div>
	
	  <!-- Table -->
	  <table class="table table-striped table-bordered table-condensed table-hover">
	  	<tr>
	  		<th>#</th>
	  		<th>Tiêu đề</th>
	  		<th>Hiển thị</th>
	  		<th>Chỉnh sửa</th>
	  	</tr>
		<?php 
			if(!empty($data['banners'])){
			$i = 0;
			foreach($data['banners'] as $item){
				$i++;
		?>
			<tr>
		  		<td><?php echo $i;?></td>
		  		<td><?php echo $item['Banner']['title']?></td>
		  		<td><?php echo ($item['Banner']['is_active'])?'Có':'Không'?></td>
		  		<td>
		  			<a href="/banners/index/<?php echo $item['Banner']['id']?>" >Sửa</a> | 
		  			<a href="javascript:delete_banner(<?php echo $item['Banner']['id']?>)" >Xóa</a>
		  		</td>
		  	</tr>
	  	<?php }
			}?>
	  </table>
	</div>
	

		
		<div class="row">
		  <div class="col-md-8 col-md-push-2">
		  	<h4 class="panel-heading">Thêm\Chỉnh Sửa Banner</h4>
		  	<form role="form" enctype='multipart/form-data' action="/banners" method="post">
		  		<input name="id" type="hidden" class="form-control" value="<?php echo @$data['banner']['id'];?>">
		  		<div class="form-group">
				    <label for="txtName">Tiêu đề</label>
				    <input name="title" type="text" class="form-control" id="txtName" placeholder="Nhập tiêu đề" value="<?php echo @$data['banner']['title'];?>">
				</div>
				
				<div class="form-group">
					<label >Hiển thị</label>
					<select name="is_active" class="form-control">
					  	<option value="1" <?php if(!empty($data['banner']['is_active'])) echo 'selected="selected"'?>>Có</option>
					  	<option value="0" <?php if(empty($data['banner']['is_active'])) echo 'selected="selected"'?>>Không</option>
					</select>
				</div>
				
				<div name="image" class="form-group">
				    <label for="txtImage">Hình banner</label>
				    <input name="image" type="file" id="txtImage">
				    <p class="help-block">Chọn hình có độ phân giải 800x300.</p>
				 </div>
				<?php if(!empty($data['banner']['image'])) {?>
				<div class="form-group">
                	<img class="image-preview" src="/img/banner/<?php echo $data['banner']['image'];?>" alt="">
				</div>
				<?php }?>
				
				<div class="form-group">
					<button class="btn btn-primary" type="submit" >Save</button>
				</div>
		  	</form>
		  </div><!-- /.col-md-6 -->
		</div>

	
	
</div>
<script type='text/javascript'>
	function delete_banner(id) {
		  var answer = confirm("Có chắc bạn muốn xóa banner này?");
	    if (answer){
	    	$.ajax({
	    		  type: "POST",
	    		  url: "/banners/delete/"+id,
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
    