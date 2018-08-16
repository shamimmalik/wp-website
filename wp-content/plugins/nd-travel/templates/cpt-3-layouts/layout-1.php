<?php

$nd_travel_destination_id = get_the_ID();
$nd_travel_destination_title = get_the_title();
$nd_travel_number_packages = 0;

//get header image info
$nd_travel_meta_box_image_position = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image_cpt_3_position', true );
$nd_travel_meta_box_image = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image_cpt_3', true );

//basic info
$nd_travel_meta_box_cpt_3_color = get_post_meta( get_the_ID(), 'nd_travel_meta_box_color_cpt_3', true );
$nd_travel_meta_box_parent_destination = get_post_meta( get_the_ID(), 'nd_travel_meta_box_parent_destination', true );

//info box
$nd_travel_meta_box_country_title_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_country_title_cpt_3', true );
$nd_travel_meta_box_country_descr_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_country_descr_cpt_3', true );
$nd_travel_meta_box_contact_title_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_contact_title_cpt_3', true );
$nd_travel_meta_box_contact_descr_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_contact_descr_cpt_3', true );


if ( $nd_travel_meta_box_image != '' ) {	


	$nd_travel_result .= '

	<div id="nd_travel_single_cpt_3_header_image" class="nd_travel_section nd_travel_background_size_cover '.$nd_travel_meta_box_image_position.' " style="background-image:url('.$nd_travel_meta_box_image.');">

        <div class="nd_travel_section nd_travel_bg_greydark_alpha_2">';

            if ( nd_travel_get_container() != 1) {  $nd_travel_result .= '<div class="nd_travel_container nd_travel_box_sizing_border_box nd_travel_clearfix">'; }

            	$nd_travel_result .= '
                <div id="nd_travel_single_cpt_3_header_image_space_top" class="nd_travel_section nd_travel_height_110"></div>

                <div class="nd_options_section nd_options_padding_15 nd_options_box_sizing_border_box nd_options_text_align_center">

                    <h1 class="nd_options_color_white nd_options_font_weight_normal nd_options_first_font">
	            		<span class="nd_options_display_block">'.get_the_title().'</span>
						<div class="nd_options_section"><span class="nd_options_bg_white nd_options_width_80 nd_options_height_4 nd_options_display_inline_block"></span></div>
                    </h1>

                </div>

               	
                <div id="nd_travel_single_cpt_3_header_image_space_bottom" class="nd_travel_section nd_travel_height_110"></div>

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
			
			$nd_travel_cpt_3_packages_section = '';
			$nd_travel_cpt_3_country_section = '';
			$nd_travel_cpt_3_contact_section = '';


			//get number packages number
			$nd_travel_number_packages = $nd_travel_number_packages + nd_travel_get_number_posts('nd_travel_cpt_1','nd_travel_meta_box_destinations',$nd_travel_destination_id);


			//check if the destination selected has some children destinations
			if ( count(nd_travel_get_destinations_with_parent($nd_travel_destination_id)) != 0 ){

				$nd_travel_children_destinations_array = nd_travel_get_destinations_with_parent($nd_travel_destination_id);

				foreach ($nd_travel_children_destinations_array as $nd_travel_children_destination_id) {
				    
				  //get parent id of children dest
				  $nd_travel_parent_id_of_children_dest = get_post_meta( $nd_travel_children_destination_id, 'nd_travel_meta_box_parent_destination', true );

				  if ( $nd_travel_parent_id_of_children_dest == $nd_travel_destination_id ) {
				    $nd_travel_number_packages = $nd_travel_number_packages + nd_travel_get_number_posts('nd_travel_cpt_1','nd_travel_meta_box_destinations',$nd_travel_children_destination_id);
				  }

				}

			}


			//packages section
			$nd_travel_cpt_3_packages_section .= '

    			<div id="nd_travel_single_cpt_3_info_packages" class="nd_travel_section nd_travel_position_relative ">

			        <img style="background-color:'.$nd_travel_meta_box_cpt_3_color.';" alt="" class="nd_travel_position_absolute nd_travel_bg_greydark nd_travel_left_0 nd_travel_padding_10 nd_travel_top_0" width="25" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-planet-earth-white.png">

			        <div class="nd_travel_section nd_travel_box_sizing_border_box nd_travel_padding_left_60"> 
			            
			            <h3 class="nd_options_second_font nd_travel_font_weight_normal  nd_travel_font_size_14 nd_travel_margin_top_5">'.__('PACKAGES','nd-travel').'</h3> 
			            <p class="nd_options_second_font ">'.$nd_travel_number_packages.' '.__('Tours','nd-travel').' '.__('in','nd-travel').' '.$nd_travel_destination_title.'</p> 
			            
			        </div>

			    </div>

    		';
			
    		//country section
    		if ( $nd_travel_meta_box_country_title_cpt_3 != '' ) {

		    	$nd_travel_cpt_3_country_section .= '

	    			<div id="nd_travel_single_cpt_3_info_country" class="nd_travel_section nd_travel_position_relative nd_travel_margin_top_20">

				        <img style="background-color:'.$nd_travel_meta_box_cpt_3_color.';" alt="" class="nd_travel_position_absolute nd_travel_left_0 nd_travel_padding_10 nd_travel_top_0" width="25" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-map-location-white.svg">

				        <div class="nd_travel_section nd_travel_box_sizing_border_box nd_travel_padding_left_60"> 
				            
				            <h3 class="nd_options_second_font nd_travel_font_weight_normal  nd_travel_font_size_14 nd_travel_margin_top_5">'.$nd_travel_meta_box_country_title_cpt_3.'</h3> 
				            <p class="nd_options_second_font ">'.$nd_travel_meta_box_country_descr_cpt_3.'</p> 
				            
				        </div>

				    </div>

	    		';	

    		}

    		//contact section
    		if ( $nd_travel_meta_box_contact_title_cpt_3 != '' ) {

		    	$nd_travel_cpt_3_contact_section .= '

	    			<div id="nd_travel_single_cpt_3_info_contact" class="nd_travel_section nd_travel_position_relative nd_travel_margin_top_20">

				        <img style="background-color:'.$nd_travel_meta_box_cpt_3_color.';" alt="" class="nd_travel_position_absolute nd_travel_left_0 nd_travel_padding_10 nd_travel_top_0" width="25" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-message-white.svg">

				        <div class="nd_travel_section nd_travel_box_sizing_border_box nd_travel_padding_left_60"> 
				            
				            <h3 class="nd_options_second_font nd_travel_font_weight_normal  nd_travel_font_size_14 nd_travel_margin_top_5">'.$nd_travel_meta_box_contact_title_cpt_3.'</h3> 
				            <p class="nd_options_second_font ">'.$nd_travel_meta_box_contact_descr_cpt_3.'</p> 
				            
				        </div>

				    </div>

	    		';	

    		}


				
	    	$nd_travel_result .= '
	    	
	    	<div class="nd_travel_section nd_travel_height_50"></div>

	  		<!--START CONTENT-->
			<div class="nd_travel_width_100_percentage nd_travel_float_left">
			 
			    <div id="nd_travel_single_cpt_3_content" class="nd_travel_width_66_percentage nd_travel_width_100_percentage_responsive nd_travel_padding_15 nd_travel_float_left nd_travel_box_sizing_border_box">

			    	<p>'.$nd_travel_content.'</p>
			    	
			    </div>

			    <div id="nd_travel_single_cpt_3_info" class="nd_travel_width_33_percentage nd_travel_width_100_percentage_responsive nd_travel_padding_15 nd_travel_float_left nd_travel_box_sizing_border_box">

			    	<div class="nd_travel_section nd_travel_box_sizing_border_box nd_travel_padding_30 nd_travel_border_1_solid_grey">

			    		'.$nd_travel_cpt_3_packages_section.'
			    		'.$nd_travel_cpt_3_country_section.'
			    		'.$nd_travel_cpt_3_contact_section.'	

			    	</div>
			    	
			    </div>

			</div>

			<div id="nd_travel_single_cpt_3_all_packages" class="nd_travel_width_100_percentage nd_travel_float_left">

				<div class="nd_travel_section nd_travel_height_50"></div>

			    <h1 id="nd_travel_single_cpt_3_all_packages_title" class="nd_travel_text_align_center nd_travel_font_weight_normal">'.__('PACKAGES','nd-travel').'</h1>

			    <div class="nd_travel_section nd_travel_height_20"></div>

			    <div class="nd_travel_section  nd_travel_text_align_center nd_travel_line_height_0">
        			<span class="nd_travel_width_80 nd_travel_bg_grey_2 nd_travel_height_4 nd_travel_display_inline_block"></span>
    			</div>
			    
			    <div class="nd_travel_section nd_travel_height_30"></div>

			    '.do_shortcode('[nd_travel_packages_pg nd_travel_width="nd_travel_width_33_percentage nd_travel_float_left" nd_travel_destinations="'.$nd_travel_destination_id.'" nd_travel_image_size="large" nd_travel_qnt="-1"]').'

			</div>

			<!--END CONTENT-->

			<div class="nd_travel_section nd_travel_height_50"></div>

	    	';
	endwhile;
endif;


if ( nd_travel_get_container() != 1 ) { $nd_travel_result .= '</div>'; }