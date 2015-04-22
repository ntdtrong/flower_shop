<section class="content-header">
	<span class="page-title">Thống kê</span>
</section>
<section class="content">
	<?php echo $this->Session->flash(); ?>
	<div class="panel panel-default">
		<!-- Table -->
		<table
			class="table table-striped table-bordered table-condensed table-hover">
			<tr>
				<td style="width: 20%"><h3>Số lượt truy cập</h3></td>
				<td><h3><?php echo $webViewCount; ?></h3></td>
			</tr>

		</table>
	</div>
</section>
