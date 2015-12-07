<?php
/**
 * Template Name: About
 */
?>

<!-- ******team Section****** -->
<section id="team" class="team section">
    <div class="container">
        <div class="row">

            <?php // The Query
                $user_query = new WP_User_Query( array( 'role' => 'Administrator' ) );

                // User Loop
                if ( ! empty( $user_query->results ) ) {
                    foreach ( $user_query->results as $user ) {
                        echo '<div class="item col-md-6 col-sm-6 col-xs-12">
                            <div class="item-inner">
                                <div class="row">
                                    <figure class="figure col-md-5 col-sm-12 col-xs-12">
                                        <img class="img-responsive" src="'. esc_url( get_template_directory_uri() ).'/dist/images/team/member-1.jpg" alt=""/>
                                    </figure>
                                    <div class="info col-md-7 col-sm-12 col-xs-12">
                                        <h3 class="name">'. $user->display_name .'</h3>
                                        <h4 class="role">'. $user->position .'</h4>
                                        <p>'. $user->description .'</p>
                                    </div><!--//info-->
                                </div><!--//row-->
                                <div class="social text-center">
                                    <ul class="social-list list-inline">
                                        <li><a href="'. $user->linkedin_profile .'"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="'. $user->twitter_profile .'"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="'. $user->github_profile .'"><i class="fa fa-github-alt"></i></a></li>
                                        <li><a href="'. $user->google_profile .'"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div><!--//social-->
                            </div><!--//item-inner-->                    
                        </div><!--//item-->';
                    }
                } else {
                    echo 'No users found.';
                }
            ?>

        </div><!--//row-->
    </div><!--//container-->
</section><!--//team-section-->

<!-- ******Job Section****** -->
<section class="join-us section">
    <div class="container">
        <h2 class="title text-center">Join Our Team</h2>
        <p class="intro text-center">We love what we do vestibulum tincidunt tincidunt nisl et consectetur mauris sed dui non sapien rhoncus volutpat pellentesque</p>
        <div class="row">
            <div class="info col-md-7 col-sm-6 col-xs-12">
                <p>You can use this section to advertise jobs or attract freelancers to join your team... Fringilla potenti morbi sociosqu dignissim sociis ridiculus. Magna parturient. Auctor convallis. Elementum adipiscing est. Rutrum. Viverra hac congue aliquam accumsan nam laoreet ut nascetur eu vulputate diam. Lacinia placerat ad lectus. Phasellus sit enim, metus quam hymenaeos fringilla venenatis natoque.</p>
                <p>Sollicitudin hendrerit facilisis. Pretium quisque blandit justo massa condimentum varius lobortis, hymenaeos nec phasellus lectus Convallis convallis magnis pellentesque blandit Molestie sociosqu pede.</p>
                
                <p>If you are an iOS/Android developer interested in joining our team, please email your CV to <a href="#">jobs@devstudio.com</a></p>
            </div>
            <div class="partner col-md-4 col-sm-5 col-xs-12 col-md-push-1 col-sm-push-1 col-xs-push-0">
                <h3 class="sub-title">Want to partner with us?</h3>
                <p>If you are a development focused team you might want to attract design partners here...Vulputate sed Nostra elit consequat penatibus. Hac habitant inceptos scelerisque tempor dis purus orci. Risus porta. Arcu gravida, cubilia taciti, ultricies Nisi posuere magna penatibus non suspendisse in mus hendrerit.</p>
                <a href="#" class="btn btn-cta btn-cta-primary">Contact us today!</a>
            </div><!--//partner-->
        </div><!--//row-->
    </div><!--//row-->
</section><!--//job-->

<section class="photos section">
    <div class="container text-center">
        <h2 class="title">We are on Instagram</h2>
        <p class="intro text-center">A sneak peek of what our team have been up to...</p>
        <div id="instafeed" class="instafeed" ></div>
    </div>
</section><!--//photos-->
                            
<!-- ******CTA Section****** -->
<section id="cta-section" class="cta-section section text-center home-cta-section">
    <div class="container">
       <h2 class="title">Want to have a quick chat?</h2>
       <p class="phone contact-info">
           <span class="intro">We are only a phone call away</span>
           <span class="info"><a href="tel:+08001234567">0800 123 4567</a></span>
       </p><!--//phone-->
       <p class="email contact-info">
           <span class="intro">You can also email us</span>
           <span class="info"><a href="mailto:hello@yourdevstudio.com">hello@yourdevstudio.com</a></span>
       </p><!--//phone-->              
    </div><!--//container-->
</section><!--//cta-section-->