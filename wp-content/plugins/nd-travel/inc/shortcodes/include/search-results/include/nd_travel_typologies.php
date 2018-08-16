<?php


$nd_travel_shortcode_left_content .= '

<!--START typologyes-->
		<div class=" '.$nd_travel_typologies_class.' nd_travel_width_100_percentage nd_travel_float_left nd_travel_box_sizing_border_box">




			<div class="nd_travel_section nd_travel_position_relative nd_travel_padding_30 nd_travel_padding_30_15_all_iphone nd_travel_box_sizing_border_box">

		        <div class="nd_travel_section">
		            <h3 class="nd_travel_float_left nd_travel_font_weight_normal nd_travel_font_size_16">'.__('Typologies','nd-travel').' :</h3> 
		            <div class="nd_travel_section nd_travel_height_20"></div>
		          </div>

    ';

		    
		    /*START typologys query*/
		    $nd_travel_typologys_args = array( 
		        'posts_per_page' => -1, 
		        'post_type'=> 'nd_travel_cpt_2'
		    );
		    $nd_travel_typologys_query = new WP_Query( $nd_travel_typologys_args );

		    while ( $nd_travel_typologys_query->have_posts() ) : $nd_travel_typologys_query->the_post();

		        $nd_travel_shortcode_left_content .= '
		        <p class="nd_travel_width_50_percentage nd_travel_width_100_percentage_all_iphone nd_travel_float_left nd_travel_margin_0">
		          <input class="nd_travel_checkbox_typology nd_travel_width_25 nd_travel_margin_0 nd_travel_padding_0 nd_travel_margin_top_8" name="nd_travel_typology_id_'.get_the_ID().'" '; if( $nd_travel_typology_idd == get_the_ID() ){ $nd_travel_shortcode_left_content .='checked'; } $nd_travel_shortcode_left_content .=' type="checkbox" value="'.get_the_ID().',">
		            '.get_the_title().'
		        </p>';

		    endwhile; 
		    wp_reset_postdata();
		    /*END typologys query*/



			$nd_travel_shortcode_left_content .= '
		    <input type="hidden" id="nd_travel_archive_form_typologys" name="nd_travel_archive_form_typologys" value="'.$nd_travel_typology_idd_value.'">


		    <script type="text/javascript">
		      //<![CDATA[
		      jQuery(document).ready(function() {

		        jQuery( function ( $ ) {

		            $( ".nd_travel_checkbox_typology" ).change(function() {

		                if ( $( this ).is( ":checked" ) ) {

		                    var nd_travel_typology_value = $( this ).val();
		                    var nd_travel_typology_previous_value = $("#nd_travel_archive_form_typologys").val();
		                    $( "#nd_travel_archive_form_typologys" ).val( nd_travel_typology_value+nd_travel_typology_previous_value );

		                    nd_travel_sorting(1);

		                }else{

		                    var nd_travel_typology_value = $( this ).val();
		                    var nd_travel_typology_previous_value = $("#nd_travel_archive_form_typologys").val();
		                    var nd_travel_archive_form_typologys = nd_travel_typology_previous_value.replace(nd_travel_typology_value, "");

		                    $( "#nd_travel_archive_form_typologys" ).val( nd_travel_archive_form_typologys );

		                    nd_travel_sorting(1);
		                }

		                
		            });

		        });

		      });
		      //]]>
		    </script>

		</div>




		<div class="nd_travel_section nd_travel_height_5"></div> 
  		<div class="nd_travel_section nd_travel_height_2 nd_travel_bg_grey"></div>


	</div>
		<!--END typologyes-->';