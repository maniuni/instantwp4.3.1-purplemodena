<?php
function modena_scripts() {
	wp_enqueue_style( 'genericons.css', get_template_directory_uri(). '/fonts/genericons/genericons.css' );
	wp_enqueue_style( 'style.css', get_stylesheet_uri() );

	wp_enqueue_script( 'html5shiv', get_template_directory_uri() .'/js/html5shiv.js', true );
	wp_enqueue_script( 'ie9', get_template_directory_uri() .'/js/ie9.js' );
	
	/* Loading the comment-reply.js script (which comes bundled with WordPress) that moves the comment form underneath the comment you’re replying to when you click the “reply” link.*/
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'modena_scripts' );


function modena_load_fonts() {
	wp_register_style( 'google-fonts', "//fonts.googleapis.com/css?family=Cuprum:400,400italic,700,700italic&subset=latin,cyrillic" );
	wp_enqueue_style( 'google-fonts' );
}
add_action( 'wp_enqueue_scripts', 'modena_load_fonts' );


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function modena_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'purplemodena' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'modena_wp_title', 10, 2 );


function modena_widgets_init() {
	
	// Sidebar widget area, located in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'purplemodena' ),
		'id' => 'sidebar-widget-area',
		'description' => __( 'The sidebar widget area', 'purplemodena' ),
		'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// First footer widget area, located in the footer. Empty by default.
	register_sidebar(
		array(
			'name' => __( 'First Footer Widget Area', 'purplemodena' ),
			'id' => 'first-footer-widget-area',
			'description' => __( 'The first footer widget area', 'purplemodena' ),
			'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	 
	// Second Footer Widget Area, located in the footer. Empty by default.
	register_sidebar(
		array(
			'name' => __( 'Second Footer Widget Area', 'purplemodena' ),
			'id' => 'second-footer-widget-area',
			'description' => __( 'The second footer widget area', 'purplemodena' ),
			'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	 
	// Third Footer Widget Area, located in the footer. Empty by default.
	register_sidebar(
		array(
			'name' => __( 'Third Footer Widget Area', 'purplemodena' ),
			'id' => 'third-footer-widget-area',
			'description' => __( 'The third footer widget area', 'purplemodena' ),
			'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
	 
	// Fourth Footer Widget Area, located in the footer. Empty by default.
	register_sidebar(
		array(
			'name' => __( 'Fourth Footer Widget Area', 'purplemodena' ),
			'id' => 'fourth-footer-widget-area',
			'description' => __( 'The fourth footer widget area', 'purplemodena' ),
			'before_widget' => '<div class="widget-container %2$s" id="%1$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'modena_widgets_init' );


function modena_setup() {

	/* Load the text domain */
	load_theme_textdomain( 'purplemodena', get_template_directory() . '/languages' );
	
	/* Set the content width based on the theme's design and stylesheet. */
	global $content_width;
	if ( ! isset( $content_width ) ){
		$content_width = 846; /* pixels */
		
		if ( is_page_template( 'page-full-width.php' ) ) {
			$content_width = 1160; /* pixels */
		}
	}
	
	/* Setup the WordPress core custom background feature. */
	add_theme_support( 'custom-background', array(
		'default-color' => 'bae',
	) );

	/* Register theme menu */
	register_nav_menu( 'primary', __( 'Main Navigation Menu', 'purplemodena' ) );

	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'automatic-feed-links' );
	
	/*Custom template tags for this theme. */
	require( get_template_directory() . '/inc/modena-tags.php' );
	
	/* Apply theme's stylesheet to the visual editor. */
	add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'modena_setup' );


/** 
 * Formats the date according to the chosen language of the theme 
 *
 * @return string The formatted date.
 * @since Purple Modena 1.4
**/
function modena_date_format() {
	if ( get_bloginfo("language") == 'en-US' ) {
		$format = get_the_date( 'F j, Y' );
	} elseif ( get_bloginfo("language") == 'bg-BG' ) {
		$format = get_the_date( 'j F Y' );
	}
	return $format;
}


function modena_pie() { ?>
<!--[if lt IE 9]>
<style type="text/css" media="screen">
input[type="submit"], 
header>div:first-of-type, 
nav.menu, article.post, 
article.page, 
.menu>ul>li:hover, 
.searchform, 
.comments-area, 
.commentlist, 
.gallery img, 
.archive{
	behavior: url("<?php echo get_stylesheet_directory_uri() . '/pie/PIE.htc'; ?>");
	position: relative;
	zoom: 1;
}
nav.menu li:hover>ul {
	behavior: url("<?php echo get_stylesheet_directory_uri() . '/pie/PIE.htc'; ?>");
	position: absolute;
	zoom: 1;
}
</style>
<![endif]-->
<?php }
add_filter( 'wp_head' , 'modena_pie' );


/* Remove the parentheses from the category widget and surround the post count with a span with a class to easily style it */

add_filter( 'wp_list_categories', 'modena_cat_postcount' );
function modena_cat_postcount( $links ) {
	$links = str_replace( '</a> (', '&nbsp;<span class="post-count">(', $links );
	$links = str_replace( ')', ')</span></a>', $links );
	return $links;
}


/* Remove the parentheses from the category widget and surround the post count with a span with a class to easily style it */

add_filter( 'wp_list_bookmarks', 'modena_links_span' );
function modena_links_span( $links ) {
	$links = str_replace( '</a>', '&nbsp;<span class="post-count">', $links );
	$links = str_replace( '</li>', '</span></a></li>', $links );
	return $links;
}


/* Remove the parentheses from the archive widget and surround the post count with a span with a class to easily style it */

add_filter( 'get_archives_link', 'modena_archive_postcount' );
function modena_archive_postcount ( $links ) {
	$links = str_replace( '</a>&nbsp;(', '&nbsp;<span class="post-count">(', $links );
	$links = str_replace( ')', ')</span></a>', $links );
	return $links;
}


/**
 * Implement the Custom Header feature
 */
 
require( get_template_directory() . '/inc/custom-header.php' );


/* Remove default styles for the gallery post format */

add_filter( 'use_default_gallery_style', '__return_false' );
