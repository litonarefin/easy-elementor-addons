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
                'label' => esc_html__( 'Logo\'s', MELA_TD )
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
                'jltma_logo_slider_list_title', [
                    'label' => esc_html__( 'Client Name', MELA_TD ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'List Title' , MELA_TD ),
                    'label_block' => true,
                ]
            );

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
                'jltma_logo_slider_enable_hover_logo',
                [
                    'label' => esc_html__( 'Enable Hover on Logo?', MELA_TD ),
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
                'jltma_logo_slider_enable_link',
                [
                    'label' => esc_html__( 'Enable Link', MELA_TD ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', MELA_TD ),
                    'label_off' => esc_html__( 'No', MELA_TD ),
                    'return_value' => 'yes',
                ]
            );

            $repeater->add_control(
                'jltma_logo_slider_website_link',
                [
                    'label' => esc_html__( 'Link', MELA_TD ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', MELA_TD ),
                    'show_external' => true,
                    'condition' => [
                        'jltma_logo_slider_enable_link' => 'yes'
                    ],
                ]
            );


            $this->add_control(
                'jltma_logo_slider_repeater',
                [
                    'label' => esc_html__( 'Logo List', MELA_TD ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'jltma_logo_slider_list_title' => esc_html__( 'Logo Title #1', MELA_TD ),
                        ],
                        [
                            'jltma_logo_slider_list_title' => esc_html__( 'Logo Title #2', MELA_TD ),
                        ],
                        [
                            'jltma_logo_slider_list_title' => esc_html__( 'Logo Title #3', MELA_TD ),
                        ],
                        [
                            'jltma_logo_slider_list_title' => esc_html__( 'Logo Title #4', MELA_TD ),
                        ],
                        [
                            'jltma_logo_slider_list_title' => esc_html__( 'Logo Title #5', MELA_TD ),
                        ],
                    ],
                    'title_field' => '{{{ jltma_logo_slider_list_title }}}',
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
                'label' => esc_html__( 'Slider Settings', MELA_TD ),
                'tab'   => Controls_Manager::TAB_STYLE
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
                    'default'               => '4',
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
                'jltma_logo_slider_slides_carousel_nav',
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
                        'jltma_logo_slider_slides_carousel_nav' => 'both',
                    ],
                ]
            );


            $this->add_control(
                'arrows_position',
                [
                    'label'     => esc_html__( 'Arrows Position', MELA_TD ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'center',
                    'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                    'condition' => [
                        'jltma_logo_slider_slides_carousel_nav' => 'arrows',
                    ],              
                ]
            );

            $this->add_control(
                'dots_position',
                [
                    'label'     => esc_html__( 'Dots Position', MELA_TD ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'bottom-center',
                    'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                    'condition' => [
                        'jltma_logo_slider_slides_carousel_nav' => 'dots',
                    ],              
                ]
            );            
        $this->end_controls_section();

        /*
        * Logo Style
        *
        */
        $this->start_controls_section(
            'jltma_section_logo_style',
            [
                'label' => esc_html__( 'Style', MELA_TD ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

            $this->start_controls_tabs( 'jltma_logo_slider_tabs' );

        	# Normal tab
            $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', MELA_TD ) ] );

                $this->add_control(
            		'jltma_logo_slider_background_style',
            			[
                        'label' => __( 'Background Style', MELA_TD ),
                        'type'  => Controls_Manager::HEADING
            			]
                );

                $this->add_group_control(
            		Group_Control_Background::get_type(),
        			[
                        'name'      => 'jltma_logo_slider_background',
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .exad-logo .exad-logo-item'
        			]
                );

                $this->add_control(
            		'jltma_logo_slider_opacity_style',
            		[
                        'label' => __( 'Opacity', MELA_TD ),
                        'type'  => Controls_Manager::HEADING
            		]
                );

                $this->add_control(
                    'jltma_logo_slider_opacity',
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

                $this->add_control(
        			'jltma_logo_slider_shadow_style',
        			[
                        'label' => __( 'Box Shadow', MELA_TD ),
                        'type'  => Controls_Manager::HEADING
        			]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'jltma_logo_slider_box_shadow',
                        'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item'
                    ]
                );

            $this->end_controls_tab();

        	# Hover tab
            $this->start_controls_tab( 'jltma_exclusive_button_hover', [ 'label' => esc_html__( 'Hover', MELA_TD ) ] );

                $this->add_control(
        			'jltma_logo_slider_hover_background',
        			[
                        'label' => __( 'Background Style', MELA_TD ),
                        'type'  => Controls_Manager::HEADING
        			]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name'      => 'jltma_logo_slider_hover_background_hover',
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .exad-logo .exad-logo-item:hover'
                    ]
                );

                $this->add_control(
            		'jltma_logo_slider_opacity_hover_style',
            		[
                        'label' => __( 'Opacity', MELA_TD ),
                        'type'  => Controls_Manager::HEADING
            		]
                );

                $this->add_control(
                    'jltma_logo_slider_hover_opacity',
                    [
                        'label'     => __('Opacity', MELA_TD),
                        'type'      => Controls_Manager::NUMBER,
                        'range'     => [
                            'min'   => 0,
                            'max'   => 1
                        ],
                        'default'   => __( 'From 0.1 to 1', MELA_TD ),
                        'selectors' => [
                            '{{WRAPPER}} .exad-logo .exad-logo-item:hover img' => 'opacity: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'jltma_logo_slider_shadow_hover_style',
                    [
                        'label' => __( 'Box Shadow', MELA_TD ),
                        'type'  => Controls_Manager::HEADING
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'jltma_logo_slider_box_hover_shadow',
                        'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item:hover'
                    ]
                );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_control(
                'jltma_logo_slider_padding',
                [
                    'label'      => __( 'Padding', MELA_TD ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'separator'  => 'before',
                    'default'    => [
                        'top'    => 20,
                        'right'  => 20,
                        'bottom' => 20,
                        'left'   => 20,
                        'unit'   => 'px'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .slick-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );


            $this->add_control(
                'jltma_logo_slider_margin',
                [
                    'label'         => esc_html__( 'Margin', MELA_TD ),
                    'type'          => Controls_Manager::DIMENSIONS,
                    'size_units'    => [ 'px', '%' ],
                    'selectors'     => [
                        '{{WRAPPER}} .slick-slider'     => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'border',
                    'selector' => '{{WRAPPER}} .exad-logo .exad-logo-item'
                ]
            );
            $this->add_control(
        		'jltma_logo_slider_border_radius',
                [
                    'label'      => __( 'Border Radius', MELA_TD ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .exad-logo .exad-logo-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

        $this->end_controls_section();
	}




	protected function render() {
        $settings       = $this->get_settings_for_display();
        echo "Logo Sliders";
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