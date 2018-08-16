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


//get price
$nd_travel_meta_box_price = get_post_meta( get_the_ID(), 'nd_travel_meta_box_price', true );
$nd_travel_meta_box_promotion_price = get_post_meta( get_the_ID(), 'nd_travel_meta_box_promotion_price', true );
if ( $nd_travel_meta_box_promotion_price != '' ) { $nd_travel_meta_box_price_classes = 'nd_travel_text_decoration_line_through'; }else{ $nd_travel_meta_box_price_classes = ''; }

if ( $nd_travel_meta_box_price == '' ) { 
    $nd_travel_price = ''; 
    $nd_travel_price_ribbon_sale = '';
} else { 

    //currency position
    $nd_travel_currency_position = get_option('nd_travel_currency_position');
    if ( $nd_travel_currency_position == 0 ) {
        $nd_travel_currency_right_value = '<span class="">'.nd_travel_get_currency().'</span>';
        $nd_travel_currency_left_value = '';
    }else{
        $nd_travel_currency_left_value = '<span class="">'.nd_travel_get_currency().'</span>';
        $nd_travel_currency_right_value = '';
    }

    $nd_travel_price = '
    <a class="nd_travel_position_absolute nd_travel_top_0 nd_travel_left_0 nd_travel_bg_white nd_travel_padding_10_20" href="'.$nd_travel_permalink.'">
        '.$nd_travel_currency_left_value.' <span class="'.$nd_travel_meta_box_price_classes.'">'.$nd_travel_meta_box_price.'</span> '.$nd_travel_meta_box_promotion_price.' '.$nd_travel_currency_right_value.'
    </a>'; 

    if ( $nd_travel_meta_box_promotion_price != '' ) { 
        $nd_travel_price_ribbon_sale = '<a class="nd_travel_width_200 nd_travel_text_align_center nd_travel_transform_rotate_45 nd_travel_position_absolute nd_travel_top_20 nd_travel_right_70_negative nd_travel_bg_greydark nd_options_color_white " href="'.$nd_travel_permalink.'">'.__('SALE','nd-travel').'</a>';
    }else{ 
        $nd_travel_price_ribbon_sale = '';
    }
}


//image
if ( has_post_thumbnail() ) { 

    $nd_travel_image_id = get_post_thumbnail_id( $nd_travel_id );
    $nd_travel_image_attributes = wp_get_attachment_image_src( $nd_travel_image_id, $nd_travel_image_size );

    $nd_travel_image = '

        <div class="nd_travel_packages_pg_l1_image nd_travel_overflow_hidden nd_travel_section nd_travel_position_relative">

            '.$nd_travel_price.'

            '.$nd_travel_price_ribbon_sale.'
            
            <img alt="" class="nd_travel_section" src="'.$nd_travel_image_attributes[0].'">

        </div>


    ';
}else{ 
    $nd_travel_image = '';
}




$str .= '

