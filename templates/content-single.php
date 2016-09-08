<?php while (have_posts())  : the_post(); ?>      
  <article <?php post_class('post'); ?>>
    <h2 class="title"><?php the_title(); ?></h2>
    <div class="meta">
      <ul class="meta-list list-inline">                                       
        <li class="post-time post_date date updated" datetime="<?= get_post_time('c', true); ?>"><i class="fa fa-calendar"></i> <?= get_the_date('M d, Y'); ?></li>
        <li class="post-author"><i class="fa fa-user"></i> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>"> <?= get_the_author(); ?></a></li>
        <li class="post-comments-link">
          <a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i><?php comments_number('Leave Comment', '1 Comment', '2 Comments'); ?></a>
        </li>
      </ul><!--//meta-list-->                             
    </div><!--meta-->
    <div class="content">
      <p class="post-figure">
        <?php the_post_thumbnail( 'post-thumbnails', array( 'class' => 'img-responsive', 'alt' => get_the_title() ) ); ?>
      </p><!--//post-figure-->

      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </div>

  <div class="clearfix"></div>
  <nav class="post-nav">
    <span class="nav-previous"><?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i>Previous'); ?></span>
    <span class="nav-next"><?php next_post_link('%link', 'Next<i class="fa fa-long-arrow-right"></i>'); ?></span>
  </nav><!--//post-nav-->
  
  <?php comments_template('/templates/comments.php'); ?>                                          
  </article><!--//post--> 
<?php endwhile; ?>
