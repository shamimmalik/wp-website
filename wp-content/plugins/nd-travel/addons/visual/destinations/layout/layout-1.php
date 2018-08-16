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
$nd_travel_meta_box_color = get_post_meta( get_the_ID(), 'nd_travel_meta_box_color_cpt_3', true );
if ( $nd_travel_meta_box_color == '' ){ $nd_travel_meta_box_color = '#1bbc9b'; }

//image
if ( has_post_thumbnail() ) { 

    $nd_travel_image_id = get_post_thumbnail_id( $nd_travel_id );
    $nd_travel_image_attributes = wp_get_attachment_image_src( $nd_travel_image_id, $nd_travel_image_size );

    $str .= '

    <div id="nd_travel_destinations_pg_l1_'.$nd_travel_id.'" class="nd_travel_masonry_item '.$nd_travel_width.' nd_travel_width_100_percentage_responsive">

        <div style="padding: '.$nd_travel_padding.';" class="nd_travel_section nd_travel_box_sizing_border_box">

            <div class="nd_travel_section nd_travel_border_1_solid_grey nd_travel_bg_white">
                
                <div class="nd_travel_destinations_pg_l1_image nd_travel_section nd_travel_position_relative">

                    <div class="nd_travel_position_absolute nd_travel_top_0 nd_travel_left_0 nd_travel_width_100_percentage nd_travel_text_align_center">
                        <a class="nd_travel_destinations_pg_l1_price nd_travel_display_inline_block nd_travel_text_transform_uppercase nd_travel_bg_white nd_travel_padding_10_20" href="'.$nd_travel_permalink.'">'.$nd_travel_title.'</a>
                    </div>
                
                    <img alt="" class="nd_travel_section" src="'.$nd_travel_image_attributes[0].'">

                </div>

            </div>

        </div>

    </div>';

}





endwhile;

$str .= '</div>';