<?php get_template_part('templates/page', 'header'); ?>

<!-- ******404 Section****** --> 
<section class="section-404 section">
    <div class="container text-center">
        <h2 class="title-404 text-center"><?php _e('404', 'sage'); ?></h2>
        <p class="intro text-center"><?php _e('Oops! Something went wrong. <br>The requested page or file may have been moved or deleted.', 'sage'); ?></p>
        <div class="center-block">
        	<a class="btn btn-cta btn-cta-secondary" href="<?= esc_url(home_url('/')); ?>"><?php _e('Back to Home', 'sage'); ?> </a>
			<?php //get_search_form(); ?>
        </div>
    </div><!--//container-->
</section><!--//contact-section-->
