<?php


//START  nd_travel_search_results
function nd_travel_shortcode_search_results($nd_travel_ssr_atts) {

    //parameters
    $nd_travel_shortcode_search_results = shortcode_atts( 
        array(
            'pagination' => '',
            'price_min_value' => '',
            'price_default_value' => '',
            'price_max_value' => '',
            'price' => '',
            'destinations' => '',
            'date' => '',
            'typologies' => '',
            'durations' => '',
            'difficulties' => '',
            'minages' => '',
            'sidebar' => '',
        ), 
    $nd_travel_ssr_atts );

    //default value
    if ( $nd_travel_shortcode_search_results['pagination'] == '' ) { $nd_travel_shortcode_search_results['pagination'] = 4; }
    if ( $nd_travel_shortcode_search_results['price_min_value'] == '' ) { $nd_travel_shortcode_search_results['price_min_value'] = 0; }
    if ( $nd_travel_shortcode_search_results['price_default_value'] == '' ) { $nd_travel_shortcode_search_results['price_default_value'] = 5000; }
    if ( $nd_travel_shortcode_search_results['price_max_value'] == '' ) { $nd_travel_shortcode_search_results['price_max_value'] = 10000; }
    if ( $nd_travel_shortcode_search_results['price'] == '' ) { $nd_travel_shortcode_search_results['price'] = 'enable'; }
    if ( $nd_travel_shortcode_search_results['destinations'] == '' ) { $nd_travel_shortcode_search_results['destinations'] = 'enable'; } 
    if ( $nd_travel_shortcode_search_results['destinations'] != 'enable' ) { $nd_travel_destinations_class = "nd_travel_display_none"; }else{ $nd_travel_destinations_class = ""; }
    if ( $nd_travel_shortcode_search_results['date'] == '' ) { $nd_travel_shortcode_search_results['date'] = 'enable'; }
    if ( $nd_travel_shortcode_search_results['date'] != 'enable' ) { $nd_travel_date_class = "nd_travel_display_none"; }else{ $nd_travel_date_class = ""; }
    if ( $nd_travel_shortcode_search_results['typologies'] == '' ) { $nd_travel_shortcode_search_results['typologies'] = 'enable'; }
    if ( $nd_travel_shortcode_search_results['typologies'] != 'enable' ) { $nd_travel_typologies_class = "nd_travel_display_none"; }else{ $nd_travel_typologies_class = ""; }
    if ( $nd_travel_shortcode_search_results['durations'] == '' ) { $nd_travel_shortcode_search_results['durations'] = 'enable'; }
    if ( $nd_travel_shortcode_search_results['durations'] != 'enable' ) { $nd_travel_durations_class = "nd_travel_display_none"; }else{ $nd_travel_durations_class = ""; }
    if ( $nd_travel_shortcode_search_results['difficulties'] == '' ) { $nd_travel_shortcode_search_results['difficulties'] = 'enable'; }
    if ( $nd_travel_shortcode_search_results['difficulties'] != 'enable' ) { $nd_travel_difficulties_class = "nd_travel_display_none"; }else{ $nd_travel_difficulties_class = ""; }
    if ( $nd_travel_shortcode_search_results['minages'] == '' ) { $nd_travel_shortcode_search_results['minages'] = 'enable'; }
    if ( $nd_travel_shortcode_search_results['minages'] != 'enable' ) { $nd_travel_minages_class = "nd_travel_display_none"; }else{ $nd_travel_minages_class = ""; }
    if ( $nd_travel_shortcode_search_results['sidebar'] == '' ) { $nd_travel_shortcode_search_results['sidebar'] = 'enable'; }


    $nd_travel_hidden_values = '
    <input type="hidden" value="'.$nd_travel_shortcode_search_results['pagination'].'" name="nd_travel_pagination" id="nd_travel_pagination">
    <input type="hidden" value="'.$nd_travel_shortcode_search_results['price'].'" name="nd_travel_price" id="nd_travel_price">
    ';


    wp_enqueue_script('masonry');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-ui-datepicker-css', plugins_url() . '/nd-travel/assets/css/jquery-ui-datepicker.css' );
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('jquery-ui-tooltip');

    //ajax results
    wp_enqueue_script( 'nd_travel_search_sorting', plugins_url() . '/nd-travel/assets/js/sorting.js', array( 'jquery' ) ); 
    wp_localize_script( 'nd_travel_search_sorting', 'nd_travel_my_vars_sorting', array( 'nd_travel_ajaxurl_sorting'   => admin_url( 'admin-ajax.php' )) ); 


    //default datas
    if( isset( $_GET['nd_travel_archive_form_keyword'] ) ) { $nd_travel_archive_form_keyword = $_GET['nd_travel_archive_form_keyword']; } else { $nd_travel_archive_form_keyword = ''; }
    if( isset( $_GET['nd_travel_archive_form_destinations'] ) ) { $nd_travel_archive_form_destinations = $_GET['nd_travel_archive_form_destinations']; } else { $nd_travel_archive_form_destinations = ''; }
    if( isset( $_GET['nd_travel_typology_slug'] ) ) { 

        if ( $_GET['nd_travel_typology_slug'] == '' ) { 
            $nd_travel_typology_idd = '';
            $nd_travel_typology_idd_value = ''; 
            $nd_travel_typology_slug = ''; 
        }else{
            $nd_travel_typology_idd = $_GET['nd_travel_typology_slug']; 
            $nd_travel_typology_slug = get_post_field( 'post_name', $nd_travel_typology_idd );
            $nd_travel_typology_idd_value = $nd_travel_typology_idd.','; 
        }
        
    } else { 
        $nd_travel_typology_idd = ''; 
        $nd_travel_typology_idd_value = ''; 
        $nd_travel_typology_slug = ''; 
    }

    //tax 1
    if( isset( $_GET['nd_travel_cpt_1_tax_1'] ) ) { 

        if ( $_GET['nd_travel_cpt_1_tax_1'] == '' ) { 
            $nd_travel_cpt_1_tax_1_slug = '';
            $nd_travel_cpt_1_tax_1_id = ''; 
            $nd_travel_cpt_1_tax_1_id_value = ''; 
        }else{
            
            $nd_travel_cpt_1_tax_1_id = $_GET['nd_travel_cpt_1_tax_1'];
            $nd_travel_cpt_1_tax_1_id_value = $nd_travel_cpt_1_tax_1_id.','; 

            //get slug
            $nd_travel_term_1 = get_term( $nd_travel_cpt_1_tax_1_id, 'nd_travel_cpt_1_tax_1' );
            $nd_travel_cpt_1_tax_1_slug = $nd_travel_term_1->slug;

        }

    } else { 
        $nd_travel_cpt_1_tax_1_slug = '';
        $nd_travel_cpt_1_tax_1_id = ''; 
        $nd_travel_cpt_1_tax_1_id_value = '';
    }


    //tax 2
    if( isset( $_GET['nd_travel_cpt_1_tax_2'] ) ) { 

        if ( $_GET['nd_travel_cpt_1_tax_2'] == '' ) { 
            $nd_travel_cpt_1_tax_2_slug = '';
            $nd_travel_cpt_1_tax_2_id = '';  
            $nd_travel_cpt_1_tax_2_id_value = ''; 
        }else{
            
            $nd_travel_cpt_1_tax_2_id = $_GET['nd_travel_cpt_1_tax_2'];
            $nd_travel_cpt_1_tax_2_id_value = $nd_travel_cpt_1_tax_2_id.','; 

            //get slug
            $nd_travel_term_2 = get_term( $nd_travel_cpt_1_tax_2_id, 'nd_travel_cpt_1_tax_2' );
            $nd_travel_cpt_1_tax_2_slug = $nd_travel_term_2->slug;

        }

    } else { 
        $nd_travel_cpt_1_tax_2_slug = '';
        $nd_travel_cpt_1_tax_2_id = ''; 
        $nd_travel_cpt_1_tax_2_id_value = '';
    }


    //tax 3
    if( isset( $_GET['nd_travel_cpt_1_tax_3'] ) ) { 

        if ( $_GET['nd_travel_cpt_1_tax_3'] == '' ) { 
            $nd_travel_cpt_1_tax_3_slug = '';
            $nd_travel_cpt_1_tax_3_id = '';  
            $nd_travel_cpt_1_tax_3_id_value = '';
        }else{
            
            $nd_travel_cpt_1_tax_3_id = $_GET['nd_travel_cpt_1_tax_3'];
            $nd_travel_cpt_1_tax_3_id_value = $nd_travel_cpt_1_tax_3_id.','; 

            //get slug
            $nd_travel_term_3 = get_term( $nd_travel_cpt_1_tax_3_id, 'nd_travel_cpt_1_tax_3' );
            $nd_travel_cpt_1_tax_3_slug = $nd_travel_term_3->slug;

        }

    } else { 
        $nd_travel_cpt_1_tax_3_slug = '';
        $nd_travel_cpt_1_tax_3_id = ''; 
        $nd_travel_cpt_1_tax_3_id_value = '';
    }


    //for pagination
    $nd_travel_qnt_posts_per_page = $nd_travel_shortcode_search_results['pagination'];

    //prepare query
    $nd_travel_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1 ;

    //prepare the destinations array
    $nd_travel_archive_form_destinations_array = array();
    $nd_travel_archive_form_destinations_array[0] = $nd_travel_archive_form_destinations;

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
        if ( count(nd_travel_get_destinations_with_parent($nd_travel_archive_form_destinations)) != 0 ){

            $nd_travel_destinations_query_i = 1;
            $nd_travel_children_destinations_array = nd_travel_get_destinations_with_parent($nd_travel_archive_form_destinations);

            foreach ($nd_travel_children_destinations_array as $nd_travel_children_destination_id) {
                
                $nd_travel_archive_form_destinations_array[$nd_travel_destinations_query_i] = $nd_travel_children_destination_id;
                $nd_travel_destinations_query_i = $nd_travel_destinations_query_i + 1;

            }

        }
        //END

    }
    //end array with all destinations

    $args = array(
        'post_type' => 'nd_travel_cpt_1',
        's' => ''.$nd_travel_archive_form_keyword.'',
        'posts_per_page' => $nd_travel_qnt_posts_per_page,
        'paged' => $nd_travel_paged,
        'nd_travel_cpt_1_tax_1' => $nd_travel_cpt_1_tax_1_slug,
        'nd_travel_cpt_1_tax_2' => $nd_travel_cpt_1_tax_2_slug,
        'nd_travel_cpt_1_tax_3' => $nd_travel_cpt_1_tax_3_slug,
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


    //START price args
    if ( $nd_travel_shortcode_search_results['price'] == 'enable' ){

        $args['meta_query'][2] = array(
            'key'     => 'nd_travel_meta_box_new_price',
            'type' => 'numeric',
            'value'   => $nd_travel_shortcode_search_results['price_max_value'],
            'compare' => '<=',
        );

    }
    //END price args


    $the_query = new WP_Query( $args );

    //pagination
    $nd_travel_qnt_results_posts = $the_query->found_posts;
    $nd_travel_qnt_pagination = ceil($nd_travel_qnt_results_posts / $nd_travel_qnt_posts_per_page);


    include 'include/search-results/nd_travel_search_results_right_content.php';
    include 'include/search-results/nd_travel_search_results_left_content.php';

    
    //START final result
    $nd_travel_shortcode_result = '';

    if ( $nd_travel_shortcode_search_results['sidebar'] != 'enable' ) { 
        $nd_travel_sidebar_class = "nd_travel_display_none";
        $nd_travel_content_class = "nd_travel_width_100_percentage"; 
    }else{
        $nd_travel_sidebar_class = "";  
        $nd_travel_content_class = "nd_travel_width_66_percentage";   
    }

    $nd_travel_shortcode_result .='

    '.$nd_travel_hidden_values.'

    <div class="nd_travel_section">
    
        <div id="nd_travel_search_cpt_1_sidebar" class="nd_travel_float_left '.$nd_travel_sidebar_class.' nd_travel_width_33_percentage nd_travel_box_sizing_border_box nd_travel_width_100_percentage_responsive">
            
            '.$nd_travel_shortcode_left_content.'

        </div>

        <div id="nd_travel_search_cpt_1_content" class="nd_travel_float_left '.$nd_travel_content_class.' nd_travel_box_sizing_border_box nd_travel_width_100_percentage_responsive">
            
            '.$nd_travel_shortcode_right_content.'

        </div>

    </div>';
    //END final result


    echo $nd_travel_shortcode_result;
        


}
add_shortcode('nd_travel_search_results', 'nd_travel_shortcode_search_results');
//END nd_travel_search_results









