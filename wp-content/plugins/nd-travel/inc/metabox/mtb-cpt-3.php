<?php

///////////////////////////////////////////////////METABOX ///////////////////////////////////////////////////////////////

add_action( 'add_meta_boxes', 'nd_travel_box_add_cpt_3' );
function nd_travel_box_add_cpt_3() {
    add_meta_box( 'nd_travel_metabox_cpt_3', __('Metabox','nd-travel'), 'nd_travel_meta_box_3', 'nd_travel_cpt_3', 'normal', 'high' );
}

function nd_travel_meta_box_3()
{

    //iris color picker
    wp_enqueue_script('iris');

    //jquery-ui-tabs
    wp_enqueue_script('jquery-ui-tabs');

    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_travel_values = get_post_custom( $post->ID );
     
    //preview settings
    $nd_travel_meta_box_color_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_color_cpt_3', true );
    $nd_travel_meta_box_text_preview_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_text_preview_cpt_3', true );
    $nd_travel_meta_box_parent_destination = get_post_meta( get_the_ID(), 'nd_travel_meta_box_parent_destination', true );

    //page settings
    $nd_travel_meta_box_image_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image_cpt_3', true );
    $nd_travel_meta_box_image_cpt_3_position = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image_cpt_3_position', true );
    $nd_travel_meta_box_page_layout_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_page_layout_cpt_3', true );

    //info box
    $nd_travel_meta_box_country_title_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_country_title_cpt_3', true );
    $nd_travel_meta_box_country_descr_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_country_descr_cpt_3', true );
    $nd_travel_meta_box_contact_title_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_contact_title_cpt_3', true );
    $nd_travel_meta_box_contact_descr_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_contact_descr_cpt_3', true );

    
    ?>




    <div id="nd_travel_id_metabox_cpt">
      
      <!--start ul-->
      <ul>
        
        <li>
          <a href="#nd_travel_tab_preview"><span class="dashicons-before dashicons-format-image nd_travel_line_height_20 nd_travel_margin_right_10 nd_travel_color_444444"></span><?php _e('Main Settings','nd-travel'); ?></a>
          <li><a href="#nd_travel_tab_page"><span class="dashicons-before dashicons-format-aside nd_travel_line_height_20 nd_travel_margin_right_10 nd_travel_color_444444"></span><?php _e('Page Settings','nd-travel'); ?></a></li>
          <li><a href="#nd_travel_tab_info_box"><span class="dashicons-before dashicons-info nd_travel_line_height_20 nd_travel_margin_right_10 nd_travel_color_444444"></span><?php _e('Info Box','nd-travel'); ?></a></li>
        </li>

      </ul>
      <!--end ul-->
        
      <div class="nd_travel_id_metabox_cpt_content">

        <!--start tab-->
        <div id="nd_travel_tab_preview">

          <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
              <p><strong><?php _e('Color','nd-travel'); ?></strong></p>
              <p><input class="nd_travel_width_100_percentage" id="nd_travel_colorpicker" type="text" name="nd_travel_meta_box_color_cpt_3" value="<?php echo $nd_travel_meta_box_color_cpt_3; ?>" /></p>
              <p><?php _e('Set package color','nd-travel'); ?></p>
          </div>
            
          <script type="text/javascript">
            //<![CDATA[
            
            jQuery(document).ready(function($){
                $('#nd_travel_colorpicker').iris();
            });

            //]]>
          </script>

          <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
              <p><strong><?php _e('Text Preview','nd-travel'); ?></strong></p>
              <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_text_preview_cpt_3" id="nd_travel_meta_box_text_preview_cpt_3" value="<?php echo $nd_travel_meta_box_text_preview_cpt_3 ?>" /></p>
              <p><?php _e('Insert the text preview which will be visible on the post grid preview','nd-travel'); ?></p>
          </div>



          <div class="nd_travel_section  nd_travel_padding_10 nd_travel_box_sizing_border_box">
            <p><strong><?php _e('Parent Destination','nd-travel'); ?></strong></p>
            <p>
              <select class="nd_travel_width_100_percentage" name="nd_travel_meta_box_parent_destination" id="nd_travel_meta_box_parent_destination">
                <?php 

                  $nd_travel_meta_box_parent_destination = get_post_meta( get_the_ID(), 'nd_travel_meta_box_parent_destination', true );
                  $nd_travel_destinations_args = array( 'posts_per_page' => -1, 'post_type'=> 'nd_travel_cpt_3' );
                  $nd_travel_destinations = get_posts($nd_travel_destinations_args); 

                  ?>

                  <option value="0"><?php _e('Not selected','nd-travel'); ?></option>

                <?php foreach ($nd_travel_destinations as $nd_travel_meta_box_parent_dest) : ?>
                    <option 

                    <?php 
                      if( $nd_travel_meta_box_parent_destination == $nd_travel_meta_box_parent_dest->ID ) { 
                        echo 'selected="selected"';
                      } 
                    ?>

                    value="<?php echo $nd_travel_meta_box_parent_dest->ID; ?>">
                        <?php echo $nd_travel_meta_box_parent_dest->post_title; ?>
                    </option>
                <?php endforeach; ?>
              </select>
            </p>
            <p><?php _e('Select the parent destination','nd-travel'); ?></p>
          </div>



        </div>
        <!--end tab-->




        <!--START tab-->
        <div id="nd_travel_tab_page">

          <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
            <p><strong><?php _e('Header Image','nd-travel'); ?></strong></p>
            <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_image_cpt_3" id="nd_travel_meta_box_image_cpt_3" value="<?php echo $nd_travel_meta_box_image_cpt_3 ?>" /></p>
            <input class="button nd_travel_meta_box_image_cpt_3_button" type="button" name="nd_travel_meta_box_image_cpt_3_button" id="nd_travel_meta_box_image_cpt_3_button" value="<?php _e('Upload','nd-travel'); ?>" />
            <p><?php _e('Insert the header image url','nd-travel'); ?></p>

            <script type="text/javascript">
              //<![CDATA[
                  
              jQuery(document).ready(function() {

                jQuery( function ( $ ) {

                  var file_frame = [],
                  $button = $( '.nd_travel_meta_box_image_cpt_3_button' );


                  $('#nd_travel_meta_box_image_cpt_3_button').click( function () {


                    var $this = $( this ),
                      id = $this.attr( 'id' );

                    // If the media frame already exists, reopen it.
                    if ( file_frame[ id ] ) {
                      file_frame[ id ].open();

                      return;
                    }

                    // Create the media frame.
                    file_frame[ id ] = wp.media.frames.file_frame = wp.media( {
                      title    : $this.data( 'uploader_title' ),
                      button   : {
                        text : $this.data( 'uploader_button_text' )
                      },
                      multiple : false  // Set to true to allow multiple files to be selected
                    } );

                    // When an image is selected, run a callback.
                    file_frame[ id ].on( 'select', function() {

                      // We set multiple to false so only get one image from the uploader
                      var attachment = file_frame[ id ].state().get( 'selection' ).first().toJSON();

                      $('#nd_travel_meta_box_image_cpt_3').val(attachment.url);

                    } );

                    // Finally, open the modal
                    file_frame[ id ].open();


                  } );

                });

              });

                //]]>
              </script>

          </div>

          <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
              <p><strong><?php _e('Image Position','nd-travel'); ?></strong></p>
              <p>
                <select class="nd_travel_width_100_percentage" name="nd_travel_meta_box_image_cpt_3_position" id="nd_travel_meta_box_image_cpt_3_position">

                  <option <?php if( $nd_travel_meta_box_image_cpt_3_position == 'nd_travel_background_position_center' ) { echo 'selected="selected"'; } ?> value="nd_travel_background_position_center"><?php _e('Center','nd-travel'); ?></option>
                  <option <?php if( $nd_travel_meta_box_image_cpt_3_position == 'nd_travel_background_position_center_top' ) { echo 'selected="selected"'; } ?> value="nd_travel_background_position_center_top"><?php _e('Top','nd-travel'); ?></option>
                  <option <?php if( $nd_travel_meta_box_image_cpt_3_position == 'nd_travel_background_position_center_bottom' ) { echo 'selected="selected"'; } ?> value="nd_travel_background_position_center_bottom"><?php _e('Bottom','nd-travel'); ?></option>
                   
                </select>
              </p>
              <p><?php _e('Select the image position for your header image','nd-travel'); ?></p>
          </div>

          <div class="nd_travel_section nd_travel_padding_10 nd_travel_box_sizing_border_box">
              <p><strong><?php _e('Page Layout','nd-travel'); ?></strong></p>
              <p>
                  
                  <select class="nd_travel_width_100_percentage" name="nd_travel_meta_box_page_layout_cpt_3" id="nd_travel_meta_box_page_layout_cpt_3">

                      <option <?php if( $nd_travel_meta_box_page_layout_cpt_3 == 'layout-1' ) { echo 'selected="selected"'; } ?> value="layout-1"><?php _e('Layout 1','nd-travel'); ?></option>
                      <option <?php if( $nd_travel_meta_box_page_layout_cpt_3 == 'free-content' ) { echo 'selected="selected"'; } ?> value="free-content"><?php _e('Free Content','nd-travel'); ?></option>

                  </select>

              </p>
              <p><?php _e('Select the layout for your room page','nd-travel'); ?></p>
          </div>

      </div>
      <!--END tab-->



      <!--start tab-->
        <div id="nd_travel_tab_info_box">

          <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
              <p><strong><?php _e('Country Title','nd-travel'); ?></strong></p>
              <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_country_title_cpt_3" id="nd_travel_meta_box_country_title_cpt_3" value="<?php echo $nd_travel_meta_box_country_title_cpt_3 ?>" /></p>
              <p><?php _e('Insert the title','nd-travel'); ?></p>
          </div>
          <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
              <p><strong><?php _e('Country Description','nd-travel'); ?></strong></p>
              <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_country_descr_cpt_3" id="nd_travel_meta_box_country_descr_cpt_3" value="<?php echo $nd_travel_meta_box_country_descr_cpt_3 ?>" /></p>
              <p><?php _e('Insert the description','nd-travel'); ?></p>
          </div>

          <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
              <p><strong><?php _e('Contact Title','nd-travel'); ?></strong></p>
              <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_contact_title_cpt_3" id="nd_travel_meta_box_contact_title_cpt_3" value="<?php echo $nd_travel_meta_box_contact_title_cpt_3 ?>" /></p>
              <p><?php _e('Insert the title','nd-travel'); ?></p>
          </div>
          <div class="nd_travel_section  nd_travel_padding_10 nd_travel_box_sizing_border_box">
              <p><strong><?php _e('Contact Description','nd-travel'); ?></strong></p>
              <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_contact_descr_cpt_3" id="nd_travel_meta_box_contact_descr_cpt_3" value="<?php echo $nd_travel_meta_box_contact_descr_cpt_3 ?>" /></p>
              <p><?php _e('Insert the description','nd-travel'); ?></p>
          </div>


        </div>
        <!--end tab-->



      </div>


    </div>




    <script type="text/javascript">
      //<![CDATA[
      
      jQuery(document).ready(function($){

        $( "#nd_travel_id_metabox_cpt" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
        $( "#nd_travel_id_metabox_cpt li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
      });

      //]]>
    </script>


    <?php   

}


add_action( 'save_post', 'nd_travel_meta_box_save_cpt_3' );
function nd_travel_meta_box_save_cpt_3( $post_id )
{

    //preview settings
    if( isset( $_POST['nd_travel_meta_box_color_cpt_3'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_color_cpt_3', wp_kses( $_POST['nd_travel_meta_box_color_cpt_3'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_text_preview_cpt_3'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_text_preview_cpt_3', wp_kses( $_POST['nd_travel_meta_box_text_preview_cpt_3'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_parent_destination'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_parent_destination', wp_kses( $_POST['nd_travel_meta_box_parent_destination'], $allowed ) );

    //page settings
    if( isset( $_POST['nd_travel_meta_box_image_cpt_3'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_image_cpt_3', wp_kses( $_POST['nd_travel_meta_box_image_cpt_3'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_image_cpt_3_position'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_image_cpt_3_position', wp_kses( $_POST['nd_travel_meta_box_image_cpt_3_position'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_page_layout_cpt_3'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_page_layout_cpt_3', wp_kses( $_POST['nd_travel_meta_box_page_layout_cpt_3'], $allowed ) );

    //info box
    if( isset( $_POST['nd_travel_meta_box_country_title_cpt_3'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_country_title_cpt_3', wp_kses( $_POST['nd_travel_meta_box_country_title_cpt_3'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_country_descr_cpt_3'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_country_descr_cpt_3', wp_kses( $_POST['nd_travel_meta_box_country_descr_cpt_3'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_contact_title_cpt_3'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_contact_title_cpt_3', wp_kses( $_POST['nd_travel_meta_box_contact_title_cpt_3'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_contact_descr_cpt_3'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_contact_descr_cpt_3', wp_kses( $_POST['nd_travel_meta_box_contact_descr_cpt_3'], $allowed ) );

}