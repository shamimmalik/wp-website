<?php


//START
add_shortcode('nd_travel_packages_pg', 'nd_travel_vc_shortcode_packages');
function nd_travel_vc_shortcode_packages($atts, $content = null)
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
    'nd_travel_destinations' => '',
    'nd_travel_typologies' => '',
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
  $nd_travel_dest = $atts['nd_travel_destinations'];
  $nd_travel_typology = $atts['nd_travel_typologies'];
  $nd_travel_padding = $atts['nd_travel_padding'];


  //default value
  if ( $nd_travel_layout == '') { $nd_travel_layout = "layout-1"; }
  if ( $nd_travel_width == '') { $nd_travel_width = "nd_travel_width_100_percentage"; }
  if ( $nd_travel_qnt == '') { $nd_travel_qnt = -1; }
  if ( $nd_travel_order == '') { $nd_travel_order = 'DESC'; }
  if ( $nd_travel_orderby == '') { $nd_travel_orderby = 'date'; }
  if ( $nd_travel_dest == '' ) { $nd_travel_dest = 0; }
  if ( $nd_travel_typology == '' ) { $nd_travel_typology = ''; }
  if ( $nd_travel_padding == '') { $nd_travel_padding = '15px'; }



  //prepare the destinations array
  $nd_travel_archive_form_destinations_array = array();
  $nd_travel_archive_form_destinations_array[0] = $nd_travel_dest;

  //if is empty insert on array all destinations
  if ( $nd_travel_archive_form_destinations_array[0] == 0 ) {

      $nd_travel_destinations_args = array( 'posts_per_page' => -1, 'post_type'=> 'nd_travel_cpt_3' );
      $nd_travel_destinations = get_posts($nd_travel_destinations_args); 
      $nd_travel_destinations_i = 0;

      foreach ($nd_travel_destinations as $nd_travel_meta_box_destination) :
                    
          $nd_travel_archive_form_destinations_array[$nd_travel_destinations_i] = $nd_travel_meta_box_destination->ID;
          $nd_travel_destinations_i = $nd_travel_destinations_i + 1;

      endforeach;

  }else{

      //start adding children ids if the parent has children
      if ( count(nd_travel_get_destinations_with_parent($nd_travel_dest)) != 0 ){

          $nd_travel_destinations_query_i = 1;
          $nd_travel_children_destinations_array = nd_travel_get_destinations_with_parent($nd_travel_dest);

          foreach ($nd_travel_children_destinations_array as $nd_travel_children_destination_id) {
              
              $nd_travel_archive_form_destinations_array[$nd_travel_destinations_query_i] = $nd_travel_children_destination_id;
              $nd_travel_destinations_query_i = $nd_travel_destinations_query_i + 1;

          }

      }
      //END

  }
  //end array with all destinations


  //get typology slug
  if( $nd_travel_typology != '' ) { 
    $nd_travel_typology_slug = get_post_field( 'post_name', $nd_travel_typology );
  }

  //args
  $args = array(
    'post_type' => 'nd_travel_cpt_1',
    'posts_per_page' => $nd_travel_qnt,
    'order' => $nd_travel_order,
    'orderby' => $nd_travel_orderby,
    'p' => $nd_travel_id,

    //destinations
    'meta_query' => array(
        array(
            'key'     => 'nd_travel_meta_box_destinations',
            'type' => 'numeric',
            'value'   => $nd_travel_archive_form_destinations_array,
        ),
        array(
            'key' => 'nd_travel_meta_box_typologies',
            'value'   => $nd_travel_typology_slug,
            'compare' => 'LIKE',
        ), 
    )

  );

  $the_query = new WP_Query( $args );

  
  //include the layout selected
  include 'layout/'.$nd_travel_layout.'.php';


  wp_reset_postdata();
  
  return apply_filters('uds_shortcode_out_filter', $str);

}
//END





//vc
add_action( 'vc_before_init', 'nd_travel_packages_pg' );
function nd_travel_packages_pg() {


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



  //get all destinations
  $nd_travel_dests = get_posts( 'post_type="nd_travel_cpt_3"&numberposts=-1' );
  $nd_travel_destinations = array();
  if ( $nd_travel_dests ) {

    //first value
    $nd_travel_destinations[__('All Destinations','nd-travel')] = '';

    foreach ( $nd_travel_dests as $nd_travel_dest ) {
      $nd_travel_destinations[ $nd_travel_dest->post_title ] = $nd_travel_dest->ID;
    }
  } else {
    $nd_travel_destinations[ __( 'No destinations found', 'nd-travel' ) ] = 0;
  }
  //END get all destinations




  //get all typologies
  $nd_travel_typos = get_posts( 'post_type="nd_travel_cpt_2"&numberposts=-1' );
  $nd_travel_typologies = array();
  if ( $nd_travel_typos ) {

    //first value
    $nd_travel_typologies[__('All Typologies','nd-travel')] = '';

    foreach ( $nd_travel_typos as $nd_travel_typo ) {
      $nd_travel_typologies[ $nd_travel_typo->post_title ] = $nd_travel_typo->ID;
    }
  } else {
    $nd_travel_typologies[ __( 'No typologies found', 'nd-travel' ) ] = 0;
  }
  //END get all destinations



  //START image size
  $nd_travel_image_sizes = get_intermediate_image_sizes(); 
  //END image size


   vc_map( array(
      "name" => __( "Packages", "nd-travel" ),
      "base" => "nd_travel_packages_pg",
      'description' => __( 'Add packages Post Grid', 'nd-travel' ),
      'show_settings_on_create' => true,
      "icon" => plugins_url() . "/nd-travel/addons/visual/thumb/pg-packages.jpg",
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
          'description' => __( "Select the width for room preview grid", "nd-travel" )
         ),
          array(
            "type" => "textfield",
            "class" => "",
            "heading" => __( "Qnt packages", "nd-travel" ),
            "param_name" => "nd_travel_qnt",
            "description" => __( "Insert the quantity of packages that you want display.", "nd-travel" )
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
            "heading" => __( "ID room", "nd-travel" ),
            "param_name" => "nd_travel_id",
            "description" => __( "Insert the id of the room that you want display ( NB: only one room )", "nd-travel" )
         ),
           array(
          'type' => 'dropdown',
          'heading' => __( 'Destinations', 'nd-travel' ),
          'param_name' => 'nd_travel_destinations',
          'value' => $nd_travel_destinations,
          'save_always' => true,
          'description' => __( 'Select the destination that you want to filter', 'nd-travel' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Typologies', 'nd-travel' ),
          'param_name' => 'nd_travel_typologies',
          'value' => $nd_travel_typologies,
          'save_always' => true,
          'description' => __( 'Select the typology that you want to filter', 'nd-travel' ),
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
            'dependency' => array( 'element' => 'nd_travel_layout', 'value' => array( 'layout-3' ) )
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