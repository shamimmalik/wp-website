<?php


//header
get_header( );

$nd_travel_result = '';


//set page layout
$nd_travel_meta_box_page_layout = get_post_meta( get_the_ID(), 'nd_travel_meta_box_page_layout', true );

//default
if ( $nd_travel_meta_box_page_layout == '' ) { $nd_travel_meta_box_page_layout = 'layout-1'; }

include 'cpt-1-layouts/'.$nd_travel_meta_box_page_layout.'.php';


echo $nd_travel_result;


//footer
get_footer( );


