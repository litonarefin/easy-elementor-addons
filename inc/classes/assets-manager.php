<?php

namespace MasterAddons\Inc\Classes;

use MasterAddons\Master_Elementor_Addons;

class Master_Addons_Assets
{
    private static $instance = null;
    public $gsap_version = '1.20.2';

    public function __construct()
    {
        add_action('elementor/init', [$this, 'jltma_on_elementor_init'], 0);

        // Enqueue Styles and Scripts
        add_action('wp_enqueue_scripts', [$this, 'jltma_enqueue_scripts'], 100);
    }

    public function jltma_on_elementor_init()
    {
        // Elementor hooks
        $this->add_actions();
    }

    public function add_actions()
    {
        // Elementor Scripts Dependencies
        add_action('elementor/frontend/after_register_styles', [$this, 'jltma_register_frontend_styles']);
        add_action('elementor/frontend/after_register_scripts', [$this, 'jltma_register_frontend_scripts']);
        // add_action( 'elementor/frontend/after_enqueue_scripts', [$this, 'jltma_enqueue_scripts'] );


        // add_action( 'elementor/editor/before_enqueue_scripts'  , array( $this, 'jltma_editor_scripts_enqueue_js' ) );

        add_action('elementor/editor/after_enqueue_scripts', [$this, 'jltma_editor_scripts_js'], 100);
        add_action('elementor/editor/after_enqueue_styles', [$this, 'jltma_enqueue_preview_scripts'], 100);

        add_action('elementor/preview/enqueue_styles', [$this, 'jltma_enqueue_preview_scripts'], 100);
        add_action('elementor/preview/enqueue_scripts', [$this, 'jltma_enqueue_preview_scripts'], 100);
    }


    /** Enqueue Elementor Editor Styles */

    public function jltma_editor_scripts_js()
    {
        wp_enqueue_script('master-addons-editor', MELA_ADMIN_ASSETS . 'js/editor.js', array('jquery'), MELA_VERSION, true);
    }

    // Enqueue Preview Scripts
    public function jltma_enqueue_preview_scripts()
    {
        wp_enqueue_style('ma-creative-buttons');
        wp_enqueue_script('jltma-timeline');
    }


    // Register Frontend Styles
    public function jltma_register_frontend_styles()
    {
        wp_register_style('gridder', MELA_PLUGIN_URL . '/assets/vendor/gridder/css/jquery.gridder.min.css');
        wp_register_style('fancybox', MELA_PLUGIN_URL . '/assets/vendor/fancybox/jquery.fancybox.min.css');
        wp_register_style('twentytwenty', MELA_PLUGIN_URL . '/assets/vendor/image-comparison/css/twentytwenty.css');

        wp_register_style('ma-creative-buttons', MELA_PLUGIN_URL . '/assets/vendor/creative-btn/buttons.css');
        wp_register_style('ma-image-hover-effects', MELA_PLUGIN_URL . '/assets/vendor/image-hover-effects/image-hover-effects.css');
    }


