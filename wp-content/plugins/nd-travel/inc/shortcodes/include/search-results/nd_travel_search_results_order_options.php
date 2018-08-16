<?php

$nd_travel_shortcode_order_options = '';
$nd_travel_current_page_permalink = get_permalink(get_the_ID());

if ( $nd_travel_current_page_permalink == nd_travel_search_page() ) {


    $nd_travel_shortcode_order_options .= '

      <script type="text/javascript">
          //<![CDATA[
          
          jQuery(document).ready(function() {

            
            jQuery(function ($) {
              
              $( "#nd_travel_search_filter_options a" ).on("click",function() {

                $( "#nd_travel_search_filter_options a" ).removeClass( "nd_travel_search_filter_options_active" );
                $(this).addClass( "nd_travel_search_filter_options_active");

                nd_travel_sorting(1);
              
              });

              $( "#nd_travel_search_filter_layout a" ).on("click",function() {

                $( "#nd_travel_search_filter_layout a" ).removeClass( "nd_travel_search_filter_layout_active" );
                $(this).addClass( "nd_travel_search_filter_layout_active");

                nd_travel_sorting();

              });

              
              $("#nd_travel_search_filter_options li").on("click",function() {
                $("#nd_travel_search_filter_options li").removeClass( "nd_travel_search_filter_options_active_parent" );
                $(this).addClass( "nd_travel_search_filter_options_active_parent");
              });

            });
            

          });

          //]]>
        </script>

        <style>
        .nd_travel_search_filter_options_active { color:#fff !important; }
        #nd_travel_search_filter_options li.nd_travel_search_filter_options_active_parent p { color:#fff !important; border-bottom: 2px solid #878787;}
    
        #nd_travel_search_filter_options li:hover .nd_travel_search_filter_options_child { display: block; }

        .nd_travel_search_filter_layout_grid { background-image:url('.plugins_url().'/nd-travel/assets/img/icons/icon-grid-grey.svg); }
        .nd_travel_search_filter_layout_grid.nd_travel_search_filter_layout_active { background-image:url('.plugins_url().'/nd-travel/assets/img/icons/icon-grid-white.svg); }

        .nd_travel_search_filter_layout_list.nd_travel_search_filter_layout_active { background-image:url('.plugins_url().'/nd-travel/assets/img/icons/icon-list-white.svg); }
        .nd_travel_search_filter_layout_list { background-image:url('.plugins_url().'/nd-travel/assets/img/icons/icon-list-grey.svg); }

        </style>




      <div id="nd_travel_search_results_order_options" class="nd_travel_section nd_travel_padding_10 nd_travel_box_sizing_border_box nd_travel_bg_greydark nd_travel_text_align_center">';

          if ( nd_travel_get_container() != 1) {  $nd_travel_shortcode_order_options .= '<div class="nd_travel_container nd_travel_padding_0_15 nd_travel_box_sizing_border_box nd_travel_clearfix">'; }
        
            $nd_travel_shortcode_order_options .= '
            <div class="nd_travel_section nd_travel_position_relative nd_travel_line_height_0">


                <ul id="nd_travel_search_filter_options" class="nd_travel_list_style_none nd_travel_display_inline_block nd_travel_padding_0 nd_travel_margin_0">
                  <li class="nd_travel_display_inline_block nd_travel_position_relative nd_travel_padding_20 nd_travel_padding_bottom_15 nd_travel_margin_0 nd_travel_float_left">
                      
                      <p class="nd_travel_font_size_12 nd_travel_padding_bottom_5 nd_travel_letter_spacing_2 nd_travel_text_transform_uppercase nd_travel_float_left">'.__('Stay Price','nd-travel').'</p>
                      <img alt="" class="nd_travel_margin_left_10 nd_travel_float_left" width="10" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-down-arrow-white.svg">

                      <ul class="nd_travel_padding_top_12 nd_travel_z_index_99 nd_travel_width_160 nd_travel_list_style_none nd_travel_search_filter_options_child nd_travel_position_absolute nd_travel_left_0 nd_travel_top_50 nd_travel_display_none nd_travel_padding_0 nd_travel_margin_0 nd_travel_width_100_percentage">
                          <li class="nd_travel_text_align_left nd_travel_bg_greydark_2 nd_travel_font_size_11 nd_travel_letter_spacing_2 nd_travel_text_transform_uppercase nd_travel_padding_15_20"><a data-meta-key="nd_travel_meta_box_min_price" data-order="ASC" class="nd_travel_cursor_pointer">'.__('Lowest Price','nd-travel').'</a></li>
                          <li class="nd_travel_text_align_left nd_travel_bg_greydark nd_travel_font_size_11 nd_travel_letter_spacing_2 nd_travel_text_transform_uppercase nd_travel_padding_15_20"><a data-meta-key="nd_travel_meta_box_min_price" data-order="DESC" class="nd_travel_cursor_pointer ">'.__('Highest Price','nd-travel').'</a></li>
                      </ul>

                  </li>   
                  <li class="nd_travel_display_inline_block nd_travel_position_relative nd_travel_padding_20 nd_travel_padding_bottom_15 nd_travel_margin_0 nd_travel_float_left">

                      <p class="nd_travel_font_size_12 nd_travel_padding_bottom_5 nd_travel_letter_spacing_2 nd_travel_text_transform_uppercase nd_travel_float_left">'.__('Room Size','nd-travel').'</p> 
                      <img alt="" class="nd_travel_margin_left_10 nd_travel_float_left" width="10" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-down-arrow-white.svg">

                      <ul class="nd_travel_padding_top_12 nd_travel_z_index_99 nd_travel_width_160 nd_travel_list_style_none nd_travel_search_filter_options_child nd_travel_position_absolute nd_travel_left_0 nd_travel_top_50 nd_travel_display_none nd_travel_padding_0 nd_travel_margin_0 nd_travel_width_100_percentage">
                          <li class="nd_travel_text_align_left nd_travel_bg_greydark_2 nd_travel_font_size_11 nd_travel_letter_spacing_2 nd_travel_text_transform_uppercase nd_travel_padding_15_20"><a data-meta-key="nd_travel_meta_box_room_size" data-order="DESC" class="nd_travel_cursor_pointer">'.__('Larger Room','nd-travel').'</a></li>
                          <li class="nd_travel_text_align_left nd_travel_bg_greydark nd_travel_font_size_11 nd_travel_letter_spacing_2 nd_travel_text_transform_uppercase nd_travel_padding_15_20"><a data-meta-key="nd_travel_meta_box_room_size" data-order="ASC" class="nd_travel_cursor_pointer">'.__('Smallest Room','nd-travel').'</a></li>
                      </ul>

                  </li>
              </ul> 


              <div id="nd_travel_search_filter_layout" class="">
                <a data-layout="1" class="nd_travel_search_filter_layout_grid nd_travel_cursor_pointer nd_travel_background_size_18 nd_travel_search_filter_layout_active nd_travel_width_18 nd_travel_height_18 nd_travel_position_absolute nd_travel_right_15 nd_travel_top_16"></a>
                <a data-layout="2" class="nd_travel_search_filter_layout_list nd_travel_cursor_pointer nd_travel_background_size_18 nd_travel_width_18 nd_travel_height_18 nd_travel_position_absolute nd_travel_right_53 nd_travel_top_16"></a>
              </div>

            </div>';


          if ( nd_travel_get_container() != 1 ) { $nd_travel_shortcode_order_options .= '</div>'; }

    $nd_travel_shortcode_order_options .= '
    </div>';


}













