(function($){
    "use strict";

    jQuery(document).ready(function($) {
    'use strict';


        // Save Button reacting on any changes
        var saveHeaderAction = $( '.master-addons-el-dashboard-header-wrapper .master-addons-el-btn' );
        $('.master-addons-dashboard-tab input').on( 'click', function() {
            saveHeaderAction.addClass( 'master-addons-el-save-now' );
            saveHeaderAction.removeAttr('disabled').css('cursor', 'pointer');
        } );

        // Enable All Elements
        $('#master-addons-elements .addons-enable-all').on("click",function (e) {
            e.preventDefault();

            $("#master-addons-elements .master_addons_feature_switchbox input:enabled").each(function (i) {
                $(this).prop("checked", true).change();
            });
            saveHeaderAction
                .addClass("master-addons-el-save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });

        // Disable All Elements
        $('#master-addons-elements .addons-disable-all').on("click",function (e) {
            e.preventDefault();

            $("#master-addons-elements .master_addons_feature_switchbox input:enabled").each(function (i) {
                $(this).prop("checked", false).change();
            });

            saveHeaderAction
                .addClass("master-addons-el-save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });

        // Enable All Extensions
        $('#master-addons-extensions .addons-enable-all').on("click",function (e) {
            e.preventDefault();

            $("#master-addons-extensions .master_addons_feature_switchbox input:enabled").each(function (i) {
                $(this).prop("checked", true).change();
            });
            saveHeaderAction
                .addClass("master-addons-el-save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });

        // Disable All Elements
        $('#master-addons-extensions .addons-disable-all').on("click",function (e) {
            e.preventDefault();

            $("#master-addons-extensions .master_addons_feature_switchbox input:enabled").each(function (i) {
                $(this).prop("checked", false).change();
            });

            saveHeaderAction
                .addClass("master-addons-el-save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });


        // a(".ha-action--btn").on("click", function (e) {
        //     e.preventDefault();
        //     var t = a(this),
        //         n = t.data("filter"),
        //         i = t.data("action"),
        //         s = c.find(".ha-dashboard-widgets__item"),
        //         r = s.not(".item--is-pro"),
        //         o = s.filter(".item--is-pro"),
        //         d = s.not(".item--is-placeholder").find(":checkbox");
        //     if (n)
        //         switch (n) {
        //             case "free":
        //                 r.show(), o.hide();
        //                 break;
        //             case "pro":
        //                 r.hide(), o.show();
        //                 break;
        //             case "*":
        //             default:
        //                 s.show();
        //         }
        //     i && ("enable" === i ? d.prop("checked", !0) : "disable" === i && d.prop("checked", !1), d.trigger("change"));
        // }),
        // a(".ha-feature-sub-title-a").magnificPopup({ disableOn: 700, type: "iframe", mainClass: "mfp-fade", removalDelay: 160, preloader: !1, fixedContentPos: !1 }),
        // a(".btn-how-to-contribute").on("click", function (e) {
        //     e.preventDefault(), a(this).next().show();
        // });


        // Variable
        // var posts = $('.post');
        // posts.hide();

        // // Click function
        // $( "#category li a" ).click(function() {
        //     // Get data of category
        //     var customType = $( this ).data('filter'); // category
        //     console.log(customType);
        //     console.log(posts.length); // Length of articles

        //     posts
        //         .hide()
        //         .filter(function () {
        //             return $(this).data('cat') === customType;
        //         })
        //         .show();
        // });


        // Dasboard Addons Filter
        $('.master-addons-dashboard-filter .master-addons-filter a').on('click',function(){
            console.log('Filter Clicked');

            var thisis = $( this ),
                thisis = $( this ),
                customType = $( this ).data('filter'); // category

            posts
                .hide()
                .filter(function () {
                    return $(this).data('cat') === customType;
                })
                .show();
        });


        // Dismissible Admin Notices
        $( 'div[data-dismissible] button.notice-dismiss' ).click(
            function (event) {
                event.preventDefault();
                var $this = $( this );

                var attr_value, option_name, dismissible_length, data;

                attr_value = $this.parent().attr( 'data-dismissible' ).split( '-' );

                // remove the dismissible length from the attribute value and rejoin the array.
                dismissible_length = attr_value.pop();

                option_name = attr_value.join( '-' );

                data = {
                    'action'                : 'dismiss_admin_notice',
                    'option_name'           : option_name,
                    'dismissible_length'    : dismissible_length,
                    'nonce'                 : dismissible_notice.nonce
                };
                // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                $.post( ajaxurl, data );
            }
        );

        // Dashboard widget links target
        $('.master-addons-posts a.rsswidget').attr('target', '_blank');

        //Navigation Tabs
        $('.master_addons_navbar a').on('click',function(event){
            event.preventDefault(); // Limit effect to the container element.

            var context = $(this).closest('.master_addons_navbar').parent();
            var url = $(this).attr('href'),
                target = $(this).attr('target');

            if(target == '_blank') {
                window.open(url, target);
            } else {
                $('.master_addons_navbar li', context).removeClass('wp-tab-active');
                $(this).closest('li').addClass('wp-tab-active');
                $('.master_addons_contents .wp-tab-panel', context).hide();
                $( $(this).attr('href'), context ).show();
            }
        });

        // Make setting wp-tab-active optional.
        $('.master_addons_navbar').each(function(){
            if ( $('.wp-tab-active', this).length )
                $('.wp-tab-active', this).click();
            else
                $('a', this).first().click();
        });



        // Go Pro Modal
        $('.ma-el-pro:parent').on('click',function(event){
                event.preventDefault();
                swal({
                    title: "Go Pro",
                    text: 'Upgrade to <a href="http://bit.ly/2ly5eaQ" target="_blank"> Pro Version </a> for ' +
                    ' Unlock more Features ',
                    type: "warning",
                    showLoaderOnConfirm: true,
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonClass: 'btn-success',
                    confirmButtonText: 'Okay'
                }, function () {
                    setTimeout(function () {
                        $('.ma-el-pro').fadeOut('slow');
                    }, 2000);
                });
        });


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

            let $this = $(this);

            if( $(this).hasClass('master-addons-el-save-now') ) {

                // Master Addons Elemements
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

                        }, function () {
                            setTimeout(function () {
                                $('.master-addons-el-settings-saved').fadeOut('fast');
                            }, 2000);
                        });

                        $this.html('Save Settings');
                        $('.master-addons-el-dashboard-header-right').prepend('<span' +
                            ' class="master-addons-el-settings-saved"></span>').fadeIn('slow');

                        saveHeaderAction.removeClass( 'master-addons-el-save-now' );
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
                        security: js_maad_el_settings.ajax_extensions_nonce,
                        fields: $( '#master-addons-el-extensions-settings' ).serialize(),
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

                        $this.html('Save Settings');
                        $('.master-addons-el-dashboard-header-right').prepend('<span' +
                            ' class="master-addons-el-settings-saved"></span>').fadeIn('slow');

                        saveHeaderAction.removeClass( 'master-addons-el-save-now' );

                        setTimeout(function(){
                            $('.master-addons-el-settings-saved').fadeOut('slow');
                            swal.close();
                        }, 1200);

                    },
                    error: function() {

                    }
                } );


            } else {
                $(this).attr('disabled', 'true').css('cursor', 'not-allowed');
            }


        } );

});

})(jQuery);
