<!-- ******Latest work section****** -->
<section id="latest-work" class="latest-work section">
    <div class="container-fluid text-center">
        <h2 class="title text-center">Our Latest Work</h2>
        <div id="work-carousel" class="items owl-carousel owl-theme">

            <?php
            // WP_Query arguments
            $args = array (
              'post_type'  => 'work',
              'posts_per_page' => 3
            );

            // The Query
            $query = new WP_Query( $args );

            // The Loop
            while ( $query->have_posts() ): $query->the_post();

            //Get the Custom Post Meta Details For Work
            $custom = get_post_custom($post->ID);
            $link = $custom["sage_link"][0];  
            $client = $custom["sage_client"][0]; 

                if ($link != "" || $link != "http://"){
                $link= "<a class='site-link' href=\"http://$link\" target='_blank'>Project link</a>";
            }else{
                $link= "";
            }
            ?>

            <div class="item item-1">
                <div class="row">
                    <figure class="figure-container col-md-6 col-sm-12 col-xs-12">
                        <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
                        <a href="<?php the_permalink(); ?>" style="background: #65758e url('<?= $image ?>') no-repeat 50% 50%;" ></a>
                    </figure>
                    <div class="content col-md-6 col-sm-12 col-xs-12">
                        <div class="content-inner">
                            <h3 class="project-title"><?php the_title(); ?></h3>
                            <ul class="meta list-unstyled">
                                <li><strong>Client:</strong> <?php if($client != "")  print " $client "; ?></li>
                                <li><strong>What we did:</strong>  
                                    <?php
                                        $terms_as_text = get_the_term_list($post->ID, 'work_type', '', ', ','');
                                        echo strip_tags($terms_as_text);
                                    ?>
                                </li>
                            </ul><!--//meta-->
                            <div class="desc">
                                <?php the_excerpt(); ?>
                            </div><!--//desc-->
                            <p class="link" ><i class="fa fa-briefcase"></i> <a class="more-link" href="<?php the_permalink(); ?>"><?php _e( 'Read full case study', 'sage' ); ?></a></p>
                            <p class="link" ><i class="fa fa-external-link"></i> <?php if($link != "") print " $link"; ?></p>
                        </div><!--//content-inner-->
                    </div><!--//content-->
                </div><!--//row-->
            </div><!--//item-->

            <?php endwhile;
            // Restore original Post Data
            wp_reset_postdata(); ?>

        </div><!--//owl-carousel-->
        <a class="btn btn-cta btn-cta-secondary" href="<?= esc_url(home_url('/work')); ?>">View all case studies</a>
    </div><!--container-fluid-->
</section><!--//latest-work-->