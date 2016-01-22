<?php
/**
 * Template Name: Contact
 */

    use Roots\Sage\Extras;
?>

<?php
    $errors = array();
    $isError = false;

    $errorName = __( 'Please enter your name!', 'sage' );
    $errorEmail = __( 'Please enter a valid email address!', 'sage' );
    $errorMessage = __( 'Please enter the message!', 'sage' );

    // Get the posted variables and validate them.
    if ( isset( $_POST['is-submitted'] ) ) {
        $name    = $_POST['cName'];
        $email   = $_POST['cEmail'];
        $message = $_POST['cMessage'];

        // Check the name
        if ( ! Roots\Sage\Extras\sage_validate_length( $name, 2 ) ) {
            $isError             = true;
            $errors['errorName'] = $errorName;
        }

        // Check the email
        if ( ! is_email( $email ) ) {
            $isError              = true;
            $errors['errorEmail'] = $errorEmail;
        }

        // Check the message
        if ( ! Roots\Sage\Extras\sage_validate_length( $message, 2 ) ) {
            $isError                = true;
            $errors['errorMessage'] = $errorMessage;
        }

        // If there's no error, send email
        if ( ! $isError ) {
            // Get admin email
            $emailReceiver = get_option( 'admin_email' );

            $emailSubject = sprintf( __( 'You have been contacted by %s', 'sage' ), $name );
            $emailBody    = sprintf( __( 'You have been contacted by %1$s. Their message is:', 'sage' ), $name ) . PHP_EOL . PHP_EOL;
            $emailBody    .= $message . PHP_EOL . PHP_EOL;
            $emailBody    .= sprintf( __( 'You can contact %1$s via email at %2$s', 'sage' ), $name, $email );
            $emailBody    .= PHP_EOL . PHP_EOL;
            
            $emailHeaders[] = "Reply-To: $email" . PHP_EOL;
            
            $emailIsSent = wp_mail( $emailReceiver, $emailSubject, $emailBody, $emailHeaders );
        }
    }
?>

<!-- ******Contact Section****** --> 
<section class="contact-section section">
    <?php while( have_posts() ) : the_post(); ?>

    <div class="container">
        <h2 class="title text-center">Start your project today</h2>
            <p class="intro text-center"><?php get_the_excerpt(); ?></p>
            
        <ul class="contact-info list-inline text-center">
            <li class="tel"><span class="fs1" aria-hidden="true" data-icon="&#x77;"></span><br /> <a href="+255 714 667 787">+255 714 667 787</a></li>
            <li class="email"><span class="fs1" aria-hidden="true" data-icon="&#xe010;"></span><br /> <a href="#">hello@wedesign.co.tz</a></li>
        </ul>

        <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
            <?php if ( isset( $emailIsSent ) && $emailIsSent ) : ?>
                <div class="alert alert-success text-center">
                    <?php _e( 'Your message has been sucessfully sent, thank you!', 'sage' ); ?>
                </div> <!-- end alert -->
            <?php else : ?>

            <?php //the_content(); ?>

            <?php if ( isset( $isError ) && $isError ) : ?>
                <div class="alert alert-danger text-center">
                    <?php _e( 'Sorry, it seems there was an error.', 'sage' ); ?>
                </div> <!-- end alert -->
            <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <form action="<?php the_permalink(); ?>" id="contact-form" method="POST" role="form">                  
            <div class="row text-center">
                <div class="contact-form-inner col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                    <div class="row">  

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group <?php if ( isset( $errors['errorName'] ) ) echo "has-error"; ?>">
                            <label class="sr-only" for="cName"><span class="required">* </span><?php _e( 'Your name:', 'sage' ); ?></label>
                            <input type="text" class="form-control" id="cname" name="cName" placeholder="Your name" minlength="2" value="<?php if ( isset( $_POST['cName'] ) ) { echo $_POST['cName']; } ?>">
                            <?php if ( isset( $errors['errorName'] ) ) : ?>
                                <p class="help-block"><?php echo $errors['errorName']; ?></p>
                            <?php endif; ?>
                        </div> 

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group <?php if ( isset( $errors['errorEmail'] ) ) echo "has-error"; ?>">
                            <label class="sr-only" for="cEmail"><span class="required">* </span><?php _e( 'Email Address:', 'sage' ); ?></label>
                            <input type="email" class="form-control" id="cemail" name="cEmail" placeholder="Your email address" value="<?php if ( isset( $_POST['cEmail'] ) ) { echo $_POST['cEmail']; } ?>">
                            <?php if ( isset( $errors['errorEmail'] ) ) : ?>
                                <p class="help-block"><?php echo $errors['errorEmail']; ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group <?php if ( isset( $errors['errorMessage'] ) ) echo "has-error"; ?>">
                            <label class="sr-only" for="cMessage"><span class="required">* </span><?php _e( 'Your message:', 'sage' ); ?></label>
                            <textarea class="form-control" id="cmessage" name="cMessage" placeholder="Enter your message" rows="12" ><?php if ( isset( $_POST['cMessage'] ) ) { echo $_POST['cMessage']; } ?></textarea>
                            <?php if ( isset( $errors['errorMessage'] ) ) : ?>
                                <p class="help-block"><?php echo $errors['errorMessage']; ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="hidden" name="is-submitted" id="is-submitted" value="true">
                            <button type="submit" class="btn btn-block btn-cta btn-cta-primary"><?php _e( 'Send Message', 'sage' ); ?></button>
                        </div>  

                    </div><!--//row-->
                </div>
            </div><!--//row-->
            <div id="form-messages"></div>
        </form><!--//contact-form-->
    </div><!--//container-->
    <?php endwhile; ?>
</section><!--//contact-section-->

<!-- ******Map Section****** --> 
<section class="map-section section">
    <div class="gmap-wrapper">
        <div class="gmap" id="map"></div><!--//map-->
        <div class="map-overlay">
            <h4 class="title">WeDesign Tz</h4>
            <p class="address">                          
                <span class="region">P.O Box 78</span><br/>
                <span class="postal-code">Arusha</span><br/>
                <span class="country-name">TZ</span>
            </p>
        </div>
    </div><!--//gmap-wrapper-->
</section><!--//map-section-->