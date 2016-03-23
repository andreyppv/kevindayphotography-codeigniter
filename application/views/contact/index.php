<div class="wrapper boxstyle">
    <div class="page-header">
        <div class="row">
            <div class="col-md-12">
                <h1>Contact us</h1>
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
                        <li>Contact us</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!--Map-->
                <div class="map-container">
                    <div id="map-canvas"></div>
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-6">
                <h2>send a message</h2>
                <form class="contact-form" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Full Name</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="first_name" placeholder="First Name" id="first-name" class="form-control" required="required">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="last_name" placeholder="Last Name" id="last-name" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Your E-mail Address</label>
                            <input type="email" name="email" placeholder="ex: myname@example.com" id="email" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Phone Number</label>
                            <input type="text" name="phone" placeholder="{800} 212-2222" id="phone" pattern="[1-9]{10}" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="textarea-input" class="control-label">Your Message</label>
                            <textarea placeholder="Content.." class="form-control" rows="9" name="textarea_input" id="textarea-input" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 170px;" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Preferred Contact?</label>
                        <div class="col-md-8">
                            <div class="radio">
                                <label for="radio1">
                                    <input type="radio" value="option1" name="radios" id="radio1" required="required">E-mail
                                </label>
                            </div>
                            <div class="radio">
                                <label for="radio2">
                                    <input type="radio" value="option2" name="radios" id="radio2" required="required">Phone
                                </label>
                            </div>
                            <div class="radio">
                                <label for="radio3">
                                    <input type="radio" value="option3" name="radios" id="radio3" required="required">SMS
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button class="btn btn-block btn-primary" type="submit" name="btn-submit" value="1">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h2>contact information</h2>
                <div class="contact-details">
                    <ul>
                        <li>address: <span>460B Harrison Avenue Unit B-17, Boston, MA 02118</span></li>
                        <li>phone: <span>617-645-1813</span></li>
                        <li>email: <span>kevin@kevindayphotography.com</span></li>
                    </ul>
                </div>
                <div class="contact-textarea">
                    <figure>
                        <img style="width: 205px; height:auto;" alt="contact info" src="<?php echo img_path(); ?>kevin-contact.jpg">
                    </figure>
                    <p>Kevin Day was born in Hamilton, MA, where his career with photography began at the early age of 12, while playing around with his Dad&rsquo;camera.</p>

                    <p>His love and fascination with photography stayed with him all through high school, and led him to The New England School of Photography in Boston, MA where he graduated in 2002 with a major in Fashion Photography and a minor in color.</p>

                    <p>Kevin specializes in model portfolios, fashion, weddings, children and head shots. He spends much of his time shooting models for New England&rsquo;s top agencies.</p>

                    <p><span style="color: #1f3685; font-size: 20px;"><strong>Gift cards are now availalble.</strong></span> Call today to purchase or for more information.</p>

                </div>
            </div>
        </div>
    </div><!--/.box-container -->
</div>

<!--Google Map Script-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script>
    function initialize() {
        "use strict";

        var mapOptions = {
            zoom: 15,
            center: new google.maps.LatLng(42.3425537, -71.0675454),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

        var marker = new google.maps.Marker({
            position: map.getCenter(),
            map: map,
            title: 'Location Name'
        });

        google.maps.event.addListener(marker, 'click', function () {
            map.setZoom(8);
            map.setCenter(marker.getPosition());
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>