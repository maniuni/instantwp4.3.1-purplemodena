<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<div id="secondary">
	<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( ! empty ( $description ) ) :
	?>
	<h2 class="site-description"><?php echo esc_html( $description ); ?></h2>
	<?php endif; ?>
	
	<div class="widget">
		<?php
		/**
		 * Create an unordered list of links to active location archives
		 */
		$locations_list = wp_list_categories( array(
			'taxonomy' => 'location',
			'orderby' => 'name',
			'show_count' => 0,
			'pad_counts' => 0,
			'hierarchical' => 1,
			'echo' => 0,
			'title_li' => 'Locations'
		) );

		// Make sure there are terms with articles
		if ( $locations_list )
			echo '<ul class="locations-list">' . $locations_list . '</ul>';
		?>
	</div>
	
	<div class="widget">
		<?php // Locations tag cloud
		$locations_cloud = wp_tag_cloud( array(
		  'taxonomy' => 'location',
		  'echo' => 0
		) );

		// Make sure there are terms with articles
		if ( $locations_cloud ): ?>
		<h2>News by Location</h2>
		<div class="locations-cloud">
		  <?php echo $locations_cloud; ?>
		</div>
		<?php endif; ?>
	</div>

	<?php if ( has_nav_menu( 'secondary' ) ) : ?>
	<nav role="navigation" class="navigation site-navigation secondary-navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
	</nav>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #primary-sidebar -->
	<?php endif; ?>
</div><!-- #secondary -->
