<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-push-2">
			<?php echo $this->Session->flash(); ?>
			<h4 class="panel-heading">Đăng nhập</h4>
			<?php echo $this->Form->create('User', array('action' => 'login', 'type' => 'post')); ?>
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

				<button type="submit" class="btn btn-primary">Đăng nhập</button>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

