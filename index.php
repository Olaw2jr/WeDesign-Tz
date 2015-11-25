<?php //get_template_part('templates/page', 'header'); ?>

<!-- ******Blog list Section****** -->
<section id="blog-list" class="blog-list section">
    <div class="container">

    	<?php if (!have_posts()) : ?>
            <div class="alert alert-warning">
                <?php _e('Sorry, no results were found.', 'sage'); ?>
            </div>
            <?php //get_search_form(); ?>
    	<?php endif; ?>

    	<?php while (have_posts()) : the_post(); ?>
        	<?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
        <?php endwhile; ?>

        <div class="pagination-container text-center">
            <!--<ul class="pagination">
                <li class="disabled"><a href="#">«</a></li>
                <li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">»</a></li>
            </ul>//pagination-->

            <?php the_posts_pagination( array(
				'mid_size' => 3,
				'prev_text' => __( '«', 'sage' ),
				'next_text' => __( '»', 'sage' ),
			) ); ?>

        </div> 
        
    </div><!--//container-->
</section><!--//blog-list--> 
