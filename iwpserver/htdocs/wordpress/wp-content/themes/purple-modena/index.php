<?php get_header(); ?>
	<div class="three-quarters left" id="content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<?php $classes = get_post_class(); ?>
				<?php if ( ( in_array( 'sticky', $classes ) ) ):?>
					<img class="sticky-img" src="<?php echo get_template_directory_uri(); ?>/images/pin.png" alt="" width="50" height="61" />
				<?php endif; ?>
					
				<h2 class="entry-title">
					<a title="<?php printf( __( 'Permalink to %s', 'purplemodena' ), the_title_attribute( 'echo=0' ) ); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2><!-- .entry-title -->
								
				<section class="entry-meta">
					
					<?php $classes = get_post_class(); ?>
					<?php if ( ! ( in_array( 'sticky', $classes ) ) ):?>
						<p>
							<?php printf( '<span class="genericon genericon-time"></span> <a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s">%4$s</time></a> <span class="genericon genericon-user"></span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span>',
								esc_url( get_permalink() ),
								esc_attr( get_the_time() ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( modena_date_format() ),
								esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
								esc_attr( sprintf( __( 'View all posts by %s', 'purplemodena' ), get_the_author() ) ),
								get_the_author()
							); ?>
						</p>
					<?php endif; ?>
					
					<p class="tags"><?php the_tags( " ", " " ); ?></p>
					
				</section><!-- .entry-meta -->
		
				<?php if ( has_post_thumbnail() ) { ?>
					<section class="left image quarter">
						<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'medium', array( 'class' => 'left attachment-medium' ) ); ?>
						</a>
					</section><!-- .left .image .quarter -->
				<?php } ?>
				
				<section class="entry-content">
					<?php the_content(); ?>
				</section><!-- .entry-content -->
				
				<?php wp_link_pages( array( 'before' => '<div class="pagination"> <span>'. __( 'Pages ', 'purplemodena' ) . '</span> <p>', 'after' => '</p></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				
				<br class="clear" />
				
				<section class="entry-meta"><?php if ( count( get_the_category() ) ) : ?>
					<p class="cat-links left">
						<?php
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list( __( ', ', 'purplemodena' ) );
							$utility_text = __( 'Categories: <a href="%2$s">%1$s</a>.', 'purplemodena' );
							printf(
								$utility_text,
								$categories_list,
								the_title_attribute( 'echo=0' )
							);
						?>
					</p>
					<?php endif; ?>
					
					<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
						<span class="comments-link"><?php comments_popup_link( 
							__( '/ Leave a comment', 'purplemodena' ), 
							__( '/ 1 Comment', 'purplemodena' ), 
							__( '/ % Comments', 'purplemodena' ) 
					); ?></span>
					<?php
						endif;
						edit_post_link( __( 'Edit', 'purplemodena' ), '<span class="edit-link right">', '</span>' );
					?>
					
				</section><!-- .entry-meta -->
				
			</article><!-- #post-##-->
			
			<?php comments_template(); ?> 
		
		<?php endwhile; ?>		
		<?php endif; ?>

		<div class="navigation">
			<p class="left"><?php previous_posts_link( __( 'Previous', 'purplemodena' ) ); ?></p>
			<p class="left"><?php next_posts_link( __( 'Next', 'purplemodena' ), '' ); ?></p>
		</div><!-- .navigation-->
		
	</div><!-- #content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>