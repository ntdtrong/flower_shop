<header class="header">
            <a <?php if (!empty($current_user) && ($current_user['role'] == ROLE_ADMIN)){ echo 'href='.$this->Html->url(array('controller' => 'companies', 'action' => 'index'));}?> class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                		<?php if(!empty($company)) echo $company['name'];?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo @$current_user['first_name'].' '.@$current_user['last_name'];?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu user user-menu">
                                <li role="presentation">
                                	<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'changepwd')); ?>">Đổi mật khẩu</a>
                                </li>
								<li role="presentation">
                                	<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>">Thoát</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
</header>