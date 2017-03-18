<?php
/**
 * Implementation of the Custom Header feature
 * 
 *
 * @package Purple Modena
 * @since Purple Modena 1.0
 */
 
/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses modena_header_style()
 * @uses modena_admin_header_style()
 * @uses modena_admin_header_image()
 *
 * @package Purple Modena
 */
function modena_custom_header_setup() {
	$args = array(
		'default-image'          => get_template_directory_uri() . '/images/header.jpg',
		'default-text-color'     => 'fff',
		'width'                  => 1200,
		'height'                 => 300,
		'wp-head-callback'       => 'modena_header_style',
		'admin-head-callback'    => 'modena_admin_header_style',
		'admin-preview-callback' => 'modena_admin_header_image',
	);
 
	$args = apply_filters( 'modena_custom_header_args', $args );
 
	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	}

}
add_action( 'after_setup_theme', 'modena_custom_header_setup' );
 
 
if ( ! function_exists( 'modena_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see modena_custom_header_setup().
 *
 * @since Purple Modena 1.0
 */
function modena_header_style() {
 
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Do we have a custom header image?
		if ( '' != get_header_image() ) :
	?>
		header>div:first-of-type{
			width: 100%;
			padding: 0 20px 20px 20px;
			background: url(<?php echo get_header_image(); ?>) no-repeat;
			overflow: auto;
		}
	<?php endif;
 
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title a,
		.site-title h2 {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		header {
			padding: 0;
			background: none;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-title h2 {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // modena_header_style

if ( ! function_exists( 'modena_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see modena_custom_header_setup().
 *
 * @since Purple Modena 1.0
 */
function modena_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg { /* This is the container for the Custom Header preview. */	
		width: 1200px;
		padding: 20px;
		min-height: 300px !important;
		border: none;
		background: #406 url(<?php echo get_header_image(); ?>) no-repeat;
		box-sizing: border-box;
	}
	#headimg h1 { /* This is the site title displayed in the preview */
		margin: 0;
		font: italic bold 45px Cuprum,sans-serif;
	}
	#headimg img{
		display: none;
	}
	#desc { /* This is the site description (tagline) displayed in the preview */
		width: 75%;
		margin: 30px 0;
		font: 30px 'Cuprum',sans-serif;
	}
	#headimg h1 a,
	#desc {
		color: #fff;
		text-decoration: none;
		text-shadow: 0 0 5px #aba3c3;
	}
	</style>
<?php
}
endif; //modena_admin_header_style
 
if ( ! function_exists( 'modena_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see modena_custom_header_setup().
 *
 * @since Purple Modena 1.0
 */
function modena_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // modena_admin_header_image