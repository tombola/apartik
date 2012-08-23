<?php


/**
 * Override or insert variables into the page template for HTML output.
 */
function apartik_dev_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function apartik_dev_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
  global $user;
  $user_roles = $user->roles;
  //unset($user_roles[2]); // authenticated? really? such a long word
  $user_roles = implode(' | ', $user_roles);
  $user_roles = str_replace('research ', '', $user_roles);
  $user_roles = str_replace('authenticated', '*', $user_roles);
  $user_roles = str_replace(' user', '', $user_roles);
  $variables['page']['user_roles'] = '<h3>'.$user_roles.'<h3>';
}

/**
 * Returns HTML for a start/end date combination on form.
 * taken from patch http://drupal.org/node/1467712#comment-6137556
 */
function apartik_dev_date_combo($variables) {
 $element = &$variables['element'];

  // Detect whether element is multiline.
  $count = preg_match_all('`<(?:div|span)\b[^>]* class="[^"]*\b(?:date-no-float|date-clear)\b`', $element['#children'], $matches, PREG_OFFSET_CAPTURE);
  $multiline = FALSE;
  if ($count > 1) {
    $multiline = TRUE;
  }
  elseif ($count) {
    $before = substr($element['#children'], 0, $matches[0][0][1]);
    if (preg_match('`<(?:div|span)\b[^>]* class="[^"]*\bdate-float\b`', $before)) {
      $multiline = TRUE;
    }
  }

  // Wrap children with a div and add an extra class if element is multiline.
  $element['#children'] = '<div class="date-form-element-content'. ($multiline ? ' date-form-element-content-multiline' : '') .'">'. $element['#children'] .'</div>';

  return theme('form_element', $variables);
}
