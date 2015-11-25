<!-- ******Logos Section****** -->
<section id="logos" class="logos section">
    <div class="container text-center">
        <h2 class="title">Who we have worked with</h2>

        <ul class="logo-list list-inline row">
            <?php $query = new WP_Query( array(
                  'post_type' => 'testimonial',
                  'posts_per_page' => 4
              ) );
              while ($query->have_posts()) : $query->the_post(); ?>
              <li class="col-md-3 col-sm-3 col-xs-6"><a href="#"><?php the_post_thumbnail('', array('class' => 'img-responsive')); ?></a></li>
              <?php endwhile;
              // Restore original Post Data
              wp_reset_postdata(); ?> 
        </ul><!--//logo-list--> 
                     
    </div><!--//container-->
</section><!--//logos-->


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