<?php


//header
get_header( );

$nd_travel_result = '';


//set page layout
$nd_travel_meta_box_page_layout_cpt_2 = get_post_meta( get_the_ID(), 'nd_travel_meta_box_page_layout_cpt_2', true );

//default
if ( $nd_travel_meta_box_page_layout_cpt_2 == '' ) { $nd_travel_meta_box_page_layout_cpt_2 = 'layout-1'; }

include 'cpt-2-layouts/'.$nd_travel_meta_box_page_layout_cpt_2.'.php';


echo $nd_travel_result;


//footer
get_footer( );


