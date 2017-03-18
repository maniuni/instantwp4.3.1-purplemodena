					<footer role="contentinfo">
						
						<aside class="fatfooter" role="complementary">

							<div class="first quarter widget-area">
								<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
							</div><!-- .first .quarter .widget-area -->
						
							<div class="second quarter widget-area">
								<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
							</div><!-- .second .quarter .widget-area -->
						
							<div class="third quarter widget-area">
								<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
							</div><!-- .third .quarter .widget-area -->
						
							<div class="fourth quarter widget-area">
								<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
							</div><!-- .fourth .quarter .widget-area -->
							
						</aside><!-- .fatfooter -->
						
						<section class="colophon">			  
							  <small class="credits half right">
								 <a href="http://wordpress.org/"><?php _e( 'Proudly powered by Wordpress', 'purplemodena' ); ?></a>
							  </small><!-- .credits .half .right -->			  
						</section><!--.colophon-->
						
					</footer>
				</div><!-- .main-content .sizing -->
			</div><!-- .main -->		
		</div><!-- #wrap -->
	</div><!-- #container -->
	<?php wp_footer(); ?>
</body>
</html>