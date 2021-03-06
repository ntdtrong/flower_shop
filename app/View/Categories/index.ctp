<section class="content-header">
	<span class="page-title">Danh mục</span>
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> Tạo danh mục', array('controller' => 'categories', 'action' => 'add'), array('escapeTitle' => false, 'class' => 'pull-right') ); ?>
</section>
<section class="content">
	<?php echo $this->Session->flash(); ?>
	<div class="panel panel-default">
  		<!-- Table -->
		<table class="table table-striped table-bordered table-condensed table-hover">
		  	<tr>
		  		<th width="5%">#</th>
		  		<th width="25%">Tên danh mục</th>
		  		<th width="25%"></th>
		  		<th width="15%">Loại</th>
		  		<th width="15%">Hiển thị</th>
		  		<th width="15%">Tùy chọn</th>
		  	</tr>
			<?php 
				if(!empty($data['categories'])){
				$i = 0;
				foreach($data['categories'] as $item){
					$i++;
			?>
				<tr>
			  		<td><?php echo $i;?></td>
			  		<td><?php echo $item['Category']['name']?></td>
			  		<td><?php echo Utils::getRootCategoriesDisplay($item['Category']['parent']);?></td>
			  		<td><?php echo ( CATEGORY_TYPE_FLOWER == $item['Category']['type'])?'Giỏ hoa':'Blog'?></td>
			  		<td><?php echo ($item['Category']['is_active'])?'Có':'Không'?></td>
			  		<td>
			  			<a href="<?php echo $this->Html->url(array('controller' => 'categories', 'action' => 'edit', $item['Category']['id'])); ?>" >Chỉnh Sửa</a> | 
			  			<a href="javascript:delete_category('<?php echo $this->Html->url(array('controller' => 'categories', 'action' => 'delete', $item['Category']['id'])); ?>')" >Xóa</a>
			  		</td>
			  	</tr>
		  	<?php }
				}?>
		</table>
	</div>
</section>
<script type='text/javascript'>
	function delete_category(url) {
		  var answer = confirm("Có chắc bạn muốn xóa danh mục này?");
	    if (answer){
	    	window.location.replace(url);
	    }
	}
/*
	$( "#selector_type" ).change(function() {
		var type = $(this).val();
		if(parseInt(type) == 1){
			$('#image_banner_panel').css('display', 'block');
		}
		else{
			$('#image_banner_panel').css('display', 'none');
		}
	});
*/
	
</script>
    