jQuery(document).ready(function($) {
    $('#import-theme-mods').click(function(e) {
        e.preventDefault();

        // Display loading text
        $('#import-response').text('Importing theme mods...');

        var fashion_estore_plugin_array = [ 
        {
          'name': 'magnify-suggestive-search',
          'slug': 'magnify-suggestive-search',
          'source': 'https://downloads.wordpress.org/plugin/magnify-suggestive-search.zip',
          'required': true,
          'force_activation': false,
          'file_name': 'magnify-suggestive-search.php'
        },
        {
          'name': 'woocommerce',
          'slug': 'woocommerce',
          'source': 'https://downloads.wordpress.org/plugin/woocommerce.zip',
          'required': true,
          'force_activation': false,
          'file_name': 'woocommerce.php'
        }];
      
        var url = '<?php echo $admin_url; ?>';
        // console.log(url)
        fashion_estore_plugin_array.map(function (plugin_url_data, index) {

          var data_to_post = {
            action:             'fashion-estore-check-plugin-exists',
            plugin_text_domain: plugin_url_data.slug,
            main_plugin_file:   plugin_url_data.file_name
          };
          
          var data_to_post_install = {
            action:             'fashion_estore_install_and_activate_plugin',
            plugin_details: {
              plugin_text_domain: plugin_url_data.slug,
              plugin_main_file: plugin_url_data.file_name,
              plugin_url: plugin_url_data.source
            },
            main_plugin_file:   plugin_url_data.file_name
          };

          jQuery.ajax({
            url:    demoImporter.ajax_url,
            type:   'post',
            data:   data_to_post,
            async:  false
          }).done( function( response ) {
            if ( response.data.install_status == true ) {
              jQuery.ajax({
                url:    demoImporter.ajax_url,
                type:   'post',
                data:   data_to_post_install,
                async:  false
              }).done( function( response ) {
                console.log(plugin_url_data.slug ,'installed');
                if((fashion_estore_plugin_array.length - 1) == index) {
                  console.log('inside length');
                  $('.spinner').removeClass('is-active');
                  fashion_estore_importDemoData();
                }
              })
            } else {
         jQuery.ajax({
                    url:    demoImporter.ajax_url,
                    type:   'post',
                    data:   data_to_post_install,
                    async:  false
         }).done( function( response ) {
                    console.log(plugin_url_data.slug ,'installed');
                    if((fashion_estore_plugin_array.length - 1) == index) {
                      fashion_estore_importDemoData();
                    }
         })
            }
          });
        })  

        
    });

    function fashion_estore_importDemoData(argument) {
    // Make the AJAX request
        $.ajax({
            url: demoImporter.ajax_url,
            type: 'post',
            data: {
                action: 'import_theme_mods',
                _ajax_nonce: demoImporter.nonce
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = response.data.redirect;
                    // $('#import-response').text(response.data.msg);
                    // window.open(response.data.redirect, '_blank')
                } else {
                    $('#import-response').text('Error: ' + response.data);
                }
            },
            error: function(xhr, status, error) {
                $('#import-response').text('AJAX error: ' + error);
            }
        });
    }
});
