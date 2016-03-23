<?php
    $transitions = array('fadefromtop', 'fadefrombottom', 'fadefromleft', 'fadefromright');
    $i = 0;
?>

<!-- START REVOLUTION SLIDER 5.0 auto mode -->
<div id="rev_slider1" class="rev_slider" data-version="5.0">
    <ul>    
        <?php foreach($photos as $p) { ?>
        <li data-transition="<?php echo $transitions[$i%4]; ?>">                        
            <!-- MAIN IMAGE -->
            <img src="<?php echo upload_url($p->link); ?>"  alt=""  width="1920" height="1280" data-bgposition="center center" data-bgfit="cover">                        
        </li>
        <?php $i++; } ?>
    </ul>                
</div><!-- END REVOLUTION SLIDER -->

<div class="prefix-play-pause">
    <div id="resumeButton" class="prefix-play"></div>
    <div id="stopButton" class="prefix-pause"></div>
</div>