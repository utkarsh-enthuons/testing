<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	
if( mh_get_option('product_layout') != '' ){

    switch( mh_get_option('product_layout') ){

		case 'col-md-6' :
				$woocommerce_loop['columns'] = 2;
		break;
		case 'col-md-4' : 	
				$woocommerce_loop['columns'] = 3;
		break;		
		case 'col-md-3' :
				$woocommerce_loop['columns'] = 4;
		break;
		default : 			
				$woocommerce_loop['columns'] = 3;
		break;
	}
}
else{
	$woocommerce_loop['columns'] = 3;
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop'];

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] ) % $woocommerce_loop['columns'] )
	$classes[] = 'first clearboth';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

	
$product_style = mh_get_option('product_layout') ? mh_get_option('product_layout') : 'col-md-4' ;

if(is_shop() || is_product_category() || is_product_tag() || is_page() ) {
	
	switch ($product_style) {
		case 'col-md-6':
			$classes[] = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 product-box product-box';
			break;
	
		case 'col-md-4':
			$classes[] = 'col-lg-4 col-md-4 col-sm-6 col-xs-12 product-box product-box';
			break;		
			
		case 'col-md-3':
			$classes[] = 'col-lg-3 col-md-3 col-sm-6 col-xs-12 product-box product-box';
			break;		
	
		default:
			$classes[] = 'col-lg-3 col-md-3 col-sm-6 col-xs-12 product-box product-box';
			break;
	}
}elseif( is_product() ) {	
	$classes[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 product-box product-box';
}
elseif( is_cart() ) {
	$classes[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 product-box product-box';
}
else {
	$classes[] = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 product-box product-box';		
}

?>
<li <?php post_class( $classes ); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	woocommerce_show_product_loop_sale_flash();

	print '<div class="fixit-product-featured-image">';

		woocommerce_template_loop_product_thumbnail();

		print '<div class="fixit-woocommerce-add-to-cart">';
			woocommerce_template_loop_add_to_cart();
		print '</div>';

		if ( class_exists('YITH_WCWL') && shortcode_exists('yith_wcwl_add_to_wishlist') && mh_get_option('woo_wishlist') == '' ) : 
			print '<div class="fixit-woocommerce-wishilist">'. do_shortcode('[yith_wcwl_add_to_wishlist]') . '</div>';
		endif;

		if (class_exists('YITH_Woocompare') && shortcode_exists('yith_compare_button') && mh_get_option('woo_compare') == '' ) : 

			printf('<div class="fixit-woocommerce-compare"><a href="%1$s?action=yith-woocompare-add-product&amp;id=%2$s" class="compare button" data-product_id="%2$s" rel="nofollow">Compare</a></div>', home_url('/'), get_the_ID() );
		endif;

		if (class_exists('YITH_WCQV_Frontend') && mh_get_option('woo_quick_view') == '' ) : 
			print '<div class="fixit-woocommerce-quick-view">';
			 	echo '<a href="#" class="button yith-wcqv-button" data-product_id="' . $product->id . '"></a>';
			print '</div>';
		endif;

	print '</div>';

	

	print '<div class="fixit-product-details">';
	woocommerce_template_loop_product_link_close();
	
	printf('<h3 class="shop-product-title"><a class="shop-heading" href="%1$s">%2$s</a></h3>', get_the_permalink(), get_the_title() );

		print '<div class="fixit-product-rating">';
			woocommerce_template_loop_rating();
		print '</div>';

		print '<div class="fixit-product-price">';
			woocommerce_template_loop_price();
		print '</div>';

	print '</div>';

	?>
</li>