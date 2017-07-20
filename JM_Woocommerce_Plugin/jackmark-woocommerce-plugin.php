<?php /**
 * Plugin Name: Jackmark Woocommerce Plugin
 * Description: Plugin to tailor Woocommerce for the Jackmark website.
 * Author:      Alex Mellor
 * Version:     1.0
 */
 ?>
<?php
add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
/**
 * woo_hide_page_title
 *
 * Removes the "shop" title on the main shop page
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function woo_hide_page_title() {
	
	return false;
	
}

add_filter( 'woocommerce_loop_add_to_cart_link', 'woocommerce_quantity_inputs', 10, 2 );
/**
 * woocommerce_quantity_inputs
 *
 * Adds Quantity input field next to "Add to Cart" button on WooCommerce shop page
 *
 * @access      public
 * @since       1.0 
 * @return      string
*/
function woocommerce_quantity_inputs( $html, $product ) {
	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
		$html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">';
		$html .= woocommerce_quantity_input( array(), $product, false );
		$html .= '<button type="submit" class="button alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
		$html .= '</form>';
	}
	return $html;
}

add_action( 'woocommerce_before_single_product', 'woocommerce_single_product_summary_button', 11);
/**
 * woocommerce_single_product_summary_button
 *
 * Adds back button to single-prouct page.
 *
 * @access      public
 * @since       1.0 
 * @return      string
*/
function woocommerce_single_product_summary_button() {
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
	$html = '<div id="shop-back"> 
		       <a class="back_button" href="' . $shop_page_url . '">Back to All Products</a>
		  </div>';
	echo $html;
}

// Display 24 products per page. @since 1.0
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

// Change the "add to cart" buttton text on Woocommerce single product pages. @since 1.0
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );

function woo_custom_cart_button_text() {
    return __( 'Request Product', 'woocommerce' );
}

//Change the "add to cart" button text on Woocommerce product archives. @since 1.0
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );
 
function woo_archive_custom_cart_button_text() {
    return __( 'Request Product', 'woocommerce' );
}

// Change the "Place Order" button text on the Woocommerce checkout page. @since 1.0
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 

function woo_custom_order_button_text() {
    return __( 'Enquire', 'woocommerce' ); 
}

// Change the "add to cart" woocommerce message text. @since 1.0
add_filter('wc_add_to_cart_message', 'handler_function_name', 10, 2);
function handler_function_name($message, $product_id) {
	$product = wc_get_product( $product_id );
	
    return $product->get_title() . '(s) added to enquiry list.
	<a class="button wc-forward" href="' . esc_url( WC()->cart->get_cart_url() ) . '">View List</a>';
}


// Adds Google Recaptcha script to woocommerce checkout head section.
add_action( 'wp_enqueue_scripts', 'recaptcha_enqueue' );

function recaptcha_enqueue() {
	if ( is_checkout() ) {
		wp_enqueue_script( 'google-recaptcha', 'https://www.google.com/recaptcha/api.js' );
	}
} 

// Adds Google Recaptcha to woocommerce checkout.
add_action( 'woocommerce_checkout_after_customer_details', 'reCaptchaInc');
 
function reCaptchaInc() {
	echo '<div class="g-recaptcha" data-sitekey="6LfAlRUUAAAAAAVeEaQ1V2NqGxsHe2mfRywWnLlO"></div>';
}

 // Google Recaptcha verification at woocommerce chekout.
add_action('woocommerce_checkout_process', 'is_human');

function is_human() { 
	$recaptchaResponse = $_POST['g-recaptcha-response'];
	$response=wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=6LfAlRUUAAAAAP6R8Mj1mReOzqA613DD_c_8waFW&response=".$recaptchaResponse);
	$responseStr = wp_remote_retrieve_body( $response );
	$obj = json_decode( $responseStr );
	if($obj->success == false) {
		// your function's body above, and if error, call this wc_add_notice
		wc_add_notice( ( 'Your Re-Captcha entry is incorrect.' ), 'error' );
	}
}  

// Removes default woocommerce 'cart is empty' message and updates it to a 'list is empty' message.
add_action( 'woocommerce_init', 'remove_cart_default' );

function remove_cart_default() {
	remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message');
}

add_action('woocommerce_cart_is_empty', 'jm_empty_cart_message', 10);

function jm_empty_cart_message() {
	echo '<p class="cart-empty">' . apply_filters( 'wc_empty_cart_message', __( 'Your list is currently empty.', 'woocommerce' ) ) . '</p>';
}
?>