<div id="nd_travel_packages_pg_l1_'.$nd_travel_id.'" class="nd_travel_masonry_item '.$nd_travel_width.' nd_travel_width_100_percentage_responsive">

    <div class="nd_travel_section nd_travel_padding_15 nd_travel_box_sizing_border_box">

        <div class="nd_travel_section nd_travel_border_1_solid_grey nd_travel_bg_white">
            
            '.$nd_travel_image.'

            <div class="nd_travel_section">
                <a class="nd_travel_packages_pg_l1_title" href="'.$nd_travel_permalink.'"><h3 class="nd_options_color_white nd_travel_bg_greydark nd_travel_font_weight_normal nd_travel_padding_20 nd_travel_box_sizing_border_box">'.$nd_travel_title.'</h3></a>
            </div>';


            //get destination
            $nd_travel_meta_box_destinations = get_post_meta( get_the_ID(), 'nd_travel_meta_box_destinations', true );

            if ( $nd_travel_meta_box_destinations == '' ) {
                $nd_travel_destination = '';
            }else{

                $nd_travel_destination_title = get_the_title($nd_travel_meta_box_destinations);
                $nd_travel_destination_permalink = get_permalink( $nd_travel_meta_box_destinations );

                $nd_travel_destination = '
                <div class="nd_travel_packages_pg_l1_destination nd_travel_float_left nd_travel_width_50_percentage nd_travel_padding_5_20 nd_travel_box_sizing_border_box">
                    <a href="'.$nd_travel_destination_permalink.'"><p class="nd_options_color_white">'.$nd_travel_destination_title.'</p></a>
                </div>
                ';
            }

            
            //get first typology
            $nd_travel_meta_box_typologies = get_post_meta( get_the_ID(), 'nd_travel_meta_box_typologies', true );

            if ( $nd_travel_meta_box_typologies == '' ) {
                $nd_travel_typology = '';
            }else{

                $nd_travel_meta_box_typologies_array = explode(',',$nd_travel_meta_box_typologies);

                $nd_travel_number_typologies = count($nd_travel_meta_box_typologies_array)-1;

                if ( $nd_travel_number_typologies > 1 ) {
                
                    $nd_travel_all_typologies = '';

                    for ($mul = 1; $mul <= $nd_travel_number_typologies-1; ++$mul) {

                        $nd_travel_page_by_path_2 = get_page_by_path($nd_travel_meta_box_typologies_array[$mul],OBJECT,'nd_travel_cpt_2');
                        $nd_travel_typology_id = $nd_travel_page_by_path_2->ID;
                        $nd_travel_typology_title = get_the_title($nd_travel_typology_id);
                        $nd_travel_typology_permalink = get_permalink( $nd_travel_typology_id );

                        $nd_travel_all_typologies .= '<a class="nd_travel_display_block nd_travel_padding_5_12" href="'.$nd_travel_typology_permalink.'"><p class="nd_travel_line_height_16 nd_travel_font_size_11">'.$nd_travel_typology_title.'</p></a>';
                    }

                    $nd_travel_all_typologies_container = '
                    <div class="nd_travel_typologies_dropdown nd_travel_position_absolute nd_travel_display_none nd_travel_top_20 nd_travel_right_0  ">
                        
                        <div class="nd_travel_triangle_typologies"></div>    

                        <div class="nd_travel_bg_white nd_travel_border_1_solid_grey nd_travel_border_top_width_0_important">
                            '.$nd_travel_all_typologies.'
                        </div>
                        
                    </div>';

                    //plus number count other typologyes and dotted
                    $nd_travel_number_typologies_display = '
                    <span style="background-color:'.$nd_travel_meta_box_color.'" class="nd_travel_typologies_count nd_travel_position_absolute nd_travel_padding_4_8 nd_travel_line_height_14 nd_travel_right_0 nd_travel_right_10_negative_all_iphone nd_travel_top_3 nd_travel_top_17_negative_all_iphone">
                        + '.($nd_travel_number_typologies-1).'
                        '.$nd_travel_all_typologies_container.'
                    </span>';
                    $nd_travel_other_typologies_dotted = '...';

                }else{
                    $nd_travel_number_typologies_display = '';
                    $nd_travel_other_typologies_dotted = '';
                    $nd_travel_all_typologies_container = '';
                }

                $nd_travel_page_by_path_2 = get_page_by_path($nd_travel_meta_box_typologies_array[0],OBJECT,'nd_travel_cpt_2');
                $nd_travel_typology_id = $nd_travel_page_by_path_2->ID;
                $nd_travel_typology_title = get_the_title($nd_travel_typology_id);
                $nd_travel_typology_permalink = get_permalink( $nd_travel_typology_id );

                $nd_travel_typology = '
                <div class="nd_travel_position_relative nd_travel_packages_pg_l1_typology nd_travel_float_left nd_travel_width_50_percentage nd_travel_padding_5_20 nd_travel_box_sizing_border_box nd_travel_bg_white_alpha_10">
                    <span class="nd_options_color_white nd_travel_position_relative nd_travel_section">
                        <a class="nd_options_color_white" href="'.$nd_travel_typology_permalink.'">'.$nd_travel_typology_title.'</a> '.$nd_travel_other_typologies_dotted.' '.$nd_travel_number_typologies_display .'
                    </span>
                </div> 
                ';
            }


            


            $str .= '
            <div style="background-color:'.$nd_travel_meta_box_color.'" class="nd_travel_section">
                '.$nd_travel_destination.' 
                '.$nd_travel_typology.' 
            </div>
            ';

            $str .= '
            <div class="nd_travel_section nd_travel_padding_20 nd_travel_box_sizing_border_box">

                <p class="nd_travel_packages_pg_l1_text_preview">'.$nd_travel_meta_box_text_preview.'</p>
                <div class="nd_travel_section nd_travel_height_20"></div>
                <a href="'.$nd_travel_permalink.'" class="nd_travel_packages_pg_l1_button nd_travel_border_1_solid_grey nd_travel_padding_10_20 nd_options_second_font_important nd_travel_border_radius_0_important nd_travel_background_color_transparent_important nd_travel_cursor_pointer nd_travel_display_inline_block">'.__('DETAILS','nd-travel').'</a>

            </div>
        </div>

    </div>

</div>';

endwhile;

$str .= '</div>';