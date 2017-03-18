<?php get_header(); ?>
<title><?php wp_title("");?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/styles/reset.css" type="text/css">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/styles/news.css" type="text/css">
</head>
<body>
<?php query_posts( array( 'posts_per_page' => 5 ) ); ?>

<div id="main-content">  
<pre class="php" name="code"><?php if(have_posts()): while(have_posts()): the_post(); ?></pre>  
</div>
<h1 class="post-heading"><?php the_title(); ?></h1>
<div class="content"><?php the_excerpt(); ?></div>
<a href="<?php the_permalink(); ?>">Прочети повече...</a> 

<?php endwhile; endif; ?>

<?php get_footer(); ?> 