<section class="content-header">
	<span class="page-title">Blogs</span>
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> Tạo blog', array('controller' => 'blogs', 'action' => 'add'), array('escapeTitle' => false, 'class' => 'pull-right') ); ?>
</section>
<section class="content">
	<?php echo $this->Session->flash(); ?>
	<div class="panel panel-default">
	  <!-- Table -->
	  <table id="table_blogs" class="table table-striped table-bordered table-condensed table-hover">
	  	<tr>
	  		<th width="5%">#</th>
	  		<th width="50%">Tiêu đề</th>
	  		<th width="30%">Danh mục</th>
	  		<th width="15%">Tùy chọn</th>
	  	</tr>
		<?php 
			if(!empty($data['blogs'])){
			$i = 0;
			foreach($data['blogs'] as $item){
				$i++;
		?>
			<tr>
		  		<td><?php echo $i;?></td>
		  		<td><?php echo $item['Blog']['title']?></td>
		  		<td><?php echo $item['Category']['name']?></td>
		  		<td>
		  			<a href="<?php echo $this->Html->url(array('controller' => 'blogs', 'action' => 'edit', $item['Blog']['id'])); ?>" >Chỉnh sửa</a> | 
		  			<a href="javascript:delete_blog('<?php echo $this->Html->url(array('controller' => 'blogs', 'action' => 'delete', $item['Blog']['id'])); ?>')" >Xóa</a>
		  		</td>
		  	</tr>
	  	<?php }
			}?>
	  </table>
	</div>
	<div class="pagination">
		<?php echo $this->Paging->render( $pagingObj, $this->Html->url(array("controller" => "blogs", "action" => "all")),'' ); ?>
	</div> 
</section>
<script type='text/javascript'>
	 function delete_blog(url) {
		  	var answer = confirm("Có chắc bạn muốn xóa blog này?");
		    if (answer){
		    	window.location.replace(url);
		    }
	}
</script>