<!-- ******Logos Section****** -->
<section id="logos" class="logos section">
    <div class="container text-center">
        <h2 class="title"><?php _e( 'Who we have worked with', 'sage' ); ?></h2>

        <ul class="logo-list list-inline row">
            <?php $query = new WP_Query( array(
                  'post_type' => 'testimonial',
                  'posts_per_page' => 4
              ) );
              while ($query->have_posts()) : $query->the_post(); ?>
              <li class="col-md-3 col-sm-3 col-xs-6">
                  <a href="#"><?php the_post_thumbnail('client-thumb2', array('class' => 'img-responsive')); ?></a>
              </li>
              <?php endwhile;
              // Restore original Post Data
              wp_reset_postdata(); ?> 
        </ul><!--//logo-list--> 
                     
    </div><!--//container-->
</section><!--//logos-->


<!-- ******CTA Section****** -->
<section id="cta-section" class="cta-section section text-center home-cta-section">
    <div class="container">
       <h2 class="title"><?php _e( 'Want to have a quick chat?', 'sage' ); ?></h2>
       <p class="phone contact-info">
           <span class="intro"><?php _e( 'We are only a phone call away', 'sage' ); ?></span>
           <span class="info"><a href="tel:+255 714 667 787">+255 714 667 787</a></span>
       </p><!--//phone-->
       <p class="email contact-info">
           <span class="intro"><?php _e( 'You can also email us', 'sage' ); ?></span>
           <span class="info"><a href="mailto:info@wedesign.co.tz">info@wedesign.co.tz</a></span>
       </p><!--//phone-->              
    </div><!--//container-->
</section><!--//cta-section-->