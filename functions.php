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

/**
 * Add your own functions here.
 */
function wpd_cannabiz_header_after() {
	$home_intro  = '';
	if ( is_front_page() ) {
		$home_intro .= '<div class="home-intro"><div class="container"><div class="row site-intro">';
		$home_intro .= '<h2>Cannabis Software for Dispensaries and Delivery Services</h2>';
		$home_intro .= '<h4>WP Dispensary makes it easy for your patients to browse your menu and order online</h4>';
		$home_intro .= '<a href="https://demo.wpdispensary.com/" class="button alt" target="_blank">View Demo</a> <a href="https://wpdispensary.com/features/" class="button">Learn More</a>';
		$home_intro .= '</div></div><div class="site-header-bg"></div></div>';
	}
	echo $home_intro;
}
add_action( 'cannabiz_header_after', 'wpd_cannabiz_header_after' );


/**
 * Set origin cookie
 *
 * Adds a cookie that stores the origin URL so we can save the referrer to each order
 * @see wpd_add_order_referrer()
 */
function wpd_set_origin_cookie() {
	// Get referrer to save as cookie value.
    $cookie_value = $_SERVER['HTTP_REFERER'];

	// Set the origin cookie.
    if ( ! is_admin() && ! isset( $_COOKIE['origin'] ) ) {
		setcookie( 'origin', $cookie_value, time() + 3600*24*30, COOKIEPATH, COOKIE_DOMAIN, FALSE );
    }
}
add_action( 'init', 'wpd_set_origin_cookie' );

/**
 * Add origin cookie to order details
 *
 * @param object $order
 * @return void
 */
function wpd_add_order_referrer( $order ) {
    $order->add_meta_data( 'referrer', $_COOKIE['origin'] );
}
add_action( 'woocommerce_checkout_create_order', 'wpd_add_order_referrer', 10, 1 );
