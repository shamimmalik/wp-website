<?php



add_action('customize_register','nd_travel_customizer_nd_travel');
function nd_travel_customizer_nd_travel( $wp_customize ) {
  

	//ADD panel
	$wp_customize->add_panel( 'nd_travel_customizer_travel', array(
	  'title' => __( 'ND Travel' ),
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '',
	  'description' => __( 'Plugin Settings' ), // Include html tags such as <p>.
	  'priority' => 320, // Mixed with top-level-section hierarchy.
	) );


}



//include all options
foreach ( glob ( plugin_dir_path( __FILE__ ) . "*/index.php" ) as $file ){
  include_once $file;
}
