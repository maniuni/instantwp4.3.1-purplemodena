<?php
 /**
 * class Cwd_wp_bootstrapwp_Walker_Nav_Menu()
 *
 * Extending Walker_Nav_Menu Class
 *
 * @author Gabriel Vasile
 **/
  class Cwd_wp_bootstrapwp_Walker_Nav_Menu extends Walker_Nav_Menu {
 
    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
      // check, whether there are children for the given ID and append it to the element with a (new) ID
      $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
 
      return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
 
    // CHANGE .sub-menu INTO .dropdown-menu
    function start_lvl(&$output, $depth) {
      $indent = str_repeat("\t", $depth);
      $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
 
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
      $item_html = '';
      parent::start_el($item_html, $item, $depth, $args);
 
      if (($item->hasChildren) && ($depth === 0)) {
        $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html);
        $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
      }
 
      $output .= $item_html;
    }
 
  }
 
function cwd_wp_bootstrapwp_nav_menu_css_class($classes, $item) {

// Add the .dropdown class to the list items that have children
if ($item->hasChildren) {
  $classes[] = 'dropdown';
}

return $classes;
}
add_filter('nav_menu_css_class', 'cwd_wp_bootstrapwp_nav_menu_css_class', 10, 2);
  
/**
 * @param  $classes array
 * @param  $item object
 * @return array
 */ 
function normalize_wp_classes(array $classes, $item = null){

  // old class => new class
  $replacements = array(
    'current-menu-item'     => 'active',
    'current-menu-parent'   => 'active',
    'current-menu-ancestor' => 'active',
  );

  // do the replacements above
  $classes = strtr(implode(',', $classes), $replacements);
  $classes = explode(',', $classes);

  // if any of the classes above are present,
  // return an array with a single class ('active')
  return array_unique($classes);
}
// for custom menus 
add_filter('nav_menu_css_class', 'normalize_wp_classes', 10, 2);

// for the page menu fallback (wp_list_pages)
add_filter('page_css_class', 'normalize_wp_classes', 10, 2);