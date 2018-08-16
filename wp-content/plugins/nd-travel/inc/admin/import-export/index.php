<?php


add_action('admin_menu','nd_travel_add_settings_menu_import_export');
function nd_travel_add_settings_menu_import_export(){

  add_submenu_page( 'nd-travel-settings','Import Export', __('Import Export','nd-travel'), 'manage_options', 'nd-travel-settings-import-export', 'nd_travel_settings_menu_import_export' );

}



function nd_travel_settings_menu_import_export() {

  wp_enqueue_script( 'nd_travel_import_sett', plugins_url() . '/nd-travel/inc/admin/import-export/js/nd_travel_import_settings.js', array( 'jquery' ) ); 

  wp_localize_script( 'nd_travel_import_sett', 'nd_travel_my_vars_import_settings', array( 'nd_travel_ajaxurl_import_settings'   => admin_url( 'admin-ajax.php' )) ); 

?>

  
  <div class="nd_travel_section nd_travel_padding_right_20 nd_travel_padding_left_2 nd_travel_box_sizing_border_box nd_travel_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_travel_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_travel_get_profile_bg_color(2); ?>;" class="nd_travel_section nd_travel_padding_20  nd_travel_box_sizing_border_box">
      <h2 class="nd_travel_color_ffffff nd_travel_display_inline_block"><?php _e('ND Travel','nd-travel'); ?></h2><span class="nd_travel_margin_left_10 nd_travel_color_a0a5aa"><?php echo nd_travel_get_plugin_version(); ?></span>
    </div>

    

    <div class="nd_travel_section  nd_travel_box_shadow_0_1_1_000_04 nd_travel_background_color_ffffff nd_travel_border_1_solid_e5e5e5 nd_travel_border_top_width_0 nd_travel_border_left_width_0 nd_travel_overflow_hidden nd_travel_position_relative">
    
      <!--START menu-->
      <div style="background-color:<?php echo nd_travel_get_profile_bg_color(1); ?>;" class="nd_travel_width_20_percentage nd_travel_float_left nd_travel_box_sizing_border_box nd_travel_min_height_3000 nd_travel_position_absolute">

        <ul class="nd_travel_navigation">
          
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-travel-settings'); ?>"><?php _e('Plugin Settings','nd-travel'); ?></a></li>
          <li><a style="background-color:<?php echo nd_travel_get_profile_bg_color(2); ?>;" class="" href="" ><?php _e('Import Export','nd-travel'); ?></a></li>
          <li><a target="_blank" class="" href="http://documentations.nicdark.com/"><?php _e('Documentation','nd-travel'); ?></a></li>
        
        </ul>
      </div>
      <!--END menu-->


      <!--START content-->
      <div class="nd_travel_width_80_percentage nd_travel_margin_left_20_percentage nd_travel_float_left nd_travel_box_sizing_border_box nd_travel_padding_20">


        <!--START-->
        <div class="nd_travel_section">
          <div class="nd_travel_width_40_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            <h2 class="nd_travel_section nd_travel_margin_0"><?php _e('Import/Export','nd-travel'); ?></h2>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_10"><?php _e('Export or Import your theme options.','nd-travel'); ?></p>
          </div>
        </div>
        <!--END-->

        <div class="nd_travel_section nd_travel_height_1 nd_travel_background_color_E7E7E7 nd_travel_margin_top_10 nd_travel_margin_bottom_10"></div>


        <?php


          $nd_travel_all_options = wp_load_alloptions();
          $nd_travel_my_options  = array();

          $nd_travel_name_write = '';
           
          foreach ( $nd_travel_all_options as $nd_travel_name => $nd_travel_value ) {
              if ( stristr( $nd_travel_name, 'nd_travel_' ) ) {
                  
                $nd_travel_my_options[ $nd_travel_name ] = $nd_travel_value;
                $nd_travel_name_write .= $nd_travel_name.'[nd_travel_option_value]'.$nd_travel_value.'[nd_travel_end_option]';

              }
          }

          $nd_travel_name_write_new = str_replace(" ", "%20", $nd_travel_name_write);
           
        ?>


        <!--START-->
        <div class="nd_travel_section">
          <div class="nd_travel_width_40_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            <h2 class="nd_travel_section nd_travel_margin_0"><?php _e('Export Settings','nd-travel'); ?></h2>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_10"><?php _e('Export Nd Booking and customizer options.','nd-travel'); ?></p>
          </div>
          <div class="nd_travel_width_60_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            
            <div class="nd_travel_section nd_travel_padding_left_20 nd_travel_padding_right_20 nd_travel_box_sizing_border_box">
              
                <a class="button button-primary" href="data:application/octet-stream;charset=utf-8,<?php echo $nd_travel_name_write_new; ?>" download="nd-travel-export.txt"><?php _e('Export','nd-travel'); ?></a>
              
            </div>

          </div>
        </div>
        <!--END-->

        
        <div class="nd_travel_section nd_travel_height_1 nd_travel_background_color_E7E7E7 nd_travel_margin_top_10 nd_travel_margin_bottom_10"></div>

        

        <!--START-->
        <div class="nd_travel_section">
          <div class="nd_travel_width_40_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            <h2 class="nd_travel_section nd_travel_margin_0"><?php _e('Import Settings','nd-travel'); ?></h2>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_10"><?php _e('Paste in the textarea the text of your export file','nd-travel'); ?></p>
          </div>
          <div class="nd_travel_width_60_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            
            <div class="nd_travel_section nd_travel_padding_left_20 nd_travel_padding_right_20 nd_travel_box_sizing_border_box">
              
                <textarea id="nd_travel_import_settings" class="nd_travel_margin_bottom_20 nd_travel_width_100_percentage" name="nd_travel_import_settings" rows="10"><?php echo esc_attr( get_option('nd_travel_textarea') ); ?></textarea>
                
                <a onclick="nd_travel_import_settings()" class="button button-primary"><?php _e('Import','nd-travel'); ?></a>

                <div class="nd_travel_margin_top_20 nd_travel_section" id="nd_travel_import_settings_result_container"></div>
                
            </div>

          </div>
        </div>
        <!--END-->


      </div>
      <!--END content-->


    </div>

  </div>

<?php } 
/*END 1*/







