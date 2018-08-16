<?php


wp_enqueue_script('masonry');

$str .= '

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

      });
      //END masonry

    });

    //]]>
  </script>

';


$str .= '<div class="nd_travel_section nd_travel_masonry_content '.$nd_travel_class.' ">';

while ( $the_query->have_posts() ) : $the_query->the_post();

//default
$nd_travel_title = get_the_title();
$nd_travel_id = get_the_ID();
$nd_travel_permalink = get_permalink( $nd_travel_id );

//datas
$nd_travel_meta_box_color = get_post_meta( get_the_ID(), 'nd_travel_meta_box_color', true );
if ( $nd_travel_meta_box_color == '' ){ $nd_travel_meta_box_color = '#1bbc9b'; }
$nd_travel_meta_box_text_preview = get_post_meta( get_the_ID(), 'nd_travel_meta_box_text_preview', true );


//get price and sale
$nd_travel_meta_box_price = get_post_meta( get_the_ID(), 'nd_travel_meta_box_price', true );
$nd_travel_meta_box_promotion_price = get_post_meta( get_the_ID(), 'nd_travel_meta_box_promotion_price', true );
if ( $nd_travel_meta_box_promotion_price != '' ) { 
    $nd_travel_meta_box_price_classes = 'nd_travel_text_decoration_line_through nd_travel_font_size_20'; 
}else{ 
    $nd_travel_meta_box_price_classes = ''; 
    $nd_travel_price_sale = '';
}

if ( $nd_travel_meta_box_price == '' ) { 
    $nd_travel_price = ''; 
    $nd_travel_price_responsive = ''; 
    $nd_travel_price_ribbon_sale = '';
} else { 

    //currency position
    $nd_travel_currency_position = get_option('nd_travel_currency_position');
    if ( $nd_travel_currency_position == 0 ) {
        $nd_travel_currency_right_value = '<span class="nd_travel_font_size_20">'.nd_travel_get_currency().'</span>';
        $nd_travel_currency_left_value = '';
    }else{
        $nd_travel_currency_left_value = '<span class="nd_travel_font_size_20">'.nd_travel_get_currency().'</span>';
        $nd_travel_currency_right_value = '';
    }

    $nd_travel_price = '
    <a class="nd_travel_packages_pg_l2_price nd_options_color_white nd_travel_font_size_30" href="'.$nd_travel_permalink.'">
        '.$nd_travel_currency_left_value.' <span class="'.$nd_travel_meta_box_price_classes.'">'.$nd_travel_meta_box_price.'</span> '.$nd_travel_meta_box_promotion_price.' '.$nd_travel_currency_right_value.'
    </a>
    <div class="nd_travel_section nd_travel_height_20"></div>
    '; 

    $nd_travel_price_responsive = '
    <div class="nd_travel_section nd_travel_height_20"></div>
    <a style="background-color:'.$nd_travel_meta_box_color.'" class="nd_travel_packages_pg_l2_responsive_price nd_travel_font_size_20 nd_travel_float_left nd_travel_padding_10_20 nd_options_color_white" href="'.$nd_travel_permalink.'">
        '.$nd_travel_currency_left_value.' <span class="'.$nd_travel_meta_box_price_classes.'">'.$nd_travel_meta_box_price.'</span> '.$nd_travel_meta_box_promotion_price.' '.$nd_travel_currency_right_value.'
    </a>
    '; 

    if ( $nd_travel_meta_box_promotion_price != '' ) { 
        $nd_travel_price_ribbon_sale = '<a class="nd_travel_width_200 nd_travel_text_align_center nd_travel_transform_rotate_45_negative nd_travel_position_absolute nd_travel_top_15 nd_travel_left_70_negative nd_travel_bg_greydark nd_options_color_white " href="'.$nd_travel_permalink.'">'.__('SALE','nd-travel').'</a>';
    }else{ 
        $nd_travel_price_ribbon_sale = '';
    }
}


