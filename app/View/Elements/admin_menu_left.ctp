<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left info">
                            <p><?php echo 'Hello, '.@$current_user['first_name'];?></p>

                            <a ><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'index')); ?>">
                                <i class="fa fa-dashboard"></i> <span>Giỏ Hoa</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'blogs', 'action' => 'index')); ?>">
                                <i class="fa fa-comment"></i> <span>Blogs</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'categories', 'action' => 'index')); ?>">
                                <i class="fa fa-bar-chart-o"></i> <span>Danh Mục</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'banners', 'action' => 'index')); ?>">
                                <i class="fa fa-dribbble"></i> <span>Banners</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index')); ?>">
                                <i class="fa fa-user"></i> <span>Tài Khoản</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'statistics')); ?>">
                                <i class="fa fa-bar-chart-o"></i> <span>Thống kê</span>
                            </a>
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>