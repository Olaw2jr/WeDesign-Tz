<?php
namespace Roots\Sage\Cpt;

/**
  * Creating a New Post Type
  */
add_action('init', __NAMESPACE__ . '\\register_custom_post_types');  
   
function register_custom_post_types() {  
  global $wpdb;
      
  // Add Excerpt support for Pages
    add_post_type_support( 'page', array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'revisions',
        'page-attributes'
    ) );

    $args = array(  
      'label' => __('Work', 'sage'),  
      'singular_label'   => __('Work', 'sage'),  
      'public'          => true,  
      'show_ui'         => true,  
      'capability_type' => 'post',  
      'hierarchical'    => false,  
      'rewrite'         => true,  
      'supports'        => array('title', 'editor', 'thumbnail'),
      'menu_position'   => 20, 
      'menu_icon'       => 'dashicons-portfolio' 
    );   
    register_post_type( 'work' , $args ); //End of Work CPT

    // Set table to store custom taxonomy metadata for Companies
      $wpdb->clientmeta = $wpdb->prefix."clientmeta"; 
        
    // Testimonials
    register_post_type( 'testimonial', array(
      'labels' => array(
        'name'              => _x( 'Testimonials', 'post type general name' ),
        'singular_name'     => _x( 'Testimonial', 'post type singular name' ),
        'add_new'           => _x( 'Add New', 'testimonial' ),
        'add_new_item'      => __( 'Add New Testimonial' ),
        'edit_item'         => __( 'Edit Testimonial' ),
        'new_item'          => __( 'New Testimonial' ),
        'view_item'         => __( 'View Testimonials' ),
        'search_items'      => __( 'Search Testimonials' ),
        'not_found'         => __( 'No testimonials found' ),
        'not_found_in_trash'=> __( 'No testimonials found in Trash' ), 
        'parent_item_colon' => ''
      ),
      'description'           => __( 'Testimonials' ),
      'public'                => true,
      'publicly_queryable'    => true,
      'exclude_from_search'   => false,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 20,
      'menu_icon'             => 'dashicons-groups',
      'capability_type'       => 'post',
      'hierarchical'          => false,
      'supports'              => array( 'title', 'excerpt', 'thumbnail' ),
      'has_archive'           => true,
      'show_in_nav_menus'     => true,
      'rewrite'               => array(
        'slug'      => 'testimonial', 
        'with_front'=> false
      ),
    ) );
 
}

/**
  * Adding a Custom Taxonomy
  */
register_taxonomy("work_type", 
  array("work"), 
  array(
    "hierarchical" => true, 
    "label" => "Work Type", 
    "singular_label" => "Work Type", 
    "rewrite" => true
  )
);

// Add Work Meta Box
function add_work_meta_box() {
  add_meta_box(
    'work_meta_box', // $id
    'Extra Work Details', // $title 
     __NAMESPACE__ . '\\show_work_meta_box', // $callback
    'work', // $page
    'normal', // $context
    'high' // $priority
  );
}
add_action('add_meta_boxes', __NAMESPACE__ . '\\add_work_meta_box');  
   
// Field Array
$prefix = 'sage_';
$work_meta_fields = array(
  array(
    'label'=> 'Client Name',
    'desc'  => 'Fill in the Name of the client',
    'id'    => $prefix.'client',
    'type'  => 'text'
  ),
  array(
    'label'=> 'Client Link',
    'desc'  => 'Fill in the link to clients work if any.',
    'id'    => $prefix.'link',
    'type'  => 'text'
  )
);

// The Callback
function show_work_meta_box() {
global $work_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="work_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
     
  // Begin the field table and loop
  echo '<table class="form-table">';
  foreach ($work_meta_fields as $field) {
    // get value of this field if it exists for this post
    $meta = get_post_meta($post->ID, $field['id'], true);
    // begin a table row with
    echo '<tr>
      <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
      <td>';
      switch($field['type']) {
      // case items will go here
        // text
        case 'text':
          echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
            <br /><span class="description">'.$field['desc'].'</span>';
        break;
        // text
        case 'text':
          echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
            <br /><span class="description">'.$field['desc'].'</span>';
        break;

      } //end switch
    echo '</td></tr>';
  } // end foreach
  echo '</table>'; // end table
}

