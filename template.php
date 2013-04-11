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

    if ( ($url_array[0] == 'australia' || $url_array[0] == 'fiji' || $url_array[0] == 'new-zealand'
      || $url_array[0] == 'special') && $url_array_length == 1) {
        $variables['display_breadcrumb'] = false;
        $variables['front'] = 'front';
    }
    else { $variables['display_breadcrumb'] = true; }

    if (substr_count(drupal_get_path_alias(current_path()), 'info')){
        $variables['green'] = 'green';
    }
		// Add custom Javascript
		//drupal_add_js(drupal_get_path('theme','ptt') . "/js/jquery-1.2.6.min.js",'file');
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
function ptt_breadcrumb($variables) {
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

	$countries = array('australia', 'australien', 'new-zealand', 'neuseeland', 'fiji', 'fidschi');
		if(in_array($url_array[0],$countries)) {
			if($url_array[1] == 'product' || $url_array[1] == 'info' || $url_array[1] == 'partner' ) { // Product, Info
				$country = $url_array[0];
				switch ($country) {
					case 'australien':
						$country_link = $url_base . 'australia';
						break;
					case 'neuseeland':
						$country_link = $url_base . 'fiji';
						break;
					case 'fidschi':
						$country_link = $url_base . 'new-zealand';
						break;
					case 'new-zealand':
						$country = 'New Zealand';
						break;
					default:break;
				}
				$crumbs .= " >> ";
				$crumbs .= "<a href=$country_link >" . ucfirst($country) . "</a>";
				$crumbs .= " >> ";
				if($url_array[1] == 'product' && $lang == 'de') $url_array[1] = 'Produkt';
				$crumbs .= "<span>" . ucfirst(t($url_array[1])) . "</span>";
			}
			else { // Product List
			  $country = $url_array[0];
			  $country_link = $url_base . $country;
			  $product_type = $url_array[1];
			  if($lang == 'de'){
			  	switch ($country) {
			  		case 'australia':
			  			$country = 'australien';
			  			break;
			  		case 'new-zealand':
			  			$country = 'neuseeland';
			  			break;
			  		case 'fiji':
			  			$country = 'fidschi';
			  			break;
			  		default:
			  			# code...
			  			break;
			  	}
			  	switch ($product_type) {
			  		case 'travel':
			  			$product_type = 'reisen';
			  			break;
			  		case 'accommodation':
			  			$product_type = 'unterkunft';
			  			break;
			  		case 'flight':
			  			$product_type = 'flüge';
			  			break;
			  		case 'rental-car-campervans':
			  			$product_type = 'Mietwagen & Wohnmobile';
			  			break;
			  		case 'wedding':
			  			$product_type = 'heiraten';
			  			break;
			  		case 'work-travel':
			  			$product_type = 'Work & Travel';
			  			break;
			  		default:
			  			break;
			  	}
			  }
			  else {
			  	switch ($country) {
			  		case 'new-zealand':
			  			$country = "New Zealand";
			  			break;
			  		default:
			  			# code...
			  			break;
			  	}
			  	switch ($product_type) {
			  		case 'rental-car-campervans':
			  			$product_type = 'Rental Cars & Campervans';
			  			break;
			  		case 'work-travel':
			  			$product_type = 'Work & Travel';
			  			break;
			  		default:
			  			# code...
			  			break;
			  	}
			  }
				$crumbs .= " >> ";
				$crumbs .= "<a href=$country_link >" . ucfirst($country) . "</a>";
				$crumbs .= " >> ";
				//if($url_array[1] == 'Product' && $lang == 'de') $url_array[1] == 'Produkt';
				$crumbs .= "<span>" . ucfirst($product_type) . "</span>";
			}
		}
		else if($url_array[0] == 'partner') { // Partner(Affiliate)
			$country = $url_array[1];
			$partner_type = $url_array[2];
			$country_link = $url_base . $country;
			if($lang == 'de') {
				switch ($country) {
					case 'australia':
						$country = 'australien';
						break;
					case 'new-zealand':
						$country = 'neuseeland';
						break;
					case 'fiji':
						$country = 'fidschi';
						break;
					default:break;
				}
				switch ($partner_type) {
					case 'flights':
						$partner_type = 'flug';
						break;
					case 'rental-cars':
						$partner_type = 'mietwagen';
						break;
					case 'travel-insurance':
						$partner_type = 'reiseversicherung';
						break;
					default:break;
				}
			}
			else {
				if($country == 'new-zealand') $country = 'New Zealand';
				switch ($partner_type) {
					case 'bed-breakfast':
						$partner_type = 'Bed & Breakfast';
						break;
					case 'rental-cars':
						$partner_type = 'Rental Cars';
						break;
					case 'travel-insurance':
						$partner_type = 'Travel Insurance';
						break;
					default:break;
				}
			}
			$crumbs .= " >> ";
			$crumbs .= "<a href=$country_link>" . ucfirst($country) . "</a>";
			$crumbs .= " >> " . "<span>Partner</span>" . " >> ";
			$crumbs .= "<span>" . ucfirst($partner_type) . "</span>";

		}
		else { // Taxonomy, Article, Contact, Basket or Inquiry
			if($url_array_length > 1) { // Taxonomy or Thank-you
				if($url_array[0] != 'node'){ // Taxonomy
					$crumbs .= " >> ";
					$crumbs .= "<span>" . ucfirst($url_array[1]) . "</span>";
				}
				// Do nothing to Thank-you page.
			}
			else { // Not Taxonomy
				$crumbs .= " >> ";
				$crumbs .= "<span>" . ucfirst($url_array[0]) . "</span>";
			}
		}
		$crumbs .= "</div>";
    return $crumbs;
}


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
