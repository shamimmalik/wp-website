<?php


//START
add_shortcode('nd_travel_search', 'nd_travel_vc_shortcode_search');
function nd_travel_vc_shortcode_search($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_travel_class' => '',
    'nd_travel_layout' => '',
    'nd_travel_style' => '',
    'nd_travel_width' => '',
    'nd_travel_fields_padding' => '',
    'nd_travel_submit_padding' => '',
    'nd_travel_submit_bg' => '',
    'nd_travel_submit_width' => '',
    'nd_travel_action' => '',
    'nd_travel_remove_fields' => '',
    'nd_travel_hide_keyword' => '',
    'nd_travel_hide_destinations' => '',
    'nd_travel_hide_typologies' => '',
    'nd_travel_hide_durations' => '',
    'nd_travel_hide_difficulty' => '',
    'nd_travel_hide_minage' => '',
  ), $atts);


  //generate id
  $nd_travel_search_component_id = rand(100000, 999999);


  $nd_travel_str = '';


  //START hide tax
  if ( $atts['nd_travel_remove_fields'] == 'yes' ) {

    $nd_travel_str .= '<style>';

    if ( $atts['nd_travel_hide_keyword'] == 1 ) { $nd_travel_str .= '#nd_travel_search_component_id_'.$nd_travel_search_component_id.'  #nd_travel_search_components_keyword{ display:none; } '; }
    if ( $atts['nd_travel_hide_destinations'] == 1 ) { $nd_travel_str .= '#nd_travel_search_component_id_'.$nd_travel_search_component_id.' #nd_travel_search_components_destinations{ display:none; } '; }
    if ( $atts['nd_travel_hide_typologies'] == 1 ) { $nd_travel_str .= '#nd_travel_search_component_id_'.$nd_travel_search_component_id.' #nd_travel_search_components_typlogies{ display:none; } '; }
    if ( $atts['nd_travel_hide_durations'] == 1 ) { $nd_travel_str .= '#nd_travel_search_component_id_'.$nd_travel_search_component_id.' #nd_travel_search_components_tax_0{ display:none; } '; }
    if ( $atts['nd_travel_hide_difficulty'] == 1 ) { $nd_travel_str .= '#nd_travel_search_component_id_'.$nd_travel_search_component_id.' #nd_travel_search_components_tax_1{ display:none; } '; }
    if ( $atts['nd_travel_hide_minage'] == 1 ) { $nd_travel_str .= '#nd_travel_search_component_id_'.$nd_travel_search_component_id.' #nd_travel_search_components_tax_2{ display:none; } '; }

    $nd_travel_str .= '</style>';

  }
  //END hide tax


  //START style fields
  if ( $atts['nd_travel_style'] == 'nd_travel_dark_fields' ) {

    $nd_travel_customizer_color_dark_2 = get_option( 'nd_travel_customizer_color_dark_2', '#151515' );

    $nd_travel_str .= '
    <style>
    .nd_travel_dark_fields {
      background-color: '.$nd_travel_customizer_color_dark_2.' !important;
      border-width: 0px !important;
    } 
    </style>';

    $nd_travel_field_class = 'nd_travel_dark_fields';

  }else{
    $nd_travel_field_class = '';  
  }


  //get variables
  $nd_travel_class = $atts['nd_travel_class'];
  $nd_travel_width = $atts['nd_travel_width'];
  $nd_travel_action = $atts['nd_travel_action']; if ( $nd_travel_action == '' ) { $nd_travel_action = nd_travel_search_page(); }else{ $nd_travel_action = get_the_permalink($nd_travel_action); }
  $nd_travel_layout = $atts['nd_travel_layout'];

  $nd_travel_submit_padding = $atts['nd_travel_submit_padding'];
  $nd_travel_fields_padding = $atts['nd_travel_fields_padding'];
  $nd_travel_submit_bg = $atts['nd_travel_submit_bg'];
  $nd_travel_submit_width = $atts['nd_travel_submit_width'];

  //default value
  if ($nd_travel_layout == '') { $nd_travel_layout = "layout-1"; }
  if ($nd_travel_width == '') { $nd_travel_width = "nd_travel_width_100_percentage"; }
  if ($nd_travel_submit_width == '') { $nd_travel_submit_width = "nd_travel_width_100_percentage"; }

  //include the layout selected
  include 'layout/'.$nd_travel_layout.'.php';

  return apply_filters('uds_shortcode_out_filter', $nd_travel_str);

}
//END





