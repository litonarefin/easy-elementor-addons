(function($){
    "use strict";

    jQuery(document).ready(function($) {
    'use strict';

    $('.wp-tab-bar a').click(function(event){
        event.preventDefault();

        // Limit effect to the container element.
        var context = $(this).closest('.wp-tab-bar').parent();
        $('.wp-tab-bar li', context).removeClass('wp-tab-active');
        $(this).closest('li').addClass('wp-tab-active');
        $('.master_addons_contents .wp-tab-panel', context).hide();
        $( $(this).attr('href'), context ).show();
    });

    // Make setting wp-tab-active optional.
    $('.wp-tab-bar').each(function(){
        if ( $('.wp-tab-active', this).length )
            $('.wp-tab-active', this).click();
        else
            $('a', this).first().click();
    });


    // Save Button reacting on any changes
    var saveHeaderAction = $( '.master-addons-el-dashboard-header-wrapper .master-addons-el-btn' );
    $('.master-addons-dashboard-tab input').on( 'click', function() {
        saveHeaderAction.addClass( 'master-addons-el-save-now' );
        saveHeaderAction.removeAttr('disabled').css('cursor', 'pointer');
    } );



    //Tracking purchases with Google Analytics and Facebook for Freemius Checkout
    var purchaseCompleted = function( response ) {
        var trial = response.purchase.trial_ends !== null,
            total = trial ? 0 : response.purchase.initial_amount.toString(),
            productName = 'Product Name',
            storeUrl = 'https://master-addons.com',
            storeName = 'Master Addons';

        if ( typeof fbq !== "undefined" ) {
            fbq( 'track', 'Purchase', { currency: 'USD', value: response.purchase.initial_amount } );
        }

        if ( typeof ga !== "undefined" ) {
            ga( 'send', 'event', 'plugin', 'purchase', productName, response.purchase.initial_amount.toString()         );

            ga( 'require', 'ecommerce' );

            ga( 'ecommerce:addTransaction', {
                'id': response.purchase.id.toString(), // Transaction ID. Required.
                'affiliation': storeName, // Affiliation or store name.
                'revenue': total, // Grand Total.
                'shipping': '0', // Shipping.
                'tax': '0' // Tax.
            } );

            ga( 'ecommerce:addItem', {
                'id': response.purchase.id.toString(), // Transaction ID. Required.
                'name': productName, // Product name. Required.
                'sku': response.purchase.plan_id.toString(), // SKU/code.
                'category': 'Plugin', // Category or variation.
                'price': response.purchase.initial_amount.toString(), // Unit price.
                'quantity': '1' // Quantity.
            } );

            ga( 'ecommerce:send' );

            ga( 'send', {
                hitType: 'pageview',
                page: '/purchase-completed/',
                location: storeUrl + '/purchase-completed/'
            } );
        }
    };



    // Saving Data With Ajax Request
    $( '.master-addons-el-js-element-save-setting' ).on( 'click', function(e) {
        e.preventDefault();
        var $this = $(this);
        if( $(this).hasClass('master-addons-el-save-now') ) {

            // Master Addons Elem
            $.ajax( {
                url: js_maad_el_settings.ajaxurl,
                type: 'post',
                data: {
                    action: 'master_addons_save_elements_settings',
                    security: js_maad_el_settings.ajax_nonce,
                    fields: $( '#master-addons-el-settings' ).serialize(),
                },
                success: function( response ) {


                    swal({
                        title: "Saved",
                        text: "Your Changes has been Saved",
                        type: "success",
                        showLoaderOnConfirm: true,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonClass: 'btn-success',
                        confirmButtonText: 'Okay'

                    });

                    // setTimeout(function(){
                    //     $('.swal2-container').fadeOut('slow');
                    // }, 2000);


                    $this.html('Save Settings');
                    $('.master-addons-el-dashboard-header-right').prepend('<span' +
                        ' class="master-addons-el-settings-saved"></span>').fadeIn('slow');

                    saveHeaderAction.removeClass( 'master-addons-el-save-now' );

                    setTimeout(function(){
                        $('.master-addons-el-settings-saved').fadeOut('slow');
                    }, 2000);



                },
                error: function() {

                }
            } );





        // Master Addons Extensions
         $.ajax( {
            url: js_maad_el_settings.ajaxurl,
            type: 'post',
            data: {
                action: 'master_addons_save_extensions_settings',
                security: js_maad_el_settings.ajax_nonce,
                fields: $( '#master-addons-el-settings' ).serialize(),
            },
            success: function( response ) {


                swal({
                    title: "Saved",
                    text: "Your Changes has been Saved",
                    type: "success",
                    showLoaderOnConfirm: true,
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonClass: 'btn-success',
                    confirmButtonText: 'Okay'

                });

                // setTimeout(function(){
                //     $('.swal2-container').fadeOut('slow');
                // }, 2000);


                $this.html('Save Settings');
                $('.master-addons-el-dashboard-header-right').prepend('<span' +
                    ' class="master-addons-el-settings-saved"></span>').fadeIn('slow');

                saveHeaderAction.removeClass( 'master-addons-el-save-now' );

                setTimeout(function(){
                    $('.master-addons-el-settings-saved').fadeOut('slow');
                }, 2000);


        } else {
            $(this).attr('disabled', 'true').css('cursor', 'not-allowed');
        }
    } );

});

})(jQuery);
