<?php


/*START pagination*/
if ( $nd_travel_qnt_results_posts > $nd_travel_qnt_posts_per_page ) {

  $nd_travel_shortcode_right_content .= '
  <div id="nd_travel_btn_pagination_content" class="nd_travel_section nd_travel_margin_top_20">

    <div id="nd_travel_btn_pagination" class="nd_travel_section nd_travel_text_align_center">';
        
        for ($nd_travel_i_pagination = 1; $nd_travel_i_pagination <= $nd_travel_qnt_pagination; $nd_travel_i_pagination++) {

            if ( $nd_travel_i_pagination == $nd_travel_paged ){ $nd_travel_class_pagination_active = 'nd_travel_btn_pagination_active'; } else { $nd_travel_class_pagination_active = ''; }

            $nd_travel_shortcode_right_content .= '
                
                <div class=" '.$nd_travel_class_pagination_active.' nd_travel_display_inline_block nd_travel_bg_greydark nd_travel_margin_0_10">
                    <a class="nd_travel_display_inline_block nd_travel_second_font nd_options_color_white nd_travel_padding_10_15 nd_travel_cursor_pointer nd_travel_font_size_11" onclick="nd_travel_sorting('.$nd_travel_i_pagination.')">
                        '.$nd_travel_i_pagination.'
                    </a>
                </div>
            ';

        }

    $nd_travel_shortcode_right_content .= '
    </div>

  </div>
';
}
/*END pagination*/