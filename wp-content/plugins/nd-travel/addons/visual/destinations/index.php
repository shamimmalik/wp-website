<?php


//START
add_shortcode('nd_travel_destinations_pg', 'nd_travel_vc_shortcode_destinations');
function nd_travel_vc_shortcode_destinations($atts, $content = null)
{  

  $atts = shortcode_atts(
  array(
    'nd_travel_class' => '',
    'nd_travel_layout' => '',
    'nd_travel_width' => '',
    'nd_travel_qnt' => '',
    'nd_travel_id' => '',
    'nd_travel_order' => '',
    'nd_travel_orderby' => '',
    'nd_travel_image_size' => '',
    'nd_travel_padding' => '',
  ), $atts);

  $str = '';

  //get variables
  $nd_travel_class = $atts['nd_travel_class'];
  $nd_travel_layout = $atts['nd_travel_layout'];
  $nd_travel_width = $atts['nd_travel_width'];
  $nd_travel_qnt = $atts['nd_travel_qnt'];
  $nd_travel_id = $atts['nd_travel_id'];
  $nd_travel_order = $atts['nd_travel_order'];
  $nd_travel_orderby = $atts['nd_travel_orderby'];
  $nd_travel_image_size = $atts['nd_travel_image_size'];
  $nd_travel_padding = $atts['nd_travel_padding'];


  //default value
  if ($nd_travel_layout == '') { $nd_travel_layout = "layout-1"; }
  if ($nd_travel_width == '') { $nd_travel_width = "nd_travel_width_100_percentage"; }
  if ($nd_travel_qnt == '') { $nd_travel_qnt = -1; }
  if ($nd_travel_order == '') { $nd_travel_order = 'DESC'; }
  if ($nd_travel_orderby == '') { $nd_travel_orderby = 'date'; }
  if ( $nd_travel_padding == '') { $nd_travel_padding = '15px'; }

  
  //args
  $args = array(
    'post_type' => 'nd_travel_cpt_3',
    'posts_per_page' => $nd_travel_qnt,
    'order' => $nd_travel_order,
    'orderby' => $nd_travel_orderby,
    'p' => $nd_travel_id
  );

  $the_query = new WP_Query( $args );

  
  //include the layout selected
  include 'layout/'.$nd_travel_layout.'.php';


  wp_reset_postdata();
  
  return apply_filters('uds_shortcode_out_filter', $str);

}
//END





//vc
add_action( 'vc_before_init', 'nd_travel_destinations_pg' );
function nd_travel_destinations_pg() {


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



  //START image size
  $nd_travel_image_sizes = get_intermediate_image_sizes(); 
  //END image size


   vc_map( array(
      "name" => __( "Destinations", "nd-travel" ),
      "base" => "nd_travel_destinations_pg",
      'description' => __( 'Add destinations Post Grid', 'nd-travel' ),
      'show_settings_on_create' => true,
      "icon" => plugins_url() . "/nd-travel/addons/visual/thumb/pg-destinations.jpg",
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
          "heading" => __( "Width", "nd-travel" ),
          'param_name' => 'nd_travel_width',
          'value' => array( __( 'Select Width', 'nd-travel' ) => 'nd_travel_width_100_percentage nd_travel_float_left', __( '20 %', 'nd-travel' ) => 'nd_travel_width_20_percentage nd_travel_float_left', __( '25 %', 'nd-travel' ) => 'nd_travel_width_25_percentage nd_travel_float_left', __( '33 %', 'nd-travel' ) => 'nd_travel_width_33_percentage nd_travel_float_left', __( '50 %', 'nd-travel' ) => 'nd_travel_width_50_percentage nd_travel_float_left', __( '100 %', 'nd-travel' ) => 'nd_travel_width_100_percentage nd_travel_float_left' ),
          'description' => __( "Select the width for destination preview grid", "nd-travel" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Qnt destinations", "nd-travel" ),
            "param_name" => "nd_travel_qnt",
            "description" => __( "Insert the quantity of destinations that you want display.", "nd-travel" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Order", "nd-travel" ),
          'param_name' => 'nd_travel_order',
          'value' => array('DESC','ASC'),
          'description' => __( "Select the Order paramater, more info <a target='_blank' href='https://codex.wordpress.org/it:Riferimento_classi/WP_Query#Parametri_Order_.26_Orderby'>here</a>", "nd-travel" )
         ),
          array(
         'type' => 'dropdown',
          "heading" => __( "Order By", "nd-travel" ),
          'param_name' => 'nd_travel_orderby',
          'value' => array('none','ID','author','title','name','date','modified','rand','comment_count'),
          'description' => __( "Select the OrderBy paramater, more info <a target='_blank' href='https://codex.wordpress.org/it:Riferimento_classi/WP_Query#Parametri_Order_.26_Orderby'>here</a>", "nd-travel" )
         ),
           array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "ID destination", "nd-travel" ),
            "param_name" => "nd_travel_id",
            "description" => __( "Insert the id of the destination that you want display ( NB: only one destination )", "nd-travel" )
         ),
         array(
          'type' => 'dropdown',
          'heading' => __( 'Image Size', 'nd-travel' ),
          'param_name' => 'nd_travel_image_size',
          'value' => $nd_travel_image_sizes,
          'save_always' => true,
          'description' => __( 'Choose the image size that you want to use', 'nd-travel' ),
        ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Padding", "nd-travel" ),
            "param_name" => "nd_travel_padding",
            "description" => __( "Insert the padding in px ( eg : 20px or 10px 15px 20px 25px )", "nd-travel" ),
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