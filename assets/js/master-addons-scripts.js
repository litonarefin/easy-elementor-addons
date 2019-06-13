
(function($){
    "use strict";

    var editMode		= false;

    var Master_Addons = {

        MA_Accordion:function($scope, $) {

            var $advanced_accordion         = $scope.find(".ma-advanced-accordion").eq(0),
                // elementSettings             = getElementSettings( $scope ),
                $accordion_title            = $scope.find(".ma-accordion-tab-title"),
                $accordion_type             = 'accordion',
                $accordion_speed            = '3000';

            // Open default actived tab
            $accordion_title.each(function(){
                if ( $(this).hasClass('ma-accordion-tab-active-default') ) {
                    $(this).addClass('ma-accordion-tab-show ma-accordion-tab-active');
                    $(this).next().slideDown($accordion_speed)
                }
            })

            // Remove multiple click event for nested accordion
            $accordion_title.unbind("click");

            $accordion_title.click(function(e) {
                e.preventDefault();

                var $this = $(this);

                if ( $accordion_type === 'accordion' ) {
                    if ( $this.hasClass("ma-accordion-tab-show") ) {
                        $this.removeClass("ma-accordion-tab-show ma-accordion-tab-active");
                        $this.next().slideUp($accordion_speed);
                    } else {
                        $this.parent().parent().find(".ma-accordion-tab-title").removeClass("ma-accordion-tab-show" +
                            " ma-accordion-tab-active");
                        $this.parent().parent().find(".ma-accordion-tab-content").slideUp($accordion_speed);
                        $this.toggleClass("ma-accordion-tab-show ma-accordion-tab-active");
                        $this.next().slideToggle($accordion_speed);
                    }
                } else {
                    // For acccordion type 'toggle'
                    if ( $this.hasClass("ma-accordion-tab-show") ) {
                        $this.removeClass("ma-accordion-tab-show ma-accordion-tab-active");
                        $this.next().slideUp($accordion_speed);
                    } else {
                        $this.addClass("ma-accordion-tab-show ma-accordion-tab-active");
                        $this.next().slideDown($accordion_speed);
                    }
                }
            });

        }


    };




    $(window).on('elementor/frontend/init', function () {
        if( elementorFrontend.isEditMode() ) {
            editMode = true;
        }
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-advanced-accordion.default', Master_Addons.MA_Accordion);
    });

})(jQuery);