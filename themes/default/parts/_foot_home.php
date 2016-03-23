<!-- jQuery JavaScript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Bootstrap JavaScript
================================================== -->
<script src="<?php echo Template::theme_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo assets_path(); ?>js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<?php echo Template::message(); ?>

<!-- REVOLUTION JS FILES -->
<script type="text/javascript" src="<?php echo Template::theme_url(); ?>js/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php echo Template::theme_url(); ?>js/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php echo Template::theme_url(); ?>js/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="<?php echo Template::theme_url(); ?>js/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="<?php echo Template::theme_url(); ?>js/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script type="text/javascript" src="<?php echo Template::theme_url(); ?>js/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script type="text/javascript" src="<?php echo Template::theme_url(); ?>js/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
                
<!-- Custom JavaScript
================================================== -->
<script>
/*** HOVER MENU ***/
$(document).ready(function() {
    function toggleNavbarMethod() {
        if ($(window).width() > 768) {
            $('.navbar .dropdown').on('mouseover', function(){
                $('.dropdown-toggle', this).trigger('click'); 
            }).on('mouseout', function(){
                $('.dropdown-toggle', this).trigger('click').blur();
            });
        }
        else {
            $('.navbar .dropdown').off('mouseover').off('mouseout');
        }
    }
    toggleNavbarMethod();
    $(window).resize(toggleNavbarMethod);
});
</script>

<script>
/******************************************
-    PREPARE PLACEHOLDER FOR SLIDER    -
******************************************/

var revapi;
jQuery(document).ready(function() {        
    revapi = jQuery("#rev_slider").revolution({
        sliderType:"standard",
        sliderLayout:"fullscreen",
        fullScreenOffsetContainer:".navbar",
        fullScreenOffset:"-20px",
        delay:9000,
        touchenabled:"on",
        navigation: {
            arrows:{enable:true},
            onHoverStop: "off",
        },            
        gridwidth:1230,
        gridheight:720        
    });        
});    /*ready*/

var revapi;
jQuery(document).ready(function() {        
    revapi = jQuery("#rev_slider1").revolution({
        sliderType:"standard",
        sliderLayout:"fullscreen",
        fullScreenOffsetContainer:".navbar",
        fullScreenOffset:"-20px",
        delay:4000,
        navigation: {
        keyboardNavigation:"off",
        keyboard_direction: "horizontal",
        mouseScrollNavigation:"off",
        onHoverStop:"off",
        touch:{
            touchenabled:"on",
            swipe_threshold: 75,
            swipe_min_touches: 1,
            swipe_direction: "horizontal",
            drag_block_vertical: false
        }
        ,
        arrows: {
            style: "uranus",
            enable: true,
            hide_onmobile: false,
            hide_onleave: false,
            tmp: '',
            left: {
                h_align: "right",
                v_align: "top",
                h_offset: 130,
                v_offset: 20
            },
            right: {
                h_align: "right",
                v_align: "top",
                h_offset: 50,
                v_offset: 20
            }
        },
    },
    viewPort: {
        enable:true,
        outof:"pause",
        visible_area:"80%"
    },
    responsiveLevels:[1240,1024,778,480],
    gridwidth:[1240,1024,778,480],
    gridheight:[600,600,500,400],
    lazyType:"none",
    parallax: {
        type:"mouse",
        origo:"slidercenter",
        speed:2000,
        levels:[2,3,4,5,6,7,12,16,10,50],
    },
    shadow:0,
    stopLoop:"off",
    stopAfterLoops:-1,
    stopAtSlide:-1,
    shuffle:"off",
    autoHeight:"off",
    hideThumbsOnMobile:"off",
    hideSliderAtLimit:0,
    hideCaptionAtLimit:0,
    hideAllCaptionAtLilmit:0,
    debugMode:false,
    fallbacks: {
        simplifyAll:"off",
        nextSlideOnWindowFocus:"off",
        disableFocusListener:false,
    }    
    });        
});    /*ready*/
</script>

<script>
    // When stop button is clicked...
    $('#stopButton').on('click', function(e){ 
        $('#rev_slider1').revpause();
    });

    // When resume button is clicked...
    $('#resumeButton').on('click', function(e){ 
        $('#rev_slider1').revresume();
    });
    
    $('#stopButton').on('click', function(e){ 
        $('#stopButton').css('display','none');
        $('#resumeButton').css('display','block');
    });
    
    $('#resumeButton').on('click', function(e){ 
        $('#resumeButton').css('display','none');
        $('#stopButton').css('display','block');
    });
</script>