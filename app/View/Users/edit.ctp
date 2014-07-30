<div class="row">
	<div class="col-md-8 col-md-push-2">
		<?php echo $this->Session->flash(); ?>
		<h4 class="panel-heading">Chỉnh sửa tài khoản</h4>
		<?php echo $this->Form->create('User', array('action' => 'edit/'.@$data['user']['id'], 'type' => 'post')); ?>
			<input name="id" type="hidden" class="form-control"
				value="<?php echo @$data['user']['id'];?>">

			<div class="form-group">
				<label for="email">Email</label> <input name="email"
					type="text" class="form-control" id="email"
					placeholder="Nhập email"
					value="<?php echo @$data['user']['email'];?>">
			</div>
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

			<button class="btn btn-primary" type="submit" >Lưu lại</button>
			<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index')); ?>"><button class="btn btn-default" type="button" >Hủy</button></a>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
