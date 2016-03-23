<div class="wrapper boxstyle">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12">
                <h1>Our clients</h1>
            </div>
        </div>
    </div><!--/.page-header -->
    <div class="box-container contact-area">
        <div class="row">
            <div class="col-md-12">
                <!--Page Navigation-->
                <nav class="pagenav">
                    <ul>
                        <li><a href="<?php echo site_url(); ?>">home</a></li>
                        <li>Our clients</li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <?php $i = 0; ?>
        <?php for($i=0; $i<count($rows); $i+=6) { ?>            
            <div class="row clients">
                <?php if(isset($rows[$i])) { $r = $rows[$i]; ?>
                <div class="col-md-2 client-first">
                    <div class="client-box">
                        <img class="img-reponsive" src="<?php echo upload_url($r->avatar); ?>" alt="<?php echo $r->name; ?>">
                    </div>                            
                </div>
                <?php } ?>
                
                <?php if(isset($rows[$i+1])) { $r = $rows[$i+1]; ?>
                <div class="col-md-2">
                    <div class="client-box">
                        <img class="img-reponsive" src="<?php echo upload_url($r->avatar); ?>" alt="<?php echo $r->name; ?>">
                    </div>                            
                </div>
                <?php } ?>
                
                <?php if(isset($rows[$i+2])) { $r = $rows[$i+2]; ?>
                <div class="col-md-2">
                    <div class="client-box">
                        <img class="img-reponsive" src="<?php echo upload_url($r->avatar); ?>" alt="<?php echo $r->name; ?>">
                    </div>                            
                </div>
                <?php } ?>
                
                <?php if(isset($rows[$i+3])) { $r = $rows[$i+3]; ?>
                <div class="col-md-2">
                    <div class="client-box">
                        <img class="img-reponsive" src="<?php echo upload_url($r->avatar); ?>" alt="<?php echo $r->name; ?>">
                    </div>                            
                </div>
                <?php } ?>
                
                <?php if(isset($rows[$i+4])) { $r = $rows[$i+4]; ?>
                <div class="col-md-2">
                    <div class="client-box">
                        <img class="img-reponsive" src="<?php echo upload_url($r->avatar); ?>" alt="<?php echo $r->name; ?>">
                    </div>                            
                </div>
                <?php } ?>
                
                <?php if(isset($rows[$i+5])) { $r = $rows[$i+5]; ?>
                <div class="col-md-2">
                    <div class="client-box">
                        <img class="img-reponsive" src="<?php echo upload_url($r->avatar); ?>" alt="<?php echo $r->name; ?>">
                    </div>                            
                </div>
                <?php } ?>
            </div>
        <?php } ?>                              
        
        <div class="row">
            <div class="col-md-12">
                <div class="CTA">
                    <h2>Like what you see? <a href="<?php echo site_url('contact'); ?>">Contact us for an appointment.</a></h2>
                </div>
            </div>
        </div>
    </div><!--/.box-container -->
</div>