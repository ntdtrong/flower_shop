﻿<div class="flower-dialog">
	<div class="row">
		
		  <div class="col-md-8 col-md-push-2">
		  	
		  	<?php 
				if($data['error']){
			?>
				<h5><span class="label label-danger"><?php echo $data['error'];?></span><h5>
			<?php 
				}
			?>
			
		  	<?php 
				if($data['success']){
			?>
				<h5><span class="label label-success"><?php echo $data['success'];?></span><h5>
			<?php 
				}
			?>
		  	
		  	<h4 class="panel-heading">Tạo Giỏ Hoa</h4>
		  	<form role="form" enctype='multipart/form-data' action="/flowers/add" method="post">
		  		<div class="form-group">
				    <label for="txtName">Tên giỏ hoa</label>
				    <input name="name" type="text" class="form-control" id="txtName" placeholder="Nhập tên" value="<?php echo @$data['flower']['name'];?>">
				 </div>
				 
		  		<div class="form-group">
				    <label for="txtPrice">Giá tiền</label>
				    <input name="price" type="text" class="form-control" id="txtPrice" placeholder="Nhập giá" value="<?php echo @$data['flower']['price'];?>">
				 </div>
				 
				 <div class="form-group">
				    <label for="txtImage">Hình ảnh</label>
				    <input name="image" type="file" id="txtImage">
				    <p class="help-block">Chọn hình có độ phân giải 300x250.</p>
				  </div>
				 
		  		<div class="form-group">
				    <label for="txtDescription">Mô tả thêm</label>
				    <textarea name="description" class="form-control" rows="3" id="txtDescription" placeholder="Nhập mô tả" ><?php if(isset($data['flower']['description'])) echo $data['flower']['description'];?></textarea>
				 </div>
				 <div class="panel panel-default">
					  <div class="panel-heading">Chọn danh mục</div>
					  <div class="panel-body">
					  <?php  
                		if(!empty($data['categories'])){

							$selectId = 0;
							if(!empty($data['flower']['category']))
								$selectId = intval($data['flower']['category']);
							
	                		foreach($data['categories'] as $cate){
							?>
					    <div class="col-sm-4 col-lg-4 col-md-4">
					    	<div class="checkbox">
							    <label>
							      <input name="data[categories_selected][<?php echo $cate['Category']['id'];?>]"	type="checkbox"
							      	<?php if(in_array($cate['Category']['id'], $data['categories_selected'])) echo "checked='checked'";?>
							      	> 
							      	<?php echo $cate['Category']['name'];?>
							    </label>
							 </div>
						</div>
						
						<?php 
							}	
                		}	
                		?>
					    
					  </div>
					</div>
				 
				 
				 
				 <button type="submit" class="btn btn-default">Save</button>
		  	</form>
		  </div><!-- /.col-md-8 -->
		</div>
</div>
    