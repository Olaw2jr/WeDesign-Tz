<!-- ******FOOTER****** --> 
<footer class="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">

                <?php //get_sidebar('templates\sidebar-footer.php'); ?>

                <?php dynamic_sidebar( 'first-footer' ); ?> <!-- .first .widget-area -->
 
                <?php dynamic_sidebar( 'second-footer' ); ?> <!-- .second .widget-area -->
             
                <?php dynamic_sidebar( 'third-footer' ); ?> <!-- .third .widget-area -->

            </div>   
        </div>        
    </div><!--//footer-content-->
    <div class="bottom-bar">
        <div class="container center">                                   
            <small class="copyright text-center"><?php _e( 'Copyright', 'sage' ); ?> @ <?php the_time('Y'); ?> <?php bloginfo('name'); ?></small>                 
        </div><!--//container-->
    </div><!--//bottom-bar-->
</footer><!--//footer-->

<?php get_template_part('front-page/modal-contact.php'); ?>