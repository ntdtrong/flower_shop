<div class="row">
  <div class="col-md-8 col-md-push-2">
  	<?php echo $this->Session->flash(); ?>
  	<h4 class="panel-heading">Tạo Danh Mục</h4>
  	<?php echo $this->Form->create('Category', array('action' => 'add', 'type' => 'post', 'enctype' => 'multipart/form-data')); ?>
  		<input name="id" type="hidden" class="form-control" value="<?php echo @$data['category']['id'];?>">
  		<div class="form-group">
		    <label for="txtName">Tên danh mục</label>
		    <input name="name" type="text" class="form-control" id="txtName" placeholder="Nhập tên danh mục" value="<?php echo @$data['category']['name'];?>">
		</div>
		<div class="form-group">
			<label >Phân loại</label>
			<select id="parent" name="parent" class="form-control">
			  	<option value="<?php echo Utils::FLOWER_CATEGORY_PARENT_BY_DESIGN; ?>">
			  		<?php echo Utils::getRootCategoriesDisplay(Utils::FLOWER_CATEGORY_PARENT_BY_DESIGN)?>
			  	</option>
			  	<option value="<?php echo Utils::FLOWER_CATEGORY_PARENT_BY_TOPIC;?>">
			  		<?php echo Utils::getRootCategoriesDisplay(Utils::FLOWER_CATEGORY_PARENT_BY_TOPIC)?>
			  	</option>
			</select>
		</div>
		<div class="form-group">
			<label >Chọn loại danh mục</label>
			<select id="selector_type" name="type" class="form-control">
			  	<option value="<?php echo CATEGORY_TYPE_FLOWER;?>">GIỎ HOA</option>
			  	<option value="<?php echo CATEGORY_TYPE_BLOG;?>">BLOG</option>
			</select>
		</div>
		<div class="form-group">
			<label >Hiển thị</label>
			<select name="is_active" class="form-control">
			  	<option value="0">Không</option>
			  	<option value="1" selected="selected">Có</option>
			</select>
		</div>
		
		<div class="form-group">
			<button class="btn btn-primary" type="submit" >Lưu lại</button>
			<a href="<?php echo $this->Html->url(array('controller' => 'categories', 'action' => 'index')); ?>"><button class="btn btn-default" type="button" >Hủy</button></a>
		</div>
  	<?php echo $this->Form->end(); ?>
  </div><!-- /.col-md-6 -->
</div>
