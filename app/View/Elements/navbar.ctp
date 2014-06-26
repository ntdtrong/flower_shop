<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <strong><a class="navbar-brand" >
                		<?php if(!empty($company)) echo $company['name'];?>
                	</a></strong>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'index')); ?>"><strong>TRANG CHỦ</strong></a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'contact')); ?>"><strong>LIÊN HỆ</strong></a></li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
</nav>