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
  $user_roles = str_replace('research', '', $user_roles);
  $user_roles = str_replace('authenticated', '*', $user_roles);
  $user_roles = str_replace(' user', '', $user_roles);
  $variables['page']['user_roles'] = '<h3>'.$user_roles.'<h3>';
}
