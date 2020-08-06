<?php
namespace MasterAddons\Modules\CustomJS;

use Elementor\Controls_Manager;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 04/08/20
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Master_Addons_Custom_JS{

    private static $instance = null;

    public function __construct(){
        // Add new controls to Page Settings on Advanced Tab globally
        add_action('elementor/documents/register_controls', [$this, 'jltma_add_section_custom_js_controls'], 20);
    }

    public function jltma_add_section_custom_js_controls($controls){
        $controls->start_controls_section(
            'jtlma_section_custom_js',
            [
                'label'         => MA_EL_BADGE . __( ' Custom JS', MELA_TD ),
                'tab'           => Controls_Manager::TAB_ADVANCED,
            ]
        );

        $controls->add_control(
            'jtlma_custom_js_label',
            [
                'type'          => Controls_Manager::RAW_HTML,
                'raw'           => __('Add your own custom JS here', MELA_TD),
            ]
        );

        $controls->add_control(
            'jtlma_custom_js',
            [
                'type'          => Controls_Manager::CODE,
                'show_label'    => false,
                'language'      => 'javascript',
            ]
        );

        $controls->add_control(
            'jtlma_custom_js_usage',
            [
                'type'              => Controls_Manager::RAW_HTML,
                'raw'               => __('You may use both jQuery selector e.g. $(‘.selector’) or Vanilla JS selector e.g. document.queryselector(‘.selector’)', MELA_TD),
                'content_classes'   => 'elementor-descriptor',
            ]
        );

        $controls->add_control(
            'jtlma_custom_js_docs',
            [
                'type'              => Controls_Manager::RAW_HTML,
                'raw'               => __('For more information, <a href="https://master-addons.com/docs/addons/custom-js-extension/" target="_blank">click here</a>', MELA_TD),
                'content_classes'   => 'elementor-descriptor',
            ]
        );

        $controls->end_controls_section();
    }

    public static function get_instance() {
        if ( ! self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}

Master_Addons_Custom_JS::get_instance();