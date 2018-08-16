<?php


//get datas
$nd_travel_meta_box_color = get_post_meta( get_the_ID(), 'nd_travel_meta_box_color', true );
if ( $nd_travel_meta_box_color == '' ){ $nd_travel_meta_box_color = '#1bbc9b'; }


//decide sidebar or not
$nd_travel_meta_box_page_sidebar = get_post_meta( get_the_ID(), 'nd_travel_meta_box_page_sidebar', true );

if ( $nd_travel_meta_box_page_sidebar == 'nd_travel_meta_box_page_layout_full_width' ) {
	$nd_travel_single_cpt_1_content_width = 'nd_travel_width_100_percentage';
}else{
	$nd_travel_single_cpt_1_content_width = 'nd_travel_width_66_percentage';
}


//get price
$nd_travel_meta_box_price = get_post_meta( get_the_ID(), 'nd_travel_meta_box_price', true );
$nd_travel_meta_box_promotion_price = get_post_meta( get_the_ID(), 'nd_travel_meta_box_promotion_price', true );
if ( $nd_travel_meta_box_promotion_price != '' ) { $nd_travel_meta_box_price_classes = 'nd_travel_font_size_20 nd_travel_text_decoration_line_through'; }else{ $nd_travel_meta_box_price_classes = ''; }


//START HEADER IMAGE
$nd_travel_meta_box_image = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image', true );

if ( $nd_travel_meta_box_image != '' ) {

	$nd_travel_meta_box_image_position = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image_position', true );	

	$nd_travel_result .= '
	<div id="nd_travel_single_cpt_1_header_image" class="nd_travel_section nd_travel_background_size_cover '.$nd_travel_meta_box_image_position.' " style="background-image:url('.$nd_travel_meta_box_image.');">

        <div class="nd_travel_section nd_travel_bg_greydark_alpha_3">';

            if ( nd_travel_get_container() != 1) {  $nd_travel_result .= '<div class="nd_travel_container nd_travel_box_sizing_border_box nd_travel_clearfix">'; }

            	$nd_travel_result .= '
            	<div class="nd_travel_section nd_travel_box_sizing_border_box nd_travel_padding_0_15">
            		
            		<div id="nd_travel_single_cpt_1_header_image_space_top" class="nd_travel_section nd_travel_height_140"></div>
	            	<h1 class="nd_options_color_white nd_travel_font_weight_normal nd_travel_text_align_center">'.get_the_title(get_the_ID()).'</h1>
	            	<div class="nd_travel_section nd_travel_height_20"></div>
	            	<div class="nd_travel_section nd_travel_text_align_center nd_travel_line_height_0"><span class="nd_travel_bg_white nd_travel_width_80 nd_travel_height_4 nd_travel_display_inline_block"></span></div>
	            	<div id="nd_travel_single_cpt_1_header_image_space_bottom" class="nd_travel_section nd_travel_height_200"></div>
            	
            	</div>
            	';

            if ( nd_travel_get_container() != 1 ) { $nd_travel_result .= '</div>'; }

        $nd_travel_result .= '
        </div>

    </div>';

}
//END HEADER IMAGE






