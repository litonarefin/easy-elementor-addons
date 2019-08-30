<?php
	namespace Elementor;
	use \Elementor\Widget_Base;
	use \Elementor\Controls_Manager as Controls_Manager;
	use \Elementor\Group_Control_Border as Group_Control_Border;
	use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
	use \Elementor\Group_Control_Typography as Group_Control_Typography;
	use \Elementor\Scheme_Typography as Scheme_Typography;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 8/28/19
	 */

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Image_Hover_Effects extends Widget_Base {

		public function get_name() {
			return 'ma-image-hover-effects';
		}

		public function get_title() {
			return esc_html__( 'MA Image Hover Effects', MELA_TD );
		}

		public function get_icon() {
			return 'ma-el-icon eicon-image-rollover';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

			/*
			* Image Hover Effects Section Start
			*/

			$this->start_controls_section(
				'ma-image-hover-effect-section',
				[
					'label' => __( 'Image Section', MELA_TD ),
				]
			);


			$this->add_control('ma_el_main_image',
				[
					'label'			=> __( 'Upload Image', MELA_TD ),
					'description'	=> __( 'Select an Image', MELA_TD ),
					'type'			=> Controls_Manager::MEDIA,
					'dynamic'       => [ 'active' => true ],
					'default'		=> [
						'url'	=> Utils::get_placeholder_image_src()
					],
					'show_external'	=> true
				]
			);

			$this->add_control('ma_el_image_link_url_switch',
				[
					'label'         => __('Image Link?', MELA_TD),
					'type'          => Controls_Manager::SWITCHER
				]
			);

			$this->add_control('ma_el_main_image_link_switcher',
				[
					'label'			=> __( 'Custom Link', MELA_TD ),
					'type'			=> Controls_Manager::SWITCHER,
					'description'	=> __( 'Add a custom link to the Image', MELA_TD ),
					'condition'     => [
						'ma_el_image_link_url_switch'    => 'yes',
					],
				]
			);
//
//			$this->add_control('ma_el_main_image_custom_link',
//				[
//					'label'			=> __( 'Set Custom Link', MELA_TD ),
//					'type'			=> Controls_Manager::URL,
//					'dynamic'       => [ 'active' => true ],
//					'description'	=> __( 'What custom link you want to set to Image?', MELA_TD ),
//					'condition'		=> [
//						'ma_el_main_image_link_switcher' => 'yes',
//						'ma_el_image_link_url_switch'    => 'yes'
//					],
//					'show_external' => false
//				]
//			);

//
//			$this->add_control('ma_el_main_image_existing_page_link',
//				[
//					'label'			=> __( 'Select a Page', MELA_TD ),
//					'type'			=> Controls_Manager::SELECT2,
//					'condition'		=> [
//						'ma_el_main_image_link_switcher!' => 'yes',
//						'ma_el_image_link_url_switch'    => 'yes'
//					],
//					'multiple'      => false,
//					'options'		=> Master_Addons_Helper::ma_get_page_templates()
//				]
//			);

//			$this->add_control('ma_el_main_image_link_title',
//				[
//					'label'			=> __( 'Link Title', MELA_TD ),
//					'type'			=> Controls_Manager::TEXT,
//					'dynamic'       => [ 'active' => true ],
//					'condition'     => [
//						'ma_el_main_image_link_switcher' => 'yes',
//						'ma_el_image_link_url_switch'    => 'yes'
//					]
//				]
//			);

			$this->add_control(
				'ma_el_main_image_link_url',
				[
					'label'       => esc_html__( 'Link URL', MELA_TD ),
					'type'        => Controls_Manager::URL,
					'label_block' => true,
					'default'     => [
						'url'         => '#',
						'is_external' => '',
					],
					'condition'		=> [
//						'ma_el_main_image_link_switcher!' => 'yes',
						'ma_el_main_image_link_switcher' => 'yes',
						'ma_el_image_link_url_switch'    => 'yes'
					],
					'show_external' => true,
				]
			);

			$this->add_control('ma_el_main_image_height',
				[
					'label'			=> __( 'Height', MELA_TD ),
					'type'			=> Controls_Manager::SELECT,
					'options'		=> [
						'default'		=> __('Default', MELA_TD),
						'custom'		=> __('Custom', MELA_TD)
					],
					'default'		=> 'default',
					'description'	=> __( 'Choose if you want to set a custom height for the banner or keep it as it is', MELA_TD )
				]
			);

			$this->add_responsive_control('ma_el_main_image_custom_height',
				[
					'label'			=> __( 'Min Height', MELA_TD ),
					'type'			=> Controls_Manager::NUMBER,
					'description'	=> __( 'Set a minimum height value in pixels', MELA_TD ),
					'condition'		=> [
						'ma_el_main_image_height' => 'custom'
					],
					'selectors'		=> [
						'{{WRAPPER}} .premium-banner-ib' => 'height: {{VALUE}}px;'
					]
				]
			);

			$this->add_responsive_control('ma_el_main_image_vertical_align',
				[
					'label'			=> __( 'Vertical Align', MELA_TD ),
					'type'			=> Controls_Manager::SELECT,
					'condition'		=> [
						'ma_el_main_image_height' => 'custom'
					],
					'options'		=> [
						'flex-start'	=> __('Top', MELA_TD),
						'center'		=> __('Middle', MELA_TD),
						'flex-end'		=> __('Bottom', MELA_TD),
						'inherit'		=> __('Full', MELA_TD)
					],
					'default'       => 'flex-start',
					'selectors'		=> [
						'{{WRAPPER}} .premium-banner-img-wrap' => 'align-items: {{VALUE}}; -webkit-align-items: {{VALUE}};'
					]
				]
			);

			$this->end_controls_section();






			/*
			 *  Master Addons: Style Controls
			 */
			$this->start_controls_section(
				'ma_el_main_image_content_section',
				[
					'label' => esc_html__( 'Content', MELA_TD )
				]
			);

			$this->add_control('ma_el_main_image_title',
				[
					'label'			=> __( 'Title', MELA_TD ),
					'placeholder'	=> __( 'Give a title to this banner', MELA_TD ),
					'type'			=> Controls_Manager::TEXT,
					'dynamic'       => [ 'active' => true ],
					'default'		=> __( 'Master Addon Image', MELA_TD ),
					'label_block'	=> false
				]
			);

			$this->add_control(
				'title_html_tag',
				[
					'label'   => __( 'HTML Tag', MELA_TD ),
					'type'    => Controls_Manager::SELECT,
					'options' => Master_Addons_Helper::ma_el_title_tags(),
					'default' => 'h2',
				]
			);

			$this->add_control('ma_el_main_image_desc',
				[
					'label'			=> __( 'Description', MELA_TD ),
					'description'	=> __( 'Give the description to this banner', MELA_TD ),
					'type'			=> Controls_Manager::WYSIWYG,
					'dynamic'       => [ 'active' => true ],
					'default'		=> __( 'Master Addons gives your website a vibrant and lively style, you would love.', MELA_TD ),
					'label_block'	=> true
				]
			);

			$this->add_control('ma_el_main_image_button_link',
				[
					'label'         => __('Read More Button', MELA_TD),
					'type'          => Controls_Manager::SWITCHER,
					'condition'     => [
						'ma_el_image_link_url_switch!'   => 'yes'
					]
				]
			);

			$this->add_control('ma_el_main_image_more_text',
				[
					'label'         => __('Read More Text',MELA_TD),
					'type'          => Controls_Manager::TEXT,
					'dynamic'       => [ 'active' => true ],
					'default'       => 'Ream More',
					'condition'     => [
						'ma_el_main_image_button_link'    => 'yes',
						'ma_el_image_link_url_switch!'   => 'yes'
					]
				]
			);

			$this->add_control(
				'ma_el_main_image_more_text_url',
				[
					'label'       => esc_html__( 'Read More URL', MELA_TD ),
					'type'        => Controls_Manager::URL,
					'label_block' => true,
					'default'     => [
						'url'         => '#',
						'is_external' => '',
					],
					'condition'     => [
						'ma_el_main_image_button_link'    => 'yes',
						'ma_el_image_link_url_switch!'   => 'yes'
					],
					'show_external' => true,
				]
			);

			$this->end_controls_section();






			/*
			 *  Master Addons: Style Controls
			 */
			$this->start_controls_section(
				'ma_el_main_image_style_settings',
				[
					'label' => esc_html__( 'Effects', MELA_TD ),
					'tab'   => Controls_Manager::TAB_STYLE
				]
			);

			// Premium Version Codes
			if ( ma_el_fs()->can_use_premium_code__premium_only() ) {

				$this->add_control(
					'ma_el_main_image_effect',
					[
						'label'       => esc_html__( 'Hover Effect', MELA_TD ),
						'type'        => Controls_Manager::SELECT,
						'default'     => 'cl-effect-1',
						'options'     => [
							'cl-effect-1' 	=> esc_html__( 'Brackets', 	                                MELA_TD ),
							'cl-effect-2' 	=> esc_html__( '3D Effect(Pro)', 	                        MELA_TD ),
							'cl-effect-3' 	=> esc_html__( 'Bottom Line Slide', 	                    MELA_TD ),
						],

					]
				);


				//Free Version Codes
			} else {

				$this->add_control(
					'ma_el_main_image_effect',
					[
						'label'       => esc_html__( 'Hover Effect', MELA_TD ),
						'type'        => Controls_Manager::SELECT,
						'default'     => 'cl-effect-1',
						'options'     => [
							'lily' 	            => __( 'Lily', 	                            MELA_TD ),
							'sadie' 	        => __( 'Sadie', 	                        MELA_TD ),
							'roxy'              => __( 'Roxy', 	                            MELA_TD ),
							'bubba'             => __( 'Bubba', 	                        MELA_TD ),
							'romeo'             => __( 'Romeo', 	                        MELA_TD ),
							'layla'             => __( 'Layla', 	                        MELA_TD ),
							'honey'             => __( 'Honey', 	                        MELA_TD ),
							'oscar'             => __( 'Oscar', 	                        MELA_TD ),
							'marley'            => __( 'Marley', 	                        MELA_TD ),
							'ruby'              => __( 'Ruby', 	                            MELA_TD ),
							'milo'              => __( 'Milo', 	                            MELA_TD ),
							'dexter'            => __( 'Dexter', 	                        MELA_TD ),
							'sarah'             => __( 'Sarah', 	                        MELA_TD ),
							'zoe'               => __( 'Zoe', 	                            MELA_TD ),
							'chico'             => __( 'Chico', 	                        MELA_TD ),
						],


						'description' => sprintf( '20+ more effects on <a href="%s" target="_blank">%s</a>',
							esc_url_raw( admin_url('admin.php?page=master-addons-settings-pricing') ),
							__( 'Upgrade Now', MELA_TD ) )
					]
				);
			}

			$this->add_control('ma_el_main_image_active',
				[
					'label'			=> __( 'Always Hovered', MELA_TD ),
					'type'			=> Controls_Manager::SWITCHER,
					'description'	=> __( 'Choose if you want the effect to be always triggered', MELA_TD )
				]
			);


			$this->add_control('ma_el_main_image_hover_effect',
				[
					'label'         => __('Hover Animation', MELA_TD),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'none'          => __('None', MELA_TD),
						'zoomin'        => __('Zoom In', MELA_TD),
						'zoomout'       => __('Zoom Out', MELA_TD),
						'scale'         => __('Scale', MELA_TD),
						'grayscale'     => __('Grayscale', MELA_TD),
						'blur'          => __('Blur', MELA_TD),
						'bright'        => __('Bright', MELA_TD),
						'sepia'         => __('Sepia', MELA_TD),
					],
					'default'       => 'none',
				]
			);


			$this->end_controls_section();


			/*
			 * Image Hover Style Section
			 */
			$this->start_controls_section('ma_el_main_image_hover_style_section',
				[
					'label' 		=> __( 'Image', MELA_TD ),
					'tab' 			=> Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control('ma_el_main_image_bg_color',
				[
					'label' 		=> __( 'Background Color', MELA_TD ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						'{{WRAPPER}} .premium-banner-ib' => 'background: {{VALUE}};'
					]
				]
			);

			$this->add_control('ma_el_main_image_opacity',
				[
					'label' => __( 'Image Opacity', MELA_TD ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 1
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1,
							'step' => .1
						]
					],
					'selectors' => [
						'{{WRAPPER}} .premium-banner-ib .premium-banner-ib-img' => 'opacity: {{SIZE}};'
					]
				]
			);

			$this->add_control('ma_el_main_image_hover_opacity',
				[
					'label' => __( 'Hover Opacity', MELA_TD ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 1
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1,
							'step' => .1
						]
					],
					'selectors' => [
						'{{WRAPPER}} .premium-banner-ib .premium-banner-ib-img.active' => 'opacity: {{SIZE}};'
					]
				]
			);


			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'image_filters',
					'label'     => __('Image Filter', MELA_TD),
					'selector' => '{{WRAPPER}} .premium-banner-ib-img',
				]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name'      => 'hover_image_filters',
					'label'     => __('Hover Image Filter', MELA_TD),
					'selector'  => '{{WRAPPER}} .premium-banner-ib .premium-banner-ib-img.active'
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'ma_el_main_image_border',
					'selector'      => '{{WRAPPER}} .premium-banner-ib'
				]
			);

			$this->add_responsive_control(
				'ma_el_main_image_border_radius',
				[
					'label' => __( 'Border Radius', MELA_TD ),
					'type' => Controls_Manager::SLIDER,
					'size_units'    => ['px', '%' ,'em'],
					'selectors' => [
						'{{WRAPPER}} .premium-banner-ib' => 'border-radius: {{SIZE}}{{UNIT}};'
					]
				]
			);

			$this->end_controls_section();




			$this->start_controls_section('ma_el_main_image_title_style',
				[
					'label' 		=> __( 'Title', MELA_TD ),
					'tab' 			=> Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control('ma_el_main_image_color_of_title',
				[
					'label' => __( 'Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1
					],
					'selectors' => [
						'{{WRAPPER}} .premium-banner-ib-desc .ma_el_main_image_title' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control('ma_el_main_image_title_bg',
				[
					'label'			=> __( 'Title Background', MELA_TD ),
					'type'			=> Controls_Manager::COLOR,
					'default'       => '#f2f2f2',
					'label_block'	=> true,
					'description'	=> __( 'Choose a background color for the title', MELA_TD ),
					'condition'		=> [
						'ma_el_main_image_effect' => 'animation5'
					],
					'selectors'     => [
						'{{WRAPPER}} .premium-banner-animation5 .premium-banner-ib-desc'    => 'background: {{VALUE}};',
					]
				]
			);

			$this->add_control('ma_el_main_image_title_border',
				[
					'label'			=> __( 'Title Border Color', MELA_TD ),
					'type'			=> Controls_Manager::COLOR,
					'condition'		=> [
						'ma_el_main_image_effect' => 'animation13'
					],
					'selectors'     => [
						'{{WRAPPER}} .premium-banner-animation13 .premium-banner-ib-title::after'    => 'background: {{VALUE}};',
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'ma_el_main_image_title_typography',
					'selector' => '{{WRAPPER}} .premium-banner-ib-desc .ma_el_main_image_title',
					'scheme' => Scheme_Typography::TYPOGRAPHY_1
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'label'             => __('Box Shadow',MELA_TD),
					'name'              => 'ma_el_main_image_title_shadow',
					'selector'          => '{{WRAPPER}} .premium-banner-ib-desc .ma_el_main_image_title'
				]
			);

			$this->end_controls_section();


			/*
			 * Description Style
			 */


			$this->start_controls_section('ma_el_main_image_desc_style_section',
				[
					'label' 		=> __( 'Description', MELA_TD ),
					'tab' 			=> Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control('ma_el_main_image_desc_color',
				[
					'label' => __( 'Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3
					],
					'selectors' => [
						'{{WRAPPER}} .premium-banner .premium_banner_content' => 'color: {{VALUE}};'
					],
				]
			);

//			$this->add_control('ma_el_main_image_desc_scaled_border_color',
//				[
//					'label' => __( 'Inner Border Color', MELA_TD ),
//					'type' => Controls_Manager::COLOR,
//					'condition'		=> [
//						'ma_el_main_image_effect' => ['animation4', 'animation6']
//					],
//					'selectors' => [
//						'{{WRAPPER}} .premium-banner-animation4 .premium-banner-ib-desc::after, {{WRAPPER}} .premium-banner-animation4 .premium-banner-ib-desc::before, {{WRAPPER}} .premium-banner-animation6 .premium-banner-ib-desc::before' => 'border-color: {{VALUE}};'
//					],
//				]
//			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'ma_el_main_image_desc_typhography',
					'selector'      => '{{WRAPPER}} .premium-banner .premium_banner_content',
					'scheme'        => Scheme_Typography::TYPOGRAPHY_3,
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'label'             => __('Box Shadow',MELA_TD),
					'name'              => 'ma_el_main_image_desc_box_shadow',
					'selector'          => '{{WRAPPER}} .premium-banner .premium_banner_content',
				]
			);

			$this->end_controls_section();



			/*
			 * Button Style
			 */

			$this->start_controls_section('ma_el_main_image_button_style_section',
				[
					'label' 		=> __( 'Button', MELA_TD ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'ma_el_main_image_link_switcher' => 'yes',
						'ma_el_image_link_url_switch'    => 'yes'
					]
				]
			);

			$this->add_control('ma_el_main_image_button_color',
				[
					'label' => __( 'Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3
					],
					'selectors' => [
						'{{WRAPPER}} .premium-banner .premium-banner-link' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control('ma_el_main_image_button_hover_color',
				[
					'label' => __( 'Hover Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3,
					],
					'selectors' => [
						'{{WRAPPER}} .premium-banner .premium-banner-link:hover' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'          => 'ma_el_main_image_button_typography',
					'scheme'        => Scheme_Typography::TYPOGRAPHY_3,
					'selector'      => '{{WRAPPER}} .premium-banner .premium-banner-link',
				]
			);

			$this->add_control(
				'ma_el_main_image_button_bg_color',
				[
					'label' => __( 'Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .premium-banner .premium-banner-link' => 'background-color: {{VALUE}};'
					],
				]
			);

			$this->add_control('ma_el_main_image_button_bg_hover_color',
				[
					'label' => __( 'Hover Background Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .premium-banner .premium-banner-link:hover' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'ma_el_main_image_button_border',
					'selector'      => '{{WRAPPER}} .premium-banner .premium-banner-link'
				]
			);

			$this->add_control('ma_el_main_image_button_border_radius',
				[
					'label'         => __('Border Radius', MELA_TD),
					'type'          => Controls_Manager::SLIDER,
					'size_units'    => ['px', '%' ,'em'],
					'selectors'     => [
						'{{WRAPPER}} .premium-banner .premium-banner-link' => 'border-radius: {{SIZE}}{{UNIT}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'label'             => __('Box Shadow',MELA_TD),
					'name'              => 'ma_el_main_image_button_box_shadow',
					'selector'          => '{{WRAPPER}} .premium-banner .premium-banner-link',
				]
			);

			$this->add_responsive_control('ma_el_main_image_button_padding',
				[
					'label'         => __('Padding', MELA_TD),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => ['px', 'em', '%'],
					'selectors'     => [
						'{{WRAPPER}} .premium-banner .premium-banner-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					]
				]
			);

			$this->end_controls_section();


		}


		protected function render() {

			$settings 	= $this->get_settings_for_display();
			$ma_el_id		= $this->get_id();


			$this->add_render_attribute( 'ma_el_image_hover_effect', [
				'class'	=> [
					'ma-el-image-hover-effect',
					esc_attr($settings['ma_el_main_image_effect'] )
				],
				'id' => 'ma-el-image-hover-effect-' . esc_attr( $ma_el_id )
			]);


//
//			$this->add_inline_editing_attributes('premium_banner_title');
//			$this->add_inline_editing_attributes('premium_banner_description', 'advanced');
//
//			$title_tag 	= $settings[ 'premium_banner_title_tag' ];
//			$title 		= $settings[ 'premium_banner_title' ];
//			$full_title = '<'. $title_tag . ' class="premium-banner-ib-title ult-responsive premium_banner_title"><div '. $this->get_render_attribute_string('premium_banner_title') .'>' .$title. '</div></'.$title_tag.'>';
//
//			$link = 'yes' == $settings['premium_banner_image_link_switcher'] ? $settings['premium_banner_image_custom_link']['url'] : get_permalink( $settings['premium_banner_image_existing_page_link'] );
//
//			$link_title = $settings['premium_banner_link_url_switch'] === 'yes' ? $settings['premium_banner_link_title'] : '';
//
//			$open_new_tab = $settings['premium_banner_image_link_open_new_tab'] == 'yes' ? ' target="_blank"' : '';
//			$nofollow_link = $settings['premium_banner_image_link_add_nofollow'] == 'yes' ? ' rel="nofollow"' : '';
//			$full_link = '<a class="premium-banner-ib-link" href="'. $link .'" title="'. $link_title .'"'. $open_new_tab . $nofollow_link . '></a>';
//			$animation_class = 'premium-banner-' . $settings['premium_banner_image_animation'];
//			$hover_class = ' ' . $settings['premium_banner_hover_effect'];
//			$extra_class = ! empty( $settings['premium_banner_extra_class'] ) ? ' '. $settings['premium_banner_extra_class'] : '';
//			$active = $settings['premium_banner_active'] == 'yes' ? ' active' : '';
//			$full_class = $animation_class.$hover_class.$extra_class.$active;
//			$min_size = $settings['premium_banner_min_range'] .'px';
//			$max_size = $settings['premium_banner_max_range'] .'px';
//
//
//			$banner_url = 'url' == $settings['premium_banner_link_selection'] ? $settings['premium_banner_link']['url'] : get_permalink($settings['premium_banner_existing_link']);
//
//			$alt = esc_attr( Control_Media::get_image_alt( $settings['premium_banner_image'] ) );



			?>

				<div <?php echo $this->get_render_attribute_string( 'ma_el_creative_links_wrapper' ); ?>>

					<figure class="effect-lily">
						<img src="<?php echo esc_url($settings['ma_el_main_image']['url']); ?>" alt="<?php echo
						get_post_meta( $settings['ma_el_main_image']['id'], '_wp_attachment_image_alt',
							true);
						?>">
						<figcaption>
							<div>
								<h2>Nice <span>Lily</span></h2>
								<p>Lily likes to play with crayons and pencils</p>
							</div>
							<a href="#">View more</a>
						</figcaption>
					</figure>

				</div>
		<?php
		}

		protected function _content_template() {}

	}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Image_Hover_Effects() );