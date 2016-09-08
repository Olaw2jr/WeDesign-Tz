<?php
if (post_password_required()) {
  return;
}
?>

<div id="comment-area" class="comment-area">
  <div class="comment-container">                   
    <div class="comment-list">
    <?php if (have_comments()) : ?>
      <h4 class="title">
        <?php
          printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sage' ),
            number_format_i18n( get_comments_number() ), get_the_title() );
        ?>
      </h4>
      
      <ol class="commentlist">
        <?php wp_list_comments('type=comment&callback=Roots\Sage\Extras\wp_bootstrap_comments'); ?>
      </ol>

      <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav>
        <ul class="pager">
          <?php if (get_previous_comments_link()) : ?>
            <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'sage')); ?></li>
          <?php endif; ?>
          <?php if (get_next_comments_link()) : ?>
            <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'sage')); ?></li>
          <?php endif; ?>
        </ul>
      </nav>
      <?php endif; ?>

    <?php endif; //have_comments(); ?>

    </div><!--comment-list-->
  </div><!--//comments-container-->

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Comments are closed.', 'sage'); ?>
    </div>
  <?php endif; ?>
  
  <div class="comment-form-container">
    <?php comment_form(); ?>
  </div><!--//comment-form-container-->               
</div><!--//comment-area--> 
