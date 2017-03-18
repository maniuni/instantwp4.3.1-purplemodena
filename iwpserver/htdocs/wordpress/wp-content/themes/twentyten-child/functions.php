<?php
include('shortcodes_tut.php');

function register_button( $buttons ) {
   array_push( $buttons, "|", "recentposts" );
   return $buttons;
}

function add_plugin( $plugin_array ) {
   $plugin_array['recentposts'] = get_template_directory_uri() . '/js/recent-posts.js';
   return $plugin_array;
}

function my_recent_posts_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }

}

add_action('init', 'my_recent_posts_button');

?>