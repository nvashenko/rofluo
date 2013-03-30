<?php


/**
 * Implements hook_theme()
 * @return array
 */
function ipex_theme() {
  $items = array();
  $items['sub_menu_wrapper'] = array(
    'render element' => 'tree',
  );
  return $items;
}


/**
 *  Implementation theme function for social bookmarks theme_follow_link().
 * @param $variables
 * @return string
 */
function ipex_follow_link($variables) {
  $link = $variables['link'];
  $title = $variables['title'];
  $attributes = array(
    'target' => '_blank',
    'class' => array('ico', $variables['link']->name),
  );
  return l($title, $link->path, array('html' => TRUE, 'attributes' => $attributes));
}

/**
 * Implementation theme function for social bookmarks theme_follow_links().
 * @param $variables
 * @return string
 */
function ipex_follow_links($variables) {
  $links = $variables['links'];
  $output = '';
  $output = '<div id="social"><div class="fr"><ul>';
  $output .= '<li class="mail" >' . variable_get('site_mail') . '</li>';
  foreach ($links as $link) {
    $output .= '<li>' . theme('follow_link', array('link' => $link, 'title' => $link->name)) . '</li>';
  }
  $output .= '</ul></div></div><div class="cl"></div>';
  return $output;
}



/**
 * Implements hook_menu_link().
 * @param $variables
 * @return string
 */
