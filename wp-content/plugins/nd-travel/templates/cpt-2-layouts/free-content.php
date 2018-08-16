<?php


//get header image info
$nd_travel_meta_box_image_position = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image_cpt_2_position', true );
$nd_travel_meta_box_image = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image_cpt_2', true );


if ( $nd_travel_meta_box_image != '' ) {	


	$nd_travel_result .= '
	<div id="nd_travel_single_cpt_2_header_image" class="nd_travel_section nd_travel_background_size_cover '.$nd_travel_meta_box_image_position.' " style="background-image:url('.$nd_travel_meta_box_image.');">

        <div class="nd_travel_section nd_travel_bg_greydark_alpha_2">';

            if ( nd_travel_get_container() != 1) {  $nd_travel_result .= '<div class="nd_travel_container nd_travel_box_sizing_border_box nd_travel_clearfix">'; }

            	$nd_travel_result .= '
                <div id="nd_travel_single_cpt_2_header_image_space_top" class="nd_travel_section nd_travel_height_110"></div>

                <div class="nd_options_section nd_options_padding_15 nd_options_box_sizing_border_box nd_options_text_align_center">

                    <h1 class="nd_options_color_white nd_options_font_weight_normal nd_options_first_font">
	            		<span class="nd_options_display_block">'.get_the_title().'</span>
						<div class="nd_options_section"><span class="nd_options_bg_white nd_options_width_80 nd_options_height_4 nd_options_display_inline_block"></span></div>
                    </h1>

                </div>

               	
                <div id="nd_travel_single_cpt_2_header_image_space_bottom" class="nd_travel_section nd_travel_height_110"></div>

               ';


            if ( nd_travel_get_container() != 1 ) { $nd_travel_result .= '</div>'; }


        $nd_travel_result .= '
        </div>

    </div>';

}


if ( nd_travel_get_container() != 1) {  $nd_travel_result .= '<div class="nd_travel_container nd_travel_box_sizing_border_box nd_travel_clearfix">'; }


if(have_posts()) :
	while(have_posts()) : the_post();
			
			$nd_travel_content = do_shortcode(get_the_content());
				
	    	$nd_travel_result .= '
	    	<!--START CONTENT-->
			<div class="nd_travel_width_100_percentage nd_travel_float_left">
			 
			    <div class="nd_travel_section nd_travel_padding_0_15 nd_travel_box_sizing_border_box">

			    	<p>'.$nd_travel_content.'</p>
			    	
			    </div>

			</div> 
			<!--END CONTENT-->';


  
	endwhile;
endif;


if ( nd_travel_get_container() != 1 ) { $nd_travel_result .= '</div>'; }