//START INFO PACKAGE
if ( $nd_travel_meta_box_image == '' ) {
	$nd_travel_info_pack_class = 'nd_travel_margin_top_60';
}else{
	$nd_travel_info_pack_class = 'nd_travel_margin_top_60_negative';
}
$nd_travel_result .= '
<div class="nd_travel_single_cpt_1_info_l1 nd_travel_section '.$nd_travel_info_pack_class.' ">';

	if ( nd_travel_get_container() != 1) {  $nd_travel_result .= '<div class="nd_travel_container nd_travel_box_sizing_border_box nd_travel_clearfix">'; }


	$nd_travel_result .= '
	<div class="nd_travel_section nd_travel_box_sizing_border_box nd_travel_padding_0_15">

		<div class="nd_travel_section nd_travel_bg_grey nd_travel_overflow_hidden nd_travel_border_1_solid_grey nd_travel_box_sizing_border_box nd_travel_padding_10">';



			//get destination
			$nd_travel_meta_box_destinations = get_post_meta( get_the_ID(), 'nd_travel_meta_box_destinations', true );

			//get info destination
			$nd_travel_destination_id = $nd_travel_meta_box_destinations;
			$nd_travel_destination_title = get_the_title($nd_travel_destination_id);
			$nd_travel_meta_box_text_preview_cpt_3 = get_post_meta( $nd_travel_destination_id, 'nd_travel_meta_box_text_preview_cpt_3', true );

			
			$nd_travel_result .= '
			<div class="nd_travel_width_33_percentage nd_travel_width_100_percentage_responsive nd_travel_float_left nd_travel_padding_10 nd_travel_position_relative nd_travel_box_sizing_border_box">
			
				<div style="background-color:'.$nd_travel_meta_box_color.'" class=" nd_travel_padding_25 nd_travel_position_absolute nd_travel_top_10 nd_travel_left_10">
					<img alt="" width="30" height="30" class="nd_travel_float_left" src="'.plugins_url().'/nd-travel/assets/img/icons/travel/icon-destination.png">
				</div>

				<div class="nd_travel_section nd_travel_padding_left_100 nd_travel_min_height_80 nd_travel_box_sizing_border_box">
					<h4 class="nd_travel_font_weight_normal">'.$nd_travel_destination_title.'</h4>
					<div class="nd_travel_section nd_travel_height_15"></div>
					<p>'.$nd_travel_meta_box_text_preview_cpt_3.'</p>
				</div>

			</div>';




			//get first typology
			$nd_travel_meta_box_typologies = get_post_meta( get_the_ID(), 'nd_travel_meta_box_typologies', true );
			$nd_travel_meta_box_typologies_array = explode(',',$nd_travel_meta_box_typologies);
			$nd_travel_page_by_path_2 = get_page_by_path($nd_travel_meta_box_typologies_array[0],OBJECT,'nd_travel_cpt_2');

			//get info typology
			$nd_travel_typology_id = $nd_travel_page_by_path_2->ID;
			$nd_travel_typology_title = get_the_title($nd_travel_typology_id);
			$nd_travel_meta_box_cpt_2_text_preview = get_post_meta( $nd_travel_typology_id, 'nd_travel_meta_box_cpt_2_text_preview', true );

			$nd_travel_result .= '
			<div class="nd_travel_width_33_percentage nd_travel_width_100_percentage_responsive nd_travel_float_left nd_travel_padding_10 nd_travel_position_relative nd_travel_box_sizing_border_box">
			
				<div style="background-color:'.$nd_travel_meta_box_color.'" class=" nd_travel_padding_25 nd_travel_position_absolute nd_travel_top_10 nd_travel_left_10">
					<img alt="" width="30" height="30" class="nd_travel_float_left" src="'.plugins_url().'/nd-travel/assets/img/icons/travel/icon-typology.png">
				</div>

				<div class="nd_travel_section nd_travel_padding_left_100 nd_travel_min_height_80 nd_travel_box_sizing_border_box">
					<h4 class="nd_travel_font_weight_normal">'.$nd_travel_typology_title.'</h4>
					<div class="nd_travel_section nd_travel_height_15"></div>
					<p>'.$nd_travel_meta_box_cpt_2_text_preview.'</p>
				</div>

			</div>';


			//get price
			$nd_travel_meta_box_price = get_post_meta( get_the_ID(), 'nd_travel_meta_box_price', true );
			$nd_travel_meta_box_promotion_price = get_post_meta( get_the_ID(), 'nd_travel_meta_box_promotion_price', true );
			if ( $nd_travel_meta_box_promotion_price != '' ) { $nd_travel_meta_box_price_classes = 'nd_travel_text_decoration_line_through nd_travel_font_size_20'; }else{ $nd_travel_meta_box_price_classes = ''; }

			if ( $nd_travel_meta_box_price == '' ) { 
			    $nd_travel_price = ''; 
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

			    $nd_travel_price = $nd_travel_currency_left_value.' <span class="'.$nd_travel_meta_box_price_classes.'">'.$nd_travel_meta_box_price.'</span> '.$nd_travel_meta_box_promotion_price.' '.$nd_travel_currency_right_value; 

			    if ( $nd_travel_meta_box_promotion_price != '' ) { 
			        $nd_travel_price_ribbon_sale = '<a class="nd_travel_width_200 nd_travel_text_align_center nd_travel_transform_rotate_45 nd_travel_position_absolute nd_travel_top_20 nd_travel_right_70_negative nd_travel_bg_greydark nd_options_color_white " href="'.$nd_travel_permalink.'">'.__('SALE','nd-travel').'</a>';
			    }else{ 
			        $nd_travel_price_ribbon_sale = '';
			    }
			}


			$nd_travel_result .= '
			<div class="nd_travel_width_33_percentage nd_travel_width_100_percentage_responsive nd_travel_float_left nd_travel_padding_10 nd_travel_position_relative nd_travel_box_sizing_border_box">
			
				<div style="background-color:'.$nd_travel_meta_box_color.'" class=" nd_travel_padding_25 nd_travel_text_align_center nd_travel_overflow_hidden_responsive nd_travel_position_relative_responsive">
					<h1 class="nd_options_color_white nd_travel_font_weight_normal nd_travel_font_size_20_responsive">'.$nd_travel_price.'</h1>	
					'.$nd_travel_price_ribbon_sale.'
				</div>

			</div>
			
			

		</div>

	</div>
	';


	if ( nd_travel_get_container() != 1 ) { $nd_travel_result .= '</div>'; }