//START function for AJAX
function nd_travel_sorting_php() {


    //recover atts
    $nd_travel_qnt_posts_per_page = $_GET['nd_travel_pagination'];
    $nd_travel_price = $_GET['nd_travel_price'];

    //recover var
    $nd_travel_paged = $_GET['nd_travel_paged'];
    $nd_travel_archive_form_destinations = $_GET['nd_travel_archive_form_destinations'];
    $nd_travel_archive_form_typologys = $_GET['nd_travel_archive_form_typologys'];
    $nd_travel_archive_form_max_price_for_day = $_GET['nd_travel_archive_form_max_price_for_day'];
    $nd_travel_archive_form_durations = $_GET['nd_travel_archive_form_durations'];
    $nd_travel_archive_form_difficultys = $_GET['nd_travel_archive_form_difficultys'];
    $nd_travel_archive_form_minages = $_GET['nd_travel_archive_form_minages'];
    $nd_travel_archive_form_date = $_GET['nd_travel_archive_form_date'];
    $nd_travel_archive_form_keyword = $_GET['nd_travel_archive_form_keyword'];
    $nd_travel_archive_form_promo_price = $_GET['nd_travel_archive_form_promo_price'];
    $nd_travel_search_filter_layout = $_GET['nd_travel_search_filter_layout'];
    $nd_travel_search_filter_options_meta_key = $_GET['nd_travel_search_filter_options_meta_key'];
    $nd_travel_search_filter_options_order = $_GET['nd_travel_search_filter_options_order'];


    //format the date base on user choice
    $nd_travel_date_format = get_option('nd_travel_date_format');
    if ( $nd_travel_archive_form_date != '' ) {
        $nd_travel_archive_form_new_date = new DateTime($nd_travel_archive_form_date);
        $nd_travel_new_date_format = date_format($nd_travel_archive_form_new_date,$nd_travel_date_format);
    }


    //order
    if ( $nd_travel_search_filter_options_meta_key == '' ) { 
        $nd_travel_orderby = 'date';
        $nd_travel_order = 'DESC';
    }elseif ( $nd_travel_search_filter_options_meta_key == 'nd_travel_name' ){
        $nd_travel_orderby = 'title';
        $nd_travel_order = $nd_travel_search_filter_options_order;
        $nd_travel_search_filter_options_meta_key = '';
    }else{
        $nd_travel_orderby = 'meta_value_num';
        $nd_travel_order = $nd_travel_search_filter_options_order;
    }


    //prepare the destinations array
    $nd_travel_archive_form_destinations_array = array();
    $nd_travel_archive_form_destinations_array[0] = $nd_travel_archive_form_destinations;

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
        if ( count(nd_travel_get_destinations_with_parent($nd_travel_archive_form_destinations)) != 0 ){

            $nd_travel_destinations_query_i = 1;
            $nd_travel_children_destinations_array = nd_travel_get_destinations_with_parent($nd_travel_archive_form_destinations);

            foreach ($nd_travel_children_destinations_array as $nd_travel_children_destination_id) {
                
                $nd_travel_archive_form_destinations_array[$nd_travel_destinations_query_i] = $nd_travel_children_destination_id;
                $nd_travel_destinations_query_i = $nd_travel_destinations_query_i + 1;

            }

        }
        //END

    }
    //end array with all destinations


    $args = array(
        'post_type' => 'nd_travel_cpt_1',
        's' => ''.$nd_travel_archive_form_keyword.'',
        'orderby' => $nd_travel_orderby,
        'meta_key' => $nd_travel_search_filter_options_meta_key,
        'order' => $nd_travel_order,
        'posts_per_page' => $nd_travel_qnt_posts_per_page,
        'paged' => $nd_travel_paged,
        'tax_query' => array(

            'relation' => 'AND',

            array(
                'taxonomy' => 'nd_travel_cpt_1_tax_1',
                'field'    => 'term_id',
                'terms'    => array(),
            ),

            array(
                'taxonomy' => 'nd_travel_cpt_1_tax_2',
                'field'    => 'term_id',
                'terms'    => array(),
            ),

            array(
                'taxonomy' => 'nd_travel_cpt_1_tax_3',
                'field'    => 'term_id',
                'terms'    => array(),
            )

        ),
        'meta_query' => array(

            array(
                'key'     => 'nd_travel_meta_box_destinations',
                'type' => 'numeric',
                'value'   => $nd_travel_archive_form_destinations_array,
            )
            
        )
    );


    
    //START price args
    if ( $nd_travel_price == 'enable' ){

        $args['meta_query'][1] = array(
            'key'     => 'nd_travel_meta_box_new_price',
            'type' => 'numeric',
            'value'   => $nd_travel_archive_form_max_price_for_day,
            'compare' => '<=',
        );
        $args['meta_query'][2] = array(
            'key'     => 'nd_travel_meta_box_promo_price',
            'type' => 'numeric',
            'value'   => $nd_travel_archive_form_promo_price,
            'compare' => 'LIKE',
        );

    }
    //END price args


    //START date args
    if ( $nd_travel_archive_form_date != '' ) {

        $args['meta_query'][3] = array(
            'key' => 'nd_travel_meta_box_availability_from',
            'type' => 'numeric',
            'value'   => intval($nd_travel_archive_form_date),
            'compare' => '<=',
        );

        $args['meta_query'][4] = array(
            'key'     => 'nd_travel_meta_box_availability_to',
            'type' => 'numeric',
            'value'   => intval($nd_travel_archive_form_date),
            'compare' => '>=',
        );

    }
    //END date args


    
    //START add typology to args
    $nd_travel_typologys_array = explode(',', $nd_travel_archive_form_typologys );

    for ($nd_travel_typologys_i = 0; $nd_travel_typologys_i < count($nd_travel_typologys_array)-1; $nd_travel_typologys_i++) {
        
        $nd_travel_typology_slug = get_post_field( 'post_name', $nd_travel_typologys_array[$nd_travel_typologys_i] );
        $nd_travel_add_new_typology_to_meta_query_position = 5+$nd_travel_typologys_i;
         
        $args['meta_query'][$nd_travel_add_new_typology_to_meta_query_position] = array(
            'key' => 'nd_travel_meta_box_typologies',
            'value'   => $nd_travel_typology_slug,
            'compare' => 'LIKE',
        );

    }
    //END


    //START add durations to args
    $nd_travel_durations_array = explode(',', $nd_travel_archive_form_durations );

    if ( $nd_travel_archive_form_durations != '' ) {

        for ($nd_travel_durations_i = 0; $nd_travel_durations_i < count($nd_travel_durations_array)-1; $nd_travel_durations_i++) {
            $args['tax_query'][0]['terms'][$nd_travel_durations_i] = $nd_travel_durations_array[$nd_travel_durations_i];    
        }

    }else{

        //get all terms
        $nd_travel_terms = get_terms('nd_travel_cpt_1_tax_1');
        $nd_travel_durations_i = 0;

        foreach ($nd_travel_terms as $nd_travel_term) {

            $args['tax_query'][0]['terms'][$nd_travel_durations_i] = $nd_travel_term->term_id;   

            $nd_travel_durations_i = $nd_travel_durations_i + 1;

        }

    }
    //END



    //START add difficulties to args
    $nd_travel_difficulties_array = explode(',', $nd_travel_archive_form_difficultys );

    if ( $nd_travel_archive_form_difficultys != '' ) {

        for ($nd_travel_difficulties_i = 0; $nd_travel_difficulties_i < count($nd_travel_difficulties_array)-1; $nd_travel_difficulties_i++) {
            $args['tax_query'][1]['terms'][$nd_travel_difficulties_i] = $nd_travel_difficulties_array[$nd_travel_difficulties_i];    
        }

    }else{

        //get all terms
        $nd_travel_terms_2 = get_terms('nd_travel_cpt_1_tax_2');
        $nd_travel_difficulties_i = 0;

        foreach ($nd_travel_terms_2 as $nd_travel_term) {

            $args['tax_query'][1]['terms'][$nd_travel_difficulties_i] = $nd_travel_term->term_id;   

            $nd_travel_difficulties_i = $nd_travel_difficulties_i + 1;

        }

    }
    //END



    //START add minages to args
    $nd_travel_minages_array = explode(',', $nd_travel_archive_form_minages );

    if ( $nd_travel_archive_form_minages != '' ) {

        for ($nd_travel_minages_i = 0; $nd_travel_minages_i < count($nd_travel_minages_array)-1; $nd_travel_minages_i++) {
            $args['tax_query'][2]['terms'][$nd_travel_minages_i] = $nd_travel_minages_array[$nd_travel_minages_i];    
        }

    }else{

        //get all terms
        $nd_travel_terms_2 = get_terms('nd_travel_cpt_1_tax_3');
        $nd_travel_minages_i = 0;

        foreach ($nd_travel_terms_2 as $nd_travel_term) {

            $args['tax_query'][2]['terms'][$nd_travel_minages_i] = $nd_travel_term->term_id;   

            $nd_travel_minages_i = $nd_travel_minages_i + 1;

        }

    }
    //END


    $the_query = new WP_Query( $args );


    //pagination
    $nd_travel_qnt_results_posts = $the_query->found_posts;
    $nd_travel_qnt_pagination = ceil($nd_travel_qnt_results_posts / $nd_travel_qnt_posts_per_page);


    //start output AJAX content
    $nd_travel_shortcode_right_content = '

    <div id="nd_travel_content_result" class="nd_travel_section">';


        if ( $nd_travel_qnt_results_posts == 0 ) { $nd_travel_shortcode_right_content .= '


        <div id="nd_travel_search_cpt_1_no_results" class="nd_travel_section nd_travel_padding_15 nd_travel_box_sizing_border_box">
            <div class="nd_travel_section nd_travel_bg_yellow nd_travel_padding_15_20 nd_travel_box_sizing_border_box">
              <img class="nd_travel_float_left nd_travel_display_none_all_iphone" width="20" src="'.plugins_url().'/nd-travel/assets/img/icons/icon-warning-white.svg">
              <h3 class="nd_travel_float_left nd_options_color_white nd_travel_color_white nd_options_first_font nd_travel_margin_left_10">'.__('No results for this search','nd-travel').'</h3>
            </div>
        </div>


        '; }

        $nd_travel_shortcode_right_content .= '<div class="nd_travel_section nd_travel_masonry_content">';

        //START loop
        while ( $the_query->have_posts() ) : $the_query->the_post();

            include 'include/search-results/nd_travel_post_preview-'.$nd_travel_search_filter_layout.'.php';

        endwhile;
        //END loop

        $nd_travel_shortcode_right_content .= '</div>

            <script type="text/javascript">
                //<![CDATA[
                
                jQuery(document).ready(function() {

                    jQuery(function ($) {

                        //Masonry
                        var $nd_travel_masonry_content = $(".nd_travel_masonry_content").imagesLoaded( function() {
                          // init Masonry after all images have loaded
                          $nd_travel_masonry_content.masonry({
                            itemSelector: ".nd_travel_masonry_item"
                          });
                        });

                        //tooltip
                        $( ".nd_travel_tooltip_jquery" ).tooltip({ 
                        tooltipClass: "nd_travel_tooltip_jquery_content",
                        position: {
                          my: "center top",
                          at: "center-7 top-33",
                        }
                        });


                    });


                });

                //]]>
              </script>';




            include 'include/search-results/nd_travel_search_results_pagination.php';




        $nd_travel_shortcode_right_content .= '</div>';


    wp_reset_postdata();


    echo $nd_travel_shortcode_right_content.'[divider]'.$nd_travel_new_date_format;

    die();

}
add_action( 'wp_ajax_nd_travel_sorting_php', 'nd_travel_sorting_php' );
add_action( 'wp_ajax_nopriv_nd_travel_sorting_php', 'nd_travel_sorting_php' );
//END