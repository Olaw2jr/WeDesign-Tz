<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    //add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size( 800, 300, false );
  add_image_size( 'post-thumb', 60, 60, true  );
  add_image_size( 'page-header', 1600, 400, false );
  add_image_size( 'work-thumbnail', 1184, 724, false );
  add_image_size( 'client-thumb', 200, 85, false );
  add_image_size( 'client-thumb2', 270, 125, false );

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));

   //Add theme support for custom Logo
   $args = [
       'height'      => 40,
       'width'       => 40,
       'flex-height' => true,
       'flex-width'  => true,
       'header-text' => [ 'site-title', 'site-description' ],
   ];
   add_theme_support('custom-logo', $args);

}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="title">',
    'after_title'   => '</h3>'
  ]);

  /* register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<div class="footer-col col-md-3 col-sm-4 %1$s %2$s"> <div class="footer-col-inner">',
    'after_widget'  => '</div> </div>',
    'before_title'  => '<h3 class="sub-title">',
    'after_title'   => '</h3>'
  ]); */

  // First footer widget area, located in the footer. Empty by default.
  register_sidebar([
    'name'          => __( 'First Footer', 'sage' ),
    'id'            => 'first-footer',
    'description'   => __( 'The first footer widget area', 'sage' ),
    'before_widget' => '<div class="footer-col col-md-3 col-sm-4  %1$s %2$s"> <div class="footer-col-inner">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h3 class="sub-title">',
    'after_title'   => '</h3>',
  ]);

  // Second Footer Widget Area, located in the footer. Empty by default.
  register_sidebar([
    'name'          => __( 'Second Footer', 'sage' ),
    'id'            => 'second-footer',
    'description'   => __( 'The second footer widget area', 'sage' ),
    'before_widget' => '<div class="footer-col col-md-6 col-sm-8  %1$s %2$s"> <div class="footer-col-inner">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h3 class="sub-title">',
    'after_title'   => '</h3>',
  ]);

  // Third Footer Widget Area, located in the footer. Empty by default.
  register_sidebar([
    'name'          => __( 'Third Footer', 'sage' ),
    'id'            => 'third-footer',
    'description'   => __( 'The third footer widget area', 'sage' ),
    'before_widget' => '<div class="footer-col col-md-3 col-sm-4  %1$s %2$s"> <div class="footer-col-inner">',
    'after_widget'  => '</div></div>',
    'before_title'  => '<h3 class="sub-title">',
    'after_title'   => '</h3>',
  ]);

}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
  wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
  // declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
  wp_localize_script( 'sage/js', 'SageAjax', [ 'ajaxurl' => admin_url( 'admin-ajax.php' ) ] );

  wp_register_script( 'pw-google-maps-api', 'https://maps.google.com/maps/api/js?key=AIzaSyAHPBcPSyJBWj2UVU8TQiODCLjgIy1sM0o', null, null, true );
  wp_enqueue_script('pw-google-maps-api');

  // Theme Admin Assets
  if(is_admin()) {
    wp_enqueue_script('sage/admin', Assets\asset_path('scripts/admin.js'), false, null);
  }
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

