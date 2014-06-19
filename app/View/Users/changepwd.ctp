<div class="container">
	

			<div class="row">

				<div class="col-md-8 col-md-push-2">
				
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
				
					<h4 class="panel-heading">Đổi Mật Khẩu</h4>
					<form role="form" enctype='multipart/form-data'
						action="/users/changepwd" method="post">

						<div class="form-group">
							<label for="current_password">Mật khẩu hiện tại</label> <input name="old_password"
								type="password" class="form-control" id="current_password"
								placeholder="Nhập mật khẩu">
						</div>
						<div class="form-group">
							<label for="new_password">Mật khẩu mới</label> <input name="new_password"
								type="password" class="form-control" id="new_password"
								placeholder="Nhập mật khẩu">
						</div>
						<div class="form-group">
							<label for="confirm">Xác nhận mật khẩu</label> <input name="confirm"
								type="password" class="form-control" id="confirm"
								placeholder="Nhập mật khẩu">
						</div>

						<button type="submit" class="btn btn-default">Thay đổi</button>
					</form>
				</div>
			</div>

</div>
