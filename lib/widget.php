<?php

/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class Sage_Recent_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'recent-posts', 'description' => __( "Your site&#8217;s most recent Posts.") );
		parent::__construct('recent-posts', __('Sage Recent Posts'), $widget_ops);
		$this->alt_option_name = 'recent-posts';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_recent_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<ul class="list-unstyled">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			
			<li>
				<?php the_post_thumbnail('thumb', array('class' => 'thumb img-responsive')); ?>
		        <!-- <img class="thumb img-responsive" src="<?= get_template_directory_uri(); ?>/dist/images/blog/blog-tiny-thumb-1.jpg" alt="" /> -->
		        <span class="post-info">
		            <a class="post-title" href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a><br />
		            <?php if ( $show_date ) : ?>
						<span class="date"><?php echo get_the_date(); ?></span>
					<?php endif; ?>
		        </span>
		    </li>

		<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	/**
	 * @access public
	 */
	public function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
	}
}

// register Sage_Recent_Posts widget
add_action('widgets_init', create_function('', 'return register_widget("Sage_Recent_Posts");'));

/**
 * Categories widget class
 *
 * @since 2.8.0
 */
class Sage_Categories extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'categories', 'description' => __( "A list or dropdown of categories." ) );
		parent::__construct('categories', __('Sage Categories'), $widget_ops);
	}

	/**
	 * @staticvar bool $first_dropdown
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		static $first_dropdown = true;

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );

		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $c,
			'hierarchical' => $h
		);

		if ( $d ) {
			$dropdown_id = ( $first_dropdown ) ? 'cat' : "{$this->id_base}-dropdown-{$this->number}";
			$first_dropdown = false;

			echo '<label class="screen-reader-text" for="' . esc_attr( $dropdown_id ) . '">' . $title . '</label>';

			$cat_args['show_option_none'] = __( 'Select Category' );
			$cat_args['id'] = $dropdown_id;

			/**
			 * Filter the arguments for the Categories widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_dropdown_categories()
			 *
			 * @param array $cat_args An array of Categories widget drop-down arguments.
			 */
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
?>

<script type='text/javascript'>
/* <![CDATA[ */
(function() {
	var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
	function onCatChange() {
		if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
			location.href = "<?php echo home_url(); ?>/?cat=" + dropdown.options[ dropdown.selectedIndex ].value;
		}
	}
	dropdown.onchange = onCatChange;
})();
/* ]]> */
</script>

<?php
		} else {
?>
		<ul class="list-unstyled">
<?php
		$cat_args['title_li'] = '';

		/**
		 * Filter the arguments for the Categories widget.
		 *
		 * @since 2.8.0
		 *
		 * @param array $cat_args An array of Categories widget options.
		 */
		wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
?>
		</ul>
<?php
		}

		echo $args['after_widget'];
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = esc_attr( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts' ); ?></label><br />

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy' ); ?></label></p>
<?php
	}

}

// register Sage_Categories widget
add_action('widgets_init', create_function('', 'return register_widget("Sage_Categories");'));

/**
 * Archives widget class
 *
 * @since 2.8.0
 */
class Sage_Archives extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'archives', 'description' => __( 'A monthly archive of your site&#8217;s Posts.') );
		parent::__construct('archives', __(' Sage Archives'), $widget_ops);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Archives' ) : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		if ( $d ) {
			$dropdown_id = "{$this->id_base}-dropdown-{$this->number}";
?>
		<label class="screen-reader-text" for="<?php echo esc_attr( $dropdown_id ); ?>"><?php echo $title; ?></label>
		<select id="<?php echo esc_attr( $dropdown_id ); ?>" name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
			<?php
			/**
			 * Filter the arguments for the Archives widget drop-down.
			 *
			 * @since 2.8.0
			 *
			 * @see wp_get_archives()
			 *
			 * @param array $args An array of Archives widget drop-down arguments.
			 */
			$dropdown_args = apply_filters( 'widget_archives_dropdown_args', array(
				'type'            => 'monthly',
				'format'          => 'option',
				'show_post_count' => $c
			) );

			switch ( $dropdown_args['type'] ) {
				case 'yearly':
					$label = __( 'Select Year' );
					break;
				case 'monthly':
					$label = __( 'Select Month' );
					break;
				case 'daily':
					$label = __( 'Select Day' );
					break;
				case 'weekly':
					$label = __( 'Select Week' );
					break;
				default:
					$label = __( 'Select Post' );
					break;
			}
			?>

			<option value=""><?php echo esc_attr( $label ); ?></option>
			<?php wp_get_archives( $dropdown_args ); ?>

		</select>
<?php
		} else {
?>
		<ul class="list-unstyled">
<?php
		/**
		 * Filter the arguments for the Archives widget.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_get_archives()
		 *
		 * @param array $args An array of Archives option arguments.
		 */
		wp_get_archives( apply_filters( 'widget_archives_args', array(
			'type'            => 'monthly',
			'show_post_count' => $c
		) ) );
?>
		</ul>
<?php
		}

		echo $args['after_widget'];
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = $new_instance['count'] ? 1 : 0;
		$instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;

		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$title = strip_tags($instance['title']);
		$count = $instance['count'] ? 'checked="checked"' : '';
		$dropdown = $instance['dropdown'] ? 'checked="checked"' : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $dropdown; ?> id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>" /> <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e('Display as dropdown'); ?></label>
			<br/>
			<input class="checkbox" type="checkbox" <?php echo $count; ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" /> <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label>
		</p>
