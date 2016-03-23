<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo theme_view('parts/_head'); ?>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <?php echo Template::draw(); ?>
            </div>
        </div>
    </div>
</div>

<?php echo theme_view('parts/_foot'); ?>
 
</body>
</html>
