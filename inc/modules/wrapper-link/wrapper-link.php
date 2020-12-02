<?php
namespace MasterAddons\Modules;

use Elementor\Controls_Manager;
use Elementor\Element_Base;


/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 2/12/2020
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.


class Master_Addons_Wrapper_Link {

	/*
	 * Instance of this class
	 */
	private static $instance = null;

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

    public static function init() {
        add_action( 'elementor/element/column/section_advanced/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );
        add_action( 'elementor/element/section/section_advanced/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );
        add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );

        add_action( 'elementor/frontend/before_render', [ __CLASS__, 'before_section_render' ], 1 );
    }

    public static function add_controls_section( Element_Base $element) {
        $tabs = Controls_Manager::TAB_CONTENT;

        if ( 'section' === $element->get_name() || 'column' === $element->get_name() ) {
            $tabs = Controls_Manager::TAB_LAYOUT;
        }

        $element->start_controls_section(
            '_section_ha_wrapper_link',
            [
                'label' => esc_html__( 'Wrapper Link', MELA_TD ) . ha_get_section_icon(),
                'tab'   => $tabs,
            ]
        );

        $element->add_control(
            'ha_element_link',
            [
                'label'       => esc_html__( 'Link', MELA_TD ),
				'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => 'https://wrapper-link.com',
            ]
        );

        $element->end_controls_section();
    }

    public static function before_section_render( Element_Base $element ) {
        $settings = $element->get_settings_for_display();
        $ha_link  = $settings['ha_element_link'];

        if ( $ha_link && ! empty( $ha_link['url'] ) ) {
            $element->add_render_attribute(
                '_wrapper',
                [
                    'data-ha-element-link' => json_encode( $ha_link ),
                    'style' => 'cursor: pointer'
                ]
            );
        }
    }
}

Master_Addons_Wrapper_Link::get_instance();