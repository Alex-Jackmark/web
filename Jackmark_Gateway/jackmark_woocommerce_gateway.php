<?php

/**
 * Plugin Name: Jackmark Woocommerce Checkout Gateway
 * Plugin URI:  
 * Description: Default checkout gateway for customers of Jackmark's website.
 * Author:      Alex Mellor
 * Author URI:  
 * Version:     1.0
 */
 
 
/**
 *
 *  Creates and adds an extra gateway to woocommerce. 
 *
 */
 function jm_wc_gWay_init() {
	 
	/**
	 *  Checks to see if the woocommerce plugin is active.
	 */
	if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;
	
	class WC_Gateway_jm_test extends WC_Payment_Gateway {
		/**
		 *  Constructor function for the Jackmark gateway class. 
		 */
		public function __construct() {
			/**
			 *  Initialisation of custom class properties and methods. 
			 */
			$this->id = 'jm_test';
			$this->has_fields = false;
			$this->method_title = __('Jackmark Gateway', 'woocommerce');
			$this->method_description = __('Checkout gateway for Jackmark customers.', 'woocommerce');
			$this->init_form_fields();
			$this->init_settings();
			$this->title        = $this->get_option( 'title' );
			$this->description  = $this->get_option( 'description' );
			$this->instructions = $this->get_option( 'instructions', $this->description );
			
			/* Saves admin properties when altered by the administrator. */
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
			/* Includes any extra instructions with the order confirmation page and following email confirmation to a customer after an order is placed. */
			add_action( 'woocommerce_thankyou_' . $this->id, array( $this, 'add_oRecieved_content' ) );
			add_action( 'woocommerce_email_before_order_table', array( $this, 'add_email_content' ), 10, 3 );
		}
		 
		/**
		 *  Initialisation of form fields for Jackmark gateway admin settings. 
		 */
		public function init_form_fields() {
			$this->form_fields = array(
					'enabled' => array(
						'title' => __( 'Enable/Disable', 'woocommerce' ),
						'type' => 'checkbox',
						'label' => __( 'Enable Jackmark gateway', 'woocommerce' ),
						'default' => 'yes'
					),
					'title' => array(
						'title' => __( 'Title', 'woocommerce' ),
						'type' => 'text',
						'description' => __( 'Sets the title for the payment method the customer sees during checkout.', 'woocommerce' ),
						'default' => '',
						'desc_tip' => true
					),
					'description' => array(
						'title' => __( 'Description', 'woocommerce' ),
						'type' => 'textarea',
						'description' => __( 'Payment method description that the customer will see on the checkout page.', 'woocommerce' ),
						'default' => __('Please remit payment to Store Name upon pickup or delivery.', 'woocommerce'),
						'desc_tip' => true
					),
					'extra content' => array(
						'title'       => __( 'Extra Order Confirmation/Email Confirmation Content', 'woocommerce' ),
						'type'        => 'textarea',
						'description' => __( 'Content that will be added to the order confirmation page and emails upon succesful orders.', 'woocommerce' ),
						'default'     => '',
						'desc_tip'    => true,
					)
			);
		}
		 
		/**
		 *  Gateway payment processing. 
		 */
		public function process_payment( $order_id ) {
    
			$order = wc_get_order( $order_id );
            
			// Marked as on-hold due to the payment being received later on.
			$order->update_status( 'on-hold', __( 'Awaiting resonse to customer', 'woocommerce' ) );
            
			// Reduce stock levels -- REMOVE?
			//$order->reduce_order_stock();
            
			// Remove cart as order has been placed.
			WC()->cart->empty_cart();
            
			// Redirect user to the order confirmation page upon the payment being processed succesfully.
			return array(
				'result'    => 'success',
				'redirect'  => $this->get_return_url( $order )
			);
		}
		
		/**
		* Output for the order received page when order instructions are included.
		*/
		public function add_oRecieved_content() {
			if ( $this->instructions ) {
				echo '<div id="instruction-container">';
				echo wpautop( wptexturize( $this->instructions ) );
				echo '</div>';
			}
		}
		
		/**
		* Confirmation e-mail additional content to include order instructions.
		*
		* @param WC_Order $order - details about the order being processed.
		* @param bool $sent_to_admin - ___________________________ .
		* @param bool $plain_text - _____________________________ .
		*/
		public function add_email_content( $order, $sent_to_admin, $plain_text = false ) {
        
			if ( $this->instructions && ! $sent_to_admin && $order->has_status( 'on-hold' ) ) {
				echo wpautop( wptexturize( $this->instructions ) ) . PHP_EOL;
			}
		}
	}
	/**
	 *  Adds the Jackmark gateway to the woocommerce checkout options gateway list. 
	 */
	function jm_gWay_integrate( $gatewayList ) {
		$gatewayList[] = 'WC_Gateway_jm_test';
		return $gatewayList;
	}
	add_filter( 'woocommerce_payment_gateways', 'jm_gWay_integrate' );
 }
 
add_filter('plugins_loaded', 'jm_wc_gWay_init' );