$nd_travel_result .= '
</div>
';
//END INFO PACKAGE











//START CONTENT
if(have_posts()) :
	while(have_posts()) : the_post();

		$nd_travel_content = do_shortcode(get_the_content());
	
		if ( nd_travel_get_container() != 1) {  $nd_travel_result .= '<div class="nd_travel_container nd_travel_box_sizing_border_box nd_travel_clearfix">'; }

			$nd_travel_result .= '

			<div class="nd_travel_section nd_travel_height_60"></div>';
			


			if ( $nd_travel_meta_box_page_sidebar == 'nd_travel_meta_box_page_layout_left_sidebar' ) {
				
				$nd_travel_result .= '
	    		<div class="nd_travel_float_left nd_travel_width_33_percentage nd_travel_padding_0_15 nd_travel_box_sizing_border_box nd_travel_sidebar">';

	    			echo $nd_travel_result;
		    		dynamic_sidebar("nd_travel_sidebar_cpt_1");
		    	
		    	$nd_travel_result = '
		    	</div>';

			}


			$nd_travel_result .= '
			<div class="nd_travel_float_left '.$nd_travel_single_cpt_1_content_width.' nd_travel_box_sizing_border_box nd_travel_padding_0_15 ">

				'.$nd_travel_content.'

			</div>';



			if ( $nd_travel_meta_box_page_sidebar == 'nd_travel_meta_box_page_layout_right_sidebar' ) {
				
				$nd_travel_result .= '
	    		<div class="nd_travel_float_left nd_travel_width_33_percentage nd_travel_padding_0_15 nd_travel_box_sizing_border_box nd_travel_sidebar">';

	    			echo $nd_travel_result;
		    		dynamic_sidebar("nd_travel_sidebar_cpt_1");
		    	
		    	$nd_travel_result = '
		    	</div>';

			}





	    	$nd_travel_result .= '
			<div class="nd_travel_section nd_travel_height_60"></div>
			';

		if ( nd_travel_get_container() != 1 ) { $nd_travel_result .= '</div>'; }

	endwhile;
endif;
//END CONTENT


