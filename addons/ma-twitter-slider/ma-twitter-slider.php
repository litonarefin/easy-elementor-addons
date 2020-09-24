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
            ]
        );

        $this->add_control(
            'jltma_ts_pauseonhover',
            [
                'label' => esc_html__( 'Pause on Hover', MELA_TD ),
                'type'  => Controls_Manager::SWITCHER,
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
            ]
        );

        $this->add_control(
            'jltma_ts_loop',
            [
                'label'   => esc_html__( 'Loop', MELA_TD ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
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
                    'show_avatar' => 'yes',
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
                'label'     => __( 'Navigation', 'bdthemes-element-pack' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation' => [ 'arrows', 'dots', 'both' ],
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_size',
            [
                'label' => __( 'Arrows Size', 'bdthemes-element-pack' ),
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
                'label'     => __( 'Background Color', 'bdthemes-element-pack' ),
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
                'label'     => __( 'Hover Background Color', 'bdthemes-element-pack' ),
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
                'label'     => __( 'Arrows Color', 'bdthemes-element-pack' ),
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
                'label'     => __( 'Arrows Hover Color', 'bdthemes-element-pack' ),
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
                'label' => __( 'Space', 'bdthemes-element-pack' ),
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
                'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
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
                'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
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
                'label' => __( 'Dots Size', 'bdthemes-element-pack' ),
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
                'label'     => __( 'Dots Color', 'bdthemes-element-pack' ),
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
                'label'     => __( 'Active Dots Color', 'bdthemes-element-pack' ),
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
                'label'   => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
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
                'label'   => __( 'Vertical Offset', 'bdthemes-element-pack' ),
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
                'label'   => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
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
                'label'   => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
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
                'label'   => __( 'Vertical Offset', 'bdthemes-element-pack' ),
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
                'label'   => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
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
                'label'   => __( 'Vertical Offset', 'bdthemes-element-pack' ),
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
                'label'   => __( 'Arrows Offset', 'bdthemes-element-pack' ),
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
                'label'   => __( 'Dots Offset', 'bdthemes-element-pack' ),
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


    // Render
	protected function render() {

        if ( ! class_exists('TwitterOAuth') ) {
            include_once MELA_PLUGIN_PATH . '/inc/classes/twitteroauth/twitteroauth.php';
        }

        $settings          = $this->get_settings();
        $options           = get_option( 'element_pack_api_settings' );
        
        $consumerKey       = (!empty($options['twitter_consumer_key'])) ? $options['twitter_consumer_key'] : '';
        $consumerSecret    = (!empty($options['twitter_consumer_secret'])) ? $options['twitter_consumer_secret'] : '';
        $accessToken       = (!empty($options['twitter_access_token'])) ? $options['twitter_access_token'] : '';
        $accessTokenSecret = (!empty($options['twitter_access_token_secret'])) ? $options['twitter_access_token_secret'] : '';
        $twitter_name      = (!empty($options['twitter_name'])) ? $options['twitter_name'] : '';

        $this->jltma_ts_loop_header();


	}

    
    // Twitter Slider : Header
    protected function jltma_ts_loop_header(){

    }
    

}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Twitter_Slider() );