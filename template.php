<?php
// Includes
$lib = dirname(__FILE__).'/lib';
include "$lib/event.php";
include "$lib/media_item.php";
include "$lib/person.php";
define('LANG', LANGUAGE_NONE);

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
    if(isset($node->field_slug) &&  isset($node->field_slug[LANG])) {
      $slug = $node->field_slug[LANG][0]['value'];
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

  // Taxonomy term classes
  if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
    $term = taxonomy_term_load(arg(2));
    $vars['classes_array'][] = 'taxonomy-'.$term->vocabulary_machine_name;
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

  // Remove taxonomy term page no content message
  if(isset($vars['page']['content']['system_main']['no_content'])) {
    unset($vars['page']['content']['system_main']['no_content']);
  }

  // Setup for Taxonomy pages
  if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
    $term = taxonomy_term_load(arg(2));
    // Set term to be available in template
    $vars['taxonomy_term'] = $term;

    // Taxonomy term templates, per vocabulary
    $vars['theme_hook_suggestions'][] = 'page__taxonomy__term__' . $term->vocabulary_machine_name;

    // Add vocabulary to breadcrumb
    $vocab_map = array(
      'people'        => 'people',
      'events'        => 'workshops',
      'organizations' => 'organizations',
      'toolbox'       => 'toolbox',
    );

    $breadcrumbs = array(l('Home', '<front>'));
    $breadcrumbs[] = l(ucfirst($term->vocabulary_machine_name), $vocab_map[$term->vocabulary_machine_name]);
    $parents =  taxonomy_get_parents_all($term->tid);
    array_shift($parents);
    foreach(array_reverse($parents) as $term) {
      $breadcrumbs[] = l($term->name, url('taxonomy/term/' . $term->tid));
    }
    // $breadcrumbs[] = l(ucfirst($term->vocabulary_machine_name), $vocab_map[$term->vocabulary_machine_name]);
    drupal_set_breadcrumb($breadcrumbs);
  }
}

function designjam_preprocess_block(&$vars) {
  $block = $vars['block'];
  if($block->region === 'highlighted') {
    $tokens = explode(' ', $block->css_class);
    $slug = array_shift($tokens);
    $vars['theme_hook_suggestions'][] = 'block__' . $vars['block']->module . '__' . strtr($slug, '-', '_');
  }
}

function designjam_preprocess_node(&$vars) {
  if ($vars['submitted']) {
    $vars['submitted'] = '';
    // unset($vars['submitted']);
  }

  // Fix Media Item Title links
  if($vars['type'] == 'media_item') {
    if(!empty($vars['field_attachment'])) {
      $vars['node_url'] = file_create_url($vars['field_attachment'][LANG][0]['uri']);
    }
    else {
      $vars['node_url'] = $vars['field_url'][LANG][0]['value'];
    }
  }
}

function designjam_preprocess_taxonomy_term(&$vars) {
  // print_r($vars);
  // $vars['vocabulary_machine_name'];
}

function designjam_menu_tree__main_menu(array $variables) {
  return '<ul class="primary-nav" id="primary-nav">' . $variables['tree'] . '</ul>';
}

function designjam_html_head_alter(&$head_elements) {
  unset ($head_elements['system_meta_content_type']);
  unset ($head_elements['system_meta_generator']);
}

function designjam_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    $breadcrumb[] = drupal_get_title();
    $output = '<ol class="breadcrumbs">';
    foreach ($breadcrumb as $value) {
      $output .= '<li>' . $value . '</li>';
    }
    $output .= '</ol>';
    return $output;
  }
}

// Helper functions
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

function format_bytes($bytes, $precision = 2) {
  if ($bytes >= 1073741824)  { $bytes = number_format($bytes / 1073741824, 2) . ' GB'; }
  elseif ($bytes >= 1048576) { $bytes = number_format($bytes / 1048576, 2) . ' MB'; }
  elseif ($bytes >= 1024)    { $bytes = number_format($bytes / 1024, 2) . ' KB'; }
  elseif ($bytes > 1)        { $bytes = $bytes . ' bytes'; }
  elseif ($bytes == 1)       { $bytes = $bytes . ' byte'; }
  else                       { $bytes = '0 bytes'; }
  return $bytes;
}
