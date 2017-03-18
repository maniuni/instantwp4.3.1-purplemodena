<?php 
get_header(); 
?>
<div class="three-quarters left" id="content">

	<?php  
	/* Queue the first post, that way we know if this is a date archive so we can display the correct title.  
	 * We reset this later so we can run the loop properly with a call to rewind_posts().    
	 */  
	if ( have_posts() ) : the_post(); ?>
		<h2 class="page-title">
			<?php if ( is_day() ) { 
				printf( __( 'Archive for %s', 'purplemodena' ), modena_date_format() );
			} elseif ( is_month() ) { 
				printf( __( 'Archive for %s', 'purplemodena' ), get_the_date( 'F Y' ) );
			} elseif ( is_year() ) { 
				printf( __( 'Archive for %s', 'purplemodena' ), get_the_date( 'Y' ) ); 
			} else { 
				echo get_queried_object()->name; 
			} ?>
		</h2><!-- .page-title -->
	<?php endif; ?>

	<section class="archive">
		<?php  rewind_posts(); ?>
		  
		<?php // start the loop properly ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>">		
				<section class="archive-content">
				
					<h3 class="entry-title">
						<a title="<?php printf( __( 'Permalink to %s', 'purplemodena' ), the_title_attribute( 'echo=0' ) ); ?>" href="<?php the_permalink(); ?>" rel="bookmark">
						<?php the_title(); ?>
						</a>
					</h3><!-- .entry-title -->
					
					<?php if ( has_post_thumbnail() ) { ?>
						<section class="left image quarter">
							<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'medium', array( 'class' => 'left attachment-medium' ) ); ?>
							</a>
						</section><!-- .left .image .quarter -->
					<?php } ?>
					
					<section class="entry-content">
						<?php the_excerpt(); ?>
					</section><!-- .entry-content -->
					
				</section><!-- .archive-content -->
				
				<?php wp_link_pages( array( 'before' => '<div class="pagination"> <span>' . __( 'Pages ', 'purplemodena' ) . '</span> <p>', 'after' => '</p></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				
			</article><!-- #post-theID-->
		<?php endwhile; ?>
	</section><!-- .archive -->

	<div class="navigation">
		<p class="left"><?php previous_posts_link( __( 'Previous', 'purplemodena' ) ); ?></p>
		<p class="left"><?php next_posts_link( __( 'Next', 'purplemodena' ), '' ); ?></p>
	</div><!-- .navigation-->

</div><!-- #content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>