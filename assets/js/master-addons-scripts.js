
(function($){
    "use strict";

    var editMode		= false;

    function animatedProgressbar(id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth){
        var triggerClass = '.ma-el-progress-bar-'+id;
        if("line" == type) {
            new ldBar(triggerClass, {
                "type"              : 'stroke',
                "path"              : 'M0 10L100 10',
                "aspect-ratio"      : 'none',
                "stroke"			: strokeColor,
                "stroke-trail"	    : trailColor,
                "stroke-width"      : strokeWidth,
                "stroke-trail-width": strokeTrailWidth
            }).set(value);
        }
        if("line-bubble" == type) {
            new ldBar(triggerClass, {
                "type"              : 'stroke',
                "path"              : 'M0 10L100 10',
                "aspect-ratio"      : 'none',
                "stroke"			: strokeColor,
                "stroke-trail"		: trailColor,
                "stroke-width"      : strokeWidth,
                "stroke-trail-width": strokeTrailWidth
            }).set(value);
            $($('.ma-el-progress-bar-'+id).find('.ldBar-label')).animate({
                left: value + '%'
            }, 1000, 'swing');
        }
        if("circle" == type){
            new ldBar(triggerClass, {
                "type"				: 'stroke',
                "path"			    : 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
                "stroke-dir"		: 'normal',
                "stroke"		    : strokeColor,
                "stroke-trail"	    : trailColor,
                "stroke-width"	    : strokeWidth,
                "stroke-trail-width": strokeTrailWidth,
            }).set(value);
        }
        if("fan" == type){
            new ldBar(triggerClass, {
                "type": 'stroke',
                "path": 'M10 90A40 40 0 0 1 90 90',
                "stroke": strokeColor,
                "stroke-trail": trailColor,
                "stroke-width": strokeWidth,
                "stroke-trail-width": strokeTrailWidth,
            }).set(value);
        }
    };


    var Master_Addons = {

//
//         try {
//         (function($) {
//
//         })(jQuery);
// } catch(e) {
//         //We can also throw from try block and catch it here
//         // No Error Show
//     }
//
        // Master Addons: Accordion

        MA_Accordion:function($scope, $) {

            try {
                (function($) {

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
                    });

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

                })(jQuery);
            } catch(e) {
                //We can also throw from try block and catch it here
                // No Error Show
            }


        },


        // Master Addons: Tabs

        MA_Tabs:function($scope, $) {

            try {
                (function($) {

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

                })(jQuery);
            } catch(e) {
                    //We can also throw from try block and catch it here
                    // No Error Show
            }


        },


        //Master Addons: Progressbar
        ProgressBar: function ($scope, $){

            try {
                (function($) {
                    var $progressBarWrapper = $scope.find('[data-progress-bar]').eq(0);
                    $progressBarWrapper.waypoint(function () {
                        var element = $(this.element);
                        var id = element.data('id');
                        var type = element.data('type');
                        var value = element.data('progress-bar-value');
                        var strokeWidth = element.data('progress-bar-stroke-width');
                        var strokeTrailWidth = element.data('progress-bar-stroke-trail-width');
                        var color = element.data('stroke-color');
                        var trailColor = element.data('stroke-trail-color');
                        animatedProgressbar(id, type, value, color, trailColor, strokeWidth, strokeTrailWidth);
                        this.destroy();
                    }, {
                        offset: 'bottom-in-view'
                    });
                })(jQuery);
                
            } catch(e) {
                //We can also throw from try block and catch it here
                // No Error Show
            }


        },

        TeamSlider: function ($scope, $){
            try {
                (function($) {

                    var teamSlider = $("#ma-el-team-member-slider");

                    teamSlider.owlCarousel({
                        autoPlay : 3000,
                        stopOnHover : true,
                        pagination : true,
                        paginationNumbers: false,

                        itemsCustom : [
                            [0, 1],
                            [450, 1],
                            [600, 1],
                            [700, 2],
                            [1000, 3],
                            [1200, 4],
                        ],
                        // Responsive
                        responsive: true,
                        responsiveRefreshRate : 200,
                        responsiveBaseWidth: window
                    });

                })(jQuery);
            } catch(e) {
                //We can also throw from try block and catch it here
                // No Error Show
            }

        }




};




    $(window).on('elementor/frontend/init', function () {
        if( elementorFrontend.isEditMode() ) {
            editMode = true;
        }
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-advanced-accordion.default', Master_Addons.MA_Accordion);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-tabs.default', Master_Addons.MA_Tabs);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-progressbar.default', Master_Addons.ProgressBar);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-team-members.default', Master_Addons.TeamSlider);
    });

})(jQuery);