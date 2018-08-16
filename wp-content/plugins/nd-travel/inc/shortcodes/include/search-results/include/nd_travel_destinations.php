<?php


$nd_travel_shortcode_left_content .= '

<!--START destinations-->
<div class=" '.$nd_travel_destinations_class.' nd_travel_section nd_travel_box_sizing_border_box nd_travel_box_sizing_border_box nd_travel_border_1_solid_grey">

  <div class="nd_travel_bg_yellow nd_travel_section nd_travel_padding_20_30 nd_travel_box_sizing_border_box">
    <h3 class="nd_travel_float_left nd_travel_font_weight_normal nd_options_color_white nd_travel_font_size_16 ">'.__('Select your destination','nd-travel').' :</h3>
  </div>

  <div class=" nd_travel_width_100_percentage nd_travel_float_left nd_travel_padding_20_30 nd_travel_box_sizing_border_box">


    <select class="nd_travel_width_100_percentage" name="nd_travel_archive_form_destinations" id="nd_travel_archive_form_destinations">';

    

      //get all destinations
      $nd_travel_destinations_args = array( 
      'posts_per_page' => -1, 
      'post_type'=> 'nd_travel_cpt_3'
      );

      $nd_travel_destinations_query = new WP_Query( $nd_travel_destinations_args );
      $nd_travel_destinations_query_i = 0;

      while ( $nd_travel_destinations_query->have_posts() ) : $nd_travel_destinations_query->the_post();

        $nd_travel_destination_id = get_the_ID();

        if ( $nd_travel_destinations_query_i == 0 ) { $nd_travel_shortcode_left_content .= '<option value="0">'.__('All Destinations','nd-travel').'</option>'; }

        //not insert if parent is setted
        $nd_travel_meta_box_parent_destination = get_post_meta( get_the_ID(), 'nd_travel_meta_box_parent_destination', true );
        if ( $nd_travel_meta_box_parent_destination != 0 ) {
          $nd_travel_shortcode_left_content .= '';
        }else{


          $nd_travel_shortcode_left_content .= '<option '; if( $nd_travel_archive_form_destinations == $nd_travel_destination_id ){ $nd_travel_shortcode_left_content .= ' selected '; } $nd_travel_shortcode_left_content .= ' value="'.$nd_travel_destination_id.'">'.get_the_title().'</option>';

          //check if the destination selected has some children destinations
          if ( count(nd_travel_get_destinations_with_parent($nd_travel_destination_id)) != 0 ){

            $nd_travel_children_destinations_array = nd_travel_get_destinations_with_parent($nd_travel_destination_id);

            foreach ($nd_travel_children_destinations_array as $nd_travel_children_destination_id) {
                
              //get parent id of children dest
              $nd_travel_parent_id_of_children_dest = get_post_meta( $nd_travel_children_destination_id, 'nd_travel_meta_box_parent_destination', true );

              if ( $nd_travel_parent_id_of_children_dest == $nd_travel_destination_id ) {
                $nd_travel_shortcode_left_content .= '<option '; if( $nd_travel_archive_form_destinations == $nd_travel_children_destination_id ){ $nd_travel_shortcode_left_content .= ' selected '; } $nd_travel_shortcode_left_content .= ' value="'.$nd_travel_children_destination_id.'">&nbsp;&nbsp;- '.get_the_title($nd_travel_children_destination_id).'</option>';  
              }

            }

          }


        }

        $nd_travel_destinations_query_i = $nd_travel_destinations_query_i + 1;

      endwhile; 

      wp_reset_postdata();


    $nd_travel_shortcode_left_content .= ' 
    </select>';
    
      
      
        $nd_travel_shortcode_left_content .= '

          <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready(function() {

              jQuery( function ( $ ) {

                  $( "#nd_travel_archive_form_destinations" ).change(function() {

                      nd_travel_sorting(1);

                  });

              });

            });
            //]]>
          </script>

      </div>
    </div>
  <!--END destination-->';