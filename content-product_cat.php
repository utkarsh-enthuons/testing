<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
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
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
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

// Increase loop count
$woocommerce_loop['loop'];

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] ) % $woocommerce_loop['columns'] )
	$classes[] = 'first clearboth';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

	
$product_style = mh_get_option('product_layout') ? mh_get_option('product_layout') : 'col-md-4' ;

if( is_shop() || is_product_category() || is_product_tag() || is_page() ) {
	
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
<li <?php wc_product_cat_class( $classes, $category ); ?>>
	<?php
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );

	/**
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );

	/**
	 * woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category ); ?>
</li>
