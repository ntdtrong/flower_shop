<section class="content-header">
	<span class="page-title">Tài khoản</span>
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> Tạo tài khoản', array('controller' => 'users', 'action' => 'add'), array('escapeTitle' => false, 'class' => 'pull-right') ); ?>
</section>
<section class="content">
	<?php echo $this->Session->flash(); ?>
	<div class="panel panel-default">
		<!-- Table -->
		<table
			class="table table-striped table-bordered table-condensed table-hover">
			<tr>
				<th width="5%">#</th>
				<th width="40%">Họ Tên</th>
				<th width="30%">Email</th>
				<th width="25%">Tùy chọn</th>
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
					<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $item['User']['id'])); ?>">Chỉnh sửa</a> | 
					<a href="javascript:delete_user('<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'delete', $item['User']['id'])); ?>')">Xóa</a> | 
					<a href="javascript:reset_pwd('<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'resetpwd', $item['User']['id'])); ?>')">Reset mật khẩu</a>
				</td>
			</tr>
			<?php 
			}
			}
			?>
		</table>
	</div>
</section>
<script type='text/javascript'>
	function delete_user(url) {
	  	var answer = confirm("Có chắc bạn muốn xóa tài khoản này?");
	    if (answer){
	    	window.location.replace(url);
	    }
	}
	
	function reset_pwd(url) {
	  	var answer = confirm("Có chắc bạn muốn reset mật khẩu của tài khoản này?");
	    if (answer){
	    	window.location.replace(url);
	    }
	}
</script>
