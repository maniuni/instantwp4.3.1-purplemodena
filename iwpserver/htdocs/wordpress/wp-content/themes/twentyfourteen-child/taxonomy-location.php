<?php
/**
 * Locations taxonomy archive
*/
get_header();
?>
<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class="taxonomy_styles">
				<?php
					// Get a list of all terms in a taxonomy
					$terms = get_terms( "location", array(
					  'hide_empty' => 0,
					) );
					$locations = array();
					if ( count($terms) > 0 ):
					  foreach ( $terms as $term )
						$locations[] = $term->name;

					  $locations_str = implode(', ', $locations);
					?>
					<h2>Nationwide Coverage</h2>
					<p>We cover stories around the country in places like <?php echo $locations_str; ?> and more. If we're not the best source for the latest news in your area, let us know!</p>
				<?php endif; ?>
			</div>

			<?php
			//Displaying the page for the chosen taxonomy
			
			/*
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			?>
				<h1 class="archive-title taxonomy_styles"><?php echo apply_filters( 'the_title', $term->name ); ?> News</h1>

				<?php if ( !empty( $term->description ) ): ?>
				<div class="archive-description">
				  <?php echo esc_html($term->description); ?>
				</div>
				<?php endif; ?>

				<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
				  <h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				  <div class="content clearfix">
					<div class="post-info">
					  <p><?php the_time(get_option('date_format')); ?> by <?php the_author_posts_link(); ?></p>
					</div><!--// end .post-info -->
					<div class="entry">
					  <?php the_content( __('Full story…') ); ?>
					</div>
				  </div>
				</div><!--// end #post-XX -->

				<?php endwhile; ?>

				<div class="navigation clearfix">
				  <div class="alignleft"><?php next_posts_link('« Previous Entries') ?></div>
				  <div class="alignright"><?php previous_posts_link('Next Entries »') ?></div>
				</div>

				<?php else: ?>

				<h2 class="post-title">No News in <?php echo apply_filters( 'the_title', $term->name ); ?></h2>
				<div class="content clearfix">
				  <div class="entry">
					<p>It seems there isn't anything happening in <strong><?php echo apply_filters( 'the_title', $term->name ); ?></strong> right now. Check back later, something is bound to happen soon.</p>
				  </div>
				</div>

				<?php endif; ?>
			 */
			?>
			<?php
			/**
			 * Display a list of the most recent news in Boston
			 *
			 * @class WP_Query http://codex.wordpress.org/Class_Reference/WP_Query
			 */
			 
			$term = 'sofia';
			$locations_query = new WP_Query( array(
			  'post_type' => 'post',
			  'posts_per_page' => 10,
			  'tax_query' => array(
				array(
				  'taxonomy' => 'location',
				  'field' => 'slug',
				  'terms' => $term,
				)
			  )
			) );
			?>
			<div class="taxonomy_styles">
				<?php
				// Display the custom loop
				if ( $locations_query->have_posts() ): ?>
					<h2>Latest News in <?php echo apply_filters( 'the_title', ucfirst( $term ) ); ?></h2>
					<ul class="postlist">
						<?php while ( $locations_query->have_posts() ) : $locations_query->the_post(); ?>
						<li><span class="date"><?php the_time(get_option('date_format')); ?></span> &#45; <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
						<?php endwhile; wp_reset_postdata(); ?>
					</ul><!--// end .postlist -->
				<?php else: ?>
					<h2 class="post-title">No News in <?php echo apply_filters( 'the_title', ucfirst( $term ) ); ?></h2>
					<div class="content clearfix">
					  <div class="entry">
						<p>It seems there isn't anything happening in <strong><?php echo apply_filters( 'the_title', ucfirst( $term ) ); ?></strong> right now. Check back later, something is bound to happen soon.</p>
					  </div>
					</div>
				<?php endif; ?>
			</div> 

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>