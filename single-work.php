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
                                <li>
                                    <img class="img-responsive" src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-0.png" alt="" />
                                </li>
                                <li>
                                    <img class="img-responsive" src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-1.png" alt="" />
                                </li>
                                <li>
                                    <img class="img-responsive" src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-2.png" alt="" />
                                </li>
                                <li>
                                    <img class="img-responsive" src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-3.png" alt="" />
                                </li>
                                <li>
                                    <img class="img-responsive" src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-4.png" alt="" />
                                </li>
                                <li>
                                    <img class="img-responsive" src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-5.png" alt="" />
                                </li>
                                <li>
                                    <img class="img-responsive" src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-6.png" alt="" />
                                </li>
                                <li>
                                    <img class="img-responsive" src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-7.png" alt="" />
                                </li>
                                <li>
                                    <img class="img-responsive" src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-8.png" alt="" />
                                </li>
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <li>
                                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-thumb-0.jpg" alt="" />
                                </li>
                                <li>
                                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-thumb-1.jpg" alt="" />
                                </li>
                                <li>
                                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-thumb-2.jpg" alt="" />
                                </li>
                                <li>
                                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-thumb-3.jpg" alt="" />
                                </li>
                                <li>
                                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-thumb-4.jpg" alt="" />
                                </li>
                                <li>
                                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-thumb-5.jpg" alt="" />
                                </li>
                                <li>
                                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-thumb-6.jpg" alt="" />
                                </li>
                                <li>
                                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-thumb-7.jpg" alt="" />
                                </li>
                                <li>
                                    <img src="<?= esc_url( get_template_directory_uri() ); ?>/dist/images/work/case-study-thumb-8.jpg" alt="" />
                                </li>
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