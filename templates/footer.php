<!-- ******FOOTER****** --> 
<footer class="footer">
    <?php //get_sidebar('templates\sidebar-footer.php'); ?>
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar( 'first-footer' ); ?> <!-- .first .widget-area -->
                <?php dynamic_sidebar( 'second-footer' ); ?> <!-- .second .widget-area -->
                <?php dynamic_sidebar( 'third-footer' ); ?> <!-- .third .widget-area -->
            </div>
        </div>
    </div> <!--//footer-content-->
    <div class="bottom-bar">
        <div class="container center">                                   
            <small class="copyright text-center"><?php _e( 'Copyright', 'sage' ); ?> @ <?php the_time('Y'); ?> <?php bloginfo('name'); ?></small>                 
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
                <?php //get_template_part('front-page/modal', 'contact'); ?>
                <ul class="contact-info list-inline text-center">
                    <li class="tel"><span class="fs1" aria-hidden="true" data-icon="&#x77;"></span><br /> <a href="#">0800 123 4567</a></li>
                    <li class="email"><span class="fs1" aria-hidden="true" data-icon="&#xe010;"></span><br /> <a href="#">hello@yourdevstudio.com</a></li>
                </ul>
                <div id="contact-form" class="contact-forms" >
                    <div class="row text-center">
                        <div class="contact-form-inner">
                            <div class="row">

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label class="sr-only" for="cname">Your name</label>
                                    <input type="text" class="form-control input-name" id="cname" name="name" placeholder="Your name" minlength="2" required>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label class="sr-only" for="cemail">Email address</label>
                                    <input type="email" class="form-control input-email" id="cemail" name="email" placeholder="Your email address" required>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label class="sr-only" for="cmessage">Your message</label>
                                    <textarea class="form-control input-message" id="cmessage" name="message" placeholder="Enter your message" rows="12" required></textarea>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button type="submit" class="btn btn-block btn-cta btn-cta-primary submit">Send Message</button>
                                </div>
                            </div><!--//row-->
                        </div>
                    </div><!--//row-->
                    <div id="form-messages"></div>
                </div> <!-- //contact-form-->
            </div><!--//modal-body-->
        </div><!--//modal-content-->
    </div><!--//modal-dialog-->
</div><!--//modal-->
