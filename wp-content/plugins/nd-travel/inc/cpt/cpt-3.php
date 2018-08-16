<?php

///////////////////////////////////////////////////CPT3///////////////////////////////////////////////////////////////
function nd_travel_create_post_type_3() {

    register_post_type('nd_travel_cpt_3',
        array(
            'labels' => array(
                'name' => __('Destinations', 'nd-travel'),
                'singular_name' => __('Destinations', 'nd-travel')
            ),
            'public' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'menu_icon'   => 'dashicons-admin-site',
            'has_archive' => true,
            'exclude_from_search' => true,
            'rewrite' => array('slug' => 'destinations'),
            'supports' => array('title','editor','thumbnail')
        )
    );
}
add_action('init', 'nd_travel_create_post_type_3');

