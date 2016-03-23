<div class="rev_slider_wrapper">
    <!-- START REVOLUTION SLIDER 5.0 auto mode -->
    <div id="rev_slider" class="rev_slider"  data-version="5.0">
        <ul> 
            <?php foreach($slides as $s) { ?>   
            <!-- SLIDE  -->
            <li data-transition="fade">
                
                <!-- MAIN IMAGE -->
                <img src="<?php echo upload_url($s->photo); ?>"  alt=""  width="1920" height="1280">    
                
                <!-- LAYER NR. 1 -->                        
                <div class="tp-caption news-title-1 tp-resizeme" 
                    id="slide-80-layer-1" 
                    data-x="left" data-hoffset="20" 
                    data-y="top" data-voffset="['500','500','400','400']" 
                    data-width="['550','550','550','500']"
                    data-height="none"
                    data-whitespace="normal"
                    data-transform_idle="o:1;"             
                    data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" 
                    data-transform_out="opacity:0;s:1000;s:1000;" 
                    data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" 
                    data-start="500" 
                    data-splitin="none" 
                    data-splitout="none" 
                    data-responsive_offset="on" 
                    style="z-index: 5;"><?php echo $s->text; ?>
                </div>                        
            </li>
            <?php } ?>
                         
            </li>
        </ul>                
    </div><!-- END REVOLUTION SLIDER -->
</div><!-- END REVOLUTION SLIDER WRAPPER -->