// Save the Data
function save_work_meta($post_id) {
  global $work_meta_fields;
   
  // verify nonce
  if (!wp_verify_nonce($_POST['work_meta_box_nonce'], basename(__FILE__))) 
    return $post_id;
  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return $post_id;
  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id))
      return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }
   
  // loop through fields and save the data
  foreach ($work_meta_fields as $field) {
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {
      update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $field['id'], $old);
    }
  } // end foreach
}
add_action('save_post', __NAMESPACE__ . '\\save_work_meta');


/**
  * Add Testimonial Meta Box
  **/
function add_testimonial_meta_box() {
  add_meta_box(
    'testimonial_meta_box', // $id
    'Extra Testimonials Details', // $title 
     __NAMESPACE__ . '\\show_testimonial_meta_box', // $callback
    'testimonial', // $page
    'normal', // $context
    'high' // $priority
  );
}
add_action('add_meta_boxes', __NAMESPACE__ . '\\add_testimonial_meta_box');  
   
// Field Array
$prefix = 'sage_';
$testimonial_meta_fields = array(
  array(
    'label'=> 'Client Position',
    'desc'  => 'Fill in the clients position at the company.',
    'id'    => $prefix.'position',
    'type'  => 'text'
  ),
  array(
    'name'  => 'Client Avatar',
    'desc'  => 'Uploads the clients Avatar if Any.',
    'id'    => $prefix.'avatar',
    'type'  => 'image'
  )
);

// The Callback
function show_testimonial_meta_box() {
global $testimonial_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="testimonial_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
     
  // Begin the field table and loop
  echo '<table class="form-table">';
  foreach ($testimonial_meta_fields as $field) {
    // get value of this field if it exists for this post
    $meta = get_post_meta($post->ID, $field['id'], true);
    // begin a table row with
    echo '<tr>
      <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
      <td>';
      switch($field['type']) {
      // case items will go here
        // text
        case 'text':
          echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
            <br /><span class="description">'.$field['desc'].'</span>';
        break;
        // image
        case 'image':
          $image = get_template_directory_uri().'/dist/images/client/client-profile-1.png';      
          echo '<span class="testimonial_default_image" style="display:none">'.$image.'</span>';
          if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');     $image = $image[0]; }                           
            echo '<input name="'.$field['id'].'" type="hidden" class="testimonial_upload_image" value="'.$meta.'" />
              <img src="'.$image.'" class="testimonial_preview_image" alt="" /><br />
              <input class="testimonial_upload_image_button button" type="button" value="Choose Avatar" />
              <small> <a href="#" class="testimonial_clear_image_button">Remove Avatar</a></small>
              <br clear="all" /><span class="description">'.$field['desc'].'</span>';
        break;

      } //end switch
    echo '</td></tr>';
  } // end foreach
  echo '</table>'; // end table
}

// Save the Data
function save_testimonial_meta($post_id) {
  global $testimonial_meta_fields;
   
  // verify nonce
  if (!wp_verify_nonce($_POST['testimonial_meta_box_nonce'], basename(__FILE__))) 
    return $post_id;
  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return $post_id;
  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id))
      return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }
   
  // loop through fields and save the data
  foreach ($testimonial_meta_fields as $field) {
    $old = get_post_meta($post_id, $field['id'], true);
    $new = $_POST[$field['id']];
    if ($new && $new != $old) {
      update_post_meta($post_id, $field['id'], $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $field['id'], $old);
    }
  } // end foreach
}
add_action('save_post', __NAMESPACE__ . '\\save_testimonial_meta');