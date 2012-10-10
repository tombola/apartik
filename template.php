<?php


/**
 * Override or insert variables into the page template for HTML output.
 */
function apartik_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function apartik_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
}

// Name module includes all titles - hide unless professional
function apartik_preprocess_field(&$variables) {
  if($variables['element']['#field_name'] == 'field_title_name') {
    //if($variables['items']['0']['#markup'] == 'thedefaultvalue') {
      $variables['items']['0']['#markup'] = _hide_name_titles($variables['items']['0']['#markup']); //preg_replace('/^Mr./','', $variables['items']['0']['#markup']);
    //}
  }
}
// Name module includes all titles - hide unless professional
// altered from name.module to vary rendering according to title (eg Mr.)
function apartik_username_alter(&$name, $account) {
  // Don't alter anonymous users or objects that do not have any user ID.
  if (empty($account->uid)) {
    return;
  }
  // Real name was loaded/generated via hook_user_load(), so re-use it.
  if (!empty($account->realname)) {
    $name = _hide_name_titles($account->realname);
  }
}

function _hide_name_titles($name) {
   $hidden_titles = array(
      'Mr.',
      'Ms.',
      'Mrs.',
      );
    return str_replace($hidden_titles, '', $name);
}