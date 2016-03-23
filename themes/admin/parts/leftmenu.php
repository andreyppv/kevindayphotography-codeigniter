<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="<?php echo admin_url(); ?> " class="<?php echo $menu=='dashboard'?'active':''; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="<?php echo admin_url('client'); ?>" class="<?php echo $menu=='client'?'active':''; ?>"><i class="fa fa-th-large fa-fw"></i> Clients</a>
            </li>
            <li>
                <a href="<?php echo admin_url('potfolio'); ?>" class="<?php echo $menu=='potfolio'?'active':''; ?>"><i class="fa fa-th-large fa-fw"></i> Potfolios</a>
            </li>
            <li>
                <a href="<?php echo admin_url('category'); ?>" class="<?php echo $menu=='category'?'active':''; ?>"><i class="fa fa-th-list fa-fw"></i> Categories</a>
            </li>
            <li>
                <a href="<?php echo admin_url('slide'); ?>" class="<?php echo $menu=='slide'?'active':''; ?>"><i class="fa fa-image fa-fw"></i> Homepage Slides</a>
            </li>
            <li>
                <a href="<?php echo admin_url('member'); ?>" class="<?php echo $menu=='member'?'active':''; ?>"><i class="fa fa-users fa-fw"></i> Members</a>
            </li>
            <li>
                <a href="<?php echo admin_url('setting'); ?>" class="<?php echo $menu=='setting'?'active':''; ?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li>
                <a href="<?php echo admin_url('profile'); ?>" class="<?php echo $menu=='profile'?'active':''; ?>"><i class="fa fa-user fa-fw"></i> My Account</a>
            </li>            
            <li>
                <a href="<?php echo admin_url('logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->