<?php get_header(); ?>  
<?php /* If there are no posts to display, such as an empty archive page */ ?>  
<?php if ( ! have_posts() ) : ?>  
        <h1>Страницата не е намерена.</h1>  
            <p>Съжаляваме, но страница с такова съдържание не е намерена в нашите архиви.</p>  
<?php endif; ?>  
  
<?php while ( have_posts() ) : the_post(); ?>  
  
<div class="post">  
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>  
    <div class="post-details">  
        <div class="post-details-left">  
        Posted on <strong><?php the_date(); ?></strong> by <span class="author"><?php the_author(); ?></span> under <span class="author"><?php the_category(', '); ?></span>  
        </div>  
        <div class="post-details-right">  
        <?php edit_post_link('Edit', '<span class="comment-count">  ' , '</span>'); ?><span class="comment-count"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments'); ?></span>  
        </div>  
    </div>  
  
    <?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>  
            <?php the_excerpt(); ?>  
    <?php else : ?>  
            <?php the_content('Прочети всичко...'); ?>  
    <?php endif; ?>  
  
    <div class="dots"></div>  
</div><!-- post -->  
  
<div class="spacer"></div>  
  
<?php comments_template('', true ); ?>  
  
<?php endwhile; ?>  
  
<div class="spacer"></div>  
<?php get_footer(); ?>