function ipex_menu_link($variables) {
  $element = $variables['element'];
  $sub_menu = '';
  // Remove leaf class name
  if (!empty($element['#attributes']['class']) && in_array('leaf', $element['#attributes']['class'])) {
    unset($element['#attributes']['class'][array_search('leaf', $element['#attributes']['class'])]);
  }
  // If element contains sub menu render it.
  if ($element['#below']) {
    if(!empty($element['#bid']['module'])){
      $element['#below']['#theme_wrappers'] = array('sub_menu_wrapper');
      $element['#localized_options']['html'] = TRUE;
      $element['#title'] = '<span class="tooltip">' . $element['#title'] . '</span>';
    }
    elseif($element['#original_link']['menu_name'] == 'main-menu' &&  $element['#original_link']['link_path'] == 'burge'){
      $element['#below'] = array();
    }
    $sub_menu = drupal_render($element['#below']);
  }
  if (!empty($element['#localized_options']['attributes']['list_element_class'])) {
    $element['#attributes']['class'][] = $element['#localized_options']['attributes']['list_element_class'];
    unset($element['#localized_options']['attributes']['list_element_class']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Implementats suggested theme function hook_menu_tree__menu_MENU_NAME()
 * @param $variables
 * @return string
 */
function ipex_menu_tree__main_menu(&$variables) {
  return '<ul class="menu cf">' . $variables['tree'] . '</ul>';
}


/**
 * Implements hook_sub_menu_wrapper().
 * @param $variables
 * @return string
 */
function ipex_sub_menu_wrapper(&$variables) {
  return '<div class="sub-menu-holder"><ul class="tooltip menu">' . $variables['tree']['#children'] . '</ul></div>';
}
/**
 * Implements hook_preprocess_node().
 * @param $variables
 */
function ipex_preprocess_node(&$variables) {
  $node = &$variables['node'];
  $variables['theme_hook_suggestions'][] = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
  $preprocess_func = 'ipex_preprocess_node_' . $variables['type'] . '_' . $variables['view_mode'];
  if (function_exists($preprocess_func)) {
    $preprocess_func($variables);
  }
}

/**
 * Implements hook_preprocess_node_TYPE_VIEW_MODE().
 * @param $variables
 */
function ipex_preprocess_node_slideshow_full(&$variables){
  $node_w = entity_metadata_wrapper('node', $variables['node']);
  $variables['caption_classes'] = 'carousel-caption';
  $variables['btn'] = FALSE;
//  $variables['btn'] = ($node_w->field_slide_type->value() == 'button') ? TRUE : FALSE;
  if($node_w->field_link->value()){
    $variables['btn'] = TRUE;
    $variables['link'] = $node_w->field_link->value();
    $variables['link']['attributes']['class'] = array('tm-btn');
    $variables['caption_classes'] .= '  btn ac';
  }
  $file = $node_w->field_slideshow_image->value();
  unset($file['width'], $file['height']);
  $file['attributes'] = array(
    'class' => array('carousel-image'),
  );
  $variables['image'] = array(
    '#theme' => 'image_formatter',
    '#item' => $file,
    '#image_style' => 'slideshow'
  );
}

/**
 * Implements hook_preprocess_node_TYPE_VIEW_MODE().
 * @param $variables
 */
function ipex_preprocess_node_news_teaser(&$variables){
  $node_w = entity_metadata_wrapper('node', $variables['node']);
  $body = $node_w->body->value();
  $variables['date'] = format_date($node_w->field_news_date->value(), 'news');
  $variables['description'] = ipex_trim_text(array('max_length' => '100', 'word_boundary' => TRUE, 'ellipsis' => '...'), $body['value']);
}

/**
 * Implements ipex_trim_text().
 * @param $alter
 * @param $value
 * @return mixed|string
 */
function ipex_trim_text($alter, $value) {
  if(!empty($alter['clear_html'])){
    $value = strip_tags($value);
  }
  if (drupal_strlen($value) > $alter['max_length']) {
    $value = drupal_substr($value, 0, $alter['max_length']);
    // TODO: replace this with cleanstring of ctools
    if (!empty($alter['word_boundary'])) {
      $regex = "(.*)\b.+";
      if (function_exists('mb_ereg')) {
        mb_regex_encoding('UTF-8');
        $found = mb_ereg($regex, $value, $matches);
      }
      else {
        $found = preg_match("/$regex/us", $value, $matches);
      }
      if ($found) {
        $value = $matches[1];
      }
    }
    // Remove scraps of HTML entities from the end of a strings
    $value = rtrim(preg_replace('/(?:<(?!.+>)|&(?!.+;)).*$/us', '', $value));
  }
  if (!empty($alter['ellipsis']) && !empty($value)) {
    $value .= t($alter['ellipsis']);
  }
  if (!empty($alter['html'])) {
    $value = _filter_htmlcorrector($value);
  }

  return $value;
}

//function ipex_preprocess_panels_pane(&$variables){
//  if($variables['pane']->subtype == 'last_news-panel_pane_1'){
//    $variables['theme_hook_suggestions'][] = 'panels_pane__views_panes__last_news_panel_pane';
//  }
//
//}

function ipex_preprocess_comment(&$variables){
  $comment_w = entity_metadata_wrapper('comment', $variables['comment']);
  $variables['theme_hook_suggestions'][] = 'comment__' . $variables['elements']['#view_mode'];
  $variables['date'] = format_date($comment_w->created->value(), 'normal');
  $body = $comment_w->comment_body->value();
  $variables['description'] = ipex_trim_text(array('max_length' => '150', 'word_boundary' => TRUE, 'ellipsis' => '...'), $body['value']);
  $variables['username'] = (!empty($variables['comment']->name)) ? $variables['comment']->name : t('Anonymous');
}

/**
 * Implements hook_preprocess_node_TYPE_VIEW_MODE().
 * @param $variables
 */
function ipex_preprocess_node_article_key_directions_teaser(&$variables){
  $node_w = entity_metadata_wrapper('node', $variables['node']);
  $variables['description'] = ipex_trim_text(array('max_length' => '49'), $node_w->field_short_description->value());
}

/**
 * Implements hook_preprocess_node_TYPE_VIEW_MODE().
 * @param $variables
 */
function ipex_preprocess_node_bright_deal_not_last_deal_block(&$variables){
  $node_w = entity_metadata_wrapper('node', $variables['node']);
  $variables['date'] = format_date($node_w->field_bright_deal_date->value(), 'normal');
  $variables['company'] = $node_w->field_company_name->value();
  $variables['jurist'] = $node_w->field_jurist->value();
  $body = $node_w->body->value();
  $variables['description'] = ipex_trim_text(array('max_length' => '150', 'word_boundary' => TRUE, 'ellipsis' => '...', 'clear_html' => TRUE), $body['value']);
  $vote_widget = reset(rate_get_active_widgets('node', 'bright_deal'));
  if(!empty($vote_widget)){
    $variables['vote'] = rate_generate_widget(1,'bright_deal', $node_w->nid->raw());
  }
}

/**
 * Theme rate button.
 *
 * @param array $variables
 * @return string
 */
function ipex_rate_button($variables) {
  $text = $variables['text'];
  $href = $variables['href'];
  $class = $variables['class'];
  static $id = 0;
  $id++;

  $classes = 'rate-button';
  if ($class) {
    $classes .= ' ' . $class;
  }
  if (empty($href)) {
    // Widget is disabled or closed.
    return '<span class="' . $classes . '" id="rate-button-' . $id . '">' .
      check_plain($text) .
      '</span>';
  }
  else {
    return '<a class="' . $classes . '" id="rate-button-' . $id . '" rel="nofollow" href="' . htmlentities($href) . '" title="' . check_plain($text) . '">' .
     $text . '</a>';
  }
}

function ipex_preprocess_node_partners_teaser(&$variables){
  $node_w = entity_metadata_wrapper('node', $variables['node']);
  $image = $node_w->field_image->value();
  if($node_w->field_link->value()){
    $variables['link'] = $node_w->field_link->value();
  }
  else{
    $variables['link']['url'] = 'node/' . $node_w->nid->raw();
    $variables['link']['attributes'] = array();
  }
  $variables['image'] = array(
    '#theme' => 'image_formatter',
    '#item' => $image
  );
}

function ipex_preprocess_asset_wrapper(&$variables){
  if($variables['asset']->type == 'image'){
    $variables['attributes_array']['class'][] = 'thumbnail';
    if($variables['view_mode'] == 'small'){
      $variables['attributes_array']['class'][] = $variables['asset']->asset_options['align'];
    }
  }

}

/**
 * Implements hook_form_element().
 * @param $variables
 * @return string
 */
function ipex_form_element($variables) {
  $element = &$variables['element'];
  $output = '';
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
    '#title_display' => 'before',
  );

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }
  $attributes['class'] = array();
  // Add element's #type and #name as class to aid with JS/CSS selectors.
  // $attributes['class'] = array('form-item');
  if (isset($element['#wrapper_classes'])) {
    $attributes['class'] += $element['#wrapper_classes'];
  }
  else{
    $attributes['class'][] = 'wrap';
  }
  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  $prefix = isset($element['#prefix']) ? $element['#prefix'] : '';
  $suffix = isset($element['#suffix']) ? $element['#suffix'] : '';
  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', $variables);
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
    case 'blue_label':
      $output .= ' ' . theme('form_element_blue_label', $variables);
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
    case 'blue_label_w_asterix':
      $output .= ' ' . theme('form_element_blue_label_w_asterix', $variables);
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
    case 'after':
      $output .= ' ' . $prefix . $element['#children'] . $suffix;
      $output .= ' ' . theme('form_element_label', $variables) . "\n";
      break;
    case 'none':
    case 'build_in':
    case 'attribute':
    case 'placeholder':
      // Output no label and no required marker, only the children.
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
  }

  if (!empty($element['#description']) && $element['#type'] != 'checkbox') {
    $output .= '<p class="size-11"><em>' . $element['#description'] . "</em></p>\n";
  }
  if (!isset($element['#no_wrapper'])) {
    $output = '<div' . drupal_attributes($attributes) . '>' . "\n" . $output . "</div>\n";
  }
  return $output;
}

