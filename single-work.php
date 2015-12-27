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
                                 }
                                 else

                                    the_post_thumbnail('work-thumbnail', array('class' => 'img-responsive'));

                                  ?>

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
                
                                                           
            </div><!--//content-wrapper-->              
        </div><!--//row-->            
    </div><!--//container-->
</article><!--//case-study-->