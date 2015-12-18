 <?php

/* The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if (   ! is_active_sidebar( 'first-footer'  )
    && ! is_active_sidebar( 'second-footer' )
    && ! is_active_sidebar( 'third-footer'  )
)
    return;

// This checks if all footer widgets are populated
else ?>

    <?php dynamic_sidebar( 'first-footer' ); ?> <!-- .first .widget-area -->
 
    <?php dynamic_sidebar( 'second-footer' ); ?> <!-- .second .widget-area -->
 
    <?php dynamic_sidebar( 'third-footer' ); ?> <!-- .third .widget-area -->

<?php
//end of all sidebar checks.
endif;





