<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/front-page/who'); ?>
  <?php get_template_part('templates/front-page/work'); ?>
  <?php get_template_part('templates/front-page/testimonial'); ?>
  <?php get_template_part('templates/front-page/logos'); ?>
  <?php get_template_part('templates/front-page/blog'); ?>
<?php endwhile; 