//vc
add_action( 'vc_before_init', 'nd_travel_search' );
function nd_travel_search() {


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
      "name" => __( "Search", "nd-travel" ),
      "base" => "nd_travel_search",
      'description' => __( 'Add search', 'nd-travel' ),
      'show_settings_on_create' => true,
      "icon" => plugins_url() . "/nd-travel/addons/visual/thumb/search.jpg",
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
            'type' => 'dropdown',
            "heading" => __( "Fields Style", "nd-travel" ),
            'param_name' => 'nd_travel_style',
            'value' => array( __( 'Select Style', 'nd-travel' ) => ' ', __( 'Default Style', 'nd-travel' ) => 'nd_travel_default_fields', __( 'Dark Style', 'nd-travel' ) => 'nd_travel_dark_fields'),
            'description' => __( "Select if you want the default fields style or the dark version", "nd-travel" )
         ),
          array(
            'type' => 'dropdown',
            "heading" => __( "Width", "nd-travel" ),
            'param_name' => 'nd_travel_width',
            'value' => array( __( 'Select Width', 'nd-travel' ) => 'nd_travel_width_100_percentage nd_travel_float_left', __( '20 %', 'nd-travel' ) => 'nd_travel_width_20_percentage nd_travel_float_left', __( '25 %', 'nd-travel' ) => 'nd_travel_width_25_percentage nd_travel_float_left', __( '33 %', 'nd-travel' ) => 'nd_travel_width_33_percentage nd_travel_float_left', __( '50 %', 'nd-travel' ) => 'nd_travel_width_50_percentage nd_travel_float_left', __( '100 %', 'nd-travel' ) => 'nd_travel_width_100_percentage nd_travel_float_left' ),
            'description' => __( "Select the width", "nd-travel" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Fields Padding", "nd-travel" ),
            "param_name" => "nd_travel_fields_padding",
            "description" => __( "Insert the padding of all fields in px ( eg : '20px' or '20px 15px' for top/bottom and left/right )", "nd-travel" )
         ),
          array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Submit Bg Color", "nd-travel" ),
            "param_name" => "nd_travel_submit_bg",
            "description" => __( "Choose submit bg color", "nd-travel" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Submit Padding", "nd-travel" ),
            "param_name" => "nd_travel_submit_padding",
            "description" => __( "Insert the submit padding in px ( eg : '20px' or '20px 15px' for top/bottom and left/right )", "nd-travel" )
         ),
           array(
            'type' => 'dropdown',
            "heading" => __( "Submit Width", "nd-travel" ),
            'param_name' => 'nd_travel_submit_width',
            'value' => array( __( 'Select Width', 'nd-travel' ) => 'nd_travel_width_100_percentage nd_travel_float_left', __( '20 %', 'nd-travel' ) => 'nd_travel_width_20_percentage nd_travel_float_left', __( '25 %', 'nd-travel' ) => 'nd_travel_width_25_percentage nd_travel_float_left', __( '33 %', 'nd-travel' ) => 'nd_travel_width_33_percentage nd_travel_float_left', __( '50 %', 'nd-travel' ) => 'nd_travel_width_50_percentage nd_travel_float_left', __( '100 %', 'nd-travel' ) => 'nd_travel_width_100_percentage nd_travel_float_left' ),
            'description' => __( "Select the width of your button", "nd-travel" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Action Page ID", "nd-travel" ),
            "param_name" => "nd_travel_action",
            "description" => __( "Action Page ID ( not mandatory ), use this field ONLY if you want to redirect the search button to a different page, insert only the ID of your site page ( only number )", "nd-travel" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Remove fields", "nd-travel" ),
          'param_name' => 'nd_travel_remove_fields',
          'value' => array(__('Select','nd-travel')=>' ',__('Yes','nd-travel')=>'yes',__('Not','nd-travel')=>'not'),
          'description' => __( "Select if you want to remove some fields", "nd-travel" )
         ),
        array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Keyword Field', 'nd-travel' ),
          'param_name' => 'nd_travel_hide_keyword',
          'value' => array( __( 'Yes', 'nd-travel' ) => '1' ),
          'dependency' => array( 'element' => 'nd_travel_remove_fields', 'value' => 'yes' )
        ), 
        array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Destinations Field', 'nd-travel' ),
          'param_name' => 'nd_travel_hide_destinations',
          'value' => array( __( 'Yes', 'nd-travel' ) => '1' ),
          'dependency' => array( 'element' => 'nd_travel_remove_fields', 'value' => 'yes' )
        ), 
        array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Typologies Field', 'nd-travel' ),
          'param_name' => 'nd_travel_hide_typologies',
          'value' => array( __( 'Yes', 'nd-travel' ) => '1' ),
          'dependency' => array( 'element' => 'nd_travel_remove_fields', 'value' => 'yes' )
        ), 
        array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Durations Field', 'nd-travel' ),
          'param_name' => 'nd_travel_hide_durations',
          'value' => array( __( 'Yes', 'nd-travel' ) => '1' ),
          'dependency' => array( 'element' => 'nd_travel_remove_fields', 'value' => 'yes' )
        ), 
        array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Difficulty Field', 'nd-travel' ),
          'param_name' => 'nd_travel_hide_difficulty',
          'value' => array( __( 'Yes', 'nd-travel' ) => '1' ),
          'dependency' => array( 'element' => 'nd_travel_remove_fields', 'value' => 'yes' )
        ), 
        array(
          'type' => 'checkbox',
          'heading' => __( 'Hide Min Age Field', 'nd-travel' ),
          'param_name' => 'nd_travel_hide_minage',
          'value' => array( __( 'Yes', 'nd-travel' ) => '1' ),
          'dependency' => array( 'element' => 'nd_travel_remove_fields', 'value' => 'yes' )
        ), 
         array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Custom class", "nd-travel" ),
            "param_name" => "nd_travel_class",
            "description" => __( "Insert custom class", "nd-travel" )
         )

        
      )
   ) );
}
//end shortcode







