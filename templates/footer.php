<!-- ******FOOTER****** --> 
<footer class="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">

                <div class="footer-col col-md-3 col-sm-4 links-col">
                    <div class="footer-col-inner">
                        <h3 class="sub-title">Quick Links</h3>
                        <ul class="list-unstyled">
                            <li><a href="about.html">About us</a></li>
                            <li><a href="work.html">Our work</a></li>
                            <li><a href="contact.html">Contact</a></li>                                
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                        </ul>
                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col-->

                <div class="footer-col col-md-6 col-sm-8 blog-col">
                    <div class="footer-col-inner">
                        <h3 class="sub-title">Latest From Our Blog</h3>
                        <div class="item">
                            <figure class="figure">
                                <img class="img-responsive" src="<?= get_template_directory_uri(); ?>/dist/images/blog/blog-tiny-thumb-1.jpg" alt="" />
                            </figure>
                            <div class="content">
                                <h4 class="post-title"><a href="blog-post.html">DevStudio helps XYZ launch</a></h4>
                                <p class="intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales dolor ut ligula faucibus...</p>
                                <ul class="meta list-inline">
                                    <li>18 Feb 2015</li>
                                    <li>James Lee</li>
                                </ul>
                            </div><!--//content-->
                        </div>  
                        <div class="item">
                            <figure class="figure">
                                <img class="img-responsive" src="<?= get_template_directory_uri(); ?>/dist/images/blog/blog-tiny-thumb-2.jpg" alt="" />
                            </figure>
                            <div class="content">
                                <h4 class="post-title"><a href="blog-post.html">devAid - Free Bootstrap Theme</a></h4>
                                <p class="intro">Mauris libero leo, dapibus a congue ut, mollis sed nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempus augue nec nulla ultricies...</p>
                                <ul class="meta list-inline">
                                    <li>21 Dec 2014</li>
                                    <li>Vincent Fowler</li>
                                </ul>
                            </div><!--//content-->
                        </div>                                                     
                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col--> 

                <div class="footer-col col-md-3 col-sm-12 contact-col">
                    <div class="footer-col-inner">
                        <h3 class="sub-title">Get In Touch</h3>
                        <p class="intro"></p>
                        <div class="row">
                            <p class="adr clearfix col-md-12 col-sm-4">
                                <span class="fs1" aria-hidden="true" data-icon="&#xe01d;"></span>        
                                <span class="adr-group">       
                                    <span class="street-address">56 College Green Road</span><br />
                                    <span class="city">Bristol</span><br />
                                    <span class="postal-code">BS1 XR18</span><br />
                                    <span class="country-name">UK</span>
                                </span>
                            </p>
                            <p class="tel col-md-12 col-sm-4"><span class="fs1" aria-hidden="true" data-icon="&#x77;"></span><a href="tel:+08001234567">0800 123 4567</a></p>
                            <p class="email col-md-12 col-sm-4"><span class="fs1" aria-hidden="true" data-icon="&#xe010;"></span><a href="#">hello@yourdevstudio.com</a></p> 
                            <ul class="social-icons list-inline">
				                <li><a href="https://twitter.com/3rdwave_themes"><i class="fa fa-twitter"></i></a></li>                        
				                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
				                <li><a href="https://www.facebook.com/3rdwavethemes"><i class="fa fa-instagram"></i></a></li>
				                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
				                <li class="last"><a href="#"><i class="fa fa-google-plus"></i></a></li>                     
				            </ul> 
                        </div> 
                    </div><!--//footer-col-inner-->            
                </div><!--//foooter-col--> 

            </div>   
        </div>        
    </div><!--//footer-content-->
    <div class="bottom-bar">
        <div class="container center">                                   
            <small class="copyright text-center">Copyright @ <?php the_time('Y'); ?> <?php bloginfo('name'); ?></small>                 
        </div><!--//container-->
    </div><!--//bottom-bar-->
</footer><!--//footer-->

<!-- Contact Modal -->
<div class="modal modal-contact" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="contactModalLabel" class="modal-title text-center">Start your project today</h4>
                <p class="intro text-center">Lorem ipsum dolor sit amet consectetur adipiscing elit laoreet tortor consequat nisi scelerisque commodo etiam justo sapien.</p>
            </div>
            <div class="modal-body">
                <ul class="contact-info list-inline text-center">
                    <li class="tel"><span class="fs1" aria-hidden="true" data-icon="&#x77;"></span><br /> <a href="%2b0800123456.html">0800 123 4567</a></li>
                    <li class="email"><span class="fs1" aria-hidden="true" data-icon="&#xe010;"></span><br /> <a href="#">hello@yourdevstudio.com</a></li>
                </ul>
                <form id="contact-form" class="contact-form" method="post" action="#">                    
                    <div class="row text-center">
                        <div class="contact-form-inner">
                            <div class="row">                                                           
                                
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label class="sr-only" for="cname">Your name</label>
                                    <input type="text" class="form-control" id="cname" name="name" placeholder="Your name" minlength="2" required>
                                </div>                    
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label class="sr-only" for="cemail">Email address</label>
                                    <input type="email" class="form-control" id="cemail" name="email" placeholder="Your email address" required>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label class="sr-only" for="cmessage">Your message</label>
                                    <textarea class="form-control" id="cmessage" name="message" placeholder="Enter your message" rows="12" required></textarea>
                                </div>
                                 <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button type="submit" class="btn btn-block btn-cta btn-cta-primary">Send Message</button>
                                </div>                           
                            </div><!--//row-->
                        </div>
                    </div><!--//row-->
                    <div id="form-messages"></div>
                </form><!--//contact-form-->
            </div><!--//modal-body-->
        </div><!--//modal-content-->
    </div><!--//modal-dialog-->
</div><!--//modal-->

    <!-- Main Javascript -->   
    <script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/plugins/jquery-1.11.3.min.js"></script>  
    <script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/plugins/back-to-top.js"></script>             
    
    <!-- Flexslider --> 
    <script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/js/flexslider-custom.js"></script> 
    
    <!-- Form Validation -->
    <script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/js/form-validation-custom.js"></script>

    <!-- Owl Carousel --> 
    <script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/js/owl-custom.js"></script> 

    <!-- isotope -->
    <script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/js/isotope-custom.js"></script>

    <!-- Google Map -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
    <script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/js/map.js"></script>
