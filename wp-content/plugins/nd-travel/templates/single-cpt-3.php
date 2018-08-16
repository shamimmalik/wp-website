<?php


//header
get_header( );

$nd_travel_result = '';


//set page layout
$nd_travel_meta_box_page_layout_cpt_3 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_page_layout_cpt_3', true );

//default
if ( $nd_travel_meta_box_page_layout_cpt_3 == '' ) { $nd_travel_meta_box_page_layout_cpt_3 = 'layout-1'; }

include 'cpt-3-layouts/'.$nd_travel_meta_box_page_layout_cpt_3.'.php';


echo $nd_travel_result;


//footer
get_footer( );


