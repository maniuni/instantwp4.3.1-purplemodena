<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file 
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php $loop = new WP_Query(array('post_type' => 'project', 'posts_per_page' => -1));
  $count =0;
?>

<?php if($loop) { ?>
	<ul id="folio" class="list">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

			<li class="item-<?php the_ID() ?> <?php if(++$count%4==0) echo 'rightmost'?> ">
				<div class="image">
					<span>
						<a href="<?php the_permalink() ?>">
							<?php
								if(has_post_thumbnail()){
									the_post_thumbnail('thumbnail');
								}
							?>
						</a>
					</span>
					<a href="<?php the_permalink() ?>" class="link">View Details</a>
				</div>
				<div class="content">
					<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
					<span class="tags">
						<?php
							// Fetching the tag names with respect to the post and displaying them
							$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'names');
							echo implode(wp_get_object_terms( $post->ID, 'project_category', $args),', ');
						?>
					</span>
					<p>
						<?php
							// Using custom excerpt function to fetch the excerpt
							folio_excerpt('folio_excerpt_length','folio_excerpt_more');
						 ?>
					</p>
					<?php
					  // If we are in a loop we can get the post ID easily
					  $price = get_post_meta( get_the_ID(), 'product_price', true );
					?>
					<p>The price is: <?php echo $price; ?></p>
				</div>
				<div class="clear"></div>
			</li>
			
		<?php endwhile; ?>
	</ul>
	<?php } ?>
	<?php wp_reset_query(); ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>