<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */

function register_my_menu() {
  register_nav_menu('nav-menu',__( 'Navigation Menu' ));
}
add_action( 'init', 'register_my_menu' );

?>