<?php
if ( ! function_exists( 'modena_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Purple Modena 1.0
 */
function modena_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'purplemodena' ); ?> <?php comment_author_link(); ?>
				<?php edit_comment_link( __( '<span class="genericon genericon-edit right"></span>', 'purplemodena' ) , ' ' ); ?></p>
			<?php
		break;
		default :
			?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<footer>

						<div class="vcard left">
							<?php echo get_avatar( $comment, 100 ); ?>
						</div><!-- .vcard .left -->
						
						<div class="comment-author">
							<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
						</div><!-- .comment-author .vcard -->
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php _e( 'Your comment is awaiting moderation.', 'purplemodena' ); ?></em>
							<br />
						<?php endif; ?>
						
						<div class="comment-content">
							
							<div class="comment-meta commentmetadata">
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
								<?php
									/* translators: 1: date, 2: time */
									printf( __( '%1$s at %2$s', 'purplemodena' ), get_comment_date(), get_comment_time() ); ?>
								</time></a> <br />
							</div><!-- .comment-meta .commentmetadata -->
							
							<?php comment_text(); ?>
							
						</div><!-- .comment-content -->
						
						<?php edit_comment_link( __( '<span class="genericon genericon-edit right"></span>', 'purplemodena' ) , ' ' ); ?>
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
						
					</footer>
				</article><!-- #comment-## -->
		<?php
		break;
	endswitch;
}
endif; // ends check for modena_comment()