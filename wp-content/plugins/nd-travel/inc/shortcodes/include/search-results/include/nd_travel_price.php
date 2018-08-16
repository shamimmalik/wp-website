<?php


//currency position
$nd_travel_currency_position = get_option('nd_travel_currency_position');
if ( $nd_travel_currency_position == 0 ) {
    $nd_travel_currency_right_value = '<span class="nd_travel_float_right nd_options_first_font nd_options_color_greydark nd_travel_line_height_20 nd_travel_font_size_16">'.nd_travel_get_currency().'</span>';
    $nd_travel_currency_left_value = '';
}else{
    $nd_travel_currency_left_value = '<span class="nd_travel_float_right nd_options_first_font nd_options_color_greydark nd_travel_line_height_20 nd_travel_font_size_16">'.nd_travel_get_currency().'</span>';
    $nd_travel_currency_right_value = '';
}


//price font color
$nd_options_customizer_font_color_h = get_option('nd_options_customizer_font_color_h');
if ( $nd_options_customizer_font_color_h == '' ){
  $nd_travel_price_range_text_color = ''; 
}else{
  $nd_travel_price_range_text_color = $nd_options_customizer_font_color_h; 
}

$nd_travel_shortcode_left_content .= '

<!--max night range-->
<div id="nd_travel_search_cpt_1_form_night_range" class="nd_travel_width_100_percentage nd_travel_float_left nd_travel_box_sizing_border_box">
        


  <div class="nd_travel_section nd_travel_position_relative nd_travel_padding_30 nd_travel_padding_30_15_all_iphone nd_travel_box_sizing_border_box">

    <div class="nd_travel_section">
      <h3 class="nd_travel_float_left nd_travel_font_weight_normal nd_travel_font_size_16">'.__('Max Price','nd-travel').' :</h3> 
      '.$nd_travel_currency_right_value.'
      <input class="nd_travel_float_right nd_options_first_font nd_travel_margin_right_5 nd_travel_line_height_20 nd_travel_border_width_0_important" type="text" id="nd_travel_archive_form_max_price_for_day" name="nd_travel_archive_form_max_price_for_day" readonly >
      '.$nd_travel_currency_left_value.'
    </div>

    <div class="nd_travel_section">
      <div id="nd_travel_slider_range"></div>   
    </div>


    <div class="nd_travel_section nd_travel_height_20"></div>
    <p class="nd_travel_width_100_percentage nd_travel_width_100_percentage_all_iphone nd_travel_float_left nd_travel_margin_0">
      <input class="nd_travel_checkbox_promo_price nd_travel_width_25 nd_travel_margin_0 nd_travel_padding_0 nd_travel_margin_top_8" name="nd_travel_checkbox_promo_price" type="checkbox" value="0">
      '.__('See only promotions','nd-travel').'
      <input type="hidden" id="nd_travel_archive_form_promo_price" name="nd_travel_archive_form_promo_price" value="">
    </p>

  </div>


  <div class="nd_travel_section nd_travel_height_5"></div> 
  <div class="nd_travel_section nd_travel_height_2 nd_travel_bg_grey"></div>

</div>




<script type="text/javascript">
  //<![CDATA[
  jQuery(document).ready(function() {

    jQuery( function ( $ ) {

        $( ".nd_travel_checkbox_promo_price" ).change(function() {

            if ( $( this ).is( ":checked" ) ) {

                $( "#nd_travel_archive_form_promo_price" ).val(1);
                nd_travel_sorting(1);

            }else{

              $( "#nd_travel_archive_form_promo_price" ).val("");
              nd_travel_sorting(1);

            }

        });

    });

  });
  //]]>
</script>




<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {

  jQuery( function ( $ ) {

      $( "#nd_travel_slider_range" ).slider({
        range: "min",
        value: '.$nd_travel_shortcode_search_results['price_default_value'].',
        min: '.$nd_travel_shortcode_search_results['price_min_value'].',
        max: '.$nd_travel_shortcode_search_results['price_max_value'].',
        slide: function( event, ui ) {
          $( "#nd_travel_archive_form_max_price_for_day" ).val( "" + ui.value );
        },
        change: function( event, ui ) {
          nd_travel_sorting(1); 
        }
      });
      $( "#nd_travel_archive_form_max_price_for_day" ).val( "" + $( "#nd_travel_slider_range" ).slider( "value" ) );

  });

});
//]]>
</script>

<style>
    #nd_travel_slider_range {
      background-color:#e4e4e4;
      height:4px;  
      position:relative;
      margin-top:20px;
    }

    #nd_travel_slider_range .ui-slider-range {
        height:4px;
    }

    #nd_travel_slider_range .ui-slider-handle {
        height: 16px;
        width: 16px;
        position: absolute;
        top: -6px;
        cursor:pointer;
        outline:0;    
    }

    #nd_travel_archive_form_max_price_for_day {
      color: '.$nd_travel_price_range_text_color.';
      background-color: transparent;
      font-size: 16px;
      width: 50px;
      text-align: right;
      padding: 0px;
    }
</style>
<!--max night range-->';


