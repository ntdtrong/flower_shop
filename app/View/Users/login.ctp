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
                <li><a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'index')); ?>">TRANG CHỦ</a>
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
			<p id="error_message">
				<?php 
					if(!empty($data['error'])){
				?>
					<h5><span class="label label-danger"><?php echo $data['error'];?></span><h5>
				<?php 
					}
				?>
				
				<?php 
					if(!empty($data['success'])){
				?>
					<h5><span class="label label-success"><?php echo $data['success'];?></span><h5>
				<?php 
					}
				?>
			</p>
			<h4 class="panel-heading">Đăng nhập</h4>
			<?php echo $this->Form->create('User', array('action' => 'login', 'type' => 'post')); ?>
				<div class="form-group">
					<label for="email">Email</label> <input name="User[email]"
						type="text" class="form-control" id="email"
						placeholder="Nhập email"
						value="<?php echo @$data['user']['email'];?>">
				</div>

				<div class="form-group">
					<label for="password">Mật khẩu</label> <input name="User[password]"
						type="password" class="form-control" id="password"
						placeholder="Nhập mật khẩu">
				</div>

				<button type="submit" class="btn btn-primary">Đăng nhập</button>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>

