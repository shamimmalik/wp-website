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

    //price
    $nd_travel_price = '
    <a class="" href="'.$nd_travel_permalink.'">
        '.$nd_travel_currency_left_value.' <span class="'.$nd_travel_meta_box_price_classes.'">'.$nd_travel_meta_box_price.'</span> '.$nd_travel_meta_box_promotion_price.' '.$nd_travel_currency_right_value.'
    </a>'; 

    //ribbon
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
    <div style="'.$nd_travel_image.'" class=" nd_travel_packages_pg_l2_image nd_travel_float_left nd_travel_width_40_percentage nd_travel_left_0 nd_travel_top_0 nd_travel_position_absolute nd_travel_height_100_percentage nd_travel_background_size_cover nd_travel_background_position_center">       
        '.$nd_travel_price_ribbon_sale.'
    </div>';

    $nd_travel_image_content_class = 'nd_travel_width_60_percentage nd_travel_margin_left_40_percentage';

}else{ 
    $nd_travel_image_content = '';
    $nd_travel_image_content_class = 'nd_travel_width_100_percentage ';
}



$str .= '

<div id="nd_travel_packages_pg_l2_'.$nd_travel_id.'" class="nd_travel_masonry_item '.$nd_travel_width.' nd_travel_width_100_percentage_responsive">

    <div style="padding: '.$nd_travel_padding.';" class="nd_travel_section nd_travel_box_sizing_border_box">

        <div class="nd_travel_section nd_travel_border_1_solid_grey nd_travel_bg_white nd_travel_overflow_hidden nd_travel_position_relative">
            

            '.$nd_travel_image_content.'



            <div class=" nd_travel_packages_pg_middle_content nd_travel_float_left '.$nd_travel_image_content_class.'">

                <div class="nd_travel_section nd_travel_bg_white">
                    <a class="nd_travel_packages_pg_l2_title" href="'.$nd_travel_permalink.'"><h4 class="nd_options_color_grey nd_travel_border_bottom_1_solid_grey nd_travel_bg_grey nd_travel_font_weight_normal nd_travel_padding_20 nd_travel_box_sizing_border_box">'.$nd_travel_title.'</h4></a>  
                    
                    <div class="nd_travel_section nd_travel_padding_20 nd_travel_box_sizing_border_box">
                        '.$nd_travel_price.'
                    </div>
                    
                </div>

            </div>    

        </div>
       
    </div>

</div>';

endwhile;

$str .= '</div>';