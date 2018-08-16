<?php


//START LEFT CONTENT
$nd_travel_shortcode_left_content = '';

$nd_travel_shortcode_left_content .= '
<!--START FORM-->
<form id="nd_travel_search_cpt_1_form_sidebar" class="nd_travel_padding_15 nd_travel_section nd_travel_box_sizing_border_box">';
  
  include 'include/nd_travel_destinations.php';

  include 'include/nd_travel_keyword.php';
  
  include 'include/nd_travel_date.php';
  include 'include/nd_travel_typologies.php';

  if ( $nd_travel_shortcode_search_results['price'] == 'enable' ) {
    include 'include/nd_travel_price.php';  
  }
  
  include 'include/nd_travel_durations.php';
  include 'include/nd_travel_difficulties.php';
  include 'include/nd_travel_minage.php';
    

$nd_travel_shortcode_left_content .= '
</form>
<!--END FORM-->';
//END LEFT CONTENT