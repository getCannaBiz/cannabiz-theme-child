<?php
/**
 * Enqueue the parent theme stylesheet
 *
 * DO NOT DELETE THIS FUNCTION :)
 */
function cannabiz_parent_enqueue_styles() {
	wp_enqueue_style( 'cannabiz-theme', get_template_directory_uri() .'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'cannabiz_parent_enqueue_styles' );
