<?php              
    $css = array(
        'js/plugins/bootstrap/dist/css/bootstrap.min.css',
        'js/plugins/metisMenu/dist/metisMenu.min.css',
        'js/plugins/font-awesome/css/font-awesome.min.css',
        'js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css',
        'js/plugins/alertify-js/alertify.css',
        'js/plugins/bootstrap-sweetalert/sweet-alert.css',
        'css/animate.min.css',
        'css/sb-admin-2.css',
        'css/custom.css',
    );
    $js = array(
        'js/plugins/metisMenu/dist/metisMenu.min.js',
        'js/plugins/bootstrap-notify/bootstrap-notify.min.js',
        'js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js',
        'js/plugins/alertify-js/alertify.js',
        'js/plugins/bootstrap-sweetalert/sweet-alert.js',
        'js/sb-admin-2.js',
        'js/custom.js',
    );
    Assets::add_css($css);
    Assets::add_js($js);
?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title><?php echo $settings['site.title']; ?> Admin</title>

<!-- CSS -->
<?php echo Assets::css(); ?>

<!-- jQuery -->
<script type="text/javascript" src="<?php echo assets_path(); ?>js/plugins/jquery/dist/jquery.min.js"></script>
<script>var base_url = '<?php echo site_url(); ?>';</script>
<script>var admin_url = '<?php echo site_url('admin'); ?>';</script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<link rel="shortcut icon" href="<?php echo site_url('favicon.png'); ?>">
