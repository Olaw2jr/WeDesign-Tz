<?php
/**
 * Template Name: About
 */
?>

<!-- ******team Section****** -->
<section id="team" class="team section">
    <div class="container">
        <h2 class="title text-center">Meet the team</h2>
        <p class="intro text-center"><?php get_the_excerpt(); ?></p>

        <?php while (have_posts())  : the_post(); ?>  
        <div class="row">

            <?php // The Query
                $user_query = new WP_User_Query( array( 'role' => 'Administrator' ) );

                // User Loop
                if ( ! empty( $user_query->results ) ) {
                    foreach ( $user_query->results as $user ) {
                        echo '<div class="item col-md-6 col-sm-6 col-xs-12">
                            <div class="item-inner">
                                <div class="row">
                                    <figure class="figure col-md-5 col-sm-12 col-xs-12">' ?>
                                        <?= get_avatar( $user->ID, 200); ?>
                                   <?= '</figure>
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

        <?php endwhile; ?>
    </div><!--//container-->
</section><!--//team-section-->

<!-- ******Services Section****** -->
<section id="services" class="services section">
    <div class="container text-center">
        <h2 class="title">Services</h2>
        <p class="intro">We offer lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
        <div class="service-items row">
            <div class="item col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="item-inner">
                    <div class="header-box">
                        <span class="fs1" aria-hidden="true" data-icon="&#xe104;"></span>
                    </div><!--//header-->
                    <div class="desc">
                        <h3 class="sub-title">UX &amp; Front-end</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae diam magna. Curabitur nibh metus, ultricies sed aliquam euismod, scelerisque eu purus. In hac habitasse platea dictumst. Suspendisse tempus elit eget libero suscipit pulvinar.</p>
                    </div>
                </div><!--//item-inner-->
            </div><!--//item-->
            <div class="item col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="item-inner">
                    <div class="header-box">
                        <span class="fs1" aria-hidden="true" data-icon="&#xe0ea;"></span>
                    </div><!--//header-->
                    <div class="desc">
                        <h3 class="sub-title">Back-end &amp; Database</h3>
                        <p>Phasellus fermentum accumsan fermentum. Vestibulum elit sapien, consequat vitae auctor sit amet, elementum sed elit. Quisque ullamcorper quis augue sit amet porttitor. Maecenas ac dolor iaculis, dapibus.</p>
                    </div>
                </div><!--//item-inner-->
            </div><!--//item-->
            <div class="item col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="item-inner">
                    <div class="header-box">
                        <span class="fs1" aria-hidden="true" data-icon="&#xe003;"></span>
                    </div><!--//header-->
                    <div class="desc">
                        <h3 class="sub-title">Hosting</h3>
                        <p>Cras mollis ex sed tortor finibus, a mattis risus rhoncus. Sed sodales et metus at sodales. Ut non dolor sollicitudin, venenatis mauris eget, fringilla enim. Pellentesque sed magna ante. Cras mollis tincidunt lectus vitae suscipit.</p>
                    </div>
                </div><!--//item-inner-->
            </div><!--//item-->
            <div class="item col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="item-inner">
                    <div class="header-box">
                        <span class="fs1" aria-hidden="true" data-icon="&#xe028;"></span>
                    </div><!--//header-->
                    <div class="desc">
                        <h3 class="sub-title">Support</h3>
                        <p>Aliquam efficitur, lorem blandit dapibus viverra, erat turpis placerat lacus, quis hendrerit libero sem eget dui. Integer eu diam orci. Nullam sed dictum lorem. Quisque ut lacus non enim aliquam pretium sit amet id augue.</p>
                    </div>
                </div><!--//item-inner-->
            </div><!--//item-->
        </div><!--//row-->
        <a class="btn btn-cta btn-cta-primary" href="contact.html">Get a quote</a>
    </div><!--//container-->
</section>
