<?php
function recent_posts_function($atts, $content = null) {
	extract(shortcode_atts(array(
		'posts' => 1,
	), $atts));

	$return_string = '<h3>'.$content.'</h3>';
	$myposts = get_posts( array('posts_per_page' => $posts) );
	
	foreach ($myposts as $mypost){
		$return_string .= '<a href="'.get_permalink($mypost->ID).'">'.$mypost->post_title.'</a><br />';
	}
	
	return $return_string;
}
add_shortcode('recent-posts', 'recent_posts_function');

function wptuts_youtube($atts, $content=null){
 
    extract(shortcode_atts( array(
		'id' => ''
	), $atts));
     
    $return = $content;
    if($content)
        $return .= "<br /><br />";
     
    $return .= '<iframe width="560" height="349" src="http://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe>';
     
    return $return; 
 
}
add_shortcode('youtube', 'wptuts_youtube');