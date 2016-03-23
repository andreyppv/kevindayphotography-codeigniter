<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo admin_url('/'); ?>"><?php echo $settings['site.title']; ?></a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-top-links navbar-right">
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <!--<i class="fa fa-user fa-fw"></i> -->
            <img src="<?php echo thumbnail($current_user->avatar, 30, 30, 'no'); ?>"/>
            <?php echo $current_user->name; ?> <i class="fa fa-caret-down"></i>
        </a>                                    
        <ul class="dropdown-menu dropdown-user">
            <li><a href="<?php echo admin_url('profile'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo site_url('logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->