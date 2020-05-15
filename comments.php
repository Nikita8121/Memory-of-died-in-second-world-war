<?php

/**
 * @author: VLThemes
 * @version: 1.0
 */

if ( post_password_required() ) {
	return;
}

?>

<div id="comments"></div>

<?php if ( comments_open() || have_comments() ) : ?>

	<div class="vlt-comments-wrap">

		<?php if ( have_comments() ) : ?>

			<div class="vlt-comments">

				<h3 class="vlt-comments__title">
					<?php comments_number( esc_html__( 'No Comments', 'ramsay' ) , esc_html__( 'One Comment', 'ramsay' ) , esc_html__( '% Comments', 'ramsay' ) ); ?>
				</h3>

				<ul class="vlt-comments__list">
					<?php
						wp_list_comments( array(
							'avatar_size' => 70,
							'style' => 'ul',
							'max_depth' => '3',
							'short_ping' => true,
							'reply_text' => esc_html__( 'Reply', 'ramsay' ),
							'callback' => 'ramsay_callback_custom_comment',
						) );
					?>
				</ul>

				<?php echo wp_kses_post( ramsay_get_comment_navigation() ); ?>

			</div>
			<!-- /.vlt-comments -->

		<?php endif; ?>

		<?php if ( comments_open() ) : ?>

			<div class="vlt-comment-form">

				<?php
					$commenter = wp_get_current_commenter();
					$args = array(
						'title_reply' => esc_html__( 'Leave a Comment', 'ramsay' ),
						'title_reply_before' => '<h3 class="vlt-comment-form__title">',
						'title_reply_after' => '</h3>',
						'cancel_reply_before' => '',
						'cancel_reply_after' => '',
						'comment_notes_before' => '',
						'comment_notes_after' => '',
						'title_reply_to' => esc_html__( 'Leave a Reply', 'ramsay' ),
						'cancel_reply_link' => '<i class="ion-android-close"></i>',
						'submit_button' => '<button type="submit" id="%2$s" class="%3$s">%4$s</button>',
						'class_submit' => 'vlt-btn vlt-btn--primary',
						'label_submit' => esc_html__( 'Post a Comment', 'ramsay' ),
						'fields' => array(
							'cookies' => false,
							'author' => '<div class="vlt-form-row two-col"><div class="vlt-form-group"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Your Name', 'ramsay' ) . '"></div>',
							'email' => '<div class="vlt-form-group"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Your Email', 'ramsay' ) . '"></div></div>',
							'url' => '<div class="vlt-form-group"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . esc_attr__( 'Website', 'ramsay' ) . '" size="30"></div>'
						),
					);
					$args['comment_field'] = '<div class="vlt-form-group"><textarea id="comment" name="comment" rows="3" placeholder="' . esc_attr__( 'Your Comment', 'ramsay' ) . '"></textarea></div>';
					comment_form( $args );
				?>

			</div>
			<!-- /.vlt-comment-form -->

		<?php endif; ?>

	</div>
	<!-- /.vlt-comments-wrap -->

<?php endif; ?>