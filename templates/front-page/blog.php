<!-- ******Latest blog Section****** -->
<section id="latest-blog" class="latest-blog section">
    <div class="container">
        <h2 class="title text-center">Latest Blog Posts</h2>
        <div class="row">

            <?php $newsposts = new WP_Query('posts_per_page=>2, ignore_sticky_posts => 1'); ?>
            <?php while ($newsposts->have_posts()) : $newsposts->the_post(); ?>
                
            <div class="item col-md-6 col-sm-6 col-xs-12">
                <div class="item-inner">
                    <figure class="figure">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('', array('class' => 'img-responsive')); ?></a>
                    </figure>
                    <div class="content-wrapper text-center">
                        <h3 class="sub-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="desc">
                            <?php the_excerpt(); ?>
                        </div><!--//desc-->
                    </div><!--//content-wrapper text-center-->
                </div><!--//item-inner-->
            </div><!--//item-->
            
            <?php endwhile;
            // Restore original Post Data
            wp_reset_postdata(); ?>

        </div><!--//row-->
    </div><!--//container-->
</section><!--//latest-blog-->