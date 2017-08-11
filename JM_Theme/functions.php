<?php

add_action( 'wp_enqueue_scripts', 'jackmark_enqueue' );

function jackmark_enqueue() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.4', true );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Dosis|Yanone+Kaffeesatz' );
	wp_enqueue_script( 'respondJS', get_template_directory_uri() . '/js/respond.min.js' );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-custom.js' );
}

// Register Primary Navigation Menu to Wordpress.
add_action( 'after_setup_theme', 'register_primary_menu' );
 
function register_primary_menu() {
    register_nav_menu( 'primary', 'Primary Menu', 'jackmark-theme' );
}

// Register Lang Switcher Menu to Wordpress.
add_action( 'after_setup_theme', 'register_lang_menu' );
 
function register_lang_menu() {
    register_nav_menu( 'language-switcher', 'Language Switcher', 'jackmark-theme' );
}

// Register Custom Navigation Walker.
require_once('wp-bootstrap-navwalker.php');

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Adding viewport meta to enable responsive changes.
function viewport_meta(){
    ?> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <?php
}

add_filter('wp_head', 'viewport_meta');

// Includes js file for play/pause functionality on Showcase page.
add_action( 'wp_enqueue_scripts', 'video_scripts' );
function video_scripts() {
	if ( is_page_template( 'showcase.php' ) ) {
		wp_enqueue_script( 'playPause', get_stylesheet_directory_uri() . '/js/playPause.js');	
	}
}

remove_filter( 'authenticate', 'wp_authenticate_username_password', 20 );
add_filter( 'authenticate', 'jm_authenticate_username_password', 20, 3);

/**
 * Override for the default Authenticate a user function, confirming the username and password are valid.
 * -- Override exludes lost password links from displaying upon incorrect details being entered.
 *
 * @since 1.0.0
 * @param WP_User|WP_Error|null $user     WP_User or WP_Error object from a previous callback. Default null.
 * @param string                $username Username for authentication.
 * @param string                $password Password for authentication.
 * @return WP_User|WP_Error WP_User on success, WP_Error on failure.
 */
function jm_authenticate_username_password($user, $username, $password) {
	if ( $user instanceof WP_User ) {
		return $user;
	}

	if ( empty($username) || empty($password) ) {
		if ( is_wp_error( $user ) )
			return $user;

		$error = new WP_Error();

		if ( empty($username) )
			$error->add('empty_username', __('<strong>ERROR</strong>: The username field is empty.'));

		if ( empty($password) )
			$error->add('empty_password', __('<strong>ERROR</strong>: The password field is empty.'));

		return $error;
	}

	$user = get_user_by('login', $username);

	if ( !$user ) {
		return new WP_Error( 'invalid_username',
			__( '<strong>ERROR</strong>: Invalid username or password.' ) .
			' <a href="' . wp_lostpassword_url() . '"></a>'
		);
	}

	/**
	 * Filters whether the given user can be authenticated with the provided $password.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_User|WP_Error $user     WP_User or WP_Error object if a previous
	 *                                   callback failed authentication.
	 * @param string           $password Password to check against the user.
	 */
	$user = apply_filters( 'wp_authenticate_user', $user, $password );
	if ( is_wp_error($user) )
		return $user;

	if ( ! wp_check_password( $password, $user->user_pass, $user->ID ) ) {
		return new WP_Error( 'incorrect_password',
			sprintf(
				/* translators: %s: user name */
				__( '<strong>ERROR</strong>:Invalid username or password.' ),
				'<strong>' . $username . '</strong>'
			) .
			' <a href="' . wp_lostpassword_url() . '"></a>'
		);
	}

	return $user;
	
	
}

// Removes "Showing all _ results" text from the Products page. @since 1.0
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

//Change the "Proceed to Checkout" button text on the Woocommerce cart page. @since 1.0
function woocommerce_button_proceed_to_checkout() {
       $checkout_url = WC()->cart->get_checkout_url();
       ?>
       <a href="<?php echo $checkout_url; ?>" class="checkout-button button alt wc-forward"><?php _e( 'Proceed to Billing and Shipping', 'woocommerce' ); ?></a>
       <?php
}

// Adds theme support for title-tags. Recommended by Theme Check. @since 1.0
add_theme_support( 'title-tag' );

// Adds theme feature "content-width" which sets the maximum allowed width for any content in the theme. Recommended by Theme Check. @since 1.0
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}