/**
 * Returns HTML for a textfield form element.
 *
 * @param $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #title, #value, #description, #size, #maxlength,
 *     #required, #attributes, #autocomplete_path.
 *
 * @ingroup themeable
 */
function ipex_textfield($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'text';
  element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
  _form_set_class($element, array('form-text'));
  if ($element['#title_display'] == 'placeholder' && !empty($element['#title'])) {
    $element['#attributes']['placeholder'] = ((isset($element['#required']) && !empty($element['#required'])) ? '*' : '') . $element['#title'];
  }
  $extra = '';
  if ($element['#autocomplete_path'] && drupal_valid_path($element['#autocomplete_path'])) {
    drupal_add_library('system', 'drupal.autocomplete');
    $element['#attributes']['class'][] = 'form-autocomplete';

    $attributes = array();
    $attributes['type'] = 'hidden';
    $attributes['id'] = $element['#attributes']['id'] . '-autocomplete';
    $attributes['value'] = url($element['#autocomplete_path'], array('absolute' => TRUE));
    $attributes['disabled'] = 'disabled';
    $attributes['class'][] = 'autocomplete';
    $extra = '<input' . drupal_attributes($attributes) . ' />';
  }
  $element['#attributes']['class'][] = 'ipt';
  $output = '<input' . drupal_attributes($element['#attributes']) . ' />';
  return $output . $extra;
}

function ipex_preprocess_node_product_teaser(&$variables){
  $node_w = entity_metadata_wrapper('node', $variables['node']);
  $image = $node_w->field_product_image->value();
  $variables['price'] = theme('ipex_site_price', array('price' => $node_w->field_product_price->value()));
  $variables['category'] = $node_w->field_product_category->value();

  $variables['parent_category'] = reset($node_w->field_product_category->parent->value());
  if(!empty($image)){
    $variables['image'] = array(
      '#theme' => 'image_formatter',
      '#item' => $image,
    );
  }
  $variables['date'] = format_date($node_w->created->value(), 'normal');
  $variables['author'] = $node_w->author->value()->name;
  $body = $node_w->body->value();
  $variables['description'] = ipex_trim_text(array('max_length' => '100', 'word_boundary' => TRUE, 'ellipsis' => '...'), $body['value']);
  $variables['stats'] = statistics_get($node_w->nid->raw());
}


function ipex_breadcrumb(&$variables){
  $breadcrumb = menu_get_active_breadcrumb();//$variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    $output = '';
    $breadcrumb[] = '<p>' . drupal_get_title() . '</p>';
    $output .= '<div class="breadcrumbs">' . implode('<span class="ico"></span>', $breadcrumb) . '</div>';
    return $output;
  }
}