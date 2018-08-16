<?php

///////////////////////////////////////////////////METABOX ///////////////////////////////////////////////////////////////


add_action( 'add_meta_boxes', 'nd_travel_box_add_cpt_2' );
function nd_travel_box_add_cpt_2() {
    add_meta_box( 'nd_travel_metabox_cpt_2', __('Metabox','nd-travel'), 'nd_travel_meta_box_cpt_2', 'nd_travel_cpt_2', 'normal', 'high' );
}

function nd_travel_meta_box_cpt_2()
{

    //iris color picker
    wp_enqueue_script('iris');

    //jquery-ui-tabs
    wp_enqueue_script('jquery-ui-tabs');

    // $post is already set, and contains an object: the WordPress post
    global $post;
    $nd_travel_values = get_post_custom( $post->ID );

    //main settings
    $nd_travel_meta_box_cpt_2_icon = get_post_meta( get_the_ID(), 'nd_travel_meta_box_cpt_2_icon', true );
    $nd_travel_meta_box_cpt_2_color = get_post_meta( get_the_ID(), 'nd_travel_meta_box_cpt_2_color', true );
    $nd_travel_meta_box_cpt_2_text_preview = get_post_meta( get_the_ID(), 'nd_travel_meta_box_cpt_2_text_preview', true );

    //page settings
    $nd_travel_meta_box_image_cpt_2 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image_cpt_2', true );
    $nd_travel_meta_box_image_cpt_2_position = get_post_meta( get_the_ID(), 'nd_travel_meta_box_image_cpt_2_position', true );
    $nd_travel_meta_box_page_layout_cpt_2 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_page_layout_cpt_2', true );

    //info box
    $nd_travel_meta_box_agent_title_cpt_2 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_agent_title_cpt_2', true );
    $nd_travel_meta_box_agent_descr_cpt_2 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_agent_descr_cpt_2', true );
    $nd_travel_meta_box_contact_title_cpt_2 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_contact_title_cpt_2', true );
    $nd_travel_meta_box_contact_descr_cpt_2 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_contact_descr_cpt_2', true );

    ?>



    <div id="nd_travel_id_metabox_cpt">
        
        <ul>
            <li><a href="#nd_travel_tab_main"><span class="dashicons-before dashicons-admin-settings nd_travel_line_height_20 nd_travel_margin_right_10 nd_travel_color_444444"></span><?php _e('Main Settings','nd-travel'); ?></a></li>
            <li><a href="#nd_travel_tab_page"><span class="dashicons-before dashicons-format-aside nd_travel_line_height_20 nd_travel_margin_right_10 nd_travel_color_444444"></span><?php _e('Page Settings','nd-travel'); ?></a></li>
            <li><a href="#nd_travel_tab_info_box"><span class="dashicons-before dashicons-info nd_travel_line_height_20 nd_travel_margin_right_10 nd_travel_color_444444"></span><?php _e('Info Box','nd-travel'); ?></a></li>
        </ul>
        
        <div class="nd_travel_id_metabox_cpt_content">
            

            <div id="nd_travel_tab_main">
                

                <!--START ICON-->
                <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
                    <p><strong><?php _e('Icon','nd-travel'); ?></strong></p>
                    <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_cpt_2_icon" id="nd_travel_meta_box_cpt_2_icon" value="<?php echo $nd_travel_meta_box_cpt_2_icon ?>" /></p>
                    <p>
                      <input class="button nd_travel_meta_box_cpt_2_icon_button" type="button" name="nd_travel_meta_box_cpt_2_icon_button" id="nd_travel_meta_box_cpt_2_icon_button" value="<?php _e('Upload','nd-travel'); ?>" />
                    </p>
                    <p><?php _e('Set the icon image for your typology','nd-travel'); ?></p>


                    <script type="text/javascript">
                      //<![CDATA[
                      
                    jQuery(document).ready(function() {

                      jQuery( function ( $ ) {

                        var file_frame = [],
                        $button = $( '.nd_travel_meta_box_cpt_2_icon_button' );


                        $('#nd_travel_meta_box_cpt_2_icon_button').click( function () {


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

                            $('#nd_travel_meta_box_cpt_2_icon').val(attachment.url);

                          } );

                          // Finally, open the modal
                          file_frame[ id ].open();


                        } );

                      });

                    });

                      //]]>
                    </script>

                </div>
                <!--END ICON-->




                <!--START COLOR-->
                <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
                    <p><strong><?php _e('Color','nd-travel'); ?></strong></p>
                    <p><input class="nd_travel_width_100_percentage" id="nd_travel_colorpicker" type="text" name="nd_travel_meta_box_cpt_2_color" value="<?php echo $nd_travel_meta_box_cpt_2_color; ?>" /></p>
                    <p><?php _e('Set the service color','nd-travel'); ?></p>
                </div>
                <script type="text/javascript">
                  //<![CDATA[
                  
                  jQuery(document).ready(function($){
                      $('#nd_travel_colorpicker').iris();
                  });

                  //]]>
                </script>
                <!--END COLOR-->




                <!--START TEXT PREVIEW-->
                <div class="nd_travel_section  nd_travel_padding_10 nd_travel_box_sizing_border_box">
                    <p><strong><?php _e('Text Preview','nd-travel'); ?></strong></p>
                    <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_cpt_2_text_preview" id="nd_travel_meta_box_cpt_2_text_preview" value="<?php echo $nd_travel_meta_box_cpt_2_text_preview ?>" /></p>
                    <p><?php _e('Insert the text preview which will be visible in the preview of the typology','nd-travel'); ?></p>
                </div>
                <!--END TEXT PREVIEW-->



            </div>





            <!--START tab-->
            <div id="nd_travel_tab_page">

              <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
                <p><strong><?php _e('Header Image','nd-travel'); ?></strong></p>
                <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_image_cpt_2" id="nd_travel_meta_box_image_cpt_2" value="<?php echo $nd_travel_meta_box_image_cpt_2 ?>" /></p>
                <input class="button nd_travel_meta_box_image_cpt_2_button" type="button" name="nd_travel_meta_box_image_cpt_2_button" id="nd_travel_meta_box_image_cpt_2_button" value="<?php _e('Upload','nd-travel'); ?>" />
                <p><?php _e('Insert the header image url','nd-travel'); ?></p>

                <script type="text/javascript">
                  //<![CDATA[
                      
                  jQuery(document).ready(function() {

                    jQuery( function ( $ ) {

                      var file_frame = [],
                      $button = $( '.nd_travel_meta_box_image_cpt_2_button' );


                      $('#nd_travel_meta_box_image_cpt_2_button').click( function () {


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

                          $('#nd_travel_meta_box_image_cpt_2').val(attachment.url);

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
                    <select class="nd_travel_width_100_percentage" name="nd_travel_meta_box_image_cpt_2_position" id="nd_travel_meta_box_image_cpt_2_position">

                      <option <?php if( $nd_travel_meta_box_image_cpt_2_position == 'nd_travel_background_position_center' ) { echo 'selected="selected"'; } ?> value="nd_travel_background_position_center"><?php _e('Center','nd-travel'); ?></option>
                      <option <?php if( $nd_travel_meta_box_image_cpt_2_position == 'nd_travel_background_position_center_top' ) { echo 'selected="selected"'; } ?> value="nd_travel_background_position_center_top"><?php _e('Top','nd-travel'); ?></option>
                      <option <?php if( $nd_travel_meta_box_image_cpt_2_position == 'nd_travel_background_position_center_bottom' ) { echo 'selected="selected"'; } ?> value="nd_travel_background_position_center_bottom"><?php _e('Bottom','nd-travel'); ?></option>
                       
                    </select>
                  </p>
                  <p><?php _e('Select the image position for your header image','nd-travel'); ?></p>
              </div>

              <div class="nd_travel_section nd_travel_padding_10 nd_travel_box_sizing_border_box">
                  <p><strong><?php _e('Page Layout','nd-travel'); ?></strong></p>
                  <p>
                      
                      <select class="nd_travel_width_100_percentage" name="nd_travel_meta_box_page_layout_cpt_2" id="nd_travel_meta_box_page_layout_cpt_2">

                          <option <?php if( $nd_travel_meta_box_page_layout_cpt_2 == 'layout-1' ) { echo 'selected="selected"'; } ?> value="layout-1"><?php _e('Layout 1','nd-travel'); ?></option>
                          <option <?php if( $nd_travel_meta_box_page_layout_cpt_2 == 'free-content' ) { echo 'selected="selected"'; } ?> value="free-content"><?php _e('Free Content','nd-travel'); ?></option>

                      </select>

                  </p>
                  <p><?php _e('Select the layout for your room page','nd-travel'); ?></p>
              </div>

          </div>
          <!--END tab-->



          <!--start tab-->
          <div id="nd_travel_tab_info_box">

            <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
                <p><strong><?php _e('Agent Title','nd-travel'); ?></strong></p>
                <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_agent_title_cpt_2" id="nd_travel_meta_box_agent_title_cpt_2" value="<?php echo $nd_travel_meta_box_agent_title_cpt_2 ?>" /></p>
                <p><?php _e('Insert the title','nd-travel'); ?></p>
            </div>
            <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
                <p><strong><?php _e('Agent Description','nd-travel'); ?></strong></p>
                <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_agent_descr_cpt_2" id="nd_travel_meta_box_agent_descr_cpt_2" value="<?php echo $nd_travel_meta_box_agent_descr_cpt_2 ?>" /></p>
                <p><?php _e('Insert the description','nd-travel'); ?></p>
            </div>

            <div class="nd_travel_section nd_travel_border_bottom_1_solid_eee nd_travel_padding_10 nd_travel_box_sizing_border_box">
                <p><strong><?php _e('Contact Title','nd-travel'); ?></strong></p>
                <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_contact_title_cpt_2" id="nd_travel_meta_box_contact_title_cpt_2" value="<?php echo $nd_travel_meta_box_contact_title_cpt_2 ?>" /></p>
                <p><?php _e('Insert the title','nd-travel'); ?></p>
            </div>
            <div class="nd_travel_section  nd_travel_padding_10 nd_travel_box_sizing_border_box">
                <p><strong><?php _e('Contact Description','nd-travel'); ?></strong></p>
                <p><input class="nd_travel_width_100_percentage" type="text" name="nd_travel_meta_box_contact_descr_cpt_2" id="nd_travel_meta_box_contact_descr_cpt_2" value="<?php echo $nd_travel_meta_box_contact_descr_cpt_2 ?>" /></p>
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


add_action( 'save_post', 'nd_travel_meta_box_save_cpt_2' );
function nd_travel_meta_box_save_cpt_2( $post_id )
{

    //main settings
    if( isset( $_POST['nd_travel_meta_box_cpt_2_icon'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_cpt_2_icon', wp_kses( $_POST['nd_travel_meta_box_cpt_2_icon'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_cpt_2_color'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_cpt_2_color', wp_kses( $_POST['nd_travel_meta_box_cpt_2_color'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_cpt_2_text_preview'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_cpt_2_text_preview', wp_kses( $_POST['nd_travel_meta_box_cpt_2_text_preview'], $allowed ) ); 

    //page settings
    if( isset( $_POST['nd_travel_meta_box_image_cpt_2'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_image_cpt_2', wp_kses( $_POST['nd_travel_meta_box_image_cpt_2'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_image_cpt_2_position'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_image_cpt_2_position', wp_kses( $_POST['nd_travel_meta_box_image_cpt_2_position'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_page_layout_cpt_2'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_page_layout_cpt_2', wp_kses( $_POST['nd_travel_meta_box_page_layout_cpt_2'], $allowed ) );
    
    //info box
    if( isset( $_POST['nd_travel_meta_box_agent_title_cpt_2'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_agent_title_cpt_2', wp_kses( $_POST['nd_travel_meta_box_agent_title_cpt_2'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_agent_descr_cpt_2'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_agent_descr_cpt_2', wp_kses( $_POST['nd_travel_meta_box_agent_descr_cpt_2'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_contact_title_cpt_2'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_contact_title_cpt_2', wp_kses( $_POST['nd_travel_meta_box_contact_title_cpt_2'], $allowed ) );
    if( isset( $_POST['nd_travel_meta_box_contact_descr_cpt_2'] ) ) update_post_meta( $post_id, 'nd_travel_meta_box_contact_descr_cpt_2', wp_kses( $_POST['nd_travel_meta_box_contact_descr_cpt_2'], $allowed ) );

}