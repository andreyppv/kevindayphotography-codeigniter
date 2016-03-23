<?php 
$this->load->model('potfolio_model');
$potfolios = $this->potfolio_model
    ->order_by('name')
    ->find_all_empty_array();
?>

<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo img_path(); ?>logo.png" alt="Logo"></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse pull-right">
        <ul class="nav navbar-nav">
            <li id="home" <?php if($menu=='home') { echo "class='active'"; } ?>><a href="<?php echo site_url(); ?>">Home</a></li>
            <li id="about" <?php if($menu=='about') { echo "class='active'"; } ?>><a href="<?php echo site_url(); ?>about/">About Kevin Day</a></li>
            <li id="portfolio" class="dropdown <?php if($menu=='portfolio') { echo "active"; } ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Portfolio <span class="plus">+</span></a>
                <ul class="dropdown-menu">
                    <?php foreach($potfolios as $p) { ?>
                    <li><a href="<?php echo site_url("potfolio/$p->slug"); ?>"><?php echo $p->name; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <li id="services" class="dropdown <?php if($menu=='services') { echo "active"; } ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="plus">+</span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url(); ?>model-service/">Model Portfolios Photographer</a></li>
                    <li><a href="<?php echo site_url(); ?>headshot-service/">Headshot Photographer</a></li>
                    <li><a href="<?php echo site_url(); ?>child-service/">Children's Photographer</a></li>
                    <li><a href="<?php echo site_url(); ?>life-service/">Life Events Photographer</a></li>
                    <li><a href="<?php echo site_url(); ?>music-service/">Music Promotion Photographer</a></li>
                    <li><a href="<?php echo site_url(); ?>wedding-service/">Wedding / Events Photographer</a></li>
                </ul>
            </li>
            <li id="packages" <?php if($menu=='packages') { echo "class='active'"; } ?>><a href="<?php echo site_url(); ?>packages/">Packages</a></li>
            <li id="clients" <?php if($menu=='clients') { echo "class='active'"; } ?>><a href="<?php echo site_url(); ?>clients/">Clients</a></li>
            <li id="contact" <?php if($menu=='contact') { echo "class='active'"; } ?>><a href="<?php echo site_url(); ?>contact/">Contact</a></li>
        </ul>
    </div><!--/.nav-collapse -->
</div>