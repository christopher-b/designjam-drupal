<?php
// Includes
$lib = dirname(__FILE__).'/lib';
include "$lib/event.php";
include "$lib/media_item.php";
include "$lib/person.php";

// function designjam_theme() {
  /* Customize login form */
  // $items = array();

  // $items['user_login'] = array(
  //   'render element'       => 'form',
  //   'path'                 => drupal_get_path('theme', 'designjam') . '/templates',
  //   'template'             => 'user-login',
  //   'preprocess functions' => array(
  //      'designjam_preprocess_user_login'
  //   ),
  // );
  // return $items;
  // return $items;
// }

// function designjam_preprocess_user_login(&$vars) {
//   // print_r($vars);die;
//   $vars['intro_text'] = t('This is my awesome login form');
// }


function designjam_preprocess_html(&$vars) {
  // Slugs in menus
  $node = menu_get_object();
  if( $node = menu_get_object() ) {
    if(isset($node->field_slug) &&  isset($node->field_slug['und'])) {
      $slug = $node->field_slug['und'][0]['value'];
      $vars['classes_array'][] = $slug;
    }
  }

  // Page-specific HTML template
  if (module_exists('path')) {
    $alias = drupal_get_path_alias(str_replace('/edit','',$_GET['q']));
    if ($alias != $_GET['q']) {
      $template_filename = 'html';
      foreach (explode('/', $alias) as $path_part) {
        $template_filename = $template_filename . '__' . $path_part;
        $vars['theme_hook_suggestions'][] = $template_filename;
      }
    }
  }
}

function designjam_preprocess_page(&$vars) {
  // Populate the page template suggestions.
  if ($suggestions = theme_get_suggestions(arg(), 'page')) {
    $vars['theme_hook_suggestions'] = $suggestions;
  }

  // Add "slug" to template suggestions
  if (isset($vars['node'])) {
    $node = $vars['node'];
    $field_items = field_get_items('node', $node, 'field_slug');
    if($field_items) {
      $slug = $field_items[0]['value'];
      $vars['theme_hook_suggestions'][] = 'page__' . $slug;
    }
  }

  // Remove taxonomy term page no content message?
  if(isset($vars['page']['content']['system_main']['no_content'])) {
    unset($vars['page']['content']['system_main']['no_content']);
  }

  // Taxonomy term templates, per vocabulary
  if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
    $term = taxonomy_term_load(arg(2));
    $vars['theme_hook_suggestions'][] = 'page__taxonomy__term__' . $term->vocabulary_machine_name;
  }

}

function designjam_preprocess_node(&$vars) {
  // $node = $vars['node'];
  // $foo= /* get the value of this field from $node */ ;
  // $vars['theme_hook_suggestions'][] = 'node__' . $foo;
}

// Block-specific templates
function designjam_preprocess_block(&$vars) {
  $block = $vars['block'];
  if($block->region === 'highlighted') {
    $tokens = explode(' ', $block->css_class);
    $slug = array_shift($tokens);
    $vars['theme_hook_suggestions'][] = 'block__' . $vars['block']->module . '__' . strtr($slug, '-', '_');
  }
}


// function designjam_preprocess_taxonomy_term(&$vars) {
//   // print_r($vars);
//   // $vars['vocabulary_machine_name'];
// }

// function designjam_preprocess_block(&$variables) {}
function designjam_menu_tree__main_menu(array $variables) {
  return '<ul class="primary-nav" id="primary-nav">' . $variables['tree'] . '</ul>';
}

function designjam_html_head_alter(&$head_elements) {
  unset ($head_elements['system_meta_content_type']);
  unset ($head_elements['system_meta_generator']);
}

function slug($string) {
  $string = str_replace(' ', '_', $string);
  $string = str_replace(',', '', $string);
  $string = str_replace('\'', '', $string);
  $string = str_replace(':', '', $string);
  $string = str_replace('?', '', $string);
  $string = strtolower($string);
  return $string;
}
function to_sentence( $array = array() ) {
  if( empty($array) || !is_array($array) ) { return $array; }
  switch(count($array)) {
    case 1:
      $string = array_pop( $array );
      break;
    case 2:
      $string = implode( ' and ', $array );
      break;
    default:
      $last_string = array_pop( $array );
      $string = implode( ', ', $array ) . ' and ' . $last_string;
      break;
  }
  return $string;
}