//image
if ( has_post_thumbnail() ) { 

    $nd_travel_image_id = get_post_thumbnail_id( $nd_travel_id );
    $nd_travel_image_attributes = wp_get_attachment_image_src( $nd_travel_image_id, $nd_travel_image_size );

    $nd_travel_image = 'background-image:url('.$nd_travel_image_attributes[0].')';

    $nd_travel_image_content = '
    <div style="'.$nd_travel_image.'" class=" nd_travel_packages_pg_l2_image nd_travel_float_left nd_travel_width_30_percentage nd_travel_left_0 nd_travel_top_0 nd_travel_position_absolute nd_travel_height_100_percentage nd_travel_background_size_cover nd_travel_background_position_center">       
        '.$nd_travel_price_sale.'
        '.$nd_travel_price_ribbon_sale.'
    </div>';

    $nd_travel_image_responsive_content = '<img class="nd_travel_section" alt="" src="'.$nd_travel_image_attributes[0].'">';

    $nd_travel_image_content_class = 'nd_travel_width_50_percentage nd_travel_margin_left_30_percentage';

}else{ 
    $nd_travel_image_content = '';
    $nd_travel_image_responsive_content = '';
    $nd_travel_image_content_class = 'nd_travel_width_80_percentage ';
}



$str .= '


<!--responsive-->
<div id="nd_travel_packages_pg_l2_responsive_'.$nd_travel_id.'" class="nd_travel_masonry_item '.$nd_travel_width.' nd_travel_width_100_percentage_responsive nd_travel_display_none nd_travel_display_block_responsive">
    <div class="nd_travel_section nd_travel_padding_15 nd_travel_box_sizing_border_box">
        
        '.$nd_travel_image_responsive_content.'

        <div class="nd_travel_section nd_travel_border_1_solid_grey nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_bg_white nd_travel_overflow_hidden nd_travel_position_relative">

            <a class="nd_travel_packages_pg_l2_responsive_title" href="'.$nd_travel_permalink.'">
                <h3 class="nd_travel_font_weight_normal nd_travel_box_sizing_border_box">'.$nd_travel_title.'</h3>
            </a> 

            <div class="nd_travel_section nd_travel_height_20"></div>

            <p class="nd_travel_packages_pg_l2_responsive_text_preview">'.$nd_travel_meta_box_text_preview.'</p>

            '.$nd_travel_price_responsive.'

        </div>

    </div>
</div>
<!--responsive-->
    


