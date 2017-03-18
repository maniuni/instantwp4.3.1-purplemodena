<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	// register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */



	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );

		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
		
		wp_enqueue_script( 'script', get_template_directory_uri() .'/js/script.js', array( 'jquery' ) );
	}	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}
	
	
	/*--- Creating custom post type for project --*/
	add_action('init', 'project_custom_init');
	/*-- Custom Post Init Begin --*/
	function project_custom_init() {
		$labels = array(
			'name' => _x('Projects', 'post type general name'),
			'singular_name' => _x('Project', 'post type singular name'),
			'add_new' => _x('Add New', 'project'),
			'add_new_item' => __('Add New Project'),
			'edit_item' => __('Edit Project'),
			'new_item' => __('New Project'),
			'view_item' => __('View Project'),
			'search_items' => __('Search Projects'),
			'not_found' =>  __('No projects found'),
			'not_found_in_trash' => __('No projects found in Trash'),
			'parent_item_colon' => '',
			'menu_name' => 'Project'
			);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments')
			);
		// The following is the main step where we register the post.
		register_post_type( 'project', $args );
	}
	/*-- Custom Post Init Ends --*
	
	
	// Add filter to ensure the text Project, or project, is displayed when a user updates a book */
	add_filter('post_updated_messages', 'project_updated_messages');
	function project_updated_messages( $messages ) {
	  global $post, $post_ID;
	 
	  $messages['project'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Project updated. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Project updated.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Project published. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Project saved.'),
		8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	 
	  return $messages;
	}
	
	
	// Initialize New Taxonomy Labels
	$labels = array(
		'name' => _x( 'Project Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Project Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Types' ),
		'all_items' => __( 'All Project Categories' ),
		'parent_item' => __( 'Parent Project Category' ),
		'parent_item_colon' => __( 'Parent Project Category:' ),
		'edit_item' => __( 'Edit Project Categories' ),
		'update_item' => __( 'Update Project Category' ),
		'add_new_item' => __( 'Add New Project Category' ),
		'new_item_name' => __( 'New Project Category Name' ),
	);
	// Custom taxonomy for Project Categories
	register_taxonomy('project_category', array('project'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'project_category' ),
	));
	
	// Adding Variable Excerpt Length
	function folio_excerpt_length($length) {
		return 80;
	}
	function folio_excerpt_more($more) {
		return ' ... <span class="excerpt_more"><a href="'.get_permalink().'">Read more</a></span>';
	}
	function folio_excerpt($length_callback='', $more_callback='') {
		global $post;
		if(function_exists($length_callback)){
			add_filter('excerpt_length', $length_callback);
		}
		if(function_exists($more_callback)){
			add_filter('excerpt_more', $more_callback);
		}
		$output = get_the_excerpt();
		$output = apply_filters('wptexturize', $output);
		$output = apply_filters('convert_chars', $output);
		$output = '<p>'.$output.'</p>';
		echo $output;
	}
	
	add_action( 'add_meta_boxes', 'product_price_box' );
	function product_price_box() {
		add_meta_box( 
			'product_price_box',
			__( 'Product Price' ),
			'product_price_box_content',
			'project',
			'side',
			'high'
		);
	}
	
	function product_price_box_content( $post ) {
		wp_nonce_field( plugin_basename( __FILE__ ), 'product_price_box_content_nonce' );
		echo '<label for="product_price"></label>';
		echo '<input type="text" id="product_price" name="product_price" placeholder="enter a price" />';
		echo '<button type="submit" id="submit" name="submit">Submit</button>';
	}
	
	add_action( 'save_post', 'product_price_box_save' );
	function product_price_box_save( $post_id ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

		if ( !wp_verify_nonce( $_POST['product_price_box_content_nonce'], plugin_basename( __FILE__ ) ) )
		return;

		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) )
			return;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ) )
			return;
		}
	  $product_price = $_POST['product_price'];
	  update_post_meta( $post_id, 'product_price', $product_price );
	}