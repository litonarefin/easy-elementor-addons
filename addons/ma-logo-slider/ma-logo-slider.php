<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Widget_Base;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

class Master_Addons_Logo_Slider extends Widget_Base {

	public function get_name() {
		return 'ma-logo-slider';
	}

	public function get_title() {
		return esc_html__( 'Logo Slider', MELA_TD );
	}

	public function get_icon() {
		return 'ma-el-icon eicon-slider-push';
	}

	public function get_categories() {
		return [ 'master-addons' ];
	}

	protected function _register_controls() {

        /*
        * Logo Images
        */
        $this->start_controls_section(
            'jltma_logo_slider_section_logos',
            [
                'label' => esc_html__( 'Logo Items', MELA_TD )
            ]
        );


            $this->add_control(
                'jltma_logo_slider_style',
                [
                    'label' => esc_html__( 'Style Preset ', MELA_TD ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'style_one',
                    'options' => [
                        'style_one'         => esc_html__( 'Default', MELA_TD ),
                        'style_two'         => esc_html__( 'Banner', MELA_TD ),
                    ],
                ]
            );        


            $repeater = new Repeater();

            $repeater->add_control(
                'jltma_logo_slider_image_normal',
                [
                    'label' => esc_html__( 'Client Logo', MELA_TD ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );


            $repeater->add_control(
                'jltma_logo_slider_brand_name',
                [
                    'label' => __('Brand Name', MELA_TD),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Brand Name', MELA_TD),
                ]
            );

            $repeater->add_control(
                'jltma_logo_slider_brand_description',
                [
                    'label' => __('Description', MELA_TD),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __('Brand Short Description Type Here.', MELA_TD),
                ]
            );

            $repeater->add_control(
                'jltma_logo_slider_website_link',
                [
                    'label' => esc_html__( 'Link', MELA_TD ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', MELA_TD ),
                    'show_external' => true
                ]
            );


            $repeater->add_control(
                'jltma_logo_slider_enable_hover_logo',
                [
                    'label' => esc_html__( 'Image Hover on Logo?', MELA_TD ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', MELA_TD ),
                    'label_off' => esc_html__( 'No', MELA_TD ),
                    'return_value' => 'yes',
                    'default' => '',
                ]
            );


            $repeater->add_control(
                'jltma_logo_slider_image_hover',
                [
                    'label' => esc_html__( 'Hover Logo Image', MELA_TD ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'jltma_logo_slider_enable_hover_logo' => 'yes'
                    ]
                ]
            );


            $repeater->add_control(
                'jltma_logo_slider_item_logo_tooltip',
                [
                    'label'   => __( 'Tooltip', MELA_TD ),
                    'type'    => Controls_Manager::SWITCHER,
                ]
            );

            $repeater->add_control(
                'jltma_logo_slider_item_logo_tooltip_placement',                       
                [
                    'label'   => esc_html__( 'Placement', MELA_TD ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'top',
                    'options' => [
                        'top-start'    => esc_html__( 'Top Left', MELA_TD ),
                        'top'          => esc_html__( 'Top', MELA_TD ),
                        'top-end'      => esc_html__( 'Top Right', MELA_TD ),
                        'bottom-start' => esc_html__( 'Bottom Left', MELA_TD ),
                        'bottom'       => esc_html__( 'Bottom', MELA_TD ),
                        'bottom-end'   => esc_html__( 'Bottom Right', MELA_TD ),
                        'left'         => esc_html__( 'Left', MELA_TD ),
                        'right'        => esc_html__( 'Right', MELA_TD ),
                    ],
                    'condition'   => [
                        'logo_tooltip' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'jltma_logo_slider_repeater',
                [
                    'label' => esc_html__( '', MELA_TD ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'jltma_logo_slider_brand_name' => esc_html__( 'Brand Name 1', MELA_TD ),
                        ],
                        [
                            'jltma_logo_slider_brand_name' => esc_html__( 'Brand Name 2', MELA_TD ),
                        ],
                        [
                            'jltma_logo_slider_brand_name' => esc_html__( 'Brand Name 3', MELA_TD ),
                        ],
                        [
                            'jltma_logo_slider_brand_name' => esc_html__( 'Brand Name 4', MELA_TD ),
                        ],
                        [
                            'jltma_logo_slider_brand_name' => esc_html__( 'Brand Name 5', MELA_TD ),
                        ],
                    ],
                    'title_field' => '{{{ jltma_logo_slider_brand_name }}}',
                ]
            );


            $this->add_control(
                'title_html_tag',
                [
                    'label'   => esc_html__( 'Title HTML Tag', MELA_TD ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => Master_Addons_Helper::ma_el_title_tags(),
                    'default' => 'h3',
                ]
            );


        $this->end_controls_section();

        /*
        * Logo Style
        *
        */
    	$this->start_controls_section(
    		'jltma_logo_slider_settings_section',
    		[
                'label' => esc_html__( 'Carousel', MELA_TD )
    		]
        );


            $this->add_responsive_control(
                'jltma_logo_slider_item_gap',
                [
                    'label'   => esc_html__( 'Column Gap', MELA_TD ),
                    'type'    => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10,
                    ],
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 100,
                            'step' => 5,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-logo-carousel-wrapper.bdt-grid'     => 'margin-left: -{{SIZE}}px',
                        '{{WRAPPER}} .bdt-logo-carousel-wrapper.bdt-grid > *' => 'padding-left: {{SIZE}}px',
                    ],
                ]
            );


            $this->add_responsive_control(
                'jltma_logo_slider_item_height',
                [
                    'label' => __( 'Item Height', MELA_TD ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'max' => 500,
                            'min' => 100,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-logo-carousel-item' => 'height: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            

            $slides_per_view = range( 1, 6 );
            $slides_per_view = array_combine( $slides_per_view, $slides_per_view );

            $this->add_responsive_control(
                'jltma_logo_slider_slides_to_show',
                [
                    'type'                  => Controls_Manager::SELECT,
                    'label'                 => esc_html__( 'Columns', MELA_TD ),
                    'options'               => $slides_per_view,
                    'devices'               => [ 'desktop', 'tablet', 'mobile' ],
                    'default'               => '4',
                    'desktop_default'       => '4',
                    'tablet_default'        => '3',
                    'mobile_default'        => '2',
                    'frontend_available'    => true,
                ]
            );


            $this->add_responsive_control(
                'jltma_logo_slider_slides_to_scroll',
                [
                    'type'      => Controls_Manager::SELECT,
                    'label'     => esc_html__( 'Items to Scroll', MELA_TD ),
                    'options'   => $slides_per_view,
                    'default'   => '1',
                ]
            );



            $this->add_control(
                'jltma_logo_slider_transition_duration',
                [
                    'label'   => esc_html__( 'Transition Duration', MELA_TD ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => 1000,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'jltma_logo_slider_autoplay',
                [
                    'label'     => esc_html__( 'Autoplay', MELA_TD ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'no',
                ]
            );

            $this->add_control(
                'jltma_logo_slider_autoplay_speed',
                [
                    'label'     => esc_html__( 'Autoplay Speed', MELA_TD ),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 5000,
                    'condition' => [
                        'jltma_logo_slider_autoplay' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'jltma_logo_slider_loop',
                [
                    'label'   => esc_html__( 'Infinite Loop', MELA_TD ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'jltma_logo_slider_pause',
                [
                    'label'     => esc_html__( 'Pause on Hover', MELA_TD ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'condition' => [
                        'jltma_logo_slider_autoplay' => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();



        /*
        * Navigation
        */
        $this->start_controls_section(
            'jltma_logo_slider_section_navigation',
            [
                'label' => esc_html__( 'Navigation', MELA_TD ),
            ]
        );


            $this->add_control(
                'jltma_logo_slider_nav',
                [
                    'label' => esc_html__( 'Navigation Style', MELA_TD ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'arrows',
                    'separator' => 'before',
                    'options' => [
                        'both'   => esc_html__( 'Arrows and Dots', MELA_TD ),
                        'arrows' => esc_html__( 'Arrows', MELA_TD ),
                        'dots'   => esc_html__( 'Dots', MELA_TD ),
                        'none'   => esc_html__( 'None', MELA_TD )
                    ],
                    'prefix_class' => 'jltma-navigation-type-',
                    'render_type'  => 'template',
                ]
            );

            $this->add_control(
                'jltma_logo_slider_nav_both_position',
                [
                    'label'     => esc_html__( 'Arrows and Dots Position', MELA_TD ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'center',
                    'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                    'condition' => [
                        'jltma_logo_slider_nav' => 'both',
                    ],
                ]
            );


            $this->add_control(
                'jltma_logo_slider_nav_arrows_position',
                [
                    'label'     => esc_html__( 'Arrows Position', MELA_TD ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'center',
                    'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                    'condition' => [
                        'jltma_logo_slider_nav' => 'arrows',
                    ],              
                ]
            );

            $this->add_control(
                'jltma_logo_slider_nav_dots_position',
                [
                    'label'     => esc_html__( 'Dots Position', MELA_TD ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'bottom-center',
                    'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                    'condition' => [
                        'jltma_logo_slider_nav' => 'dots',
                    ],              
                ]
            );  





            $this->start_controls_tabs( 'jltma_logo_slider_nav_tabs' );

                $this->start_controls_tab( 
                    'jltma_logo_slider_nav_normal_control', 
                    [ 
                        'label' => esc_html__( 'Normal', MELA_TD),
                        'condition' => [
                            'jltma_logo_slider_nav!' => 'none'
                        ]
                    ] );

                    $this->add_control(
                        'jltma_logo_slider_nav_arrows_color',
                        [
                            'label'     => __( 'Arrows Color', MELA_TD ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ma-el-team-carousel-prev, {{WRAPPER}} .ma-el-team-carousel-next' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'jltma_logo_slider_nav' => [ 'arrows', 'both' ],
                            ],
                        ]
                    );

                    $this->add_control(
                        'jltma_logo_slider_nav_normal_arrow_color',
                        [
                            'label' => esc_html__( 'Arrows Background', MELA_TD ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#b8bfc7',
                            'selectors' => [
                                '{{WRAPPER}} .ma-el-team-carousel-prev, {{WRAPPER}} .ma-el-team-carousel-next' => 'background: {{VALUE}};',
                            ],
                            'condition' => [
                                'jltma_logo_slider_nav' => [ 'arrows', 'both' ],
                            ],
                        ]
                    );




                    $this->add_control(
                        'jltma_logo_slider_nav_dots_color',
                        [
                            'label'     => __( 'Dots Color', MELA_TD ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ma-el-team-carousel-wrapper .slick-dots li button' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'jltma_logo_slider_nav' => [ 'dots', 'both' ],
                            ],
                        ]
                    );

                $this->end_controls_tab();


                $this->start_controls_tab( 
                    'jltma_logo_slider_nav_hover_tab', 
                    [ 
                        'label' => esc_html__( 'Hover', MELA_TD ),
                        'condition' => [
                            'jltma_logo_slider_nav!' => 'none'
                        ],                    
                    ] 
                );

                $this->add_control(
                    'jltma_logo_slider_nav_arrows_hover_bg',
                    [
                        'label'     => __( 'Arow Background', MELA_TD ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .ma-el-team-carousel-prev:hover, {{WRAPPER}} .ma-el-team-carousel-next:hover' =>
                                'background: {{VALUE}};',
                        ],
                        'condition' => [
                            'jltma_logo_slider_nav' => [ 'arrows', 'both' ],
                        ],
                    ]
                );


                $this->add_control(
                    'jltma_logo_slider_nav_arrows_hover_color',
                    [
                        'label'     => __( 'Arrows Color', MELA_TD ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .bdt-navigation-prev:hover svg,
                            {{WRAPPER}} .bdt-navigation-next:hover svg' => 'color: {{VALUE}}',
                        ],
                        'condition' => [
                            'jltma_logo_slider_nav' => [ 'arrows', 'both' ],
                        ],
                    ]
                );                


                $this->add_control(
                    'jltma_logo_slider_nav_active_dot_color',
                    [
                        'label'     => __( 'Active Dots Color', MELA_TD ),
                        'type'      => Controls_Manager::COLOR,
                        'default' => '#8a8d91',
                        'selectors' => [
                            '{{WRAPPER}} .ma-el-team-carousel-wrapper .slick-dots li.slick-active button, {{WRAPPER}} .ma-el-team-carousel-wrapper .slick-dots li button:hover' => 'background: {{VALUE}};',
                        ],
                        'condition' => [
                            'jltma_logo_slider_nav' => [ 'dots', 'both' ],
                        ],
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();


        $this->end_controls_section();



        /*
        * Tooltips
        */
        $this->start_controls_section(
            'jltma_logo_slider_section_tooltip_settings',
            [
                'label' => esc_html__( 'Tooltip', MELA_TD ),
            ]
        );


            $this->add_control(
                'jltma_logo_slider_tooltip',
                [
                    'label'   => esc_html__( 'Tooltip', MELA_TD ),
                    'type'    => Controls_Manager::SWITCHER,
                ]
            );

            $this->add_control(
                'jltma_logo_slider_tooltip_placement',                       
                [
                    'label'   => esc_html__( 'Placement', MELA_TD ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'top',
                    'options' => [
                        'top-start'    => esc_html__( 'Top Left', MELA_TD ),
                        'top'          => esc_html__( 'Top', MELA_TD ),
                        'top-end'      => esc_html__( 'Top Right', MELA_TD ),
                        'bottom-start' => esc_html__( 'Bottom Left', MELA_TD ),
                        'bottom'       => esc_html__( 'Bottom', MELA_TD ),
                        'bottom-end'   => esc_html__( 'Bottom Right', MELA_TD ),
                        'left'         => esc_html__( 'Left', MELA_TD ),
                        'right'        => esc_html__( 'Right', MELA_TD ),
                    ],
                    'condition'   => [
                        'jltma_logo_slider_tooltip' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'jltma_logo_slider_tooltip_animation',
                [
                    'label'   => esc_html__( 'Animation', MELA_TD ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'shift-toward',
                    'options' => [
                        'shift-away'   => esc_html__( 'Shift-Away', MELA_TD ),
                        'shift-toward' => esc_html__( 'Shift-Toward', MELA_TD ),
                        'fade'         => esc_html__( 'Fade', MELA_TD ),
                        'scale'        => esc_html__( 'Scale', MELA_TD ),
                        'perspective'  => esc_html__( 'Perspective', MELA_TD ),
                    ],
                    'render_type'  => 'template',
                    'condition'   => [
                        'jltma_logo_slider_tooltip' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'jltma_logo_slider_tooltip_x_offset',
                [
                    'label'   => esc_html__( 'Offset', MELA_TD ),
                    'type'    => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'condition'   => [
                        'jltma_logo_slider_tooltip' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'jltma_logo_slider_tooltip_y_offset',
                [
                    'label'   => esc_html__( 'Distance', MELA_TD ),
                    'type'    => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'condition'   => [
                        'jltma_logo_slider_tooltip' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'jltma_logo_slider_tooltip_arrow',
                [
                    'label'        => esc_html__( 'Arrow', MELA_TD ),
                    'type'         => Controls_Manager::SWITCHER,
                    'condition'   => [
                        'jltma_logo_slider_tooltip' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'jltma_logo_slider_tooltip_trigger',
                [
                    'label'       => esc_html__( 'Trigger on Click', MELA_TD ),
                    'description' => esc_html__( 'Don\'t set yes when you set lightbox image with marker.', MELA_TD ),
                    'type'        => Controls_Manager::SWITCHER,
                    'condition'   => [
                        'jltma_logo_slider_tooltip' => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();



        /*
        * Logo Style
        *
        */
        $this->start_controls_section(
            'jltma_logo_slider_sesction_style_carousel',
            [
                'label' => esc_html__( 'Logo Carousel', MELA_TD ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );



            $this->start_controls_tabs( 'jltma_logo_slider_carousel_tabs' );

        	# Normal tab
            $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', MELA_TD ) ] );

                $this->add_group_control(
            		Group_Control_Background::get_type(),
        			[
                        'name'      => 'jltma_logo_slider_carousel_normal_background',
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .exad-logo .exad-logo-item'
        			]
                );

                $this->add_control(
                    'jltma_logo_slider_carousel_opacity',
                    [
                        'label' => __('Opacity', MELA_TD),
                        'type'  => Controls_Manager::NUMBER,
                        'range' => [
                            'min'   => 0,
                            'max'   => 1
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .exad-logo .exad-logo-item img' => 'opacity: {{VALUE}};'
                        ]
                    ]
                );
                

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'        => 'jltma_logo_slider_carousel_item_border',
                        'label'       => esc_html__( 'Border', MELA_TD ),
                        'selector'    => '{{WRAPPER}} .bdt-logo-carousel-figure',
                    ]
                );


                $this->add_control(
                    'jltma_logo_slider_carousel_item_border_radius',
                    [
                        'label'      => esc_html__( 'Border Radius', MELA_TD ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors'  => [
                            '{{WRAPPER}} .bdt-logo-carousel-figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'jltma_logo_slider_carousel_padding',
                    [
                        'label' => __( 'Padding', MELA_TD ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .bdt-logo-carousel-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );


                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'jltma_logo_slider_carousel_box_shadow',
                        'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Css_Filter::get_type(),
                    [
                        'name' => 'jltma_logo_slider_carousel_image_css_filters',
                        'selector' => '{{WRAPPER}} .bdt-logo-carousel-figure img',
                    ]
                );
            $this->end_controls_tab();

        	# Hover tab
            $this->start_controls_tab( 'jltma_logo_slider_carousel_hover_tab', [ 'label' => esc_html__( 'Hover', MELA_TD ) ] );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'jltma_logo_slider_carousel_hover_background',
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .exad-logo .exad-logo-item'
                    ]
                );

                $this->add_control(
                    'jltma_logo_slider_carousel_hover_opacity',
                    [
                        'label' => __('Opacity', MELA_TD),
                        'type'  => Controls_Manager::NUMBER,
                        'range' => [
                            'min'   => 0,
                            'max'   => 1
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .exad-logo .exad-logo-item img' => 'opacity: {{VALUE}};'
                        ]
                    ]
                );
                

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'        => 'jltma_logo_slider_carousel_hover_item_border',
                        'label'       => esc_html__( 'Border', MELA_TD ),
                        'selector'    => '{{WRAPPER}} .bdt-logo-carousel-figure',
                    ]
                );


                $this->add_control(
                    'jltma_logo_slider_carousel_hover_item_border_radius',
                    [
                        'label'      => esc_html__( 'Border Radius', MELA_TD ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors'  => [
                            '{{WRAPPER}} .bdt-logo-carousel-figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'jltma_logo_slider_carousel_hover_padding',
                    [
                        'label' => __( 'Padding', MELA_TD ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .bdt-logo-carousel-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );


                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'jltma_logo_slider_carousel_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Css_Filter::get_type(),
                    [
                        'name' => 'jltma_logo_slider_carousel_hover_image_css_filters',
                        'selector' => '{{WRAPPER}} .bdt-logo-carousel-figure img',
                    ]
                );
            $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();




        $this->start_controls_section(
            'jltma_logo_slider_section_style_tooltip',
            [
                'label' => esc_html__( 'Tooltip', MELA_TD ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'jltma_logo_slider_tooltip_logo_width',
            [
                'label'      => esc_html__( 'Width', MELA_TD ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [
                    'px', 'em',
                ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tippy-tooltip' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'jltma_logo_slider_tooltip_typography',
                'selector' => '{{WRAPPER}} .tippy-tooltip .tippy-content',
            ]
        );

        $this->add_control(
            'jltma_logo_slider_tooltip_color',
            [
                'label'     => esc_html__( 'Text Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tippy-tooltip' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'jltma_logo_slider_tooltip_text_align',
            [
                'label'   => esc_html__( 'Text Alignment', MELA_TD ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left'    => [
                        'title' => esc_html__( 'Left', MELA_TD ),
                        'icon'  => 'fas fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', MELA_TD ),
                        'icon'  => 'fas fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', MELA_TD ),
                        'icon'  => 'fas fa-align-right',
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'jltma_logo_slider_tooltip_background',
                'selector' => '{{WRAPPER}} .tippy-tooltip, {{WRAPPER}} .tippy-tooltip .tippy-backdrop',
            ]
        );

        $this->add_control(
            'jltma_logo_slider_tooltip_arrow_color',
            [
                'label'     => esc_html__( 'Arrow Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tippy-popper[x-placement^=left] .tippy-arrow'  => 'border-left-color: {{VALUE}}',
                    '{{WRAPPER}} .tippy-popper[x-placement^=right] .tippy-arrow' => 'border-right-color: {{VALUE}}',
                    '{{WRAPPER}} .tippy-popper[x-placement^=top] .tippy-arrow'   => 'border-top-color: {{VALUE}}',
                    '{{WRAPPER}} .tippy-popper[x-placement^=bottom] .tippy-arrow'=> 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'jltma_logo_slider_tooltip_padding',
            [
                'label'      => __( 'Padding', MELA_TD ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tippy-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'render_type'  => 'template',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'jltma_logo_slider_tooltip_border',
                'label'       => esc_html__( 'Border', MELA_TD ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tippy-tooltip',
            ]
        );

        $this->add_responsive_control(
            'jltma_logo_slider_tooltip_border_radius',
            [
                'label'      => __( 'Border Radius', MELA_TD ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tippy-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'jltma_logo_slider_tooltip_box_shadow',
                'selector' => '{{WRAPPER}} .tippy-tooltip',
            ]
        );

        $this->end_controls_section();
        


        /* 
        * STYLE TAB: Navigation
        */
        $this->start_controls_section(
            'jltma_logo_slider_section_style_navigation',
            [
                'label'      => __( 'Navigation', MELA_TD ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'terms' => [
                        [
                            'name'     => 'jltma_logo_slider_nav',
                            'operator' => '!=',
                            'value'    => 'none',
                        ],
                    ],
                ],
            ]
        );



        $this->start_controls_tabs( 'jltma_logo_slider_style_nav_tabs' );

            /*
            * Tab: Normal
            */

            $this->start_controls_tab( 
                'jltma_logo_slider_style_nav_normal_control', 
                [ 
                    'label' => esc_html__( 'Normal', MELA_TD),
                    'condition' => [
                        'jltma_logo_slider_nav!' => 'none'
                    ]
                ] );


                $this->add_control(
                    'jltma_logo_slider_nav_arrows_size',
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
                            '{{WRAPPER}} .bdt-navigation-prev svg,
                            {{WRAPPER}} .bdt-navigation-next svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                        ],
                        'condition' => [
                            'jltma_logo_slider_nav' => [ 'arrows', 'both' ],
                        ],
                    ]
                );


                $this->add_control(
                    'jltma_logo_slider_nav_dots_size',
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
                            '{{WRAPPER}} .bdt-slider-dotnav a' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'jltma_logo_slider_nav' => [ 'dots', 'both' ],
                        ],
                    ]
                );



                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'        => 'jltma_logo_slider_nav_arrows_border',
                        'label'       => esc_html__( 'Border', MELA_TD ),
                        'condition' => [
                            'jltma_logo_slider_nav' => [ 'arrows', 'both' ],
                        ],
                        'selector'    => '{{WRAPPER}} .bdt-navigation-prev,
                        {{WRAPPER}} .bdt-navigation-next',
                    ]
                );


                $this->add_control(
                    'jltma_logo_slider_nav_border_radius',
                    [
                        'label'      => __( 'Border Radius', MELA_TD ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors'  => [
                            '{{WRAPPER}} .bdt-navigation-prev,
                            {{WRAPPER}} .bdt-navigation-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [
                            'jltma_logo_slider_nav' => [ 'arrows', 'both' ],
                        ],
                    ]
                );
                
                $this->add_responsive_control(
                    'jltma_logo_slider_nav_arrows_padding',
                    [
                        'label'      => esc_html__( 'Padding', MELA_TD ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em', '%' ],
                        'selectors'  => [
                            '{{WRAPPER}} .bdt-navigation-prev,
                            {{WRAPPER}} .bdt-navigation-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_controls_tab();


            /*
            * Tab: Hover
            */
            $this->start_controls_tab( 
                'jltma_logo_slider_style_nav_hover_tab', 
                [ 
                    'label' => esc_html__( 'Hover', MELA_TD ),
                    'condition' => [
                        'jltma_logo_slider_nav!' => 'none'
                    ],                    
                ] 
            );


                $this->add_control(
                    'jltma_logo_slider_nav_hover_border_radius',
                    [
                        'label'      => __( 'Border Radius', MELA_TD ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors'  => [
                            '{{WRAPPER}} .bdt-navigation-prev,
                            {{WRAPPER}} .bdt-navigation-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [
                            'jltma_logo_slider_nav' => [ 'arrows', 'both' ],
                        ],
                    ]
                );
                

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'        => 'jltma_logo_slider_nav_hover_border',
                        'placeholder' => '1px',
                        'default'     => '0px',
                        'selector'    => '{{WRAPPER}} .ma-el-team-carousel-prev:hover, {{WRAPPER}} .ma-el-team-carousel-next:hover',
                        'condition' => [
                            'jltma_logo_slider_nav!' => 'none',
                        ]
                    ]
                );


                $this->add_responsive_control(
                    'jltma_logo_slider_nav_arrows_hover_padding',
                    [
                        'label'      => esc_html__( 'Padding', MELA_TD ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', 'em', '%' ],
                        'selectors'  => [
                            '{{WRAPPER}} .bdt-navigation-prev,
                            {{WRAPPER}} .bdt-navigation-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_control(
            'jltma_logo_slider_nav_arrows_space',
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
                    '{{WRAPPER}} .bdt-navigation-prev' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .bdt-navigation-next' => 'margin-left: {{SIZE}}px;',
                ],
                'conditions'   => [
                    'terms' => [
                        [
                            'name'  => 'jltma_logo_slider_nav',
                            'value' => 'both',
                        ],
                        [
                            'name'     => 'jltma_logo_slider_nav_both_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
            ]
        );


        $this->add_responsive_control(
            'jltma_logo_slider_nav_arrows_ncx_position',
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
                            'name'  => 'jltma_logo_slider_nav',
                            'value' => 'arrows',
                        ],
                        [
                            'name'     => 'jltma_logo_slider_nav_arrows_position',
                            'operator' => '!=',
                            'value'    => 'center',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: Docs Links
         */
        $this->start_controls_section(
            'jltma_section_help_docs',
            [
                'label' => esc_html__( 'Help Docs', MELA_TD ),
            ]
        );


        $this->add_control(
            'help_doc_1',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Live Demo %2$s', MELA_TD ), '<a href="https://master-addons.com/demos/team-carousel/" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_2',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Documentation %2$s', MELA_TD ), '<a href="https://master-addons.com/docs/addons/team-members-carousel/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_3',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Watch Video Tutorial %2$s', MELA_TD ), '<a href="https://www.youtube.com/watch?v=ubP_h86bP-c" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );
        $this->end_controls_section();




        if ( ma_el_fs()->is_not_paying() ) {

            $this->start_controls_section(
                'jltma_section_pro',
                [
                    'label' => esc_html__( 'Upgrade to Pro Version for More Features', MELA_TD )
                ]
            );

            $this->add_control(
                'jltma_control_get_pro',
                [
                    'label' => esc_html__( 'Unlock more possibilities', MELA_TD ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        '1' => [
                            'title' => esc_html__( '', MELA_TD ),
                            'icon' => 'fa fa-unlock-alt',
                        ],
                    ],
                    'default' => '1',
                    'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
                ]
            );

            $this->end_controls_section();
        }


	}





    public function jltma_render_logo_header(){
        $settings = $this->get_settings_for_display();
        $id       = $this->get_id();

    }
    

    public function jltma_render_logo_loop_item(){?>

    <? }
    

    public function jltma_render_logo_footer(){

    }


    public function render_arrow_navigation(){

    }


    public function render_dot_navigation(){

    }


    public function render_navigation(){
        
    }


    public function render() {
        $settings = $this->get_settings_for_display();

        // $this->jltma_render_logo_header();
        // $this->jltma_render_logo_loop_item($settings);
        // $this->jltma_render_logo_footer($settings);
        ?>
        
            <section class="jltma-logo-slider">

                <div class="jltma-slider-item col-sm-3 col-xs-6">
                    <a href="#"><img src="images/clients/1.png" alt="client"></a>
                    <h3 class="jltma-slider-item-title">Company Name 01</h3><!-- /.item-title -->
                </div><!-- /.client -->

                <div class="jltma-slider-item col-sm-3 col-xs-6">
                    <a href="#"><img src="images/clients/2.png" alt="client"></a>
                    <h3 class="jltma-slider-item-title">Company Name 02</h3><!-- /.item-title -->
                </div><!-- /.client -->

            </section><!--/.Clients-->

        <?php 
    }



    /**
     * Render logo box widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Logo_Slider());