//START nd_travel_import_settings_php_function for AJAX
function nd_travel_import_settings_php_function() {


  //recover datas
  $nd_travel_value_import_settings = $_GET['nd_travel_value_import_settings'];

  $nd_travel_import_settings_result = '';

  if ( $nd_travel_value_import_settings != '' ) {

    $nd_travel_array_options = explode("[nd_travel_end_option]", $nd_travel_value_import_settings);

    foreach ($nd_travel_array_options as $nd_travel_array_option) {
        
      $nd_travel_array_single_option = explode("[nd_travel_option_value]", $nd_travel_array_option);
      $nd_travel_option = $nd_travel_array_single_option[0];
      $nd_travel_new_value = $nd_travel_array_single_option[1];

      if ( $nd_travel_new_value != '' ){
        $nd_travel_update_result = update_option($nd_travel_option,$nd_travel_new_value);  

        if ( $nd_travel_update_result == 1 ) {
          $nd_travel_import_settings_result .= '

            <div class="notice updated is-dismissible nd_travel_margin_0_important">
              <p>'.__('Updated option','nd-travel').' "'.$nd_travel_option.'" '.__('with','nd-travel').' '.$nd_travel_new_value.'.</p>
            </div>

            ';

        }else{
          $nd_travel_import_settings_result .= '

            <div class="notice updated is-dismissible nd_travel_margin_0_important">
              <p>'.__('Updated option','nd-travel').' "'.$nd_travel_option.'" '.__('with the same value','nd-travel').'.</p>
            </div>

          ';    
        }

      }else{

        if ( $nd_travel_option != '' ){
          $nd_travel_import_settings_result .= '

        <div class="notice notice-warning is-dismissible nd_travel_margin_0">
          <p>'.__('No value founded for','nd-travel').' "'.$nd_travel_option.'" '.__('option.','nd-travel').'</p>
        </div>
        ';
        }

        
      }
      
    }

  }else{

    $nd_travel_import_settings_result .= '
      <div class="notice notice-error is-dismissible nd_travel_margin_0">
        <p>'.__('Empty textarea, please paste your export options.','nd-travel').'</p>
      </div>
    ';

  }
  
  echo $nd_travel_import_settings_result;

  die();


}
add_action( 'wp_ajax_nd_travel_import_settings_php_function', 'nd_travel_import_settings_php_function' );
add_action( 'wp_ajax_nopriv_nd_travel_import_settings_php_function', 'nd_travel_import_settings_php_function' );
//END