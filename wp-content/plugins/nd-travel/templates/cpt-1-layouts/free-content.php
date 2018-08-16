<?php


//START CONTENT
if(have_posts()) :
	while(have_posts()) : the_post();

		$nd_travel_content = do_shortcode(get_the_content());
	
		if ( nd_travel_get_container() != 1) {  $nd_travel_result .= '<div class="nd_travel_container nd_travel_box_sizing_border_box nd_travel_clearfix">'; }

			
			$nd_travel_result .= '
			<div class="nd_travel_section nd_travel_box_sizing_border_box nd_travel_padding_0_15 ">

				'.$nd_travel_content.'

			</div>';


		if ( nd_travel_get_container() != 1 ) { $nd_travel_result .= '</div>'; }

	endwhile;
endif;
//END CONTENT


