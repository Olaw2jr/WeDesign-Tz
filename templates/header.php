<?php
  use Roots\Sage\Extras;

  $page_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
$featuredImage = wp_get_attachment_image_src( get_option( 'page_for_posts' ) );
?>

<div class="header-wrapper <?= Extras\container_class(); ?>" style="background:  #65758e url('<?= $page_image ?>') no-repeat 50% top;">
  <!-- ******HEADER****** --> 
  <header id="header" class="header navbar-fixed-top">  
      <div class="container">
          <?php
          if ( function_exists( 'the_custom_logo' ) ) {
          ?>
              <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
                  <?php
                      $sage_logo = get_theme_mod( 'custom_logo' );
                      $image = wp_get_attachment_image_src( $sage_logo , 'full' );
                  ?>
                  <img class="nav-logo" style="height: 100%; width: auto; margin-right: 5px;" src="<?= $image[0]; ?>" alt="<?php bloginfo('name'); ?>">
              </a>
          <?php
          }
          ?>
          <h1 class="logo hidden-xs">
              <a href="<?= esc_url(home_url('/')); ?>"> <?php bloginfo('name'); ?> </a>
          </h1><!--//logo-->
          <nav class="main-nav navbar-right" role="navigation">
              <div class="navbar-header">
                  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                      <span class="sr-only"><?php _e( 'Toggle navigation', 'sage' ); ?> </span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button><!--//nav-toggle-->
              </div><!--//navbar-header-->
              <div id="navbar-collapse" class="navbar-collapse collapse">
                  <?php
                  if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu( array(
                      'theme_location'    => 'primary_navigation',
                      'depth'             => 2,
                      //'container'         => 'div',
                      //'container_class'   => 'navbar-collapse collapse',
                      //'container_id'      => 'navbar-collapse',
                      'menu_class'        => 'nav navbar-nav',
                      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                      'walker'            => new wp_bootstrap_navwalker())
                    );
                  endif;
                  ?>
              </div>
          </nav><!--//main-nav-->
      </div><!--//container-->
  </header><!--//header-->  

  <?php if ( is_front_page() ): ?> 
  <div class="bg-slider-wrapper">
    <div id="bg-slider" class="flexslider bg-slider">
      <ul class="slides">
        <li class="slide" style="background: #65758e url('<?= $page_image ?>') no-repeat 50% top;"></li> 
      </ul>
    </div>
  </div><!--//bg-slider-wrapper--> 
  <section id="home-promo" class="home-promo section">
    <div class="container text-center">                
      <h2 class="title">
        <span class="upper"><?php _e( 'We build', 'sage' ); ?> </span>
        <span class="middle"><?php _e( 'Web and Mobile Apps', 'sage' ); ?> </span>
        <span class="bottom"><?php _e( 'for startups and agencies', 'sage' ); ?> </span>
      </h2>
      <button class="btn btn-cta btn-cta-primary" type="button" data-toggle="modal" data-target="#modal-contact" data-backdrop="static"><?php _e( 'Talk to us', 'sage' ); ?></button>
    </div><!--//container-->
  </section><!--//promo-->
  <?php endif; ?> <!--End is Front page-->

  <?php get_template_part('templates/page', 'header'); ?>

</div><!--//header-wrapper-->
