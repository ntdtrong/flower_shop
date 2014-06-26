<?php echo $this->element('navbar'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-push-2">
			<h4>Liên hệ với chúng tôi</h4>
			<div class="panel panel-info">
				<div class="panel-heading"><h4><strong><?php echo @$company['full_name'];?></strong></h4></div>
				<div class="panel-body">
					
					<div class="col-md-10 col-md-push-1">
					<strong>
						<p>Địa chỉ: <?php echo @$company['address'];?></p>
						<p>Điện thoại: <?php echo @$company['phone'];?></p>
						<p>Email: <?php echo @$company['email'];?></p>
					</strong>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

