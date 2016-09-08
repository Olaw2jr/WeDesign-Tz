<form role="search" method="get" id="searchform" action="<?= esc_url(home_url('/')); ?>" class="search-blog-form">
    <div class="form-group">
        <input type="text" class="form-control" value="<?= get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search blog...', 'sage' ); ?>">
    </div>
    <button type="submit" id="searchsubmit" class="btn btn-cta btn-cta-secondary"><i class="fa fa-search"></i></button>
</form>