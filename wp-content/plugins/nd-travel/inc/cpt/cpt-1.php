<?php

///////////////////////////////////////////////////CPT1///////////////////////////////////////////////////////////////
function nd_travel_create_post_type_1() {

    register_post_type('nd_travel_cpt_1',
        array(
            'labels' => array(
                'name' => __('Packages', 'nd-travel'),
                'singular_name' => __('Packages', 'nd-travel')
            ),
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'packages' ),
            'menu_icon'   => 'dashicons-palmtree',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt' )
        )
    );
}
add_action('init', 'nd_travel_create_post_type_1');


//START create sidebar
function nd_travel_single_travel_sidebar() {

  // Sidebar Main
  register_sidebar(array(
      'name' =>  esc_html__('ND Travel Sidebar','nd-travel'),
      'id' => 'nd_travel_sidebar_cpt_1',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h3>',
      'after_title' => '</h3>',
  ));

}
add_action( 'widgets_init', 'nd_travel_single_travel_sidebar' );
//END create sidebar



///////////////////////////////////////////////////TAXONOMIES///////////////////////////////////////////////////////////////

//Durations
function nd_travel_create_taxonomies_cpt_1() {
    
    register_taxonomy(
        'nd_travel_cpt_1_tax_1',
        'post',
        array(
            'label'=>__('Durations', 'nd-travel'),
            'rewrite'=>array('slug'=>'durations-packages'),
            'hierarchical'=>true
        )
    );

    register_taxonomy(
        'nd_travel_cpt_1_tax_2',
        'post',
        array(
            'label'=>__('Difficulty', 'nd-travel'),
            'rewrite'=>array('slug'=>'difficulty-packages'),
            'hierarchical'=>true
        )
    );

    register_taxonomy(
        'nd_travel_cpt_1_tax_3',
        'post',
        array(
            'label'=>__('Min Age', 'nd-travel'),
            'rewrite'=>array('slug'=>'minage-packages'),
            'hierarchical'=>true
        )
    );

}
add_action('init','nd_travel_create_taxonomies_cpt_1');


///////////////////////////////////////////////////ADD TAXONOMIES TO CPT///////////////////////////////////////////////////////////////
function nd_travel_add_taxonomies_to_cpt_1(){ 
 
    register_taxonomy_for_object_type('nd_travel_cpt_1_tax_1', 'nd_travel_cpt_1'); 
    register_taxonomy_for_object_type('nd_travel_cpt_1_tax_2', 'nd_travel_cpt_1'); 
    register_taxonomy_for_object_type('nd_travel_cpt_1_tax_3', 'nd_travel_cpt_1'); 

}
add_action('init', 'nd_travel_add_taxonomies_to_cpt_1');




