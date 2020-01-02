<?php
/**
 * Display single product reviews (comments)
 * 
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer)
 * will need to copy the new files to your theme to maintain compatibility. We try to do this
 * as little as possible, but it does happen. When this occurs the version of the template file will
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews">
	<div id="comments">
		<h2><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'fixit' ), $count, get_the_title() );
			else
				_e( 'Reviews', 'fixit' );
		?></h2>

		<?php if ( have_comments() ) : ?>

			<div class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</div>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'fixit' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'fixit' ) : __( 'Be the first to review', 'fixit' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'fixit' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="form-group comment-form-author">' . '<label for="author" class="col-md-2 control-label">' . __( 'Name', 'fixit' ) . ' <span class="required">*</span></label> ' .
							            '<div class="col-lg-10 col-md-10"><input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div></div>',
							'email'  => '<div class="form-group comment-form-email"><label for="email" class="col-md-2 control-label" >' . __( 'Email', 'fixit' ) . ' <span class="required">*</span></label> ' .
							            '<div class="col-md-10"><input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div></div>',
						),
						'label_submit'  => __( 'Submit', 'fixit' ),
					    'submit_field'  => '<div class="form-group form-submit">													
												<div class="col-lg-offset-2 col-md-offset-2 col-lg-8 col-md-8"> %1$s %2$s </div>
										   </div>',
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'fixit' ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="form-group comment-form-rating"><label for="rating" class="col-md-2 control-label">' . __( 'Your Rating', 'fixit' ) .'</label>
						<div class="col-lg-10 col-md-10">
						<select name="rating" id="rating">
							<option value="">'  . __( 'Rate&hellip;', 'fixit' ) . '</option>
							<option value="5">' . __( 'Perfect', 'fixit' ) . '</option>
							<option value="4">' . __( 'Good', 'fixit' ) . '</option>
							<option value="3">' . __( 'Average', 'fixit' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'fixit' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'fixit' ) . '</option>
						</select></div></div>';
					}

					$comment_form['comment_field'] .= '<div class="form-group comment-form-comment"><label for="comment" class="col-md-2 control-label">' . __( 'Your Review', 'fixit' ) . '</label><div class="col-md-10"><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></div></div>';

					ob_start();	
					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					echo preg_replace('/<h3 id="reply-title"(.*)>(.*)<\/h3>/','<h2 id="reply-title"\1>\2</h2>',ob_get_clean());
	
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'fixit' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
