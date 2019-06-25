
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

    var getElementSettings = function( $element ) {
        var elementSettings = {},
            modelCID 		= $element.data( 'model-cid' );

        if ( elementorFrontend.isEditMode && modelCID ) {
            var settings 		= elementorFrontend.config.elements.data[ modelCID ],
                settingsKeys 	= elementorFrontend.config.elements.keys[ settings.attributes.widgetType || settings.attributes.elType ];

            jQuery.each( settings.getActiveControls(), function( controlKey ) {
                if ( -1 !== settingsKeys.indexOf( controlKey ) ) {
                    elementSettings[ controlKey ] = settings.attributes[ controlKey ];
                }
            } );
        } else {
            elementSettings = $element.data('settings') || {};
        }

        return elementSettings;
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
        // Master Addons: Headlines

        MA_Headlines: function($scope, $) {
            try {
                (function($) {

                    /*----------- Animated Headlines --------------*/

                    //set animation timing
                    var animationDelay = 2500,
                        //loading bar effect
                        barAnimationDelay = 3800,
                        barWaiting = barAnimationDelay - 3000, //3000 is the duration of the transition on the loading bar - set in the scss/css file
                        //letters effect
                        lettersDelay = 50,
                        //type effect
                        typeLettersDelay = 150,
                        selectionDuration = 500,
                        typeAnimationDelay = selectionDuration + 800,
                        //clip effect
                        revealDuration = 600,
                        revealAnimationDelay = 1500;

                    initHeadline();


                    function initHeadline() {
                        //insert <i> element for each letter of a changing word
                        singleLetters($('.cd-headline.letters').find('b'));
                        //initialise headline animation
                        animateHeadline($('.cd-headline'));
                    }

                    function singleLetters($words) {
                        $words.each(function(){
                            var word = $(this),
                                letters = word.text().split(''),
                                selected = word.hasClass('is-visible');
                            for (i in letters) {
                                if(word.parents('.rotate-2').length > 0) letters[i] = '<em>' + letters[i] + '</em>';
                                letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>': '<i>' + letters[i] + '</i>';
                            }
                            var newLetters = letters.join('');
                            word.html(newLetters).css('opacity', 1);
                        });
                    }

                    function animateHeadline($headlines) {
                        var duration = animationDelay;
                        $headlines.each(function(){
                            var headline = $(this);

                            if(headline.hasClass('loading-bar')) {
                                duration = barAnimationDelay;
                                setTimeout(function(){ headline.find('.cd-words-wrapper').addClass('is-loading') }, barWaiting);
                            } else if (headline.hasClass('clip')){
                                var spanWrapper = headline.find('.cd-words-wrapper'),
                                    newWidth = spanWrapper.width() + 10
                                spanWrapper.css('width', newWidth);
                            } else if (!headline.hasClass('type') ) {
                                //assign to .cd-words-wrapper the width of its longest word
                                var words = headline.find('.cd-words-wrapper b'),
                                    width = 0;
                                words.each(function(){
                                    var wordWidth = $(this).width();
                                    if (wordWidth > width) width = wordWidth;
                                });
                                headline.find('.cd-words-wrapper').css('width', width);
                            };

                            //trigger animation
                            setTimeout(function(){ hideWord( headline.find('.is-visible').eq(0) ) }, duration);
                        });
                    }

                    function hideWord($word) {
                        var nextWord = takeNext($word);

                        if($word.parents('.cd-headline').hasClass('type')) {
                            var parentSpan = $word.parent('.cd-words-wrapper');
                            parentSpan.addClass('selected').removeClass('waiting');
                            setTimeout(function(){
                                parentSpan.removeClass('selected');
                                $word.removeClass('is-visible').addClass('is-hidden').children('i').removeClass('in').addClass('out');
                            }, selectionDuration);
                            setTimeout(function(){ showWord(nextWord, typeLettersDelay) }, typeAnimationDelay);

                        } else if($word.parents('.cd-headline').hasClass('letters')) {
                            var bool = ($word.children('i').length >= nextWord.children('i').length) ? true : false;
                            hideLetter($word.find('i').eq(0), $word, bool, lettersDelay);
                            showLetter(nextWord.find('i').eq(0), nextWord, bool, lettersDelay);

                        }  else if($word.parents('.cd-headline').hasClass('clip')) {
                            $word.parents('.cd-words-wrapper').animate({ width : '2px' }, revealDuration, function(){
                                switchWord($word, nextWord);
                                showWord(nextWord);
                            });

                        } else if ($word.parents('.cd-headline').hasClass('loading-bar')){
                            $word.parents('.cd-words-wrapper').removeClass('is-loading');
                            switchWord($word, nextWord);
                            setTimeout(function(){ hideWord(nextWord) }, barAnimationDelay);
                            setTimeout(function(){ $word.parents('.cd-words-wrapper').addClass('is-loading') }, barWaiting);

                        } else {
                            switchWord($word, nextWord);
                            setTimeout(function(){ hideWord(nextWord) }, animationDelay);
                        }
                    }

                    function showWord($word, $duration) {
                        if($word.parents('.cd-headline').hasClass('type')) {
                            showLetter($word.find('i').eq(0), $word, false, $duration);
                            $word.addClass('is-visible').removeClass('is-hidden');

                        }  else if($word.parents('.cd-headline').hasClass('clip')) {
                            $word.parents('.cd-words-wrapper').animate({ 'width' : $word.width() + 10 }, revealDuration, function(){
                                setTimeout(function(){ hideWord($word) }, revealAnimationDelay);
                            });
                        }
                    }

                    function hideLetter($letter, $word, $bool, $duration) {
                        $letter.removeClass('in').addClass('out');

                        if(!$letter.is(':last-child')) {
                            setTimeout(function(){ hideLetter($letter.next(), $word, $bool, $duration); }, $duration);
                        } else if($bool) {
                            setTimeout(function(){ hideWord(takeNext($word)) }, animationDelay);
                        }

                        if($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
                            var nextWord = takeNext($word);
                            switchWord($word, nextWord);
                        }
                    }

                    function showLetter($letter, $word, $bool, $duration) {
                        $letter.addClass('in').removeClass('out');

                        if(!$letter.is(':last-child')) {
                            setTimeout(function(){ showLetter($letter.next(), $word, $bool, $duration); }, $duration);
                        } else {
                            if($word.parents('.cd-headline').hasClass('type')) { setTimeout(function(){ $word.parents('.cd-words-wrapper').addClass('waiting'); }, 200);}
                            if(!$bool) { setTimeout(function(){ hideWord($word) }, animationDelay) }
                        }
                    }

                    function takeNext($word) {
                        return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
                    }

                    function takePrev($word) {
                        return (!$word.is(':first-child')) ? $word.prev() : $word.parent().children().last();
                    }

                    function switchWord($oldWord, $newWord) {
                        $oldWord.removeClass('is-visible').addClass('is-hidden');
                        $newWord.removeClass('is-hidden').addClass('is-visible');
                    }


                })(jQuery);
            } catch(e) {
                        //We can also throw from try block and catch it here
                        // No Error Show
            }

        },

        // Master Addons: Accordion
        MA_Accordion:function($scope, $) {
            //
            // try {
            //     (function() {
                    var $advanced_accordion         = $scope.find(".ma-advanced-accordion").eq(0),
                        elementSettings             = getElementSettings( $scope ),
                        $accordion_title            = $scope.find(".ma-accordion-tab-title"),
                        $accordion_type             = elementSettings.accordion_type,
                        $accordion_speed            = elementSettings.toggle_speed;

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
                                $this.parent().parent().find(".ma-accordion-tab-title").removeClass("ma-accordion-tab-show ma-accordion-tab-active");
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

            //
            //     })(jQuery);
            // } catch(e) {
            //     //We can also throw from try block and catch it here
            //     // No Error Show
            // }


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

                    var $teamCarouselWrapper = $scope.find('.ma-el-team-carousel-wrapper').eq(0),
                        $carousel_nav = $teamCarouselWrapper.data("carousel-nav"),
                        $loop = ($teamCarouselWrapper.data("loop") !== undefined) ? $teamCarouselWrapper.data("loop") : false,
                        $slidesToShow = $teamCarouselWrapper.data("slidestoshow"),
                        $slidesToScroll = $teamCarouselWrapper.data("slidestoscroll"),
                        $autoPlay = ($teamCarouselWrapper.data("autoplay") !== undefined) ? $teamCarouselWrapper.data("autoplay") : false,
                        $autoplaySpeed = ($teamCarouselWrapper.data("autoplayspeed") !== undefined) ? $teamCarouselWrapper.data("autoplayspeed") : false,
                        $transitionSpeed = $teamCarouselWrapper.data("speed"),
                        $pauseOnHover = ($teamCarouselWrapper.data("pauseonhover") !== undefined) ? $teamCarouselWrapper.data("pauseonhover") : false;

                    // Team Carousel
                    if ($carousel_nav == "arrows" ) {
                        var arrows = true;
                        var dots = false;
                    } else {
                        var arrows = false;
                        var dots = true;
                    }

                    $teamCarouselWrapper.slick({
                        infinite: $loop,
                        slidesToShow : $slidesToShow,
                        slidesToScroll: $slidesToScroll,
                        autoplay: $autoPlay,
                        autoplaySpeed: $autoplaySpeed,
                        speed: $transitionSpeed,
                        pauseOnHover: $pauseOnHover,
                        dots: dots,
                        arrows: arrows,
                        prevArrow: "<div class='ma-el-team-carousel-prev'><i class='fa fa-angle-left'></i></div>",
                        nextArrow: "<div class='ma-el-team-carousel-next'><i class='fa fa-angle-right'></i></div>",
                        rows: 0,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 2,
                                }
                            },
                            {
                                breakpoint: 576,
                                settings: {
                                    slidesToShow: 1,
                                }
                            }
                        ],
                    });


                })(jQuery);
            } catch(e) {
                //We can also throw from try block and catch it here
                // No Error Show
            }

        },


        ParticlesBG : function ($scope, $) {

            if ($scope.hasClass('eae-particle-yes')) {
                id = $scope.data('id');
                //console.lgo(id);
                element_type = $scope.data('element_type');
                pdata = $scope.data('eae-particle');
                pdata_wrapper = $scope.find('.eae-particle-wrapper').data('eae-pdata');
                if (typeof pdata != 'undefined' && pdata != '') {
                    if ($scope.find('.eae-section-bs').length > 0) {
                        $scope.find('.eae-section-bs').after('<div class="eae-particle-wrapper" id="eae-particle-' + id + '"></div>');
                        particlesJS('eae-particle-' + id, pdata);
                    } else {

                        if (element_type == 'column') {

                            $scope.find('.elementor-column-wrap').prepend('<div class="eae-particle-wrapper" id="eae-particle-' + id + '"></div>');
                        } else {
                            $scope.prepend('<div class="eae-particle-wrapper" id="eae-particle-' + id + '"></div>');
                        }

                        particlesJS('eae-particle-' + id, pdata);
                    }


                } else if (typeof pdata_wrapper != 'undefined' && pdata_wrapper != '') {

                    // $scope.prepend('<div class="eae-particle-wrapper" id="eae-particle-'+ id +'"></div>');
                    //console.log('calling particle js else', JSON.parse(pdata_wrapper));
                    if (element_type == 'column') {
                        $scope.find('.elementor-column-wrap').prepend('<div class="eae-particle-wrapper" id="eae-particle-' + id + '"></div>');
                    }
                    else{
                        $scope.prepend('<div class="eae-particle-wrapper" id="eae-particle-' + id + '"></div>');
                    }

                    particlesJS('eae-particle-' + id, JSON.parse(pdata_wrapper));
                }

            }

        }




};




    $(window).on('elementor/frontend/init', function () {
        if( elementorFrontend.isEditMode() ) {
            editMode = true;
        }
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-headlines.default', Master_Addons.MA_Headlines);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-advanced-accordion.default', Master_Addons.MA_Accordion);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-tabs.default', Master_Addons.MA_Tabs);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-progressbar.default', Master_Addons.ProgressBar);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-team-members.default', Master_Addons.TeamSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/ma-particles.default', Master_Addons.ParticlesBG);
    });

})(jQuery);