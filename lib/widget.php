<?php
/**
* The Contact infomation widget
*/
class ContactInfoWidget extends WP_Widget {

	//Constructor
	function ContactInfoWidget(){
		parent::WP_Widget(false, $name = 'Contact Infomation');
	}

	// @See WP_Widget::widget this function is where the widget is rendered
	function widget($args, $instance) {
		extract($args);

		//get the variables, cleaning where needed
		$title = apply_filters('widget_title', $instance['title']);
		$fullname = $instance['fullname'];
		$email = $instance['contact_email'];
		$phone = nl2br($instance['phone']);
		$hours = nl2br($instance['office-hours']);
		$location = nl2br($instance['office-location']);

		//Start actual rendering of the widget area
		echo $before_widget;

		//if the specified the title, give a title, if not we set it for them
		if ( $title ) {
		 	echo $before_title . $title . $after_title;
		 } else {

		 }
	}

	function(){

	}
}


?>