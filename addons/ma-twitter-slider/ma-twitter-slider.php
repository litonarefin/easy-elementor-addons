<?php
namespace Elementor;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Box_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 02/05/2020
 */

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Master_Addons_Twitter_Slider extends Widget_Base {

    private $_query = null;

	public function get_name() {
		return 'jltma-twitter-slider';
	}

	public function get_title() {
		return esc_html__( 'Twitter Slider', MELA_TD );
	}

	public function get_icon() {
		return 'ma-el-icon eicon-twitter-feed';
	}

	public function get_categories() {
		return [ 'master-addons' ];
	}

    public function get_style_depends() {
        return [
            'font-awesome-5-all',
            'font-awesome-4-shim'
        ];
    }

    public function get_script_depends() {
        return [ 'jquery-slick', 'master-addons-scripts' ];
    }

    public function get_help_url(){
        return 'https://master-addons.com/demos/logo-slider/';
    }

    public function on_import( $element ) {
        if ( ! get_post_type_object( $element['settings']['posts_post_type'] ) ) {
            $element['settings']['posts_post_type'] = 'post';
        }
        return $element;
    }

    public function get_query() {
        return $this->_query;
    }

    public function on_export( $element ) {
        $element = Group_Control_Posts::on_export_remove_setting_from_element( $element, 'posts' );
        return $element;
    }

	protected function _register_controls() {

        /*
        * Content: Layout
        */
        $this->start_controls_section(
            'jltma_ts_section_layout',
            [
                'label' => esc_html__( 'Layout', MELA_TD ),
            ]
        );


        $this->add_responsive_control(
            'jltma_ts_columns',
            [
                'label'          => esc_html__( 'Columns', MELA_TD ),
                'type'           => Controls_Manager::SELECT,
                'default'        => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options'        => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_tweet_num',
            [
                'label'   => esc_html__( 'Limit', MELA_TD ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'jltma_ts_cache_time',
            [
                'label'   => esc_html__( 'Cache Time(m)', MELA_TD ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 60,
            ]
        );

        $this->add_control(
            'jltma_ts_show_avatar',
            [
                'label'   => esc_html__( 'Show Avatar', MELA_TD ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'jltma_ts_avatar_link',
            [
                'label'     => esc_html__( 'Avatar Link', MELA_TD ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'jltma_ts_show_avatar' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'jltma_ts_show_time',
            [
                'label'   => esc_html__( 'Show Time', MELA_TD ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'jltma_ts_long_time_format',
            [
                'label'     => esc_html__( 'Long Time Format', MELA_TD ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'jltma_ts_show_time' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'jltma_ts_show_meta_button',
            [
                'label' => esc_html__( 'Execute Buttons', MELA_TD ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'jltma_ts_exclude_replies',
            [
                'label' => esc_html__( 'Exclude Replies', MELA_TD ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();



        /*
        * Content: Layout
        */
        $this->start_controls_section(
            'jltma_ts_section_navigation',
            [
                'label' => esc_html__( 'Navigation', MELA_TD ),
            ]
        );

        $this->add_control(
            'jltma_ts_navigation',
            [
                'label'   => esc_html__( 'Navigation', MELA_TD ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
                    'both'   => esc_html__( 'Arrows and Dots', MELA_TD ),
                    'arrows' => esc_html__( 'Arrows', MELA_TD ),
                    'dots'   => esc_html__( 'Dots', MELA_TD ),
                    'none'   => esc_html__( 'None', MELA_TD ),
                ],
                'prefix_class' => 'bdt-navigation-type-',
                'render_type'  => 'template',               
            ]
        );
        
        $this->add_control(
            'jltma_ts_both_position',
            [
                'label'     => esc_html__( 'Arrows and Dots Position', MELA_TD ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                'condition' => [
                    'jltma_ts_navigation' => 'both',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_position',
            [
                'label'     => esc_html__( 'Arrows Position', MELA_TD ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                'condition' => [
                    'jltma_ts_navigation' => 'arrows',
                ],              
            ]
        );

        $this->add_control(
            'jltma_ts_dots_position',
            [
                'label'     => esc_html__( 'Dots Position', MELA_TD ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bottom-center',
                'options'   => Master_Addons_Helper::jltma_carousel_pagination_position(),
                'condition' => [
                    'jltma_ts_navigation' => 'dots',
                ],              
            ]
        );

        $this->end_controls_section();


        /*
        * Content: Slider Setting
        */

        $this->start_controls_section(
            'jltma_ts_section_slider_settins',
            [
                'label' => esc_html__( 'Slider Settings', MELA_TD ),
            ]
        );


        $this->add_control(
            'jltma_ts_autoplay',
            [
                'label'   => esc_html__( 'Auto Play', MELA_TD ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'jltma_ts_autoplay_speed',
            [
                'label'     => esc_html__( 'Autoplay Speed', MELA_TD ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'jltma_ts_autoplay' => 'yes',
                ],
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'jltma_ts_pauseonhover',
            [
                'label' => esc_html__( 'Pause on Hover', MELA_TD ),
                'type'  => Controls_Manager::SWITCHER,
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'jltma_ts_speed',
            [
                'label'   => esc_html__( 'Animation Speed (ms)', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 500,
                ],
                'range' => [
                    'min'  => 100,
                    'max'  => 5000,
                    'step' => 50,
                ],
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'jltma_ts_loop',
            [
                'label'   => esc_html__( 'Loop', MELA_TD ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'jltma_ts_transition',
            [
                'label'   => esc_html__( 'Transition', MELA_TD ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide'     => esc_html__( 'Slide', MELA_TD ),
                    'fade'      => esc_html__( 'Fade', MELA_TD ),
                    'cube'      => esc_html__( 'Cube', MELA_TD ),
                    'coverflow' => esc_html__( 'Coverflow', MELA_TD ),
                    'flip'      => esc_html__( 'Flip', MELA_TD ),
                ],
                'frontend_available'    => true,
            ]
        );        
        $this->end_controls_section();




        /*
        * STYLE: Items
        */

        $this->start_controls_section(
            'jltma_ts_section_style_layout',
            [
                'label' => esc_html__( 'Items', MELA_TD ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'jltma_ts_item_color',
            [
                'label'     => esc_html__( 'Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-carousel-item .bdt-twitter-text,
                    {{WRAPPER}} .bdt-twitter-slider .bdt-carousel-item .bdt-twitter-text *' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_alignment',
            [
                'label'   => esc_html__( 'Alignment', MELA_TD ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left'    => [
                        'title' => esc_html__( 'Left', MELA_TD ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', MELA_TD ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', MELA_TD ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-carousel-item .bdt-card-body' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        /*
        * STYLE: Avatar
        */


        $this->start_controls_section(
            'jltma_ts_section_style_avatar',
            [
                'label'     => esc_html__( 'Avatar', MELA_TD ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'jltma_ts_show_avatar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_avatar_width',
            [
                'label' => esc_html__( 'Width', MELA_TD ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 48,
                        'min' => 15,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'jltma_ts_avatar_align',
            [
                'label'   => esc_html__( 'Alignment', MELA_TD ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => esc_html__( 'Left', MELA_TD ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', MELA_TD ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', MELA_TD ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_avatar_background',
            [
                'label'     => esc_html__( 'Background', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'jltma_ts_avatar_padding',
            [
                'label'      => esc_html__( 'Padding', MELA_TD ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'jltma_ts_avatar_margin',
            [
                'label'      => esc_html__( 'Margin', MELA_TD ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'jltma_ts_avatar_radius',
            [
                'label'      => esc_html__( 'Border Radius', MELA_TD ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper,
                    {{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_avatar_opacity',
            [
                'label'   => esc_html__( 'Opacity (%)', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-thumb-wrapper img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_section();      



        /*
        * STYLE: Execute Button
        */

        $this->start_controls_section(
            'jltma_ts_section_style_meta',
            [
                'label'     => esc_html__( 'Execute Buttons', MELA_TD ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'jltma_ts_show_meta_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_meta_color',
            [
                'label'     => esc_html__( 'Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-meta-button > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_meta_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-meta-button > a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        /*
        * STYLE: Time
        */

        $this->start_controls_section(
            'jltma_ts_section_style_time',
            [
                'label'     => esc_html__( 'Time', MELA_TD ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'jltma_ts_show_time' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_time_color',
            [
                'label'     => esc_html__( 'Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-meta-wrapper a.bdt-twitter-time-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_time_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-twitter-meta-wrapper a.bdt-twitter-time-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();     


        /*
        * STYLE: Navigation
        */ 

        $this->start_controls_section(
            'jltma_ts_section_style_navigation',
            [
                'label'     => __( 'Navigation', MELA_TD ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation' => [ 'arrows', 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_size',
            [
                'label' => __( 'Arrows Size', MELA_TD ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev svg,
                    {{WRAPPER}} .bdt-carousel .bdt-navigation-next svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'jltma_ts_navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_background',
            [
                'label'     => __( 'Background Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev,
                    {{WRAPPER}} .bdt-carousel .bdt-navigation-next' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'jltma_ts_navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_hover_background',
            [
                'label'     => __( 'Hover Background Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev:hover, {{WRAPPER}} .bdt-carousel .bdt-navigation-next:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'jltma_ts_navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_color',
            [
                'label'     => __( 'Arrows Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev svg, {{WRAPPER}} .bdt-carousel .bdt-navigation-next svg' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'jltma_ts_navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_hover_color',
            [
                'label'     => __( 'Arrows Hover Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev:hover svg,
                    {{WRAPPER}} .bdt-carousel .bdt-navigation-next:hover svg' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'jltma_ts_navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_space',
            [
                'label' => __( 'Space', MELA_TD ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-next' => 'margin-left: {{SIZE}}px;',
                ],
                'conditions'   => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'both',
                        ],
                        [
                            'name'     => 'jltma_ts_both_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'jltma_ts_arrows_padding',
            [
                'label'      => esc_html__( 'Padding', MELA_TD ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev,
                    {{WRAPPER}} .bdt-carousel .bdt-navigation-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_radius',
            [
                'label'      => __( 'Border Radius', MELA_TD ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev,
                    {{WRAPPER}} .bdt-carousel .bdt-navigation-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'jltma_ts_navigation' => [ 'arrows', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_dots_size',
            [
                'label' => __( 'Dots Size', MELA_TD ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'jltma_ts_navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_dots_color',
            [
                'label'     => __( 'Dots Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_active_dot_color',
            [
                'label'     => __( 'Active Dots Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'navigation' => [ 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_ncx_position',
            [
                'label'   => __( 'Horizontal Offset', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'arrows',
                        ],
                        [
                            'name'     => 'jltma_ts_arrows_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_ncy_position',
            [
                'label'   => __( 'Vertical Offset', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-arrows-container' => 'transform: translate({{arrows_ncx_position.size}}px, {{SIZE}}px);',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'arrows',
                        ],
                        [
                            'name'     => 'jltma_ts_arrows_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_acx_position',
            [
                'label'   => __( 'Horizontal Offset', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => -60,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev' => 'left: {{SIZE}}px;',
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-next' => 'right: {{SIZE}}px;',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'arrows',
                        ],
                        [
                            'name'  => 'jltma_ts_arrows_position',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_dots_nnx_position',
            [
                'label'   => __( 'Horizontal Offset', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'conditions'   => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'dots',
                        ],
                        [
                            'name'     => 'jltma_ts_dots_position',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_dots_nny_position',
            [
                'label'   => __( 'Vertical Offset', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-dots-container' => 'transform: translate({{dots_nnx_position.size}}px, {{SIZE}}px);',
                ],
                'conditions'   => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'dots',
                        ],
                        [
                            'name'     => 'jltma_ts_dots_position',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_both_ncx_position',
            [
                'label'   => __( 'Horizontal Offset', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'conditions'   => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'both',
                        ],
                        [
                            'name'     => 'jltma_ts_both_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_both_ncy_position',
            [
                'label'   => __( 'Vertical Offset', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-arrows-dots-container' => 'transform: translate({{both_ncx_position.size}}px, {{SIZE}}px);',
                ],
                'conditions'   => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'both',
                        ],
                        [
                            'name'     => 'jltma_ts_both_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_both_cx_position',
            [
                'label'   => __( 'Arrows Offset', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => -60,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-prev' => 'left: {{SIZE}}px;',
                    '{{WRAPPER}} .bdt-carousel .bdt-navigation-next' => 'right: {{SIZE}}px;',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'both',
                        ],
                        [
                            'name'  => 'jltma_ts_both_position',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_both_cy_position',
            [
                'label'   => __( 'Dots Offset', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-carousel .bdt-dots-container' => 'transform: translateY({{SIZE}}px);',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name'  => 'jltma_ts_navigation',
                            'value' => 'both',
                        ],
                        [
                            'name'  => 'jltma_ts_both_position',
                            'value' => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

	}

    // Twitter Slider: Loop
    public function jltma_ts_loop_twitter( $twitter_consumer_key, $consumer_secret, $access_token, $access_token_secret, $twitter_username  ) {
        
        $settings          = $this->get_settings();

        $name              = $twitter_username;
        $exclude_replies   = ('yes' === $settings['jltma_ts_exclude_replies'] ) ? true : false;
        $transName         = 'bdt-tweets-'.$name; // Name of value in database. [added $name for multiple account use]
        $backupName        = $transName . '-backup'; // Name of backup value in database.


        if(false === ($tweets = get_transient( $name ) ) ) :
        
            $connection = new \TwitterOAuth( $twitter_consumer_key, $consumer_secret, $access_token, $access_token_secret );

            $totalToFetch = ($exclude_replies) ? max(50, $settings['jltma_ts_tweet_num'] * 3) : $settings['jltma_ts_tweet_num'];

            $fetchedTweets = $connection->get(
                'statuses/user_timeline',
                array(
                    'screen_name'     => $name,
                    'count'           => $totalToFetch,
                    'exclude_replies' => $exclude_replies
                )
            );

            // Did the fetch fail?
            if($connection->http_code != 200) :
                $tweets = get_option($backupName); // False if there has never been data saved.
            else :
                // Fetch succeeded.
                // Now update the array to store just what we need.
                // (Done here instead of PHP doing this for every page load)
                $limitToDisplay = min($settings['jltma_ts_tweet_num'], count($fetchedTweets));

                for($i = 0; $i < $limitToDisplay; $i++) :
                    $tweet = $fetchedTweets[$i];

                        // Core info.
                        $name = $tweet->user->name;
                        $screen_name = $tweet->user->screen_name;
                        $permalink = 'https://twitter.com/'. $screen_name .'/status/'. $tweet->id_str;
                        $tweet_id = $tweet->id_str;

                        /* Alternative image sizes method: http://dev.twitter.com/doc/get/users/profile_image/:screen_name */
                        //  Check for SSL via protocol https then display relevant image - thanks SO - this should do
                        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
                            // $protocol = 'https://';
                            $image = $tweet->user->profile_image_url_https;
                        }
                        else {
                            // $protocol = 'http://';
                            $image = $tweet->user->profile_image_url;
                        }

                        // Process Tweets - Use Twitter entities for correct URL, hash and mentions
                        $text  = $this->process_links($tweet);
                        // lets strip 4-byte emojis
                        $text  = $this->twitter_api_strip_emoji( $text );
                        
                        // Need to get time in Unix format.
                        $time  = $tweet->created_at;
                        $time  = date_parse($time);
                        $uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);

                        // Now make the new array.
                        $tweets[] = array(
                            'text'      => $text,
                            'name'      => $name,
                            'permalink' => $permalink,
                            'image'     => $image,
                            'time'      => $uTime,
                            'tweet_id'  => $tweet_id
                            );
                endfor;

                set_transient($transName, $tweets, 60 * $settings['jltma_ts_cache_time']);
                update_option($backupName, $tweets );
            endif;
        endif;

        ?>
        
        <?php

        // Now display the tweets, if we can.
        if($tweets) : ?>
            <?php foreach( (array) $tweets as $t) : // casting array to array just in case it's empty - then prevents PHP warning ?>
                    <div class="bdt-carousel-item swiper-slide">
                        <div class="bdt-card">
                            <div class="bdt-card-body">
                                <?php if ('yes' === $settings['jltma_ts_show_avatar']) : ?>

                                    <?php if ('yes' === $settings['jltma_ts_avatar_link']) : ?>
                                        <a href="https://twitter.com/<?php echo esc_attr( $name ); ?>">
                                    <?php endif; ?>

                                        <div class="bdt-twitter-thumb">
                                            <div class="bdt-twitter-thumb-wrapper">
                                                <img src="<?php echo esc_url($t['image']); ?>" alt="<?php echo esc_html($t['name']); ?>" />
                                            </div>
                                        </div>

                                    <?php if ('yes' === $settings['jltma_ts_avatar_link']) : ?>                                  
                                        </a>
                                    <?php endif; ?>

                                <?php endif; ?>

                                <div class="bdt-twitter-text bdt-clearfix">         
                                    <?php echo wp_kses_post($t['text']); ?>
                                </div>

                                <div class="bdt-twitter-meta-wrapper">
                                    
                                    <?php if('yes' === $settings['jltma_ts_show_time']) : ?>
                                    <a href="<?php echo $t['permalink']; ?>" target="_blank" class="bdt-twitter-time-link">
                                        <?php
                                            // Original - long time ref: hours...
                                            if('yes' === $settings['jltma_ts_long_time_format']){
                                                // New - short Twitter style time ref: h...
                                                $timeDisplay = human_time_diff($t['time'], current_time('timestamp'));
                                            } else {
                                                $timeDisplay = $this->twitter_time_diff($t['time'], current_time('timestamp'));
                                            }
                                            $displayAgo = _x('ago', 'leading space is required', 'bdthemes-element-pack');
                                            // Use to make il8n compliant
                                            printf(__( '%1$s %2$s', 'bdthemes-element-pack' ), $timeDisplay, $displayAgo);
                                        ?>
                                    </a>
                                    <?php endif; ?> 


                                    <?php if ('yes' === $settings['jltma_ts_show_meta_button']) : ?>
                                    <div class="bdt-twitter-meta-button">
                                        <a href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $t['tweet_id']; ?>" data-lang="en" class="bdt-tmb-reply" title="<?php _e('Reply','bdthemes-element-pack'); ?>" target="_blank">
                                            <span aria-hidden="true" bdt-icon="icon: reply; ratio: 0.7;"></span>
                                        </a>
                                        <a href="https://twitter.com/intent/retweet?tweet_id=<?php echo $t['tweet_id']; ?>" data-lang="en" class="bdt-tmb-retweet" title="<?php _e('Retweet','bdthemes-element-pack'); ?>" target="_blank">
                                            <span aria-hidden="true" bdt-icon="icon: refresh; ratio: 0.7;"></span>
                                        </a>
                                        <a href="https://twitter.com/intent/favorite?tweet_id=<?php echo $t['tweet_id']; ?>" data-lang="en" class="bdt-tmb-favorite" title="<?php _e('Favourite','bdthemes-element-pack'); ?>" target="_blank">
                                            <span aria-hidden="true" bdt-icon="icon: star; ratio: 0.7;"></span>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach;
        endif;
    }


    // Render
	protected function render() {

        if ( ! class_exists('TwitterOAuth') ) {
            include_once MELA_PLUGIN_PATH . '/inc/classes/twitteroauth/twitteroauth.php';
        }

        $settings               = $this->get_settings();
        $jltma_api_settings     = get_option( 'jltma_api_save_settings' );
        
        $twitter_username       = (!empty($jltma_api_settings['twitter_username'])) ? $jltma_api_settings['twitter_username'] : '';
        
        $twitter_consumer_key   = (!empty($jltma_api_settings['twitter_consumer_key'])) ? $jltma_api_settings['twitter_consumer_key'] : '';
        $consumer_secret        = (!empty($jltma_api_settings['twitter_consumer_secret'])) ? $jltma_api_settings['twitter_consumer_secret'] : '';
        $access_token           = (!empty($jltma_api_settings['twitter_access_token'])) ? $jltma_api_settings['twitter_access_token'] : '';
        $access_token_secret    = (!empty($jltma_api_settings['twitter_access_token_secret'])) ? $jltma_api_settings['twitter_access_token_secret'] : '';
        

        $this->jltma_ts_loop_header();


        if ( $twitter_consumer_key and $consumer_secret and $access_token and $access_token_secret  ) {
            $this->jltma_ts_loop_twitter( $twitter_consumer_key, $consumer_secret, $access_token, $access_token_secret, $twitter_username );
        } else { ?>

            <div class="ma-el-alert elementor-alert elementor-alert-warning" role="alert">                
                <a class="elementor-alert-dismiss"></a>
                <?php $jltma_admin_api_url = esc_url( admin_url('admin.php?page=master-addons-settings#ma_api_keys')); ?>
                <p><?php printf(__( 'Please set Twitter API settings from here <a href="%s" target="_blank">Master Addons Settings</a> to show Tweet data correctly.', MELA_TD ), $jltma_admin_api_url); ?></p>
            </div>
            <?php
        }

        $this->jltma_ts_loop_footer();

	}


    // Twitter Slider: Header
    protected function jltma_ts_loop_header(){
        
        $settings = $this->get_settings();
        $id = 'jltma-twitter-slider-' . $this->get_id();

        $this->add_render_attribute( 'jltma_twitter_slider', 'id', $id );
        $this->add_render_attribute( 'jltma_twitter_slider', 'class', 'jltma-twitter-slider jltma-carousel' );

        if ('arrows' == $settings['jltma_ts_navigation']) {
            $this->add_render_attribute( 'jltma_twitter_slider', 'class', 'jltma-arrows-align-'. $settings['jltma_ts_arrows_position'] );
        }

        if ('dots' == $settings['jltma_ts_navigation']) {
            $this->add_render_attribute( 'jltma_twitter_slider', 'class', 'jltma-dots-align-'. $settings['jltma_ts_dots_position'] );
        }

        if ('both' == $settings['jltma_ts_navigation']) {
            $this->add_render_attribute( 'jltma_twitter_slider', 'class', 'jltma-arrows-dots-align-'. $settings['jltma_ts_both_position'] );
        }
        ?>

        <div <?php echo $this->get_render_attribute_string( 'jltma_twitter_slider' ); ?>>
            <div class="swiper-container">
                <div class="swiper-wrapper">
        <?php
    }

    // Twitter Slider: Footer
    protected function jltma_ts_loop_footer(){
        $id       = 'bdt-twitter-slider-' . $this->get_id();
        $settings = $this->get_settings();

        ?>
                </div>
            </div>
            
            <?php if ('both' == $settings['jltma_ts_navigation']) : ?>
                <?php $this->jltma_render_both_navigation(); ?>
                <?php if ('center' === $settings['jltma_ts_both_position']) : ?>
                    <div class="bdt-dots-container">
                        <div class="swiper-pagination"></div>
                    </div>
                <?php endif; ?>
            <?php else : ?>         
                <?php $this->render_pagination(); ?>
                <?php $this->render_navigation(); ?>
            <?php endif; ?>
            
        </div>
        <?php
    }



    protected function jltma_render_both_navigation() {
        $settings = $this->get_settings();

        ?>
        <div class="bdt-position-z-index bdt-position-<?php echo esc_attr($settings['jltma_ts_both_position']); ?>">
            <div class="bdt-arrows-dots-container bdt-slidenav-container ">
                
                <div class="bdt-flex bdt-flex-middle">
                    <div class="bdt-visible@m">
                        <a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav" bdt-icon="icon: chevron-left; ratio: 1.9"></a>   
                    </div>

                    <?php if ('center' !== $settings['jltma_ts_both_position']) : ?>
                        <div class="swiper-pagination"></div>
                    <?php endif; ?>
                    
                    <div class="bdt-visible@m">
                        <a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav" bdt-icon="icon: chevron-right; ratio: 1.9"></a>      
                    </div>
                    
                </div>
            </div>
        </div>      
        <?php
    }



    protected function render_navigation() {
        $settings = $this->get_settings();

        if ( 'arrows' == $settings['jltma_ts_navigation'] ) : ?>
            <div class="bdt-position-z-index bdt-visible@m bdt-position-<?php echo esc_attr($settings['jltma_ts_arrows_position']); ?>">
                <div class="bdt-arrows-container bdt-slidenav-container">
                    <a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav" bdt-icon="icon: chevron-left; ratio: 1.9"></a>
                    <a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav" bdt-icon="icon: chevron-right; ratio: 1.9"></a>
                </div>
            </div>
        <?php endif;
    }


    protected function render_pagination() {
        $settings = $this->get_settings();
        
        if ( 'dots' == $settings['jltma_ts_navigation'] ) : ?>
            <?php if ( 'arrows' !== $settings['jltma_ts_navigation'] ) : ?>
                <div class="bdt-position-z-index bdt-position-<?php echo esc_attr($settings['jltma_ts_dots_position']); ?>">
                    <div class="bdt-dots-container">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            <?php endif; ?>
            
        <?php endif;
    }

    private function twitter_api_strip_emoji( $text ){
        // four byte utf8: 11110www 10xxxxxx 10yyyyyy 10zzzzzz
        return preg_replace('/[\xF0-\xF7][\x80-\xBF]{3}/', '', $text );
    }


    private function process_links($tweet) {

        // Is the Tweet a ReTweet - then grab the full text of the original Tweet
        if(isset($tweet->retweeted_status)) {
            // Split it so indices count correctly for @mentions etc.
            $rt_section = current(explode(":", $tweet->text));
            $text = $rt_section.": ";
            // Get Text
            $text .= $tweet->retweeted_status->text;
        } else {
            // Not a retweet - get Tweet
            $text = $tweet->text;
        }

        // NEW Link Creation from clickable items in the text
        $text = preg_replace('/((http)+(s)?:\/\/[^<>\s]+)/i', '<a href="$0" target="_blank" rel="nofollow">$0</a>', $text );
        // Clickable Twitter names
        $text = preg_replace('/[@]+([A-Za-z0-9-_]+)/', '<a href="http://twitter.com/$1" target="_blank" rel="nofollow">@$1</a>', $text );
        // Clickable Twitter hash tags
        $text = preg_replace('/[#]+([A-Za-z0-9-_]+)/', '<a href="http://twitter.com/search?q=%23$1" target="_blank" rel="nofollow">$0</a>', $text );
        // END TWEET CONTENT REGEX
        return $text;

    }

    private function twitter_time_diff( $from, $to = '' ) {
        $diff = human_time_diff($from,$to);
        $replace = array(
                ' hour'    => 'h',
                ' hours'   => 'h',
                ' day'     => 'd',
                ' days'    => 'd',
                ' minute'  => 'm',
                ' minutes' => 'm',
                ' second'  => 's',
                ' seconds' => 's',
        );
        return strtr($diff,$replace);
    }



}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Twitter_Slider() );