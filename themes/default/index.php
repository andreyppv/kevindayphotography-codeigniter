<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo theme_view('parts/_head'); ?>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <?php echo theme_view('parts/topmenu'); ?>
</nav>

<div class="container">
    <?php echo Template::draw(); ?>
</div>

<?php echo theme_view('parts/footer'); ?>

<?php echo theme_view('parts/_foot'); ?>
</body>
</html>
