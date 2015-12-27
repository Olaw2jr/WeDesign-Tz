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
