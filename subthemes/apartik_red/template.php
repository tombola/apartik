<?php


/**
 * Override or insert variables into the page template for HTML output.
 */
function apartik_red_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function apartik_red_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
  global $user;
  $user_roles = $user->roles;
  unset($user_roles[2]);
  $user_roles = implode('|', $user_roles);
  $variables['page']['user_roles'] = '<h3 style="text-align: right; position: absolute; top:80px; right: 20px; margin-right:20px;">'.$user_roles.'<h3>';
}
