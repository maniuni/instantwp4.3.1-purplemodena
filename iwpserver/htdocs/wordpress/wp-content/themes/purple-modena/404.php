<?php get_header(); ?>
	<div class="three-quarters left" id="content">
		<article class="page" >
			<h2 class="entry-title">
				<?php _e( 'Page Not Found', 'purplemodena' ); ?>
			</h2><!-- .entry-title -->
			<section class="entry-content">
				<?php 
					_e( 'It looks like nothing was found at this location. Maybe try a search?', 'purplemodena' );
					get_search_form(); 
				?>
			</section><!-- .entry-content -->
		</article>
	</div><!-- #content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>