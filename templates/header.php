<?php
  use Roots\Sage\Extras;
?>

<div class="header-wrapper <?= Extras\container_class(); ?>" style="background:  #65758e url('<?= get_template_directory_uri(); ?>/dist/images/background/heading-background-1.jpg') no-repeat 50% top;">
  <!-- ******HEADER****** --> 
  <header id="header" class="header navbar-fixed-top">  
      <div class="container">       
          <h1 class="logo">
              <a href="<?= esc_url(home_url('/')); ?>"><span class="highlight">We</span>Design <?php //bloginfo('name'); ?></a>
          </h1><!--//logo-->
          <nav class="main-nav navbar-right" role="navigation">
              <div class="navbar-header">
                  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button><!--//nav-toggle-->
              </div><!--//navbar-header-->

                  <?php
                  if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu( array(
                      'theme_location'    => 'primary_navigation',
                      'depth'             => 2,
                      'container'         => 'div',
                      'container_class'   => 'navbar-collapse collapse',
                      'container_id'      => 'navbar-collapse',
                      'menu_class'        => 'nav navbar-nav',
                      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                      'walker'            => new wp_bootstrap_navwalker())
                    );
                  endif;
                  ?>

          </nav><!--//main-nav-->
      </div><!--//container-->
  </header><!--//header-->  

  <?php if ( is_front_page() ): ?> 
  <div class="bg-slider-wrapper">
    <div id="bg-slider" class="flexslider bg-slider">
      <ul class="slides">
        <li class="slide slide-1"></li>
        <li class="slide slide-2"></li>
        <li class="slide slide-3"></li>
      </ul>
    </div>
  </div><!--//bg-slider-wrapper--> 
  <section id="home-promo" class="home-promo section">
    <div class="container text-center">                
      <h2 class="title">
        <span class="upper">We build</span>
        <span class="middle">Web and Mobile Apps</span>
        <span class="bottom">for startups and agencies</span>
      </h2>
      <button class="btn btn-cta btn-cta-primary" type="button" data-toggle="modal" data-target="#modal-contact" data-backdrop="static">Talk to us</button>
    </div><!--//container-->
  </section><!--//promo-->
  <?php endif; ?> <!--End is Front page-->

  <?php get_template_part('templates/page', 'header'); ?>

</div><!--//header-wrapper-->
