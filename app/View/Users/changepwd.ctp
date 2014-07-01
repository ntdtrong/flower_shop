<div class="row">
	<div class="col-md-8 col-md-push-2">
		<h4 class="panel-heading">Đổi Mật Khẩu</h4>
		<?php echo $this->Form->create('User', array('action' => 'changepwd/'.@$data['user']['id'], 'type' => 'post')); ?>
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

			<button type="submit" class="btn btn-primary">Thay đổi</button>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
