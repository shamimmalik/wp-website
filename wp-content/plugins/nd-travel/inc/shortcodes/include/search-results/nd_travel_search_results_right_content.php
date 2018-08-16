<?php


$nd_travel_shortcode_right_content = '';

//START RIGHT CONTENT
$nd_travel_shortcode_right_content .= '

  <div id="nd_travel_archive_search_masonry_container" class="nd_travel_section nd_travel_position_relative">
    
    <div id="nd_travel_content_result" class="nd_travel_section">

        <!--<h3>'.__('Results Founded : ','nd-travel').''.$nd_travel_qnt_results_posts.'</h3>-->';

        //if NO RESULT
        if ( $nd_travel_qnt_results_posts == 0 ) { 

          $nd_travel_shortcode_right_content .= '

          <div class="nd_travel_section nd_travel_padding_15 nd_travel_box_sizing_border_box">
            <div class="nd_travel_section nd_travel_bg_yellow nd_travel_padding_15_20 nd_travel_box_sizing_border_box">
              <img class="nd_travel_float_left nd_travel_display_none_all_iphone" width="20" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-warning-white.svg">
              <h3 class="nd_travel_float_left nd_options_color_white nd_travel_color_white nd_options_first_font nd_travel_margin_left_10">'.__('No results for this search','nd-travel').'</h3>
            </div>
          </div>
          
          '; 

        }
        //END if

        $nd_travel_shortcode_right_content .= '
        <div class="nd_travel_section nd_travel_masonry_content">';

          //START loop
          while ( $the_query->have_posts() ) : $the_query->the_post();

              include 'nd_travel_post_preview-1.php';

          endwhile;
          //END loop

        $nd_travel_shortcode_right_content .= '
        </div>


        <script type="text/javascript">
        //<![CDATA[
        
        jQuery(document).ready(function() {

          //START masonry
          jQuery(function ($) {
            
            //Masonry
            var $nd_travel_masonry_content = $(".nd_travel_masonry_content").imagesLoaded( function() {
              // init Masonry after all images have loaded
              $nd_travel_masonry_content.masonry({
                itemSelector: ".nd_travel_masonry_item"
              });
            });


            //tooltip
            $( ".nd_travel_tooltip_jquery" ).tooltip({ 
              tooltipClass: "nd_travel_tooltip_jquery_content",
              position: {
                my: "center top",
                at: "center-7 top-33",
              }
            });


          });
          //END masonry

        });

        //]]>
      </script>';


      
      include 'nd_travel_search_results_pagination.php';



    $nd_travel_shortcode_right_content .= '
    </div>
  </div>
';
//END RIGHT CONTENT