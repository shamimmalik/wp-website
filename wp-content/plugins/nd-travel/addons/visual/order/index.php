<?php


//START
add_shortcode('nd_travel_order', 'nd_travel_vc_shortcode_order');
function nd_travel_vc_shortcode_order($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_travel_class' => '',
    'nd_travel_layout' => '',
    'nd_travel_bg_color' => '',
    'nd_travel_bg_color_2' => '',
    'nd_travel_text_color' => '',
    'nd_travel_text_color_active' => '',
    'nd_travel_arrow_image' => '',
    'nd_travel_list_image' => '',
    'nd_travel_grid_image' => '',
  ), $atts);

  $str = '';

  //get variables
  $nd_travel_class = $atts['nd_travel_class'];
  $nd_travel_layout = $atts['nd_travel_layout'];
  $nd_travel_bg_color = $atts['nd_travel_bg_color'];
  $nd_travel_bg_color_2 = $atts['nd_travel_bg_color_2'];
  $nd_travel_text_color = $atts['nd_travel_text_color'];
  $nd_travel_text_color_active = $atts['nd_travel_text_color_active'];
  $nd_travel_arrow_image = $atts['nd_travel_arrow_image'];
  $nd_travel_list_image = $atts['nd_travel_list_image'];
  $nd_travel_grid_image = $atts['nd_travel_grid_image'];

  //images
  if ( $nd_travel_arrow_image == '' ) { 
    $nd_travel_arrow_image_src = plugins_url().'/nd-travel/assets/img/icons/icon-down-arrow-white.svg '; 
  }else{
    $nd_travel_arrow_image_src = wp_get_attachment_image_src($nd_travel_arrow_image,'large');
  }

  if ( $nd_travel_list_image == '' ) { 
    $nd_travel_list_image_src = plugins_url().'/nd-travel/assets/img/icons/icon-list-white.svg'; 
  }else{
    $nd_travel_list_image_src = wp_get_attachment_image_src($nd_travel_list_image,'large');
  }

  if ( $nd_travel_grid_image == '' ) { 
    $nd_travel_grid_image_src = plugins_url().'/nd-travel/assets/img/icons/icon-grid-grey.svg'; 
  }else{
    $nd_travel_grid_image_src = wp_get_attachment_image_src($nd_travel_grid_image,'large');
  }
  

  //default value
  if ($nd_travel_layout == '') { $nd_travel_layout = "layout-1"; }

  //include the layout selected
  include 'layout/'.$nd_travel_layout.'.php';

  return apply_filters('uds_shortcode_out_filter', $str);

}
//END





//vc
add_action( 'vc_before_init', 'nd_travel_order' );
function nd_travel_order() {


  //START get all layout
  $nd_travel_layouts = array();

  //php function to descover all name files in directory
  $nd_travel_directory = plugin_dir_path( __FILE__ ) .'layout/';
  $nd_travel_layouts = scandir($nd_travel_directory);


  //cicle for delete hidden file that not are php files
  $i = 0;
  foreach ($nd_travel_layouts as $value) {
    
    //remove all files that aren't php
    if ( strpos( $nd_travel_layouts[$i] , ".php" ) != true ){
      unset($nd_travel_layouts[$i]);
    }else{
      $nd_travel_layout_name = str_replace(".php","",$nd_travel_layouts[$i]);
      $nd_travel_layouts[$i] = $nd_travel_layout_name;
    } 
    $i++; 

  }
  //END get all layout


   vc_map( array(
      "name" => __( "Order", "nd-travel" ),
      "base" => "nd_travel_order",
      'description' => __( 'Add Order', 'nd-travel' ),
      'show_settings_on_create' => true,
      "icon" => plugins_url() . "/nd-travel/addons/visual/thumb/order.jpg",
      "class" => "",
      "category" => __( "ND Travel", "nd-travel"),
      "params" => array(
   

          array(
           'type' => 'dropdown',
            'heading' => __( 'Layout', 'nd-travel' ),
            'param_name' => 'nd_travel_layout',
            'value' => $nd_travel_layouts,
            'description' => __( "Choose the layout", "nd-travel" )
         ),
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Custom class", "nd-travel" ),
            "param_name" => "nd_travel_class",
            "description" => __( "Insert custom class", "nd-travel" )
         ),

         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Bg color", "nd-travel" ),
            "param_name" => "nd_travel_bg_color",
            "description" => __( "Insert bg color", "nd-travel" ),
            'dependency' => array( 'element' => 'nd_travel_layout', 'value' => array( 'layout-2' ) )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Bg color 2", "nd-travel" ),
            "param_name" => "nd_travel_bg_color_2",
            "description" => __( "Insert bg color 2", "nd-travel" ),
            'dependency' => array( 'element' => 'nd_travel_layout', 'value' => array( 'layout-2' ) )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Text Color", "nd-travel" ),
            "param_name" => "nd_travel_text_color",
            "description" => __( "Insert text color", "nd-travel" ),
            'dependency' => array( 'element' => 'nd_travel_layout', 'value' => array( 'layout-2' ) )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Text Color Active", "nd-travel" ),
            "param_name" => "nd_travel_text_color_active",
            "description" => __( "Insert text active color", "nd-travel" ),
            'dependency' => array( 'element' => 'nd_travel_layout', 'value' => array( 'layout-2' ) )
         ),

         array(
            'type' => 'attach_image',
            'heading' => __( 'Arrow Icon', 'nd-travel' ),
            'param_name' => 'nd_travel_arrow_image',
            'description' => __( 'Select image from media library.', 'nd-travel' ),
            'dependency' => array( 'element' => 'nd_travel_layout', 'value' => array( 'layout-2' ) )
         ),
         array(
            'type' => 'attach_image',
            'heading' => __( 'List Icon', 'nd-travel' ),
            'param_name' => 'nd_travel_list_image',
            'description' => __( 'Select image from media library.', 'nd-travel' ),
            'dependency' => array( 'element' => 'nd_travel_layout', 'value' => array( 'layout-2' ) )
         ),
         array(
            'type' => 'attach_image',
            'heading' => __( 'Grid Icon', 'nd-travel' ),
            'param_name' => 'nd_travel_grid_image',
            'description' => __( 'Select image from media library.', 'nd-travel' ),
            'dependency' => array( 'element' => 'nd_travel_layout', 'value' => array( 'layout-2' ) )
         ),
         

        
      )
   ) );
}
//end shortcode