function nd_travel_build_select($nd_travel_tax,$nd_travel_i,$nd_travel_width,$nd_travel_fields_padding,$nd_travel_field_class){ 
  
  //declare
  $nd_travel_select = '';

  //get all terms
  $nd_travel_terms = get_terms($nd_travel_tax);
  
  //get tax
  $nd_travel_the_tax = get_taxonomy($nd_travel_tax);
  
  //get name
  $nd_travel_tax_name = $nd_travel_the_tax->labels->name;



  //START LAYOUT 1
  $nd_travel_select .= '

  <div style="padding:'.$nd_travel_fields_padding.';" id="nd_travel_search_components_tax_'.$nd_travel_i.'" class=" '.$nd_travel_width.' nd_travel_float_left nd_travel_width_100_percentage_responsive nd_travel_box_sizing_border_box">

  <select class="nd_travel_section '.$nd_travel_field_class.' " name="'.$nd_travel_tax.'">';

  //default value
  $nd_travel_select .= '<option value="">'.__('All','nd-travel').' '. $nd_travel_tax_name .'</option>';

  //built options
  foreach ($nd_travel_terms as $nd_travel_term) {
    $nd_travel_select .= '<option value="' . $nd_travel_term->term_id . '">' . $nd_travel_term->name . '</option>';  
  }

  $nd_travel_select .= '</select></div>';
  //END LAYOUT 1

  return $nd_travel_select;

}
