<?php



function nd_travel_get_post_img_src($nd_travel_id){

	$nd_travel_image_id = get_post_thumbnail_id($nd_travel_id);
	$nd_travel_image_attributes = wp_get_attachment_image_src( $nd_travel_image_id, 'large' );
	$nd_travel_img_src = $nd_travel_image_attributes[0];

	return $nd_travel_img_src;

}



function nd_travel_get_number_posts($nd_travel_post_type,$nd_travel_meta_query,$nd_travel_meta_query_id){

	//START IF DECIDE ARGS
	if ( $nd_travel_meta_query == 'nd_travel_meta_box_destinations' ) {

		//args for destinations
		$nd_travel_args = array(
		
			'post_type' => $nd_travel_post_type,
			'posts_per_page' => -1,

			//destinations
			'meta_query' => array(
			    array(
			        'key'     => $nd_travel_meta_query,
			        'type' => 'numeric',
			        'value'   => $nd_travel_meta_query_id,
			    )
			)

		);

	}else{

		//get typology slug
		$nd_travel_typology_slug = get_post_field( 'post_name', $nd_travel_meta_query_id );

		//args for typlogies
		$nd_travel_args = array(
		
			'post_type' => $nd_travel_post_type,
			'posts_per_page' => -1,

			//destinations
			'meta_query' => array(
			    array(
		            'key' => $nd_travel_meta_query,
		            'value'   => $nd_travel_typology_slug,
		            'compare' => 'LIKE',
		        ), 
			)

		);

	}
	//END IF DECIDE ARGS

	//args
	

	$nd_travel_the_query = new WP_Query( $nd_travel_args );

	$nd_travel_number_posts = 0;

  	while ( $nd_travel_the_query->have_posts() ) : $nd_travel_the_query->the_post();

  		$nd_travel_number_posts = $nd_travel_number_posts + 1;

  	endwhile;

  	wp_reset_postdata();


	return $nd_travel_number_posts;

}



function nd_travel_get_destinations_with_parent($nd_travel_parent_destination_id){

	$nd_travel_destinations_with_parent = array();
	$nd_travel_destinations_query_i = 0;

	$nd_travel_destinations_args = array( 
		'posts_per_page' => -1, 
		'post_type'=> 'nd_travel_cpt_3'
	);
	$nd_travel_destinations_query = new WP_Query( $nd_travel_destinations_args );


	while ( $nd_travel_destinations_query->have_posts() ) : $nd_travel_destinations_query->the_post();

		$nd_travel_meta_box_parent_destination = get_post_meta( get_the_ID(), 'nd_travel_meta_box_parent_destination', true );
		
		if ( $nd_travel_meta_box_parent_destination != 0 ) {

			if ( $nd_travel_parent_destination_id == $nd_travel_meta_box_parent_destination ) {
				$nd_travel_destinations_with_parent[$nd_travel_destinations_query_i] = get_the_ID();	
			}

		}

		$nd_travel_destinations_query_i = $nd_travel_destinations_query_i + 1;

	endwhile; 

	
	return $nd_travel_destinations_with_parent;

}





/* **************************************** START WORDPRESS INFORMATION **************************************** */

//function for get color profile admin
function nd_travel_get_profile_bg_color($nd_travel_color){
	
	global $_wp_admin_css_colors;
	$nd_travel_admin_color = get_user_option( 'admin_color' );
	
	$nd_travel_profile_bg_colors = $_wp_admin_css_colors[$nd_travel_admin_color]->colors; 


	if ( $nd_travel_profile_bg_colors[$nd_travel_color] == '#e5e5e5' ) {

		return '#6b6b6b';

	}else{

		return $nd_travel_profile_bg_colors[$nd_travel_color];
		
	}

	
}

/* **************************************** END WORDPRESS INFORMATION **************************************** */





/* **************************************** START SETTINGS **************************************** */

function nd_travel_search_page() {

  $nd_travel_search_page = get_option('nd_travel_search_page');
  $nd_travel_search_page_url = get_permalink($nd_travel_search_page);

  return $nd_travel_search_page_url;

}


function nd_travel_get_currency(){

	$nd_travel_currency = get_option('nd_travel_currency');

	return $nd_travel_currency;

}

function nd_travel_get_container(){

  $nd_travel_container = get_option('nd_travel_container');

  return $nd_travel_container;

}

/* **************************************** END SETTINGS **************************************** */



