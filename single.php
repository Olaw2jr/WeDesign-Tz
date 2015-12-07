<?php //get_template_part('templates/content-single', get_post_type()); ?>

<div class="breadcrumbs container">
    <?php Roots\Sage\Extras\breadcrumbs(); ?>
</div><!--//breadcrumbs-->

<!-- ******Blog Post****** -->
<div class="blog-post-wrapper container">            
    <div class="row">
        <div class="blog-entry col-md-8 col-sm-8 col-xs-12"> 
        	<?php get_template_part('templates/content-single', get_post_type()); ?> 
        </div><!--//blog-entry-->
        
        <aside id="blog-sidebar" class="blog-sidebar col-md-3 col-sm-4 col-xs-12 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
            <?php include Roots\Sage\Wrapper\sidebar_path(); ?>
        </aside><!--//blog-side-bar-->               
    </div><!--//row-->
</div><!--//blog-->