<?php
	}
}

// register Sage_Archives widget
add_action('widgets_init', create_function('', 'return register_widget("Sage_Archives");'));


/********************************************************************************************************************************************
**********************************************************************************************************************************************
*********************************************************************************************************************************************/



/**
* The Contact infomation widget
*/
class ContactInfoWidget extends WP_Widget {
    
    /** constructor */
    function ContactInfoWidget() {
        parent::WP_Widget(false, $name = 'Contact Information');	
    }
    /** @see WP_Widget::widget this function is where the widget is rendered*/
    function widget($args, $instance) {		
        extract( $args );
        //get the variables, cleaning where needed
        $title    = apply_filters('widget_title', $instance['title']);
        $street_address = $instance['street_address'];
        $city = $instance['city'];
        $postal_code = $instance['postal_code'];
        $country_name = $instance['country_name'];
        $email    = $instance['contact-email'];
        $phone    = nl2br($instance['phone']);

        /*
	        street-address
	        city
	        postal-code
	        country-name

	        phone
	        email
        */

        //start actual rendering of widget data
        echo $before_widget; 
 		
 		// if they specify a title, give a title, if not we set it for them
 		if ( $title ) {
    	echo $before_title . $title . $after_title;
    }else {
    	echo $before_title . "Contact Information" . $after_title;
    }
    
    //name of the person
    if ($fullname != ""){
    	echo "<p><strong>$fullname</strong></p>";
    }
    
    //email address, making sure that it's obfuscated    
    if ($email != ""){  
    	$email = antispambot($email);          
			echo "<p><strong>Email:</strong><br/>";
			echo "<a href=\"mailto:$email\">$email</a></p>";
		}
		
		//phone number
		if ($phone != ""){ 
			echo "<p><strong>Phone:</strong><br/>$phone</p>";
		}
				
		//Office Location
		if ($location != ""){
			echo "<p><strong>Address:</strong><br/>$location</p>";
		}
		
		//Office Hours
		if ($hours != ""){
			echo "<p><strong>Office Hours:</strong><br/>$hours</p>";
		}
		
		//WP after widget cleanup
		echo $after_widget; 
    }
    /** @see WP_Widget::update  this function is where the widget is saved to the WP database*/
    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title']            = strip_tags($new_instance['title']           );
		$instance['fullname']         = strip_tags($new_instance['fullname']        );
		$instance['contact-email']    = strip_tags($new_instance['contact-email']   );
		$instance['phone']            = strip_tags($new_instance['phone']           );
		$instance['office-hours']     = strip_tags($new_instance['office-hours']    );
		$instance['office-location']  = strip_tags($new_instance['office-location'] );
   	    return $instance;
    }
    /** @see WP_Widget::form   this function renders the form that users see in Appearence -> Widgets*/
    function form($instance) {				
        //clean up those variables
        $title    = esc_attr($instance['title']           );
        $fullname = esc_attr($instance['fullname']        );
        $email    = esc_attr($instance['contact-email']   );
        $phone    = esc_attr($instance['phone']           );
        $hours    = esc_attr($instance['office-hours']    );
        $location = esc_attr($instance['office-location'] );
        ?>
        <p>
          <small><em>All fields are optional, if left blank, they will not display anything</em></small></p>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p><p>  
          <label for="<?php echo $this->get_field_id('fullname'); ?>"><?php _e('Name:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('fullname'); ?>" name="<?php echo $this->get_field_name('fullname'); ?>" type="text" value="<?php echo $fullname; ?>" />
        </p><p>
          <label for="<?php echo $this->get_field_id('contact-email'); ?>"><?php _e('Email:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('contact-email'); ?>" name="<?php echo $this->get_field_name('contact-email'); ?>" type="text" value="<?php echo $email; ?>" />
        </p><p>  
          <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:'); ?></label> 
          <textarea id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" ><?php echo $phone; ?></textarea>
        </p><p>  
          <label for="<?php echo $this->get_field_id('office-location'); ?>"><?php _e('Office Location:'); ?></label> 
          <textarea id="<?php echo $this->get_field_id('office-location'); ?>" name="<?php echo $this->get_field_name('office-location'); ?>" ><?php echo $location; ?></textarea>
        </p><p>  
          <label for="<?php echo $this->get_field_id('office-hours'); ?>"><?php _e('Office Hours: <small><em>(line breaks are preserved)</em></small>'); ?></label> 
          <textarea id="<?php echo $this->get_field_id('office-hours'); ?>" name="<?php echo $this->get_field_name('office-hours'); ?>" ><?php echo $hours; ?></textarea>
        </p>
        <?php 
    }
} // end class ContactInfoWidget
// register ContactInfoWidget widget
add_action('widgets_init', create_function('', 'return register_widget("ContactInfoWidget");'));