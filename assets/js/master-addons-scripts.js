
(function($){
    "use strict";

    var Master_Addons = {

        MA_Accordion: function($scope, $) {
            var $accordionTitle = $scope.find('.ma-accordion-title-text');

            // Open default actived tab
            $accordionTitle.each(function(){
                if($(this).hasClass('active-default')){
                    $(this).addClass('active');
                    $(this).next('.ma-accordion-content').slideDown();
                }
            })

            // Remove multiple click event for nested accordion
            $accordionTitle.unbind("click");

            //$accordionWrapper.children('.ma-accordion-content').first().show();
            $accordionTitle.click(function(e){
                e.preventDefault();
                if ($(this).hasClass("active")) {
                    $(this).removeClass('active');
                    $(this).next().slideUp(400);
                } else {
                    $(this).parent().parent().find(".ma-accordion-title-text").removeClass("active");
                    $(this).parent().parent().find(".ma-accordion-content").slideUp(400);
                    $(this).toggleClass("active");
                    $(this).next().slideToggle(400);
                }
            });

        },



    };

    // $(document).ready(function() {
    //     "use strict";

    $(window).on('elementor/frontend/init', function () {
        if( elementorFrontend.isEditMode() ) {
            editMode = true;
        }
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-accordion.default', Master_Addons.MA_Accordion);
    });

})(jQuery);