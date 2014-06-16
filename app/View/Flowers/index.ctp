<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" >Shop Hoa</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/homes">TRANG CHỦ</a>
                </li>
                <li><a href="/flowers">GIỎ HOA</a>
                </li>
                <li><a href="/categories">DANH MỤC</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="container">
	<div class="row">
		
		  <div class="col-md-8 col-md-push-2">
		  	<h4 class="panel-heading">Tạo Giỏ Hoa</h4>
		  	<form role="form" action="/flowers/add" method="post">
		  	
		  		<div class="form-group">
				    <label for="txtName">Tên giỏ hoa</label>
				    <input name="name" type="text" class="form-control" id="txtName" placeholder="Nhập tên">
				 </div>
				 
		  		<div class="form-group">
				    <label for="txtPrice">Giá tiền</label>
				    <input name="price" type="text" class="form-control" id="txtPrice" placeholder="Nhập giá">
				 </div>
				 
				 <div class="form-group">
				    <label for="txtImage">Hình ảnh</label>
				    <input name="image" type="file" id="txtImage">
				  </div>
				 
		  		<div class="form-group">
				    <label for="txtDescription">Mô tả thêm</label>
				    <textarea name="description" class="form-control" rows="3" id="txtDescription" placeholder="Nhập mô tả"></textarea>
				 </div>
				 
				 <button type="submit" class="btn btn-default">Save</button>
		  	</form>
		  </div><!-- /.col-md-8 -->
		</div>
</div>
<script type='text/javascript'>
	
</script>
    