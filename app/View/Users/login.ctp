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

			<div class="row">

				<div class="col-md-8 col-md-push-2">
					<h4 class="panel-heading">Đăng nhập</h4>
					<form role="form" enctype='multipart/form-data'
						action="/users/login" method="post">
						<div class="form-group">
							<label for="email">Email</label> <input name="User[email]"
								type="text" class="form-control" id="email"
								placeholder="Nhập email"
								value="<?php echo @$data['user']['email'];?>">
						</div>

						<div class="form-group">
							<label for="password">Mật khẩu</label> <input name="User[password]"
								type="password" class="form-control" id="password"
								placeholder="Nhập mật khẩu">
						</div>

						<button type="submit" class="btn btn-default">Đăng nhập</button>
					</form>
				</div>
			</div>

</div>
<script type='text/javascript'>
	function delete_user(id) {
	  	var answer = confirm("Có chắc bạn muốn xóa tài khoản này?");
	    if (answer){
	    	$.ajax({
	    		  type: "POST",
	    		  url: "/users/delete/"+id,
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
	
	function reset_pwd(id) {
	  	var answer = confirm("Có chắc bạn muốn reset mật khẩu của tài khoản này?");
	    if (answer){
	    	$.ajax({
	    		  type: "POST",
	    		  url: "/users/resetpwd/"+id,
	    		  }).done(function( msg ) {
		    		  if(msg == "OK"){
		    			  $("#error_message").html("<h5><span class='label label-success'>Reset mật khẩu thành công</span><h5>");  
		    			  
		    		  }
		    		  else{
			    		  $("#error_message").html("<h5><span class='label label-danger'>"+msg+"</span><h5>");
		    		  }
	    		  });
	    }
	}
</script>
