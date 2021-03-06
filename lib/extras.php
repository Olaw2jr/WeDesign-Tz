<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return '';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
* Add Classes according to the page opened
*/
function container_class() {
  if (is_front_page() ) {
    return 'header-wrapper-home';
  } elseif (is_home() || is_page()) {
    return 'header-wrapper-page';
  } else {
    return 'no-header-wrapper';
  }
}

/**
  * Adds more author fields in the back end.
  */
function contact_info($contactmethods) {
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['twitter']);
    unset($contactmethods['facebook']);
    $contactmethods['position'] = 'Position';
    $contactmethods['phone_no'] = 'Phone No';
    $contactmethods['twitter_profile'] = 'Twitter';
    $contactmethods['github_profile'] = 'Github';
    return $contactmethods;
}
add_filter('user_contactmethods', __NAMESPACE__ . '\\contact_info',10,1);

// Add a custom user role
 
  $result = add_role( 'developer', __( 'Developer' ),
    array(
      'read' => true, // true allows this capability
      'edit_posts' => true, // Allows user to edit their own posts
      'edit_pages' => true, // Allows user to edit pages
      'edit_others_posts' => true, // Allows user to edit others posts not just their own
      'create_posts' => true, // Allows user to create new posts
      'manage_categories' => true, // Allows user to manage post categories
      'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
      'edit_themes' => false, // false denies this capability. User can’t edit your theme
      'install_plugins' => false, // User cant add new plugins
      'update_plugin' => false, // User can’t update any plugins
      'update_core' => false // user cant perform core updates
    )
  );

/**
  * Creating a Breadcrumbs
  */
function breadcrumbs() {

  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '<i class="fa fa-angle-right"></i>'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<li class="current">'; // tag before the current crumb
  $after = '</li>'; // tag after the current crumb

  global $post;
  $homeLink = get_bloginfo('url');

  if (is_home() || is_front_page()) {

    if ($showOnHome == 1) echo '<ul class="breadcrumbs-list list-inline"><li><a href="' . $homeLink . '">' . $home . '</a></li></ul>';

  } else {

    echo '<ul class="breadcrumbs-list list-inline"><li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . '' . single_cat_title('', false) . '' . $after;

    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li> ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id = $page->post_parent;
      }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . '</li> ';
      }
        if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</ul>';

  }
} // end sage_breadcrumbs()

/**
 * Function that validates a field's length in contact page.
 */
function sage_validate_length( $fieldValue, $minLength ) {
  // First, remove trailing and leading whitespace
  return ( strlen( trim( $fieldValue ) ) > $minLength );
}

/**
  * COMMENT LAYOUT 
  */
// Comment Layout
function wp_bootstrap_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <div id="comment-<?php comment_ID(); ?>" class="comment-item depth-1 parent">
          <div class="comment-item-box">
              <div class="comment-author">
                  <?php echo get_avatar( $comment, $size='60' ); ?>
              </div><!--//comment-author-->
              <div class="comment-body">
                  <?php printf('<cite class="name">%s Says:</cite>', get_comment_author_link()) ?>
                  <p class="time"><?php comment_time('F j, Y '); ?></p>
                  <div class="content">
                      <?php comment_text() ?>
                  </div><!--//content-->
                  <a class="comment-reply-link btn btn-cta btn-cta-secondary" href="#">Reply</a>
              </div><!--//comment-body-->          
          </div><!--//comment-box--> 
      </div><!--//comment-item depth-1-->
    <!-- </li> is added by wordpress automatically -->

<?php
} // don't remove this bracket!
// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php 
}

/**
 * Contact Form Ajax
 * @Author: Oscar Olotu
 * @Class: sage_posts
 *
 * Thanks to Carl Victor Fontanos
 * http://carlofontanos.com/build-your-own-ajax-contact-form-in-wordpress/
 */
add_action('wp_ajax_sage_send_message', array( __NAMESPACE__ . '\\sage_posts', 'sage_send_message'));
add_action('wp_ajax_nopriv_sage_send_message', array( __NAMESPACE__ . '\\sage_posts', 'sage_send_message'));
add_filter('wp_mail_content_type', array( __NAMESPACE__ . '\\sage_posts', 'sage_mail_content_type'));

class sage_posts{
    public static function sage_send_message(){
        if(isset($_POST['message'])){
            $to = get_option( 'admin_email' );
            $headers = 'From: '. $_POST['name'] . '<"'. $_POST['email'] .'">';
            $subject = "New Message from " . $_POST['name'];
            ob_start();
            echo '
                <h2>Message: </h2>' .
                wpautop($_POST['message']) . '
                <br />
                --
                <p> <a href="'. home_url() .'" >https://minshock.co.tz</a></p>
            ';
            $message = ob_get_contents();
            ob_end_clean();
            $mail = wp_mail($to, $subject, $message, $headers);
            if($mail){
                echo 'success';
            }
        }
        die();
    }

    public static function sage_mail_content_type(){
        return "text/html";
    }
}
// This has to with issues on WordPress 4.6 i guess see more in the link below..
// https://github.com/Automattic/vip-quickstart/issues/512#issue-165799484
add_filter( 'wp_mail_from', __NAMESPACE__ . '\\sage_mail_from' );
function sage_mail_from() {
    return 'noreply@minshock.com';
};
