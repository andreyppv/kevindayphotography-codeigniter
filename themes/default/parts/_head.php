<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $settings['meta.description']; ?>">
<meta name="keywords" content="<?php echo $settings['meta.keywords']; ?>">
<meta name="author" content="<?php echo $settings['meta.author']; ?>>">

<title>
    <?php if(isset($page_title2) && $page_title2 != '') echo $page_title2 . ' | '; ?>
    <?php echo $settings['site.title']; ?> 
    <?php if(isset($page_title) && $page_title != '') echo ' | ' . $page_title; ?>
</title>

<link rel="canonical" href="<?php echo site_url(); ?>" />
<link rel="icon" href="<?php echo img_path(); ?>favicon.png">

<!-- Bootstrap core CSS -->
<link href="<?php echo Template::theme_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo Template::theme_url('css/animate.min.css'); ?>" rel="stylesheet">

<!-- Custom CSS -->
<link href="<?php echo Template::theme_url('css/custom.css'); ?>" rel="stylesheet">
<link href="<?php echo Template::theme_url('css/flexslider.css'); ?>" rel="stylesheet" type="text/css" />

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600,600italic,700,700italic,900,900italic,300italic,300,200italic,200' rel='stylesheet' type='text/css'>

<!-- Awesome Icons -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- REVOLUTION STYLE SHEETS -->
<link rel="stylesheet" type="text/css" href="<?php echo Template::theme_url('js/revolution/css/settings.css'); ?>">
<!-- REVOLUTION LAYERS STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo Template::theme_url('js/revolution/css/layers.css'); ?>">
    
<!-- REVOLUTION NAVIGATION STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo Template::theme_url('js/revolution/css/navigation.css'); ?>">
