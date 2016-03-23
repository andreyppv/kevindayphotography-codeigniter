<footer>
    <div class="footer-container">
        <div class="container">
            <div class="wrapper">                    
                <!--Footer Testimonial slider-->
                <div class="footer-aboutus col-md-4">
                    <figure>
                        <img alt="logo" src="<?php echo img_path(); ?>footer-logo.png">
                    </figure>
                   
                    <div class="flexslider" style="margin-top:20px; margin-left:10px;">
                        <ul class="slides">                           
                        <li>&ldquo;We worked with Kevin to shoot a series of lifestyle photos when we recently launched our fashion accessories business.  
                        Shooting with him was great.  He is organized, creative and a whole lot of fun to work with. He made the models feel comfortable
                        and the results were fabulous!  We hired him again for our new line and as we expected, got a repeat performance.&rdquo;<br><br>
                        <strong>Lisa Pelaggi<br>Creator of Relative Threads Inc</strong> </li>
                       
                        <li>&ldquo;I&rsquo;ve had the honor of knowing and working with Kevin for well over a decade and I&rsquo;ve often been inspired by his unique 
                        combination of talent, skill and professionalism.  His collaboration with new models is remarkable: he has an infectious 
                        charm and keen sense that puts people at ease while bringing out their best.  Kevin is an utmost professional consistently 
                        delivering quality service to all with whom he works.&rdquo;<br><br><strong>Robert Casey<br>Owner/Agent at Maggie Inc</strong></li>

                        <li>&ldquo;Thanks for providing such a great experience when photographing our models & talent! Everyone comes back really 
                        excited with your work, and we absolutely love the fact that you frame the shots to make our job easier at the Agency. 
                        Keep up the fabulous work!&rdquo;<br><br><strong>Kathleen Longsderff<br>NEMG Agency Director</strong></li> 

                        <li>&ldquo;I have worked with Kevin for many years. All my models rave about how well he works with newcomers and experienced models alike. 
                        Kevin&rsquo;s photos are extraordinary, creative and so beautiful. As an agent with work from casual headshot to lifestyle or high-fashion, 
                        Kevin is my &ldquo;go to&rdquo; photographer for any age and any style.&rdquo;<br><br><strong>Lynda St James<br>Owner/Agent Cameo Models and Talent</strong> </li>
                       </ul>
                </div>
            </div>
                <!--Footer Testimonial slider end-->
                
                <!--Footer Gallery-->
                <div class="footer-gallery col-md-4">
                    <h2 class="footer-title">gallery</h2>
                    
                    <?php 
                    $this->load->model('potfolio_model');
                    $this->load->model('potfolio_photo_model');
                    
                    $potfolios = $this->potfolio_model
                        ->order_by('name')
                        ->find_all_empty_array();
                    ?>
                    
                    <ul>
                        <?php foreach($potfolios as $p) { ?> 
                        <li>
                            <a class="fancybox" data-fancybox-group="footergallery" href="<?php echo site_url("potfolio/$p->slug"); ?>">
                                <div style="max-width:72px; max-height:72px;" class="thumbnail-hover"></div>
                                <img style="max-width:72px; max-height:72px;" src="<?php echo thumbnail($this->potfolio_photo_model->main_image($p->id), 140, 140); ?>" alt="gallery thumbnail" />
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </ul>
                </div>
                <!--Footer Gallery End-->
                
                <!--Footer Contact-->
                <div class="footer-contact col-md-4">
                    <h2 class="footer-title">get in touch</h2>
                    <p style="padding-right:10px;">Kevin answers his calls personally and will help you set your appointment.</p>
                    <ul class="footer-address">
                        <li>Kevin Day Photography</li>
                        <li>460B Harrison Avenue Unit B-17</li>
                        <li>Boston, MA 02118</li><li>tel: 617-645-1813</li>
                        <li>email: kevin@kevindayphotography.com</li>
                    </ul>
                    
                    <!--Footer Social-->
                    <ul class="footer-social">
                        <li><a href="http://facebook.com/people/@/pages/Kevin-Day-Photography/128692922970"><img alt="social media" src="<?php echo img_path(); ?>social-icon1.png"></a></li>
                        <li class="social-color2"><a href="http://twitter.com/KDayphotography"><img src="<?php echo img_path(); ?>social-icon2.png" alt="social media 2"></a></li>
                        <li class="social-color4"><a href="http://statigr.am/kevindayphotography"><img alt="social media" src="<?php echo img_path(); ?>social-icon6.png"></a></li>
                        <li class="social-color2"><a href="http://www.linkedin.com/profile/view?id=316319701&amp;trk=nav_responsive_tab_profile_pic"><img alt="social media" src="<?php echo img_path(); ?>social-icon-linkdin.png"></a></li>
                    </ul>
                    <!--Footer Social End-->
                    
                </div>
                <!--Footer Contact End-->
                
            </div>
        </div>
    </div>
    
    <!--Footer Bottom-->
    <div class="footer-bottom">
        <div class="container">
            <div class="wrapper">
                <div class="copyright col-md-6">
                    Copyright &copy; All Rights Reserved. <a href="<?php echo site_url(); ?>">KevinDayPhotography.com</a>
                </div>
                <nav class="col-md-6">
                    <ul>
                        <li><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li><a href="<?php echo site_url('about'); ?>">About Us</a></li>
                        <li><a href="<?php echo site_url('commercial'); ?>">Portfolio</a></li>
                        <li><a href="<?php echo site_url('contact'); ?>">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--Footer Bottom End-->
</footer>