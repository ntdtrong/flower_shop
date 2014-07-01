<div class="row">
  <div class="col-md-8 col-md-push-2">
  	<h4 class="panel-heading">Tạo Banner</h4>
  	<?php echo $this->Form->create('Banner', array('action' => 'add/'.@$data['banner']['id'], 'type' => 'post', 'enctype' => 'multipart/form-data')); ?>
  		<input name="id" type="hidden" class="form-control" value="<?php echo @$data['banner']['id'];?>">
  		<div class="form-group">
		    <label for="txtName">Tiêu đề</label>
		    <input name="title" type="text" class="form-control" id="txtName" placeholder="Nhập tiêu đề" value="<?php echo @$data['banner']['title'];?>">
		</div>
		
		<div class="form-group">
		    <label for="txtDescription">Mô tả thêm</label>
		    <textarea name="description" class="form-control" rows="3" id="txtDescription" placeholder="Nhập mô tả" ><?php if(isset($data['banner']['description'])) echo $data['banner']['description'];?></textarea>
		 </div>
		
		<div class="form-group">
			<label >Hiển thị</label>
			<select name="is_active" class="form-control">
			  	<option value="1" <?php if(!empty($data['banner']['is_active'])) echo 'selected="selected"'?>>Có</option>
			  	<option value="0" <?php if(empty($data['banner']['is_active'])) echo 'selected="selected"'?>>Không</option>
			</select>
		</div>
		
		<div name="image" class="form-group">
		    <label for="txtImage">Hình banner</label>
		    <input name="image" type="file" id="txtImage">
		    <p class="help-block">Chọn hình có độ phân giải 1600 x 482.</p>
		 </div>
		 
		 
		
		<div class="form-group">
			<button class="btn btn-primary" type="submit" >Lưu lại</button>
			<a href="<?php echo $this->Html->url(array('controller' => 'banners', 'action' => 'index')); ?>"><button class="btn btn-default" type="button" >Hủy</button></a>
		</div>
  	<?php echo $this->Form->end(); ?>
  </div><!-- /.col-md-6 -->
</div>