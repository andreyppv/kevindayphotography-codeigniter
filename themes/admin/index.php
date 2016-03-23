<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo theme_view('parts/_head'); ?>
</head>

<body>

<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <?php echo theme_view('parts/topmenu'); ?>
        
        <?php echo theme_view('parts/leftmenu'); ?>
    </nav>
    
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $pagetitle; ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        
        <div>
            <?php echo Template::draw(); ?>
        </div>
    </div>
</div>                                   

<?php echo theme_view('parts/_foot'); ?>

</body>
</html>
