<?php

namespace MasterAddons\Modules;

use \Elementor\Controls_Manager;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/5/2021
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly.

class Extension_Glassmorphism
{

    /*
	* Instance of this class
	*/
    private static $instance = null;

    public function __construct()
    {
        // Add new controls to advanced tab globally
        add_action("elementor/element/section/section_background/before_section_end", array($this, 'jltma_section_add_glassmorphism_controls'), 19, 3);
        add_action("elementor/element/column/section_style/before_section_end", array($this, 'jltma_section_add_glassmorphism_controls'), 19, 3);
        add_action("elementor/element/common/_section_background/before_section_end", array($this, 'jltma_section_add_glassmorphism_controls'), 19, 3);
    }

    // Add Section Controls
    public function jltma_section_add_glassmorphism_controls($section)
    {
        // Adds Glasshmorphism options
        // ---------------------------------------------------------------------
        $section->add_control(
            'jltma_section_style_container_glassmorphism',
            array(
                'label'     => __(' MA Glassmorphism', MELA_TD),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            )
        );

        $section->add_control(
            'jltma_glassmorphism_notice',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __('Not Supported Browers: Mozilla Firefox ', MELA_TD),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
            ]
        );

        $section->add_control(
            'jltma_enable_glassmorphism_effect',
            [
                'label'        => __('Enable Glassmorphism', MELA_TD),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
                'render_type'  => 'template',
                'label_on'     => __('Enable', MELA_TD),
                'label_off'    => __('Disable', MELA_TD),
                'prefix_class' => 'jltma-glass-effect-',
            ]
        );

        $section->add_control(
            'jltma_glass_effect_blur_value',
            [
                'label' => __('Blur Value', MELA_TD),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 20,
                'selectors' => [
                    '{{WRAPPER}}.jltma-glass-effect-yes.elementor-section'             => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
                    '{{WRAPPER}}.jltma-glass-effect-yes > .elementor-column-wrap'      => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
                    '{{WRAPPER}}.jltma-glass-effect-yes > .elementor-widget-container' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
                ],
                'condition' => [
                    'jltma_enable_glassmorphism_effect' => 'yes'
                ],
            ]
        );
    }


    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

Extension_Glassmorphism::get_instance();
