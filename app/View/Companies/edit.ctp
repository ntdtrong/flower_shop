<div class="row">
	<div class="col-md-8 col-md-push-2">
		<h4 class="panel-heading">Thông Tin Cửa Hàng</h4>
		<?php echo $this->Form->create('Company', array('action' => 'edit/'.@$data['company']['id'], 'type' => 'post', 'enctype' => 'multipart/form-data')); ?>
			<input name="id" type="hidden" class="form-control"
				value="<?php echo @$data['company']['id'];?>">
				
			<div class="form-group">
				<label for="name">Tên</label> <input name="name"
					type="text" class="form-control" id="name"
					placeholder="Nhập tên"
					value="<?php echo @$data['company']['name'];?>">
			</div>
			
			<div class="form-group">
				<label for="full_name">Tên đầy đủ</label> <input name="full_name"
					type="text" class="form-control" id="full_name"
					placeholder="Nhập tên đầy đủ"
					value="<?php echo @$data['company']['full_name'];?>">
			</div>
			
			<div class="form-group">
				<label for="address">Địa chỉ</label> <input name="address"
					type="text" class="form-control" id="address"
					placeholder="Nhập địa chỉ"
					value="<?php echo @$data['company']['address'];?>">
			</div>
			
			<div class="form-group">
				<label for="phone">Điện thoại</label> <input name="phone"
					type="text" class="form-control" id="phone"
					placeholder="Nhập số điện thoại"
					value="<?php echo @$data['company']['phone'];?>">
					<p class="help-block">Nhập nhiều số điện thoại cách nhau dấu "-". Ví dụ 0905 123 456 - 08 1234 567</p>
			</div>
			
			<div class="form-group">
				<label for="email">Email</label> <input name="email"
					type="text" class="form-control" id="email"
					placeholder="Nhập số email"
					value="<?php echo @$data['company']['email'];?>">
			</div>
			<button type="submit" class="btn btn-primary">Lưu lại</button>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
