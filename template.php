<?php
function taxonomy_node_get_terms($node, $key = 'tid') {
    static $terms;

    if (!isset($terms[$node->vid][$key])) {
        $query = db_select('taxonomy_index', 'r');
        $t_alias = $query->join('taxonomy_term_data', 't', 'r.tid = t.tid');
        $v_alias = $query->join('taxonomy_vocabulary', 'v', 't.vid = v.vid');
        $query->fields( $t_alias );
        $query->condition("r.nid", $node->nid);
        $result = $query->execute();
        $terms[$node->vid][$key] = array();
        foreach ($result as $term) {
            $terms[$node->vid][$key][$term->$key] = $term;
        }
    }
    return $terms[$node->vid][$key];
}

function ptt_preprocess_html(&$variables) {
    if(arg(0)=='node' && is_numeric(arg(1))) {
        $node = node_load(arg(1));
        $results = taxonomy_node_get_terms($node);
        if(is_array($results)) {
            foreach ($results as $item) {
               $variables['classes_array'][] = "taxonomy-".strtolower(drupal_clean_css_identifier($item->name));
            }
       }
   }

}
function ptt_preprocess_page(&$variables) {
    $url = drupal_get_path_alias(current_path());
    //Get the url's segment
    $url_array = explode('/', $url);
    $url_array_length = count($url_array);

    $countries = array('australia', 'fiji', 'new-zealand', 'special');

    if ( in_array($url_array[0], $countries) && $url_array_length == 1) {
        $variables['display_breadcrumb'] = false;
        $variables['front'] = 'front';
    } else { $variables['display_breadcrumb'] = true; }

    if (substr_count($url, 'info')){ $variables['green'] = 'green'; }

		// Add custom Javascript
		drupal_add_js(drupal_get_path('theme','ptt') . "/js/ptt.js",'file');
}

function ptt_menu_link(array $variables) {

//	if ($variables['element']['#original_link']['menu_name']=="menu-countries"){
		$element = $variables['element'];
		$sub_menu = '';

		if ($element['#below']) {
			$sub_menu = drupal_render($element['#below']);
		}
	$output = l($element['#title'], $element['#href'], $element['#localized_options']);
    return '<li' . drupal_attributes($element['#attributes']) . '><div class="before"></div><div class="text">' .
      $output . $sub_menu . '</div><div class="after"></div></li>';
//  }
}

// For breadcrumb
/*function ptt_breadcrumb($variables) {
	// Check the current language
	global $language;
	$lang = $language->language;
	// Check the current page type.
	$crumbs = "<div class='breadcrumb'>";
	$home_text = ($lang == 'en')? "Home" : "Startseite";
	$crumbs .= "<a href='/'>$home_text</a>";

  $url = drupal_get_path_alias(current_path());
  $url_array = explode('/', $url);
  $url_array_length = count($url_array);
  $url_base = base_path();
}*/


/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @see contact_site_form()
 */
function ptt_form_contact_site_form_alter(&$form, &$form_state, $form_id) {
  $form['#submit'][] = 'ptt_contact_form_blocks_submit';
}

/**
 * Extra form submission handler for contact_site_form().
 */
function ptt_contact_form_blocks_submit($form, &$form_state) {
  // Redirect user back to page with form instead of frontpage.
	global $language;
	$lang = $language->language;
  if ($lang == 'en') {
    $form_state['redirect'] = 'thank-you';
  }
  else {
    $form_state['redirect'] = 'danke';
  }
}

?>
