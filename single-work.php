<div class="breadcrumbs container">
    <?php Roots\Sage\Extras\breadcrumbs(); ?>
</div><!--//breadcrumbs-->

<article class="case-study-article article">
    <div class="container">
                    
        <?php if (have_posts()) : ?>

        <?php

        $custom = get_post_custom($post->ID);
            $link = $custom["sage_link"][0];  
            $client = $custom["sage_client"][0]; 

                if ($link != "" || $link != "http://"){
                $link= "<a href=\"http://$link\" target='_blank'>$link</a>";
            }else{
                $link= "";
            }
        ?>
        <h1 class="project-title text-center"><?php the_title(); ?></h1>
        <h2 class="project-type text-center">
            <?php
                $terms_as_text = get_the_term_list($post->ID, 'work_type', '', ' / ','');
                echo strip_tags($terms_as_text);
            ?>
        </h2>
        <div class="row">
            <div class="content-wrapper col-md-10 col-sm-12 col-xs-12 col-md-push-1 col-sm-push-0 col-xs-push-0"> 
            <?php while (have_posts()) : the_post(); ?>
                <div class="content">
                    <section class="slideshow">
                        <div id="slider" class="flexslider">
                            <ul class="slides">

                                <?php if( class_exists('Dynamic_Featured_Image') ) {
                                     global $dynamic_featured_image;
                                     $featuredImages = $dynamic_featured_image->get_featured_images( $postId );

                                    if( !is_null($featuredImages) ){
                                       foreach($featuredImages as $images) { ?>
                                            <li>
                                                <img class="img-responsive" src="<?= $images['full'] ?>" alt="<?= $dynamic_featured_image->get_image_alt_by_id($images['attachment_id']) ?>" />
                                            </li>                                          
                                       <?php }
                                    }
                                 } ?>

                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">

                                <?php if( class_exists('Dynamic_Featured_Image') ) {
                                     global $dynamic_featured_image;
                                     $featuredImages = $dynamic_featured_image->get_featured_images( $postId );

                                    if( !is_null($featuredImages) ){
                                       foreach($featuredImages as $images) { ?>
                                            <li>
                                                <img src="<?= $images['thumb'] ?>" alt="<?= $dynamic_featured_image->get_image_alt_by_id($images['attachment_id']) ?>" />
                                            </li>                                          
                                       <?php }
                                    }
                                 } ?>

                                
                            </ul>
                        </div>
                    </section><!--//slideshow-->
                    <ul class="meta list-unstyled">
                        <li><strong>Client:</strong> <?php if($client != "")  print " $client "; ?></li>
                        <li><strong>What we did:</strong> 
                            <?php
                                $terms_as_text = get_the_term_list($post->ID, 'work_type', '', ', ','');
                                echo strip_tags($terms_as_text);
                            ?> 
                        </li>
                        <li><strong>Site link:</strong> <?php if($link != "") print " $link"; ?></li>
                    </ul><!--//meta-->

                    <?php the_content( ); ?>

                </div><!--//content-->  
            <?php endwhile; endif; ?>    
                
                <div class="testimonial-wrapper text-center">
                    <div class="testimonial-inner">
                        <div class="quote-container text-left">
                            <i class="fa fa-quote-left"></i> 
                            <blockquote class="quote">We had great experience working with Phasellus ut cursus tellus. Etiam ullamcorper varius diam, nec consequat dolor gravida non. Nullam commodo feugiat arcu, ut scelerisque nisl vulputate eget. Cras a euismod elit. Ut ex neque, cursus vulputate facilisis sed, tempor quis ligula. Pellentesque sodales sagittis fringilla.
                                
                            </blockquote><!--//quote-->                              
                        </div><!--//quote-->
                        <div class="meta">
                            <div class="profile">
                                <img class="img-circle" src="<?= get_template_directory_uri(); ?>/dist/images/client/client-profile-6.png" alt="" />
                                <p class="name">Christopher Hopkins<br />
                                <span class="source-title">Product Manager</span>
                                </p>
                            </div><!--//profile-->
                        </div><!--//meta-->     
                    </div><!--//testimonial-inner-->   
                </div><!--//testimonail--> 
                                                           
            </div><!--//content-wrapper-->              
        </div><!--//row-->            
    </div><!--//container-->
</article><!--//case-study-->