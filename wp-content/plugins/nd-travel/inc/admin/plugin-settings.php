<?php


/////////////////////////////////////////////////// START MAIN PLUGIN SETTINGS ///////////////////////////////////////////////////////////////
add_action('admin_menu', 'nd_travel_create_menu');
function nd_travel_create_menu() {
  
  add_menu_page('Travel Plugin', __('Travel Plugin','nd-travel'), 'manage_options', 'nd-travel-settings', 'nd_travel_settings_page', 'dashicons-admin-generic' );
  add_action( 'admin_init', 'nd_travel_settings' );

  //custom hook
  do_action("nd_travel_add_menu_settings");

}

function nd_travel_settings() {
  register_setting( 'nd_travel_settings_group', 'nd_travel_currency' );
  register_setting( 'nd_travel_settings_group', 'nd_travel_currency_position' );
  register_setting( 'nd_travel_settings_group', 'nd_travel_date_format' );
  register_setting( 'nd_travel_settings_group', 'nd_travel_container' );
  register_setting( 'nd_travel_settings_group', 'nd_travel_search_page' );

  //custom hook
  do_action("nd_travel_add_settings_group");

}

function nd_travel_settings_page() {

?>


<form method="post" action="options.php">
    
  <?php settings_fields( 'nd_travel_settings_group' ); ?>
  <?php do_settings_sections( 'nd_travel_settings_group' ); ?>


  <div class="nd_travel_section nd_travel_padding_right_20 nd_travel_padding_left_2 nd_travel_box_sizing_border_box nd_travel_margin_top_25 ">

    

    <div style="background-color:<?php echo nd_travel_get_profile_bg_color(0); ?>; border-bottom:3px solid <?php echo nd_travel_get_profile_bg_color(2); ?>;" class="nd_travel_section nd_travel_padding_20 nd_travel_box_sizing_border_box">
      <h2 class="nd_travel_color_ffffff nd_travel_display_inline_block"><?php _e('ND Travel','nd-travel'); ?></h2><span class="nd_travel_margin_left_10 nd_travel_color_a0a5aa"><?php echo nd_travel_get_plugin_version(); ?></span>
    </div>

    

    <div class="nd_travel_section  nd_travel_box_shadow_0_1_1_000_04 nd_travel_background_color_ffffff nd_travel_border_1_solid_e5e5e5 nd_travel_border_top_width_0 nd_travel_border_left_width_0 nd_travel_overflow_hidden nd_travel_position_relative">

      <!--START menu-->
      <div style="background-color:<?php echo nd_travel_get_profile_bg_color(1); ?>;" class="nd_travel_width_20_percentage nd_travel_float_left nd_travel_box_sizing_border_box nd_travel_min_height_3000 nd_travel_position_absolute">

        <ul class="nd_travel_navigation">
          <li><a style="background-color:<?php echo nd_travel_get_profile_bg_color(2); ?>;" class="" href="#"><?php _e('Plugin Settings','nd-travel'); ?></a></li>
          <li><a class="" href="<?php echo admin_url('admin.php?page=nd-travel-settings-import-export'); ?>"><?php _e('Import Export','nd-travel'); ?></a></li>
          <li><a target="_blank" class="" href="http://documentations.nicdark.com/"><?php _e('Documentation','nd-travel'); ?></a></li>
        </ul>
      </div>
      <!--END menu-->

      <!--START content-->
      <div class="nd_travel_width_80_percentage nd_travel_margin_left_20_percentage nd_travel_float_left nd_travel_box_sizing_border_box nd_travel_padding_20">


        <!--START-->
        <div class="nd_travel_section">
          <div class="nd_travel_width_40_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            <h2 class="nd_travel_section nd_travel_margin_0"><?php _e('Plugin Settings','nd-travel'); ?></h2>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_10"><?php _e('Below some important plugin settings.','nd-travel'); ?></p>
          </div>
        </div>
        <!--END-->
        <div class="nd_travel_section nd_travel_height_1 nd_travel_background_color_E7E7E7 nd_travel_margin_top_10 nd_travel_margin_bottom_10"></div>


        <!--START-->
        <div class="nd_travel_section">
          <div class="nd_travel_width_40_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            <h2 class="nd_travel_section nd_travel_margin_0"><?php _e('Currency','nd-travel'); ?></h2>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_10"><?php _e('Plugin Currency','nd-travel'); ?></p>
          </div>
          <div class="nd_travel_width_60_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            
            <input class="nd_travel_width_100_percentage" type="text" name="nd_travel_currency" value="<?php echo esc_attr( get_option('nd_travel_currency') ); ?>" />
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_20"><?php _e('Insert the currency. Eg: $','nd-travel'); ?></p>

              <div class="nd_travel_section nd_travel_height_20"></div>
              <div class="nd_travel_section nd_travel_height_20"></div>

             <select class="nd_travel_width_100_percentage" name="nd_travel_currency_position">

              <?php 
              
              $nd_travel_currency_positions = array(0,1);
              
              foreach ($nd_travel_currency_positions as $nd_travel_currency_position) : ?>
                  
                  <option <?php if( get_option('nd_travel_currency_position') == $nd_travel_currency_position ) { echo 'selected="selected"'; } ?> value=" <?php echo $nd_travel_currency_position; ?> "><?php if ( $nd_travel_currency_position == 0 ) { _e('After Price','nd-travel'); }else{ _e('Before Price','nd-travel'); } ?></option>

              <?php 
              endforeach;
              ?>
            
            
            </select>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_20"><?php _e('Select the currency position','nd-travel'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_travel_section nd_travel_height_1 nd_travel_background_color_E7E7E7 nd_travel_margin_top_10 nd_travel_margin_bottom_10"></div>




        <!--START-->
        <div class="nd_travel_section">
          <div class="nd_travel_width_40_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            <h2 class="nd_travel_section nd_travel_margin_0"><?php _e('Date Format','nd-travel'); ?></h2>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_10"><?php _e('Customize your format','nd-travel'); ?></p>
          </div>
          <div class="nd_travel_width_60_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            
            
            <select class="nd_travel_width_100_percentage" name="nd_travel_date_format">

              <?php 
              
              $nd_travel_date_formats = array('m-d-Y','d-m-Y','Y-m-d','Y-d-m');
              
              foreach ($nd_travel_date_formats as $nd_travel_date_format) : ?>
                  
                  <option <?php if( get_option('nd_travel_date_format') == $nd_travel_date_format ) { echo 'selected="selected"'; } ?> value=" <?php echo $nd_travel_date_format; ?> "><?php echo $nd_travel_date_format; ?></option>

              <?php 
              endforeach;
              ?>
            
            
            </select>

            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_20"><?php _e('Select the date format that you want to use','nd-travel'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_travel_section nd_travel_height_1 nd_travel_background_color_E7E7E7 nd_travel_margin_top_10 nd_travel_margin_bottom_10"></div>


        <?php
          //custom hook
          do_action("nd_travel_add_setting_on_main_page");
        ?>


        <!--START-->
        <div class="nd_travel_section">
          <div class="nd_travel_width_40_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            <h2 class="nd_travel_section nd_travel_margin_0"><?php _e('Container','nd-travel'); ?></h2>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_10"><?php _e('Remove default container','nd-travel'); ?></p>
          </div>
          <div class="nd_travel_width_60_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            
            <input <?php if( get_option('nd_travel_container') == 1 ) { echo 'checked="checked"'; } ?> name="nd_travel_container" type="checkbox" value="1">
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_20"><?php _e('If your theme does not need the default container of 1200px in template pages you can remove it by flagging the checkbox.','nd-travel'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_travel_section nd_travel_height_1 nd_travel_background_color_E7E7E7 nd_travel_margin_top_10 nd_travel_margin_bottom_10"></div>


        <!--START-->
        <div class="nd_travel_section">
          <div class="nd_travel_width_40_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            <h2 class="nd_travel_section nd_travel_margin_0"><?php _e('Search Page','nd-travel'); ?></h2>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_10"><?php _e('Select your search page','nd-travel'); ?></p>
          </div>
          <div class="nd_travel_width_60_percentage nd_travel_padding_20 nd_travel_box_sizing_border_box nd_travel_float_left">
            
            <select class="nd_travel_width_100_percentage" name="nd_travel_search_page">
              <?php $nd_travel_pages = get_pages(); ?>
              <?php foreach ($nd_travel_pages as $nd_travel_page) : ?>
                  <option

                  <?php 
                    if( get_option('nd_travel_search_page') == $nd_travel_page->ID ) { 
                      echo 'selected="selected"';
                    } 
                  ?>

                   value="<?php echo $nd_travel_page->ID; ?>">
                      <?php echo $nd_travel_page->post_title; ?>
                  </option>
              <?php endforeach; ?>
            </select>
            <p class="nd_travel_color_666666 nd_travel_section nd_travel_margin_0 nd_travel_margin_top_20"><?php _e('Select the page where you have added the shortcode [nd_travel_search_results]','nd-travel'); ?></p>

          </div>
        </div>
        <!--END-->
        <div class="nd_travel_section nd_travel_height_1 nd_travel_background_color_E7E7E7 nd_travel_margin_top_10 nd_travel_margin_bottom_10"></div>




        <div class="nd_travel_section nd_travel_padding_left_20 nd_travel_padding_right_20 nd_travel_box_sizing_border_box">
          <?php submit_button(); ?>
        </div>      


      </div>
      <!--END content-->


    </div>

  </div>
</form>

<?php } 
/////////////////////////////////////////////////// END MAIN PLUGIN SETTINGS ///////////////////////////////////////////////////////////////



//include all options
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
  include_once $file;
}

