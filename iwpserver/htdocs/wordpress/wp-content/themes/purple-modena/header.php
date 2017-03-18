<!DOCTYPE html>
<!--[if lt IE 8]><html class="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><html <?php language_attributes(); ?>><![endif]-->
<!--[if !IE]> --><html <?php language_attributes(); ?>><!-- <![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	</script>
	<div id="container">
		<div id="wrap"> 
			<div class="main">
				<div class="main-content sizing">
					<header role="banner">
						<div class="site-name half left">
							<div class="site-title">
								<h1 id="site-title" ><a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
							</div>
						</div><!-- .site-name .half .left -->
					</header><!-- header -->
					<nav class="menu">
						<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
						<div class="skip-link screen-reader-text">
							<a title="Skip to content" href="#content"><?php _e( 'Skip to content', 'purplemodena' ); ?></a>
						</div>
						<?php wp_nav_menu( array( 'container_class' => 'main-nav', 'theme_location' => 'primary' ) ); ?>						
					</nav><!-- .menu -->