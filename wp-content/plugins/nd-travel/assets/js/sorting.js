//START function
function nd_travel_sorting(paged){

  jQuery( "body" ).append( "<div id='nd_travel_sorting_result_layer' class='nd_travel_cursor_progress nd_travel_position_fixed nd_travel_width_100_percentage nd_travel_height_100_percentage nd_travel_z_index_999'></div>" );

  var nd_travel_sorting_result_loader = jQuery('<div id="nd_travel_sorting_result_loader" class="nd_travel_position_absolute nd_travel_top_0 nd_travel_z_index_9 nd_travel_left_0 nd_travel_bg_white  nd_travel_cursor_progress nd_travel_height_100_percentage nd_travel_width_100_percentage"></div>').hide();
  jQuery( "#nd_travel_archive_search_masonry_container" ).append(nd_travel_sorting_result_loader);
  nd_travel_sorting_result_loader.fadeIn('slow');

  //layout
  var nd_travel_search_filter_layout = jQuery( "#nd_travel_search_filter_layout .nd_travel_search_filter_layout_active").attr('data-layout');
  if ( typeof nd_travel_search_filter_layout === 'undefined' ){ nd_travel_search_filter_layout = 1; }

  //order
  var nd_travel_search_filter_options_meta_key = jQuery( "#nd_travel_search_filter_options .nd_travel_search_filter_options_active").attr('data-meta-key');
  var nd_travel_search_filter_options_order = jQuery( "#nd_travel_search_filter_options .nd_travel_search_filter_options_active").attr('data-order');
  
  //variables passed on function
  var nd_travel_paged = paged;
  if(typeof nd_travel_paged === 'undefined'){
    nd_travel_paged = jQuery( ".nd_travel_btn_pagination_active" ).text();
  }

  var nd_travel_archive_form_destinations = jQuery( "#nd_travel_archive_form_destinations").val();
  var nd_travel_archive_form_typologys = jQuery( "#nd_travel_archive_form_typologys").val();
  var nd_travel_archive_form_max_price_for_day = jQuery( "#nd_travel_archive_form_max_price_for_day").val();
  var nd_travel_archive_form_durations = jQuery( "#nd_travel_archive_form_durations").val();
  var nd_travel_archive_form_difficultys = jQuery( "#nd_travel_archive_form_difficultys").val();
  var nd_travel_archive_form_minages = jQuery( "#nd_travel_archive_form_minages").val();
  var nd_travel_archive_form_date = jQuery( "#nd_travel_archive_form_date").val();
  var nd_travel_archive_form_keyword = jQuery( "#nd_travel_archive_form_keyword").val();
  var nd_travel_archive_form_promo_price = jQuery( "#nd_travel_archive_form_promo_price").val();
  
  //shortcode atts
  var nd_travel_pagination = jQuery( "#nd_travel_pagination").val();
  var nd_travel_price = jQuery( "#nd_travel_price").val();

  
  //START post method
  jQuery.get(
    
  
    //ajax
    nd_travel_my_vars_sorting.nd_travel_ajaxurl_sorting,
    {
      action : 'nd_travel_sorting_php',
      nd_travel_paged : nd_travel_paged,
      nd_travel_archive_form_destinations : nd_travel_archive_form_destinations,
      nd_travel_archive_form_typologys : nd_travel_archive_form_typologys,
      nd_travel_archive_form_max_price_for_day : nd_travel_archive_form_max_price_for_day,
      nd_travel_archive_form_durations : nd_travel_archive_form_durations,
      nd_travel_archive_form_difficultys : nd_travel_archive_form_difficultys,
      nd_travel_archive_form_minages : nd_travel_archive_form_minages,
      nd_travel_archive_form_date : nd_travel_archive_form_date,
      nd_travel_archive_form_keyword : nd_travel_archive_form_keyword,
      nd_travel_archive_form_promo_price : nd_travel_archive_form_promo_price,
      nd_travel_search_filter_layout : nd_travel_search_filter_layout,
      nd_travel_search_filter_options_meta_key : nd_travel_search_filter_options_meta_key,
      nd_travel_search_filter_options_order : nd_travel_search_filter_options_order,
      nd_travel_pagination : nd_travel_pagination,
      nd_travel_price : nd_travel_price
    },
    //end ajax


    //START success
    function( nd_travel_sorting_result ) {


      var nd_travel_sorting_result_array = nd_travel_sorting_result.split("[divider]");
      var nd_travel_result_content = nd_travel_sorting_result_array[0];
      var nd_travel_result_date = nd_travel_sorting_result_array[1];

      //set format date in date field
      jQuery( "#nd_travel_archive_form_date_visual" ).val(nd_travel_result_date );


      setTimeout(function(){

        jQuery( "#nd_travel_content_result" ).remove();
        jQuery( "#nd_travel_archive_search_masonry_container" ).append(nd_travel_result_content);

        jQuery( "#nd_travel_sorting_result_loader" ).fadeOut( "slow", function() {
          jQuery( "#nd_travel_sorting_result_loader" ).remove();
          jQuery( "#nd_travel_sorting_result_layer" ).remove();  
        });

      },10);

      
    }
    //END

    

  );
  //END

  
}
//END function