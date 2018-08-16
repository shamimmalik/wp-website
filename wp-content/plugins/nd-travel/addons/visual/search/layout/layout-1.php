<?php



$nd_travel_str .= '

    <div id="nd_travel_search_component_id_'.$nd_travel_search_component_id.'" class="nd_travel_section '.$nd_travel_class.' ">

        <!--START FORM-->
        <form action="'.$nd_travel_action.'" method="get">

        	

        	<div style="padding:'.$nd_travel_fields_padding.';" id="nd_travel_search_components_keyword" class=" '.$nd_travel_width.' nd_travel_float_left nd_travel_width_100_percentage_responsive nd_travel_box_sizing_border_box">
        		<input id="nd_travel_vc_search_l1_keyword" name="nd_travel_archive_form_keyword" placeholder="'.__('Insert keyword','nd-travel').'" value="" class=" '.$nd_travel_field_class.' nd_travel_section" type="text">
        	</div>';

            
			//get all destinations
			$nd_travel_destinations_args = array( 
				'posts_per_page' => -1, 
				'post_type'=> 'nd_travel_cpt_3'
			);
			$nd_travel_destinations_query = new WP_Query( $nd_travel_destinations_args );

			$nd_travel_destinations_query_i = 0;

			$nd_travel_str .= '
			<div style="padding:'.$nd_travel_fields_padding.';" id="nd_travel_search_components_destinations" class="'.$nd_travel_width.' nd_travel_float_left nd_travel_width_100_percentage_responsive nd_travel_box_sizing_border_box">
				<select class="nd_travel_section '.$nd_travel_field_class.' " name="nd_travel_archive_form_destinations">';

				while ( $nd_travel_destinations_query->have_posts() ) : $nd_travel_destinations_query->the_post();

					$nd_travel_destination_id = get_the_ID();

					if ( $nd_travel_destinations_query_i == 0 ) { $nd_travel_str .= '<option value="0">'.__('All Destinations','nd-travel').'</option>'; }

					//not insert if parent is setted
					$nd_travel_meta_box_parent_destination = get_post_meta( get_the_ID(), 'nd_travel_meta_box_parent_destination', true );
					if ( $nd_travel_meta_box_parent_destination != 0 ) {
						$nd_travel_str .= '';
					}else{


						$nd_travel_str .= '<option value="'.$nd_travel_destination_id.'">'.get_the_title().'</option>';

						//check if the destination selected has some children destinations
						if ( count(nd_travel_get_destinations_with_parent($nd_travel_destination_id)) != 0 ){

							$nd_travel_children_destinations_array = nd_travel_get_destinations_with_parent($nd_travel_destination_id);

							foreach ($nd_travel_children_destinations_array as $nd_travel_children_destination_id) {
							    
								//get parent id of children dest
								$nd_travel_parent_id_of_children_dest = get_post_meta( $nd_travel_children_destination_id, 'nd_travel_meta_box_parent_destination', true );

								if ( $nd_travel_parent_id_of_children_dest == $nd_travel_destination_id ) {
									$nd_travel_str .= '<option value="'.$nd_travel_children_destination_id.'">&nbsp;&nbsp;- '.get_the_title($nd_travel_children_destination_id).'</option>';	
								}

							}

						}


					}

					$nd_travel_destinations_query_i = $nd_travel_destinations_query_i + 1;

				endwhile; 

				wp_reset_postdata();
				
				$nd_travel_str .= ' 
				</select>

			</div>';
			/*END destinations*/





			//get all typlogies
			$nd_travel_typlogies_args = array( 
				'posts_per_page' => -1, 
				'post_type'=> 'nd_travel_cpt_2'
			);
			$nd_travel_typlogies_query = new WP_Query( $nd_travel_typlogies_args );

			$nd_travel_typlogies_query_i = 0;

			$nd_travel_str .= '
			<div style="padding:'.$nd_travel_fields_padding.';" id="nd_travel_search_components_typlogies" class=" '.$nd_travel_width.' nd_travel_float_left nd_travel_width_100_percentage_responsive nd_travel_box_sizing_border_box">
				<select class="nd_travel_section '.$nd_travel_field_class.' " name="nd_travel_typology_slug">';

				while ( $nd_travel_typlogies_query->have_posts() ) : $nd_travel_typlogies_query->the_post();

					if ( $nd_travel_typlogies_query_i == 0 ) { $nd_travel_str .= '<option value="">'.__('All Typologies','nd-travel').'</option>'; }
					$nd_travel_str .= '<option value="'.get_the_ID().'">'.get_the_title().'</option>';
					$nd_travel_typlogies_query_i = $nd_travel_typlogies_query_i + 1;

				endwhile; 

				wp_reset_postdata();
				
				$nd_travel_str .= ' 
				</select>

			</div>';
			/*END typlogies*/

            


            //get all taxonmies
		    $nd_travel_taxonomies = get_object_taxonomies('nd_travel_cpt_1');
		    
		    //call the functions for each tax
		    $nd_travel_i = 0;
		    foreach($nd_travel_taxonomies as $nd_travel_tax){

		      $nd_travel_str .= nd_travel_build_select($nd_travel_tax,$nd_travel_i,$nd_travel_width,$nd_travel_fields_padding,$nd_travel_field_class);
		      $nd_travel_i = $nd_travel_i + 1;

		    }
		    /*END taxonmies*/



    		$nd_travel_str .= '
    		<div style="padding:'.$nd_travel_fields_padding.';" id="nd_travel_search_components_submit" class=" '.$nd_travel_submit_width.' nd_travel_float_left nd_travel_width_100_percentage_responsive nd_travel_box_sizing_border_box">
            	<input style="padding: '.$nd_travel_submit_padding.'; background-color:'.$nd_travel_submit_bg.';" class="nd_options_color_white nd_options_second_font_important nd_travel_width_100_percentage " type="submit" value="'.__('SEARCH','nd-travel').'">
            </div>

        </form>
        <!--END FORM-->

    </div>


';