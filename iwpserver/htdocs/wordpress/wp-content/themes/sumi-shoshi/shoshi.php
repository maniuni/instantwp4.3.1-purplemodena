<?php 
/*
Template Name: Shoshi-template
*/
?>
<?php get_header(); ?>
    <title><?php wp_title("");?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/styles/reset.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/styles-Shoshi.css" />
</head>
<body>
	<div class="wrapper">
		<img src="<?php echo get_template_directory_uri(); ?>/images/Shoshi-logo.png" alt="Шоши" />
		<section>
			<img src="<?php echo get_template_directory_uri(); ?>/images/Shoshi-photo.png" alt="Снимчица" />
			<article>
				<h1>Suspendisse</h1>
				<p>Suspendisse: imperdiet rhoncus molestie. Maecenas ultrices varius lectus vitae pellentesque.Aenean orci purus, blandit lacinia volutpat vitae, rhoncus eu ligula. Suspendisse eleifend consequat ultricies. Fusce non lectus nulla, a venenatis lorem.</p>
				<form>
					<button type="button" value="prev"><span>Previous</span></button>
					<button type="button" value="next"><span>Next</span></button>
				</form>
			</article>
			<div class="slider">
				<h2>любими играчки:<br/><span>Всички мишки на събрание</span></h2>
				<a href="#" class="previous">Previous</a>
				<div class="toys">
					<img src="<?php echo get_template_directory_uri(); ?>/images/toy1.png" />
					<img src="<?php echo get_template_directory_uri(); ?>/images/toy2.png" />
					<img src="<?php echo get_template_directory_uri(); ?>/images/toy3.png" />
				</div>
				<a href="#" class="next">Next</a>
			</div>
                        
			<a href="<?php echo home_url(); ?>">Към началото</a>
			<img src="<?php echo get_template_directory_uri(); ?>/images/corner-paw.png" />
		</section>
	</div>
<?php get_footer(); ?>