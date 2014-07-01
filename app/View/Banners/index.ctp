<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
  	<strong>Banners</strong>
	<?php echo $this->Html->link('Tạo banner', array('controller' => 'banners', 'action' => 'add'), array('escapeTitle' => false, 'class' => 'pull-right') ); ?>
  </div>

  <!-- Table -->
  <table class="table table-striped table-bordered table-condensed table-hover">
  	<tr>
  		<th width="5%">#</th>
  		<th width="65%">Tiêu đề</th>
  		<th width="15%">Hiển thị</th>
  		<th width="15%">Tùy chọn</th>
  	</tr>
	<?php 
		if(!empty($data['banners'])){
		$i = 0;
		foreach($data['banners'] as $item){
			$i++;
	?>
		<tr>
	  		<td><?php echo $i;?></td>
	  		<td><?php echo $item['Banner']['title']?></td>
	  		<td><?php echo ($item['Banner']['is_active'])?'Có':'Không'?></td>
	  		<td>
	  			<a href="<?php echo $this->Html->url(array('controller' => 'banners', 'action' => 'edit', $item['Banner']['id'])); ?>" >Chỉnh Sửa</a> | 
	  			<a href="javascript:delete_banner('<?php echo $this->Html->url(array('controller' => 'banners', 'action' => 'delete', $item['Banner']['id'])); ?>')" >Xóa</a>
	  		</td>
	  	</tr>
  	<?php }
		}?>
  </table>
</div>
<script type='text/javascript'>
	function delete_banner(url) {
		  var answer = confirm("Có chắc bạn muốn xóa banner này?");
	    if (answer){
	    	window.location.replace(url);
	    }
	}
</script>
    