<div id="nd_travel_packages_pg_l2_'.$nd_travel_id.'" class="nd_travel_masonry_item '.$nd_travel_width.' nd_travel_width_100_percentage_responsive nd_travel_display_none_responsive">

    <div class="nd_travel_section nd_travel_padding_15 nd_travel_box_sizing_border_box">

        <div class="nd_travel_section nd_travel_border_1_solid_grey nd_travel_bg_white nd_travel_overflow_hidden nd_travel_position_relative">
            

            '.$nd_travel_image_content.'



            <div class=" nd_travel_packages_pg_middle_content nd_travel_float_left '.$nd_travel_image_content_class.'">

                <div class="nd_travel_section nd_travel_bg_white nd_travel_min_height_150">
                    <a class="nd_travel_packages_pg_l2_title" href="'.$nd_travel_permalink.'"><h4 class="nd_options_color_grey nd_travel_border_bottom_1_solid_grey nd_travel_bg_grey nd_travel_font_weight_normal nd_travel_padding_20 nd_travel_box_sizing_border_box">'.$nd_travel_title.'</h4></a>  
                    
                    <div class="nd_travel_section nd_travel_padding_20 nd_travel_box_sizing_border_box">
                        <p class="nd_travel_packages_pg_l2_text_preview">'.$nd_travel_meta_box_text_preview.'</p>
                    </div>';



                    //get typologies icons
                    $nd_travel_meta_box_typologies = get_post_meta( $nd_travel_id, 'nd_travel_meta_box_typologies', true );

                    if ( $nd_travel_meta_box_typologies != '' ){

                        $nd_travel_meta_box_typologies_array = explode(',',$nd_travel_meta_box_typologies);

                        $nd_travel_number_typologies = count($nd_travel_meta_box_typologies_array)-1;

                        $str .= '<div class="nd_travel_packages_pg_l2_typologies_list_icons nd_travel_section nd_travel_padding_bottom_20 nd_travel_padding_left_20 nd_travel_padding_right_20 nd_travel_box_sizing_border_box">';

                        for ($nd_travel_typology_i = 0; $nd_travel_typology_i <= $nd_travel_number_typologies-1; ++$nd_travel_typology_i) {

                            $nd_travel_page_by_path_2 = get_page_by_path($nd_travel_meta_box_typologies_array[$nd_travel_typology_i],OBJECT,'nd_travel_cpt_2');
                            $nd_travel_typology_id = $nd_travel_page_by_path_2->ID;
                            $nd_travel_typology_title = get_the_title($nd_travel_typology_id);
                            $nd_travel_typology_permalink = get_permalink( $nd_travel_typology_id );
                            $nd_travel_meta_box_cpt_2_icon = get_post_meta( $nd_travel_typology_id, 'nd_travel_meta_box_cpt_2_icon', true );
                            
                            if ( $nd_travel_meta_box_cpt_2_icon != '' ) {

                                $str .= '
                                <div class="nd_travel_float_left nd_travel_packages_pg_l2_typology_icon nd_travel_position_relative nd_travel_padding_right_20 nd_travel_padding_left_20 nd_travel_border_right_1_solid_grey_2">
                                    
                                    <a class="nd_travel_float_left " href="'.$nd_travel_typology_permalink.'">
                                        <img class="nd_travel_float_left" alt="" width="25" src="'.$nd_travel_meta_box_cpt_2_icon.'">
                                    </a>

                                    <div class="nd_travel_typology_icon_dropdown nd_travel_position_absolute nd_travel_display_none nd_travel_top_35_negative nd_travel_left_0  ">
                        
                                        <div class="nd_travel_bg_white nd_travel_border_1_solid_grey nd_travel_border_1_solid_grey_important">
                                            <p class="nd_travel_padding_3_10 nd_travel_line_height_16 nd_travel_font_size_11">'.$nd_travel_typology_title.'</p>
                                        </div>
                                        
                                    </div>

                                </div>

                                ';
                            }

                        }

                        $str .= '</div>'; 

                     }


                $str .= '     
                </div>

            </div>



            <div style="background-color:'.$nd_travel_meta_box_color.'" class=" nd_travel_packages_pg_l2_right_content nd_travel_float_left nd_travel_width_20_percentage nd_travel_top_0 nd_travel_right_0 nd_travel_text_align_center nd_travel_height_100_percentage nd_travel_position_absolute nd_travel_padding_0_30 nd_travel_box_sizing_border_box">

                <div class="nd_travel_section nd_travel_display_table nd_travel_height_100_percentage">

                    <div class="nd_travel_section nd_travel_display_table_cell nd_travel_vertical_align_middle nd_travel_float_initial">
                        <div class="nd_travel_section">
                            '.$nd_travel_price.'
                        </div>

                        <div class="nd_travel_section">
                            <a href="'.$nd_travel_permalink.'" class="nd_travel_packages_pg_l2_button nd_options_color_white nd_travel_border_1_solid_white nd_travel_padding_10_20 nd_options_second_font_important nd_travel_border_radius_0_important nd_travel_line_height_20 nd_travel_background_color_transparent_important nd_travel_cursor_pointer nd_travel_display_inline_block">'.__('DETAILS','nd-travel').'</a>
                        </div>
                    </div>

                </div>

            </div>


                

        </div>
       
    </div>

</div>';

endwhile;

$str .= '</div>';