<?php
namespace Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

use MasterAddons\Inc\Controls\MA_Group_Control_Transition;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/27/19
 */

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class JLTMA_Gallery_Slider extends Widget_Base {

	//use ElementsCommonFunctions;
	public function get_name() {
		return 'jltma-gallery-slider';
	}
	public function get_title() {
		return esc_html__( 'MA Gallery Slider', MELA_TD );
	}
	public function get_icon() {
		return 'ma-el-icon eicon-slider-push';
	}
	public function get_categories() {
		return [ 'master-addons' ];
	}

	public function get_script_depends() {
		return [
			'jquery-slick',
			'master-addons-waypoints',
			'master-addons-scripts'
		];
	}

	public function get_keywords() {
		return [ 
			'gallery', 
			'image carousel', 
			'image slider', 
			'carousel gallery', 
			'left gallery slider',
			'right gallery slider',
			'slider gallery'
		];
	}


	public function get_help_url() {
		return 'https://master-addons.com/demos/gallery-slider/';
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'jltma_gallery_slider_section_start',
			[
				'label' => esc_html__( 'Gallery', MELA_TD )
			]
		);

			$this->add_control(
				'jltma_gallery_slider',
				[
					'label' 	=> esc_html__( 'Add Images', MELA_TD ),
					'type' 		=> Controls_Manager::GALLERY,
					'dynamic'	=> [ 'active' => true ],
				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'jltma_gallery_slider_section_thumbnails',
			[
				'label' => esc_html__( 'Thumbnails', MELA_TD ),
			]
		);	


			$this->add_control(
				'jltma_gallery_slider_show_thumbnails',
				[
					'type' 		=> Controls_Manager::SWITCHER,
					'label' 	=> esc_html__( 'Thumbnails', MELA_TD ),
					'default' 	=> 'yes',
					'label_off' => esc_html__( 'Hide', MELA_TD ),
					'label_on' 	=> esc_html__( 'Show', MELA_TD ),
					'frontend_available' => true,
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 		=> 'jltma_gallery_slider_thumbnail',
					'label'		=> esc_html__( 'Thumbnails Size', MELA_TD ),
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'columns',
				[
					'label' 	=> esc_html__( 'Columns', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> '2',
					'tablet_default' 	=> '4',
					'mobile_default' 	=> '4',
					'options' 			=> [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
					],
					'prefix_class'	=> 'ee-grid-columns%s-',
					'frontend_available' => true,
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_gallery_rand',
				[
					'label' 	=> esc_html__( 'Ordering', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'options' 	=> [
						'' 		=> esc_html__( 'Default', MELA_TD ),
						'rand' 	=> esc_html__( 'Random', MELA_TD ),
					],
					'default' 	=> '',
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_thumbnails_caption_type',
				[
					'label' 	=> esc_html__( 'Caption', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> '',
					'options' 	=> [
						'' 				=> esc_html__( 'None', MELA_TD ),
						'title' 		=> esc_html__( 'Title', MELA_TD ),
						'caption' 		=> esc_html__( 'Caption', MELA_TD ),
						'description' 	=> esc_html__( 'Description', MELA_TD ),
					],
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_view',
				[
					'label' 	=> esc_html__( 'View', MELA_TD ),
					'type' 		=> Controls_Manager::HIDDEN,
					'default' 	=> 'traditional',
					'condition' => [
						'jltma_gallery_slider_show_thumbnails!' => '',
					],
				]
			);	
		
		$this->end_controls_section();


        /**
         * Content Tab: Previews
         */


		$this->start_controls_section(
			'jltma_gallery_slider_section_preview',
			[
				'label' => esc_html__( 'Preview', MELA_TD ),
			]
		);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' 		=> 'jltma_gallery_slider_preview',
					'label'		=> esc_html__( 'Preview Size', MELA_TD ),
					'default'	=> 'full',
				]
			);

			$this->add_control(
				'jltma_gallery_slider_link_to',
				[
					'label' 	=> esc_html__( 'Link to', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'none',
					'options' 	=> [
						'none' 		=> esc_html__( 'None', MELA_TD ),
						'file' 		=> esc_html__( 'Media File', MELA_TD ),
						'custom' 	=> esc_html__( 'Custom URL', MELA_TD ),
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_link',
				[
					'label' 		=> 'Link to',
					'type' 			=> Controls_Manager::URL,
					'placeholder' 	=> esc_html__( 'http://your-link.com', MELA_TD ),
					'condition' 	=> [
						'jltma_gallery_slider_link_to' 	=> 'custom',
					],
					'show_label' 	=> false,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_open_lightbox',
				[
					'label' 			=> esc_html__( 'Lightbox', MELA_TD ),
					'type' 				=> Controls_Manager::SWITCHER,
					'default'           => 'no',
					'label_on'          => esc_html__( 'Yes', MELA_TD ),
					'label_off'         => esc_html__( 'No', MELA_TD ),
					'return_value'      => 'yes',
					'condition' 		=> [
						'jltma_gallery_slider_link_to' => 'file',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_preview_stretch',
				[
					'label' 			=> esc_html__( 'Image Stretch', MELA_TD ),
					'type' 				=> Controls_Manager::SWITCHER,
					'default'           => 'yes',
					'label_on'          => esc_html__( 'Yes', MELA_TD ),
					'label_off'         => esc_html__( 'No', MELA_TD ),
					'return_value'      => 'yes'
				]
			);

			$this->add_control(
				'jltma_gallery_slider_caption_type',
				[
					'label' 	=> esc_html__( 'Caption', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'caption',
					'options' 	=> [
						'' 				=> esc_html__( 'None', MELA_TD ),
						'title' 		=> esc_html__( 'Title', MELA_TD ),
						'caption' 		=> esc_html__( 'Caption', MELA_TD ),
						'description' 	=> esc_html__( 'Description', MELA_TD ),
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_show_arrows',
				[
					'type' 		=> Controls_Manager::SWITCHER,
					'label' 	=> esc_html__( 'Arrows', MELA_TD ),
					'default' 	=> '',
					'label_off' => esc_html__( 'Hide', MELA_TD ),
					'label_on' 	=> esc_html__( 'Show', MELA_TD ),
					'frontend_available' => true,
					'prefix_class' 	=> 'elementor-arrows-',
					'render_type' 	=> 'template',
				]
			);

			$this->add_control(
				'jltma_gallery_slider_autoplay',
				[
					'label' 			=> esc_html__( 'Autoplay', MELA_TD ),
					'type' 				=> Controls_Manager::SWITCHER,
					'default'           => 'yes',
					'label_on'          => esc_html__( 'Yes', MELA_TD ),
					'label_off'         => esc_html__( 'No', MELA_TD ),
					'return_value'      => 'yes',
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_autoplay_speed',
				[
					'label' 	=> esc_html__( 'Autoplay Speed', MELA_TD ),
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> 5000,
					'frontend_available' => true,
					'condition'	=> [
						'jltma_gallery_slider_autoplay' => 'yes',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_pause_on_hover',
				[
					'label' 				=> esc_html__( 'Pause on Hover', MELA_TD ),
					'type' 					=> Controls_Manager::SWITCHER,
					'default'           	=> 'yes',
					'label_on'          	=> esc_html__( 'Yes', MELA_TD ),
					'label_off'         	=> esc_html__( 'No', MELA_TD ),
					'return_value'      	=> 'yes',
					'frontend_available' 	=> true,
					'condition'				=> [
						'jltma_gallery_slider_autoplay' => 'yes',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_infinite',
				[
					'label' 				=> esc_html__( 'Infinite Loop', MELA_TD ),
					'type' 					=> Controls_Manager::SWITCHER,
					'default'           	=> 'yes',
					'label_on'          	=> esc_html__( 'Yes', MELA_TD ),
					'label_off'         	=> esc_html__( 'No', MELA_TD ),
					'return_value'      	=> 'yes',
					'frontend_available' 	=> true,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_adaptive_height',
				[
					'label' 				=> esc_html__( 'Adaptive Height', MELA_TD ),
					'type' 					=> Controls_Manager::SWITCHER,
					'default'           	=> 'yes',
					'label_on'          	=> esc_html__( 'Yes', MELA_TD ),
					'label_off'         	=> esc_html__( 'No', MELA_TD ),
					'return_value'      	=> 'yes',
					'frontend_available' 	=> true,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_effect',
				[
					'label' 	=> esc_html__( 'Effect', MELA_TD ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'slide',
					'options' 	=> [
						'slide' 	=> esc_html__( 'Slide', MELA_TD ),
						'fade' 		=> esc_html__( 'Fade', MELA_TD ),
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'jltma_gallery_slider_speed',
				[
					'label' 	=> esc_html__( 'Animation Speed', MELA_TD ),
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> 500,
					'frontend_available' => true,
				]
			);

			$this->add_control(
	            'jltma_gallery_slider_direction',
	            [
	                'label' 		=> esc_html__( 'Direction', MELA_TD ),
	                'type' 			=> Controls_Manager::CHOOSE,
	                'label_block' 	=> false,
	                'options' 		=> [
	                    'ltr' 			=> [
							'title' 		=> esc_html__( 'Left to Right', MELA_TD ),
							'icon' 			=> 'fa fa-arrow-right',
	                    ],
	                    'rtl' 			=> [
	                        'title' 		=> esc_html__( 'Right to Left', MELA_TD ),
	                        'icon' 			=> 'fa fa-arrow-left',
	                    ],
	                ],
	                'default' 		 => 'ltr',
	                'style_transfer' => true,
	            ]
	        );

		$this->end_controls_section();



        /**
         * Content Tab: Preview Styles
         */


		$this->start_controls_section(
			'jltma_gallery_slider_section_style_preview',
			[
				'label' 	=> esc_html__( 'Preview', MELA_TD ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs( 'jltma_gallery_slider_preview_tabs' );

				$this->start_controls_tab( 'jltma_gallery_slider_preview_layout', [ 'label' => esc_html__( 'Layout', MELA_TD ) ] );

					$this->add_control(
						'jltma_gallery_slider_preview_position',
						[
							'label' 	=> esc_html__( 'Position', MELA_TD ),
							'type' 		=> Controls_Manager::SELECT,
							'default' 	=> 'left',
							'tablet_default' 	=> 'top',
							'mobile_default' 	=> 'top',
							'options' 	=> [
								'top' 		=> esc_html__( 'Top', MELA_TD ),
								'right' 	=> esc_html__( 'Right', MELA_TD ),
								'left' 		=> esc_html__( 'Left', MELA_TD ),
							],
							'prefix_class'	=> 'ee-gallery-slider--',
							'condition' => [
								'jltma_gallery_slider_show_thumbnails!' => '',
							],
						]
					);

					$this->add_control(
						'jltma_gallery_slider_preview_stack',
						[
							'label' 	=> esc_html__( 'Stack on', MELA_TD ),
							'type' 		=> Controls_Manager::SELECT,
							'default' 	=> 'tablet',
							'tablet_default' 	=> 'top',
							'mobile_default' 	=> 'top',
							'options' 	=> [
								'tablet' 	=> esc_html__( 'Tablet & Mobile', MELA_TD ),
								'mobile' 	=> esc_html__( 'Mobile Only', MELA_TD ),
							],
							'prefix_class'	=> 'ee-gallery-slider--stack-',
							'condition' => [
								'jltma_gallery_slider_show_thumbnails!' => '',
							],
						]
					);

					$this->add_responsive_control(
						'jltma_gallery_slider_preview_width',
						[
							'label' 	=> esc_html__( 'Width (%)', MELA_TD ),
							'type' 		=> Controls_Manager::SLIDER,
							'range' 	=> [
								'px' 	=> [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' 	=> [
								'size' 	=> 70,
							],
							'condition'	=> [
								'jltma_gallery_slider_preview_position!' => 'top',
								'jltma_gallery_slider_show_thumbnails!' => '',
							],
							'selectors'		=> [
								'{{WRAPPER}}.ee-gallery-slider--left .ee-gallery-slider__preview' => 'width: {{SIZE}}%',
								'{{WRAPPER}}.ee-gallery-slider--right .ee-gallery-slider__preview' => 'width: {{SIZE}}%',
								'{{WRAPPER}}.ee-gallery-slider--left .ee-gallery-slider__gallery' => 'width: calc(100% - {{SIZE}}%)',
								'{{WRAPPER}}.ee-gallery-slider--right .ee-gallery-slider__gallery' => 'width: calc(100% - {{SIZE}}%)',
							],
						]
					);

					$preview_horizontal_margin = is_rtl() ? 'margin-right' : 'margin-left';
					$preview_horizontal_padding = is_rtl() ? 'padding-right' : 'padding-left';

					$this->add_responsive_control(
						'jltma_gallery_slider_preview_spacing',
						[
							'label' 	=> esc_html__( 'Spacing', MELA_TD ),
							'type' 		=> Controls_Manager::SLIDER,
							'range' 	=> [
								'px' 	=> [
									'min' => 0,
									'max' => 200,
								],
							],
							'default' 	=> [
								'size' 	=> 24,
							],
							'selectors' => [
								'{{WRAPPER}}.ee-gallery-slider--left .ee-gallery-slider > *,
								 {{WRAPPER}}.ee-gallery-slider--right .ee-gallery-slider > *' => $preview_horizontal_padding . ': {{SIZE}}{{UNIT}};',

								'{{WRAPPER}}.ee-gallery-slider--left .ee-gallery-slider,
								 {{WRAPPER}}.ee-gallery-slider--right .ee-gallery-slider' => $preview_horizontal_margin . ': -{{SIZE}}{{UNIT}};',

								'{{WRAPPER}}.ee-gallery-slider--top .ee-gallery-slider__preview' => 'margin-bottom: {{SIZE}}{{UNIT}};',

								'(tablet){{WRAPPER}}.ee-gallery-slider--stack-tablet .ee-gallery-slider__preview' => 'margin-bottom: {{SIZE}}{{UNIT}};',
								'(mobile){{WRAPPER}}.ee-gallery-slider--stack-mobile .ee-gallery-slider__preview' => 'margin-bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'jltma_gallery_slider_show_thumbnails!' => '',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab( 'jltma_gallery_slider_preview_images', [ 'label' => esc_html__( 'Images', MELA_TD ) ] );

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name' 		=> 'jltma_gallery_slider_preview_border',
							'label' 	=> esc_html__( 'Image Border', MELA_TD ),
							'selector' 	=> '{{WRAPPER}} .slick-slider',
						]
					);

					$this->add_control(
						'jltma_gallery_slider_preview_border_radius',
						[
							'label' 		=> esc_html__( 'Border Radius', MELA_TD ),
							'type' 			=> Controls_Manager::DIMENSIONS,
							'size_units' 	=> [ 'px', '%' ],
							'selectors' 	=> [
								'{{WRAPPER}} .slick-slide' 	=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name' 		=> 'jltma_gallery_slider_preview_box_shadow',
							'selector' 	=> '{{WRAPPER}} .slick-slider',
							'separator'	=> '',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'jltma_gallery_slider_arrows_style_heading',
				[
					'label' 	=> esc_html__( 'Arrows', MELA_TD ),
					'separator' => 'before',
					'type' 		=> Controls_Manager::HEADING,
					'condition'		=> [
						'jltma_gallery_slider_show_arrows!' => '',
					]
				]
			);

			$this->add_responsive_control(
				'jltma_gallery_slider_arrows_size',
				[
					'label' 		=> esc_html__( 'Size', MELA_TD ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 12,
							'max' => 48,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ee-carousel__arrow' => 'font-size: {{SIZE}}px;',
					],
					'condition'		=> [
						'jltma_gallery_slider_show_arrows!' => '',
					]
				]
			);

			$this->add_responsive_control(
				'jltma_gallery_slider_arrows_padding',
				[
					'label' 		=> esc_html__( 'Padding', MELA_TD ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' 	=> 0,
							'max' 	=> 1,
							'step'	=> 0.1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ee-carousel__arrow' => 'padding: {{SIZE}}em;',
					],
					'condition'		=> [
						'jltma_gallery_slider_show_arrows!' => '',
					]
				]
			);

			$this->add_responsive_control(
				'jltma_gallery_slider_arrows_distance',
				[
					'label' 		=> esc_html__( 'Distance', MELA_TD ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ee-carousel__arrow' => 'margin: {{SIZE}}px; transform: translateY( calc(-50% - {{SIZE}}px ) )',
					],
					'condition'		=> [
						'jltma_gallery_slider_show_arrows!' => '',
					]
				]
			);

			$this->add_responsive_control(
				'jltma_gallery_slider_arrows_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', MELA_TD ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ee-carousel__arrow' => 'border-radius: {{SIZE}}%;',
					],
					'condition'		=> [
						'jltma_gallery_slider_show_arrows!' => '',
					],
					'separator'		=> 'after',
				]
			);

			$this->add_group_control(
				MA_Group_Control_Transition::get_type(),
				[
					'name' 			=> 'jltma_gallery_slider_arrows',
					'selector' 		=> '{{WRAPPER}} .ee-carousel__arrow,
										{{WRAPPER}} .ee-carousel__arrow:before',
					'condition'		=> [
						'jltma_gallery_slider_show_arrows!' => '',
					]
				]
			);

			$this->start_controls_tabs( 'jltma_gallery_slider_arrows_tabs_hover' );

			$this->start_controls_tab( 'jltma_gallery_slider_arrows_tab_default', [
				'label' => esc_html__( 'Default', MELA_TD ),
				'condition'	=> [
					'jltma_gallery_slider_show_arrows!' => '',
				]
			] );

				$this->add_control(
					'jltma_gallery_slider_arrows_color',
					[
						'label' 	=> esc_html__( 'Color', MELA_TD ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ee-carousel__arrow i:before' => 'color: {{VALUE}};',
						],
						'condition'		=> [
							'jltma_gallery_slider_show_arrows!' => '',
						]
					]
				);

				$this->add_control(
					'jltma_gallery_slider_arrows_background_color',
					[
						'label' 	=> esc_html__( 'Background Color', MELA_TD ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ee-carousel__arrow' => 'background-color: {{VALUE}};',
						],
						'condition'		=> [
							'jltma_gallery_slider_show_arrows!' => '',
						]
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'jltma_gallery_slider_arrows_tab_hover', [
				'label' => esc_html__( 'Hover', MELA_TD ),
				'condition'	=> [
					'jltma_gallery_slider_show_arrows!' => '',
				]
			] );

				$this->add_control(
					'jltma_gallery_slider_arrows_color_hover',
					[
						'label' 	=> esc_html__( 'Color', MELA_TD ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ee-carousel__arrow:hover i:before' => 'color: {{VALUE}};',
						],
						'condition'		=> [
							'jltma_gallery_slider_show_arrows!' => '',
						]
					]
				);

				$this->add_control(
					'jltma_gallery_slider_arrows_background_color_hover',
					[
						'label' 	=> esc_html__( 'Background Color', MELA_TD ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ee-carousel__arrow:hover' => 'background-color: {{VALUE}};',
						],
						'condition'		=> [
							'jltma_gallery_slider_show_arrows!' => '',
						]
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'jltma_gallery_slider_arrows_tab_disabled', [
				'label' => esc_html__( 'Disabled', MELA_TD ),
				'condition'	=> [
					'jltma_gallery_slider_show_arrows!' => '',
				]
			] );

				$this->add_responsive_control(
					'jltma_gallery_slider_arrows_opacity_disabled',
					[
						'label' 		=> esc_html__( 'Opacity', MELA_TD ),
						'type' 			=> Controls_Manager::SLIDER,
						'range' 		=> [
							'px' 		=> [
								'min' => 0,
								'max' => 1,
								'step'=> 0.05,
							],
						],
						'selectors' 	=> [
							'{{WRAPPER}} .ee-carousel__arrow.slick-disabled' => 'opacity: {{SIZE}};',
						],
						'condition'		=> [
							'jltma_gallery_slider_show_arrows!' => '',
						]
					]
				);

			$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();




        /**
         * Content Tab: Preview Captions
         */


		$this->start_controls_section(
			'jltma_gallery_slider_section_style_preview_captions',
			[
				'label' 	=> esc_html__( 'Preview Captions', MELA_TD ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'jltma_gallery_slider_caption_type!' => '',
				],
			]
		);

			$this->add_control(
				'jltma_gallery_slider_preview_vertical_align',
				[
					'label' 	=> esc_html__( 'Vertical Align', MELA_TD ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'top' 	=> [
							'title' 	=> esc_html__( 'Top', MELA_TD ),
							'icon' 		=> 'eicon-v-align-top',
						],
						'middle' 		=> [
							'title' 	=> esc_html__( 'Middle', MELA_TD ),
							'icon' 		=> 'eicon-v-align-middle',
						],
						'bottom' 		=> [
							'title' 	=> esc_html__( 'Bottom', MELA_TD ),
							'icon' 		=> 'eicon-v-align-bottom',
						],
					],
					'default' 		=> 'bottom',
					'condition' 	=> [
						'jltma_gallery_slider_caption_type!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_preview_horizontal_align',
				[
					'label' 	=> esc_html__( 'Horizontal Align', MELA_TD ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' 	=> esc_html__( 'Left', MELA_TD ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', MELA_TD ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'right' 		=> [
							'title' 	=> esc_html__( 'Right', MELA_TD ),
							'icon' 		=> 'eicon-h-align-right',
						],
						'justify' 		=> [
							'title' 	=> esc_html__( 'Justify', MELA_TD ),
							'icon' 		=> 'eicon-h-align-stretch',
						],
					],
					'default' 		=> 'justify',
					'condition' 	=> [
						'jltma_gallery_slider_caption_type!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_preview_align',
				[
					'label' 	=> esc_html__( 'Text Align', MELA_TD ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 	=> [
							'title' 	=> esc_html__( 'Left', MELA_TD ),
							'icon' 		=> 'fa fa-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', MELA_TD ),
							'icon' 		=> 'fa fa-align-center',
						],
						'right' 		=> [
							'title' 	=> esc_html__( 'Right', MELA_TD ),
							'icon' 		=> 'fa fa-align-right',
						],
					],
					'default' 	=> 'center',
					'selectors' => [
						'{{WRAPPER}} .ee-carousel__media__caption' => 'text-align: {{VALUE}};',
					],
					'condition' => [
						'jltma_gallery_slider_thumbnails_caption_type!' => '',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'jltma_gallery_slider_preview_typography',
					'label' 	=> esc_html__( 'Typography', MELA_TD ),
					'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
					'selector' 	=> '{{WRAPPER}} .ee-carousel__media__caption',
					'condition' 	=> [
						'jltma_gallery_slider_caption_type!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_preview_text_padding',
				[
					'label' 		=> esc_html__( 'Padding', MELA_TD ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ee-carousel__media__caption' 	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'jltma_gallery_slider_caption_type!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_preview_text_margin',
				[
					'label' 		=> esc_html__( 'Margin', MELA_TD ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ee-carousel__media__caption' 	=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'jltma_gallery_slider_caption_type!' => '',
					],
					'separator'		=> 'after',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'jltma_gallery_slider_preview_text_border',
					'label' 	=> esc_html__( 'Border', MELA_TD ),
					'selector' 	=> '{{WRAPPER}} .ee-carousel__media__caption',
					'separator' => '',
					'condition'	=> [
						'jltma_gallery_slider_caption_type!' => '',
					],
				]
			);

			$this->add_control(
				'jltma_gallery_slider_preview_text_border_radius',
				[
					'label' 		=> esc_html__( 'Border Radius', MELA_TD ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ee-carousel__media__caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' 	=> [
						'jltma_gallery_slider_caption_type!' => '',
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
                'raw'             => sprintf( esc_html__( '%1$s Live Demo %2$s', MELA_TD ), '<a href="https://master-addons.com/demos/gallery-slider/" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_2',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Documentation %2$s', MELA_TD ), '<a href="https://master-addons.com/docs/addons/gallery-slider-for-elementor/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_3',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Watch Video Tutorial %2$s', MELA_TD ), '<a href="https://www.youtube.com/watch?v=9amvO6p9kpM" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );
        $this->end_controls_section();




        //Upgrade to Pro
		if ( ma_el_fs()->is_not_paying() ) {

			$this->start_controls_section(
				'jltma_section_pro_style_section',
				[
					'label' => esc_html__( 'Upgrade to Pro Version for More Features', MELA_TD ),
				]
			);

			$this->add_control(
				'jltma_control_get_pro_style_tab',
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


	protected function render() {

		$settings  = $this->get_settings_for_display();



	}


}

Plugin::instance()->widgets_manager->register_widget_type( new JLTMA_Gallery_Slider() );
