<?php
/**
 * *
 * Cart totals
 *
 * OVERWRIDDEN to suit the jackmark webiste by removing VAT/Shipping costs from table as well as specififying that enquiry totals exclude VAT. @since 1.0
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cart_totals">

	<table cellspacing="0" class="shop_table shop_table_responsive">
		<tr class="cart-no-vat">
			<th><?php _e( 'Price excl. VAT', 'integral-child' ); ?></th>
			<td data-title="<?php esc_attr_e( 'Price excl. VAT', 'integral-child' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>
	</table>

	<div class="wc-proceed-to-checkout">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
