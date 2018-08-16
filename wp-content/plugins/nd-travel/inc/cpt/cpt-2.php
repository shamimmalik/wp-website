<?php

///////////////////////////////////////////////////CPT2///////////////////////////////////////////////////////////////
function nd_travel_create_post_type_2() {

    register_post_type('nd_travel_cpt_2',
        array(
            'labels' => array(
                'name' => __('Typologies', 'nd-travel'),
                'singular_name' => __('Typologies', 'nd-travel')
            ),
            'public' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'typologies' ),
            'menu_icon'   => 'dashicons-networking',
            'supports' => array('title', 'editor', 'thumbnail' )
        )
    );
}
add_action('init', 'nd_travel_create_post_type_2');

