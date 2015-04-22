<div role="navigation" class="navbar navbar-tshop navbar-fixed-top megamenu">
  <div class="navbar-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
          <div class="pull-left ">
            <ul class="userMenu ">
              <li> <a href="#"> <span class="hidden-xs">HELP</span><i class="glyphicon glyphicon-info-sign hide visible-xs "></i> </a> </li>
              <li class="phone-number"> <a href="callto:0862810328 "> <span> <i class="glyphicon glyphicon-phone-alt "></i></span> <span style="margin-left:5px" class="hidden-xs"> (08) 6281.0328  </span> </a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/.navbar-top-->
  
  <div class="container">
    <div class="navbar-header">
      <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> </button>
      <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'index')); ?>" class="navbar-brand " style="padding: 4px 20px 0 15px;"><?php echo $this->Html->image('logo.png', array('alt' => 'FiL')); ?></a>
    </div>
    
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"> <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'index')); ?>"> Trang Chủ </a> </li>
        <!-- change width of megamenu = use class > megamenu-fullwidth, megamenu-60width, megamenu-40width -->
        <li class="dropdown megamenu-40width "> <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'shop')); ?>" class="dropdown-toggle" data-toggle="dropdown"> Sản Phẩm <b class="caret"> </b> </a>
          <ul class="dropdown-menu">
            <li class="megamenu-content"> 
              
              <!-- megamenu-content -->
              
              <ul class="col-lg-6  col-sm-6 col-md-6  unstyled noMarginLeft">
                <li>
                  <p> <strong> <?php echo Utils::getRootCategoriesDisplay(Utils::FLOWER_CATEGORY_PARENT_BY_DESIGN) ?></strong> </p>
                </li>
                <?php foreach ($categories as $item): ?>
                <?php if ($item['Category']['parent'] == Utils::FLOWER_CATEGORY_PARENT_BY_DESIGN): ?>
                <li> <a href="<?php echo $this->Html->url(array("controller" => "homes", "action" => "all", 1)) . '/' . $item['Category']['id']; ?>"> <?php echo $item['Category']['name']; ?> </a> </li>
                <?php endif; ?>
                <?php endforeach;?>
              </ul>
              <ul class="col-lg-6  col-sm-6 col-md-6  unstyled">
                <li>
                  <p> <strong> <?php echo Utils::getRootCategoriesDisplay(Utils::FLOWER_CATEGORY_PARENT_BY_TOPIC) ?></strong> </p>
                </li>
                <?php foreach ($categories as $item): ?>
                <?php if ($item['Category']['parent'] == Utils::FLOWER_CATEGORY_PARENT_BY_TOPIC): ?>
                <li> <a href="<?php echo $this->Html->url(array("controller" => "homes", "action" => "all", 1)) . '/' . $item['Category']['id']; ?>"> <?php echo $item['Category']['name']; ?> </a> </li>
                <?php endif; ?>
                <?php endforeach;?>
              </ul>
            </li>
          </ul>
        </li>
        <li> <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'about')); ?>"> Giới thiệu </a> </li>
     	<li> <a href="#">Tin Tức</a> </li>
		<li> <a href="<?php echo $this->Html->url(array('controller' => 'homes', 'action' => 'contact')); ?>">Liên Hệ</a> </li>
      </ul>
      
    </div>
    <!--/.nav-collapse --> 
    
  </div>
  <!--/.container -->
  
</div>