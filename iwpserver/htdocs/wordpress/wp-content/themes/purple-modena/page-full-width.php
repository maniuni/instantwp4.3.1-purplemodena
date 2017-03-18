<?php
/**
 * Template Name: Full-width page, no sidebar
 */
get_header(); 
?>
<div class="full-width" id="content">	
	<?php
	// Run the page loop to output the page content.
	if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<?php if ( ! is_front_page() ) { ?>
				<h2 class="entry-title"><a title="<?php printf( __( 'Permalink to %s', 'purplemodena' ), the_title_attribute( 'echo=0' ) ); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
			<?php } ?>					
			
			<section class="entry-content">
				<?php the_content(); ?>
			</section><!-- .entry-content -->
			
			<?php wp_link_pages( array( 'before' => '<div class="pagination"> <span>'. __( 'Pages ', 'purplemodena' ) . '</span> <p>', 'after' => '</p></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					
			<section class="entry-meta">
			
				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<span class="comments-link"><?php comments_popup_link( 
							__( 'Leave a comment', 'purplemodena' ), 
							__( '1 Comment', 'purplemodena' ), 
							__( '% Comments', 'purplemodena' ) 
					); ?></span>
				<?php
					endif;
					edit_post_link( __( 'Edit', 'purplemodena' ), '<span class="edit-link right">', '</span>' );
				?>
				
			</section><!-- .entry-meta -->
						
		</article><!-- #post-## -->
		
		<?php comments_template(); ?> 
				
	<?php endwhile; ?>
	<?php endif; ?>
</div><!-- #content-->
<?php get_footer(); ?>