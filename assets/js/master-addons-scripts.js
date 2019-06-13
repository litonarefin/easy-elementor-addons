
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

        },

        // Exclusive Tabs script
        MA_Tabs:function($scope, $) {
            var $tabsWrapper = $scope.find('[data-tabs]').eq(0);
            $tabsWrapper.each( function() {
                var tab = $(this);
                var isTabActive = false;
                var isContentActive = false;
                tab.find('[data-tab]').each( function (){
                    if($(this).hasClass('active')){
                        isTabActive = true;
                    }
                });
                tab.find('.ma-el-advance-tab-content').each( function (){
                    if($(this).hasClass('active')){
                        isContentActive = true;
                    }
                });
                if(!isContentActive){
                    tab.find('.ma-el-advance-tab-content').eq(0).addClass('active');
                }
                if(!isTabActive){
                    tab.find('[data-tab]').eq(0).addClass('active');
                }
                tab.find('[data-tab]').click(function() {
                    tab.find('[data-tab]').removeClass('active');
                    tab.find('.ma-el-advance-tab-content').removeClass('active');
                    $(this).addClass('active');
                    tab.find('.ma-el-advance-tab-content').eq($(this).index()).addClass('active');
                });
            });
        }



    };




    $(window).on('elementor/frontend/init', function () {
        if( elementorFrontend.isEditMode() ) {
            editMode = true;
        }
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-advanced-accordion.default', Master_Addons.MA_Accordion);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-tabs.default', Master_Addons.MA_Tabs);
    });

})(jQuery);