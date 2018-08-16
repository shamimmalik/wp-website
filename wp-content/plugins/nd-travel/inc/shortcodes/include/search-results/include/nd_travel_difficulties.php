<?php


$nd_travel_shortcode_left_content .= '

      <!--START difficultys-->
        <div class=" '.$nd_travel_difficulties_class.' nd_travel_width_100_percentage nd_travel_float_left nd_travel_box_sizing_border_box">

          <div class="nd_travel_section nd_travel_position_relative nd_travel_padding_30 nd_travel_padding_30_15_all_iphone nd_travel_box_sizing_border_box">
                <h3 class="nd_travel_font_weight_normal nd_travel_font_size_16">'.__('Difficulty','nd-travel').' :</h3>
                <img class="nd_travel_toogle_difficulty_open_content nd_travel_position_absolute nd_travel_right_30 nd_travel_top_35 nd_travel_cursor_pointer" alt="" width="12" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-down-arrow-grey.svg">
                <img style="transform: rotate(180deg);" class="nd_travel_toogle_difficulty_close_content nd_travel_display_none nd_travel_position_absolute nd_travel_right_30 nd_travel_top_35 nd_travel_cursor_pointer" alt="" width="12" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-down-arrow-grey.svg">
            </div>

        ';


          //get all terms
          $nd_travel_terms = get_terms('nd_travel_cpt_1_tax_2');

          //get tax
          $nd_travel_the_tax = get_taxonomy('nd_travel_cpt_1_tax_2');

          //get name
          $nd_travel_tax_name = $nd_travel_the_tax->labels->name;


          $nd_travel_shortcode_left_content .= '
          <div class="nd_travel_toogle_difficulty_content nd_travel_padding_0_30 nd_travel_section nd_travel_display_none  nd_travel_margin_top_10_negative nd_travel_box_sizing_border_box">';

            foreach ($nd_travel_terms as $nd_travel_term) {

                  $nd_travel_shortcode_left_content .= '
                  <p class="nd_travel_width_50_percentage nd_travel_width_100_percentage_all_iphone nd_travel_float_left nd_travel_margin_0">
                    <input class="nd_travel_checkbox_difficulty nd_travel_width_25 nd_travel_margin_0 nd_travel_padding_0 nd_travel_margin_top_8" name="nd_travel_difficulty_id_'.$nd_travel_term->term_id.'" '; if( $nd_travel_cpt_1_tax_2_id == $nd_travel_term->term_id ){ $nd_travel_shortcode_left_content .='checked'; } $nd_travel_shortcode_left_content .='  type="checkbox" value="'.$nd_travel_term->term_id.',">
                      '.$nd_travel_term->name.'
                  </p>'; 

                }

                $nd_travel_shortcode_left_content .= '
            
            <div class="nd_travel_section nd_travel_height_20"></div>
            </div>';


            $nd_travel_shortcode_left_content .= '
            <input type="hidden" id="nd_travel_archive_form_difficultys" name="nd_travel_archive_form_difficultys" value="'.$nd_travel_cpt_1_tax_2_id_value.'">


            <script type="text/javascript">
              //<![CDATA[
              jQuery(document).ready(function() {

                jQuery( function ( $ ) {

                    $( ".nd_travel_checkbox_difficulty" ).change(function() {

                        if ( $( this ).is( ":checked" ) ) {

                            var nd_travel_difficulty_value = $( this ).val();
                            var nd_travel_difficulty_previous_value = $("#nd_travel_archive_form_difficultys").val();
                            $( "#nd_travel_archive_form_difficultys" ).val( nd_travel_difficulty_value+nd_travel_difficulty_previous_value );

                            nd_travel_sorting(1);

                        }else{

                            var nd_travel_difficulty_value = $( this ).val();
                            var nd_travel_difficulty_previous_value = $("#nd_travel_archive_form_difficultys").val();
                            var nd_travel_archive_form_difficultys = nd_travel_difficulty_previous_value.replace(nd_travel_difficulty_value, "");

                            $( "#nd_travel_archive_form_difficultys" ).val( nd_travel_archive_form_difficultys );

                            nd_travel_sorting(1);
                        }

                        
                    });



                    //toogle
                    $( ".nd_travel_toogle_difficulty_open_content" ).click(function() {
                      $( ".nd_travel_toogle_difficulty_content" ).slideToggle( "slow", function() {
                        $( ".nd_travel_toogle_difficulty_open_content" ).css("display","none");
                        $( ".nd_travel_toogle_difficulty_close_content" ).css("display","block");
                      });
                    });
                    $( ".nd_travel_toogle_difficulty_close_content" ).click(function() {
                      $( ".nd_travel_toogle_difficulty_content" ).slideToggle( "slow", function() {
                        $( ".nd_travel_toogle_difficulty_close_content" ).css("display","none");
                        $( ".nd_travel_toogle_difficulty_open_content" ).css("display","block");  
                      }); 
                    });';

                    if ( $nd_travel_cpt_1_tax_2_id_value != '' ) {
                      $nd_travel_shortcode_left_content .= '$( ".nd_travel_toogle_difficulty_open_content" ).trigger( "click" );';
                    }

                $nd_travel_shortcode_left_content .= '
                });

              });
              //]]>
            </script>

            <div class="nd_travel_section nd_travel_height_5"></div> 
            <div class="nd_travel_section nd_travel_height_2 nd_travel_bg_grey"></div>

            </div>
        <!--END difficultys-->';

