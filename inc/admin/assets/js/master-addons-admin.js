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


    // $( '.master-addons-dashboard-tabs li a' ).on( 'click', function(e) {
    //     e.preventDefault();
    //     $( '.master-addons-dashboard-tabs li a' ).removeClass( 'active' );
    //     $(this).addClass( 'active' );
    //     var tab = $(this).attr( 'href' );
    //     $( '.master-addons-dashboard-tab' ).removeClass( 'active' );
    //     $( '.master-addons-dashboard-tabs-wrapper' ).find( tab ).addClass( 'active' );
    // });

    // Save Button reacting on any changes
    var saveHeaderAction = $( '.master-addons-el-dashboard-header-wrapper .master-addons-el-btn' );
    $('.master-addons-dashboard-tab input').on( 'click', function() {
        saveHeaderAction.addClass( 'master-addons-el-save-now' );
        saveHeaderAction.removeAttr('disabled').css('cursor', 'pointer');
    } );

// Saving Data With Ajax Request
    $( '.master-addons-el-js-element-save-setting' ).on( 'click', function(e) {
        e.preventDefault();
        var $this = $(this);
        if( $(this).hasClass('master-addons-el-save-now') ) {
            $.ajax( {
                url: js_maad_el_settings.ajaxurl,
                type: 'post',
                data: {
                    action: 'master_addons_save_elements_settings',
                    security: js_maad_el_settings.ajax_nonce,
                    fields: $( '#master-addons-el-settings' ).serialize(),
                },
                beforeSend: function() {
                    $this.html('<svg id="master-addons-el-spinner" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48' +
                        ' 48"><circle' +
                        ' cx="24" cy="4" r="4" fill="#fff"/><circle cx="12.19" cy="7.86" r="3.7" fill="#fffbf2"/><circle cx="5.02" cy="17.68" r="3.4" fill="#fef7e4"/><circle cx="5.02" cy="30.32" r="3.1" fill="#fef3d7"/><circle cx="12.19" cy="40.14" r="2.8" fill="#feefc9"/><circle cx="24" cy="44" r="2.5" fill="#feebbc"/><circle cx="35.81" cy="40.14" r="2.2" fill="#fde7af"/><circle cx="42.98" cy="30.32" r="1.9" fill="#fde3a1"/><circle cx="42.98" cy="17.68" r="1.6" fill="#fddf94"/><circle cx="35.81" cy="7.86" r="1.3" fill="#fcdb86"/></svg><span>Saving Data..</span>');
                },
                success: function( response ) {

                    $this.html('Save Settings');
                    $('.master-addons-el-dashboard-header-right').prepend('<span' +
                        ' class="master-addons-el-settings-saved">Settings Saved</span>').fadeIn('slow');

                    saveHeaderAction.removeClass( 'master-addons-el-save-now' );

                    setTimeout(function(){
                        $('.master-addons-el-settings-saved').fadeOut('slow');
                    }, 2000);

                },
                error: function() {

                }
            } );
        } else {
            $(this).attr('disabled', 'true').css('cursor', 'not-allowed');
        }
    } );

});
