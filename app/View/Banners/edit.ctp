<div class="row">
  <div class="col-md-8 col-md-push-2">
  	<h4 class="panel-heading">Chỉnh Sửa Banner</h4>
  	<?php echo $this->Form->create('Banner', array('action' => 'edit/'.@$data['banner']['id'], 'type' => 'post', 'enctype' => 'multipart/form-data')); ?>
  		<input name="id" type="hidden" class="form-control" value="<?php echo @$data['banner']['id'];?>">
  		<div class="form-group">
		    <label for="txtName">Tiêu đề</label>
		    <input name="title" type="text" class="form-control" id="txtName" placeholder="Nhập tiêu đề" value="<?php echo @$data['banner']['title'];?>">
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
		    <p class="help-block">Chọn hình có độ phân giải 800x300.</p>
		 </div>
		<?php if(!empty($data['banner']['image'])) {?>
				<div class="form-group">
                	<img class="image-preview" src="/img/banner/<?php echo $data['banner']['image'];?>" alt="">
		</div>
		<?php }?>
		
		<div class="form-group">
			<button class="btn btn-primary" type="submit" >Save</button>
		</div>
  	<?php echo $this->Form->end(); ?>
  </div><!-- /.col-md-6 -->
</div>