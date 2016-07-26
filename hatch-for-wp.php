<?php

/*
Plugin Name: Hatch for Wordpress
Plugin URI: http://hatchspot.com/
Version: 1.0
Author: Hatch
Description: Plugin to easily integrate Hatch features with an existing Wordpress site.
*/



/**
 * hatch-showroom shortcode handle function
 * usage : [hatch-showroom id=1]
 * @param  array $atts 
 * @return  string
 */
function hatch_showroom($atts) {
  $default_domain = 'app.hatchspot.com';
  $default_review_domain = 'reviews.nicework.io';
  $a = shortcode_atts( array(
    'id' => 0,
    'domain' => $default_domain,
    'review_domain' => $default_review_domain
	), $atts );
	$id = (int) $a['id'];

  $domain = $default_domain;
  $app_url = 'https://'.$domain;
  if(isset($a['domain']) && $a['domain']!=''){
    $domain = $a['domain'];
    $app_url = 'http'.(($domain==$default_domain)?'s':'').'://'.$domain;
  }

  $review_domain = $default_review_domain;
  if(isset($a['review_domain']) && $a['review_domain']!=''){
    $review_domain = $a['review_domain'];
  }

	ob_start();
	?>
	<div class="nicework-showroom-container"></div><script>var NWDOMAIN="<?php echo $domain; ?>";var NWRDOMAIN="<?php echo $review_domain; ?>";!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.setAttribute("data-id",<?php echo $id ?>);js.setAttribute("data-campaign","showroom");js.src="<?php echo $app_url; ?>/js/nicework-showroom.js";d.getElementsByTagName('head')[0].appendChild(js,fjs);}}(document,"script","nicework-showroomjs");</script>
	<?php
	return ob_get_clean();
}
add_shortcode( 'hatch-showroom', 'hatch_showroom' );


/**
 * hatch-review-feed shortcode handle function
 * usage : [hatch-review-feed id=1 column='single' width=300 height=400]
 * @param  array $atts 
 * @return  string
 */
function hatch_review_feed($atts) {
	$default_domain = 'app.hatchspot.com';
  $a = shortcode_atts( array(
	    'id' => 0,
	    'column' => 'single',
	    'width' => 0,
	    'height' => 0,
	    'domain' => $default_domain
	), $atts );

  $domain = $default_domain;
  $app_url = 'https://'.$domain;
  if(isset($a['domain']) && $a['domain']!=''){
    $domain = $a['domain'];
    $app_url = 'http'.(($domain==$default_domain)?'s':'').'://'.$domain;
  }

	ob_start();
	?>
	<a class="nicework-review-feed-widget" href="<?php echo $app_url; ?>" data-option="<?php echo $a['column'] .",". $a['width'] .",". $a['height'];?>">powered by NiceWork</a><script>var NWDOMAIN="<?php echo $domain; ?>";!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.setAttribute("data-id",<?php echo $a['id']; ?>);js.src="<?php echo $app_url ?>/js/nicework-widgets.js";fjs.parentNode.appendChild(js,fjs);}}(document,"script","nicework-widgetjs");</script>

	<?php
	return ob_get_clean();
}
add_shortcode( 'hatch-review-feed', 'hatch_review_feed' );





