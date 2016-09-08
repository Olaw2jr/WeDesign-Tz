<article <?php post_class('item'); ?>>                
    <div class="row">
        <h3 class="post-title col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="clearfix"></div>
        <div class="meta col-md-2 col-sm-3 col-xs-12 text-right">
            <ul class="meta-list list-unstyled">                                       
            	<li class="post-time post_date date updated">
            	    <span class="date"><?= get_the_date('d'); ?></span>
            	    <span class="month"><?= get_the_date('M'); ?></span>
                </li>
            	<li class="post-author"><a href="#"><?= get_the_author(); ?></a></li>
            	<li class="post-comments-link">
        	        <a href="<?php comments_link(); ?>"><?php comments_number('Leave Comment', '1 Comment', '2 comments'); ?></a>
        	    </li>
        	</ul><!--//meta-list-->                           	
        </div><!--//meta-list-->

        <?php //get_template_part('templates/entry-meta'); ?> 

        <div class="content-wrapper col-md-10 col-sm-9 col-xs-12">
            <figure class="figure">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'post-thumbnails', array( 'class' => 'img-responsive', 'alt' => get_the_title() ) ); ?>
                </a>
            </figure>
            <div class="content">
                <div class="desc">
                    <?php the_excerpt(); ?>
                    <a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'sage' ); ?> <i class="fa fa-long-arrow-right"></i></a>
                </div><!--//desc-->
            </div><!--//content-->
        </div><!--//content-wrapper-->   
    </div><!--//row-->            
</article><!--//item-->
