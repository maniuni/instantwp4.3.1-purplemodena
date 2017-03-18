<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to modena_comment() which is
 * located in the modena-tags.php file.
 *
 * @package Purple Modena
 * @since Purple Modena 1.0
 */
?>
 
<?php
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() )
		return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'purplemodena' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
		<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation-above">
			<div class="nav-previous left"><?php previous_comments_link( __( '&larr; Older Comments', 'purplemodena' ) ); ?></div>
			<div class="nav-next right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'purplemodena' ) ); ?></div>
		</nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use modena_comment() to format the comments.
				 * See modena_comment() in modena-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'modena_comment' ) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  // are there comments to navigate through? If so, show navigation ?>
		
		<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation-below">
			<div class="nav-previous left"><?php previous_comments_link( __( '&larr; Older Comments', 'purplemodena' ) ); ?></div>
			<div class="nav-next right"><?php next_comments_link( __( 'Newer Comments &rarr;', 'purplemodena' ) ); ?></div>
		</nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'purplemodena' ); ?></p>
	<?php endif; ?>

	<?php 
		// Changing the defaults for the comment form
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? "aria-required='true'" : '' );
		$fields =  array(
		  'author' =>
			'<p class="comment-form-author">'.'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( "Name", 'purplemodena' ) . '"/></p>',
		  'email' =>
			'<p class="comment-form-email">' . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .	'" size="30"' . $aria_req . ' placeholder="' . __( "Email", 'purplemodena' ) . '"/></p>',
		  'url' =>
			'<p class="comment-form-url">' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . __( "Website(optional)", 'purplemodena' ) . '"/></p>',
		);
		comment_form( array( 
			'fields' => 
				apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field' => 
				'<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'Add comment', 'purplemodena' ) . '"></textarea></p>',
			'must_log_in' =>
				'<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'purplemodena' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'logged_in_as' =>
				'<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'purplemodena' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'comment_notes_before' => 
				'<p class="comment-notes">' . __( 'Your email address will not be published.', 'purplemodena' ) . '</p>',
			'comment_notes_after' =>
				" ",
			'title_reply' =>
				__( 'Leave a Reply', 'purplemodena' ),
			'title_reply_to' =>
				__( 'Leave a Reply to %s', 'purplemodena' ),
			'cancel_reply_link' =>
				__( 'Cancel Reply', 'purplemodena' ),
			'label_submit' =>
				__( 'Post Comment', 'purplemodena' ),
		));
	?>
 
</div><!-- #comments .comments-area -->