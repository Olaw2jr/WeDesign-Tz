<?php
if (post_password_required()) {
  return;
}
?>

<div id="comment-area" class="comment-area">
  <div class="comment-container">                   
    <div class="comment-list">
    <?php if (have_comments()) : ?>
      <h3 class="title">5 Comments</h3>
      
      <div class="comment-item depth-1 parent">
          <div class="comment-item-box">
              <div class="comment-author">
                  <img class="img-responsive" src="<?= get_template_directory_uri(); ?>/dist/images/comment/user-4.jpg" alt="" />
              </div><!--//comment-author-->
              <div class="comment-body">
                  <cite class="name">Kathy Morgan Says:</cite>
                  <p class="time">Jan 03, 2015 at 9:35m</p>
                  <div class="content">
                      <p>Nunc in urna eu lorem accumsan placerat vel eu turpis. Etiam laoreet posuere mauris, id pharetra orci molestie sit amet. Duis pretium diam ex, vitae eleifend diam ornare sit amet. </p>
                  </div><!--//content-->
                  <a class="comment-reply-link btn btn-cta btn-cta-secondary" href="#">Reply</a>
              </div><!--//comment-body-->          
          </div><!--//comment-box--> 
      </div><!--//comment-item depth-1-->

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