    // Enqueue Preview Scripts
    public function jltma_register_frontend_scripts()
    {

        wp_register_script('ma-animated-headlines', MELA_PLUGIN_URL . '/assets/js/animated-main.js', array('jquery'),    '1.0', true);

        wp_register_script('master-addons-progressbar', MELA_PLUGIN_URL . '/assets/js/loading-bar.js', ['jquery'], MELA_VERSION, true);

        wp_register_script('jquery-stats', MELA_PLUGIN_URL . '/assets/js/jquery.stats.js', ['jquery'], MELA_VERSION, true);

        wp_register_script('master-addons-waypoints', MELA_PLUGIN_URL . '/assets/vendor/jquery.waypoints.min.js', ['jquery'], MELA_VERSION, true);

        wp_register_script('jltma-owl-carousel', MELA_PLUGIN_URL . '/assets/vendor/owlcarousel/owl.carousel.min.js', ['jquery'], MELA_VERSION, true);

        wp_register_script('gridder', MELA_PLUGIN_URL . '/assets/vendor/gridder/js/jquery.gridder.min.js', ['jquery'], MELA_VERSION, true);

        wp_register_script('isotope', MELA_PLUGIN_URL . '/assets/js/isotope.js', array('jquery'), MELA_VERSION, true);

        wp_register_script('ma-news-ticker', MELA_PLUGIN_URL . '/assets/vendor/newsticker/js/newsticker.js', array('jquery'), MELA_VERSION, true);

        wp_register_script('jquery-rss', MELA_PLUGIN_URL . '/assets/vendor/newsticker/js/jquery.rss.min.js', ['jquery'], MELA_VERSION, true);

        wp_register_script('ma-counter-up', MELA_PLUGIN_URL . '/assets/js/counterup.min.js', array('jquery'), MELA_VERSION, true);

        wp_register_script('ma-countdown', MELA_PLUGIN_URL . '/assets/vendor/countdown/jquery.countdown.js', array('jquery'), MELA_VERSION, true);

        wp_register_script('tocbot', MELA_PLUGIN_URL . '/assets/vendor/tocbot/tocbot.min.js', array('jquery'), MELA_VERSION, true);

        wp_register_script('fancybox', MELA_PLUGIN_URL . '/assets/vendor/fancybox/jquery.fancybox.min.js', array('jquery'), MELA_VERSION, true);

        wp_register_script('jltma-timeline', MELA_PLUGIN_URL . '/assets/js/timeline.js', array('jquery'), MELA_VERSION, true);
        // wp_register_script('jltma-tilt', MELA_PLUGIN_URL . '/assets/vendor/tilt/tilt.jquery.min.js', array('jquery'), MELA_VERSION, true);


        // Image Comparison
        wp_register_script('jquery-event-move', MELA_PLUGIN_URL . '/assets/vendor/image-comparison/js/jquery.event.move.js', array('jquery'), MELA_VERSION, true);
        wp_register_script('twentytwenty', MELA_PLUGIN_URL . '/assets/vendor/image-comparison/js/jquery.twentytwenty.js', array('jquery'), MELA_VERSION, true);

        // Toggle Content
        wp_register_script('jltma-toggle-content', MELA_PLUGIN_URL . '/assets/vendor/toggle-content/toggle-content.js', array('jquery'), MELA_VERSION, true);

        // GSAP TweenMax
        wp_register_script('gsap-js', '//cdnjs.cloudflare.com/ajax/libs/gsap/' . $this->gsap_version . '/TweenMax.min.js', array(), null, true);


        // Advanced Animations
        wp_register_script('jltma-floating-effects', MELA_PLUGIN_URL . '/assets/vendor/floating-effects/floating-effects.js', array('ma-el-anime-lib', 'jquery'), MELA_VERSION);
    }


    /**
     * Enqueue Plugin Styles and Scripts
     *
     */
    public function jltma_enqueue_scripts()
    {

        $is_activated_widget = Master_Elementor_Addons::activated_widgets();
        $is_activated_extensions = Master_Elementor_Addons::activated_extensions();
        $jltma_api_settings = get_option('jltma_api_save_settings');

        // Register Styles

        //Reveal
        wp_register_script('ma-el-reveal-lib', MELA_PLUGIN_URL . '/assets/vendor/reveal/revealFx.js', array('jquery'), MELA_VERSION, true);
        wp_register_script('ma-el-anime-lib', MELA_PLUGIN_URL . '/assets/vendor/anime/anime.min.js', array('jquery'), MELA_VERSION, true);

        //Rellax
        wp_register_script('ma-el-rellaxjs-lib', MELA_PLUGIN_URL . '/assets/vendor/rellax/rellax.min.js', array('jquery'), MELA_VERSION, true);

        // Register Scripts


        // Enqueue Styles
        wp_enqueue_style('master-addons-main-style', MELA_PLUGIN_URL . '/assets/css/master-addons-styles.css');


        // Enqueue Scripts
        wp_enqueue_script('master-addons-plugins', MELA_PLUGIN_URL . '/assets/js/plugins.js', ['jquery'], MELA_VERSION, true);
        wp_enqueue_script('master-addons-scripts', MELA_PLUGIN_URL . '/assets/js/master-addons-scripts.js', ['jquery'], MELA_VERSION, true);


        // Add essential inline scripts to header
        $jltma_header_inline_scripts = 'function jltmaNS(n){for(var e=n.split("."),a=window,i="",r=e.length,t=0;r>t;t++)"window"!=e[t]&&(i=e[t],a[i]=a[i]||{},a=a[i]);return a;}';
        if ($jltma_header_inline_scripts = apply_filters('jltma_header_inline_scripts', $jltma_header_inline_scripts)) {
            wp_add_inline_script(
                'jquery-core',
                "/* < ![CDATA[ */\n" . $jltma_header_inline_scripts . "\n/* ]]> */",
                'before'
            );
        }


        $localize_data = array(
            'plugin_url'    => MELA_PLUGIN_URL,
            'ajaxurl'       => admin_url('admin-ajax.php'),
            'nonce'           => 'master-addons-elementor',
        );
        wp_localize_script('master-addons-scripts', 'jltma_scripts', $localize_data);

    }


    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
Master_Addons_Assets::get_instance();
