<!-- ******Testimonials Section****** -->
<section id="testimonials" class="testimonials section">
    <div class="container">
        <h2 class="title text-center"><?php _e( 'Testimonials', 'sage' ); ?></h2>
        <p class="intro text-center"><?php _e( 'Don’t just take our word for it – see what our clients are saying', 'sage' ); ?></p>
        <div class="row">

            <?php $query = new WP_Query( array(
                'post_type' => 'testimonial',
                'posts_per_page' => 2
            ) );

            // The Loop
            while ($query->have_posts()) : $query->the_post(); 

            //Get the Custom Post Meta Details For Work
            $custom = get_post_custom($post->ID);
            $position = $custom["sage_position"][0];
            $avatar = get_post_meta( get_the_ID(), 'sage_avatar', true );
                if(empty($avatar)){
                    $avatar_url = esc_url( get_template_directory_uri().'/dist/images/client/client-profile-1.png');
                    //$avatar_url = get_template_directory_uri()"/dist/images/client/client-profile-1.png";

                } else {
                    $avatar_url = wp_get_attachment_url( $avatar );
                } ?>

            <div class="item col-md-6 col-sm-6 col-xs-12">
                <div class="item-inner">
                    <div class="quote-container">
                        <i class="fa fa-quote-left"></i> 
                        <blockquote class="quote"><?php the_excerpt(); ?></blockquote><!--//quote-->                              
                    </div><!--//quote-->
                    <div class="meta">
                        <div class="profile">
                            <?//= $avatar_url; ?>
                            <img class="img-circle img-responsive" width="100px" src="<?= $avatar_url; ?>" alt="" />

                            <p class="name"><?php the_title(); ?><br />
                                <span class="source-title"><?= $position; ?></span>
                            </p>
                        </div><!--//profile-->
                        <div class="client-logo">
                            <?php the_post_thumbnail('client-thumb', array('class' => 'img-responsive') ); ?>
                        </div><!--//client-logo-->
                    </div><!--//meta-->        
                </div><!--//item-inner-->        
            </div><!--//item-->
            
            <?php endwhile;
            // Restore original Post Data
            wp_reset_postdata(); ?>

            <div class="clearfix"></div>

        </div><!--//row-->
    </div><!--//container-->
</section><!--//testimonials-->