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
				<div class="panel-heading">Tài khoản</div>

				<!-- Table -->
				<table
					class="table table-striped table-bordered table-condensed table-hover">
					<tr>
						<th>#</th>
						<th>Họ Tên</th>
						<th>Email</th>
						<th>Thay đổi</th>
					</tr>
					<?php 
					if(!empty($data['users'])){
			$i = 0;
			foreach($data['users'] as $item){
				$i++;
				?>
					<tr>
						<td><?php echo $i;?>
						</td>
						<td><?php echo $item['User']['first_name'].' '.$item['User']['last_name']; ?>
						</td>
						<td><?php echo $item['User']['email']; ?>
						</td>
						<td>
							<a href="/users/index/<?php echo $item['User']['id']; ?>">Chỉnh sửa</a> | 
							<a href="javascript:delete_user(<?php echo $item['User']['id']?>)">Xóa</a> | 
							<a href="javascript:reset_pwd(<?php echo $item['User']['id']?>)">Reset mật khẩu</a>
						</td>
					</tr>
					<?php 
			}
		}
		?>
				</table>
			</div>



			<div class="row">

				<div class="col-md-8 col-md-push-2">
					<h4 class="panel-heading">Tạo tài khoản</h4>
					<form role="form" enctype='multipart/form-data'
						action="/users" method="post">
						<input name="id" type="hidden" class="form-control"
							value="<?php echo @$data['user']['id'];?>">

						<div class="form-group">
							<label for="email">Email</label> <input name="email"
								type="text" class="form-control" id="email"
								placeholder="Nhập email"
								value="<?php echo @$data['user']['email'];?>">
						</div>
<!-- 
						<div class="form-group">
							<label for="password">Mật khẩu</label> <input name="password"
								type="password" class="form-control" id="password"
								placeholder="Nhập mật khẩu">
						</div>


						<div class="form-group">
							<label for="password_confirm">Xác nhận mật khẩu</label> <input
								name="password_confirm" type="password" class="form-control" id="password_confirm"
								placeholder="Nhập lại mật khẩu">
						</div>

 -->
						<div class="form-group">
							<label for="first_name">Họ</label> <input name="first_name" type="text"
								class="form-control" id="first_name" placeholder="Nhập họ"
								value="<?php echo @$data['user']['first_name'];?>">
						</div>

						<div class="form-group">
							<label for="last_name">Tên</label> <input name="last_name" type="text"
								class="form-control" id="last_name" placeholder="Nhập tên"
								value="<?php echo @$data['user']['last_name'];?>">
						</div>

						<button type="submit" class="btn btn-default">Lưu lại</button>
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
