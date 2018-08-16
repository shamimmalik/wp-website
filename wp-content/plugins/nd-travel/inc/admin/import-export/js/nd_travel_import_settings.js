//START function
function nd_travel_import_settings(){

  //variables
  var nd_travel_value_import_settings = jQuery( "#nd_travel_import_settings").val();

  //empty result div
  jQuery( "#nd_travel_import_settings_result_container").empty();

  //START post method
  jQuery.get(
    
  
    //ajax
    nd_travel_my_vars_import_settings.nd_travel_ajaxurl_import_settings,
    {
      action : 'nd_travel_import_settings_php_function',         
      nd_travel_value_import_settings: nd_travel_value_import_settings
    },
    //end ajax


    //START success
    function( nd_travel_import_settings_result ) {
    
      jQuery( "#nd_travel_import_settings").val('');
      jQuery( "#nd_travel_import_settings_result_container").append(nd_travel_import_settings_result);

    }
    //END
  

  );
  //END

  
}
//END function
