<?php


if ($nd_travel_archive_form_keyword != '') {

	$nd_travel_shortcode_left_content .= '
	<!--START search form-->
	<div class=" nd_travel_archive_form_keyword_content nd_travel_width_100_percentage nd_travel_float_left nd_travel_box_sizing_border_box">

		<div class="nd_travel_section nd_travel_position_relative nd_travel_padding_30 nd_travel_padding_30_15_all_iphone nd_travel_box_sizing_border_box">
			
			<div class="nd_travel_section nd_travel_height_10"></div>

			<h3 class="nd_travel_float_left nd_travel_font_weight_normal  nd_travel_font_size_16">'.__('Keyword','nd-travel').' : '.$nd_travel_archive_form_keyword.' <img id="nd_travel_remove_keyword" width="8" class="nd_travel_cursor_pointer nd_travel_bg_greydark nd_travel_padding_2 nd_travel_border_radius_100_percentage" alt="" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-close-2-white.svg"></h3> 
			<input class="nd_travel_width_100_percentage" id="nd_travel_archive_form_keyword" name="nd_travel_archive_form_keyword" value="'.$nd_travel_archive_form_keyword.'" type="hidden">

		</div>

		<div class="nd_travel_section nd_travel_height_5"></div> 
	    <div class="nd_travel_section nd_travel_height_2 nd_travel_bg_grey"></div>
	  
	</div>


	<script type="text/javascript">
      //<![CDATA[
      jQuery(document).ready(function() {

        jQuery( function ( $ ) {

          $( "#nd_travel_remove_keyword" ).on( "click", function() {
            $("#nd_travel_archive_form_keyword").val("");
            nd_travel_sorting(1);
            $( ".nd_travel_archive_form_keyword_content" ).slideToggle( "slow", function() {}); 
          });


  
        });

      });
      //]]>
    </script>



	<!--END search form-->';

}