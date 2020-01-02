<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
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
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" id="fixit-woocommerce-search" method="get" class="" action="<?php print esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input class="form-control" type="text" value="<?php print esc_attr(get_search_query()); ?>"  name="s" placeholder="Search Product">
		<input type="hidden" name="post_type" value="product" />
		<span class="input-group-btn">
			<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
		</span>
	</div>
</form>