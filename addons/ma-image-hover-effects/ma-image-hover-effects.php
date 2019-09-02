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
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'thumbnail',
					'default' => 'full',
					'condition' => [
						'ma_el_main_image[url]!' => '',
					],
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
						'{{WRAPPER}} .ma-el-image-hover-effect' => 'height: {{VALUE}}px;'
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
						'{{WRAPPER}} .ma-el-image-hover-effect figure' => 'align-items: {{VALUE}}; -webkit-align-items: {{VALUE}};'
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
					'default'		=> __( 'Master <span>Addons</span>', MELA_TD ),
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
					'label_block'	=> true,
					'condition'     => [
						'ma_el_main_image_effect!'   => ['julia']
					]

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
					'default'       => 'Read More',
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
             *  Master Addons: Set 2 Image Descriptions
             */
			$this->start_controls_section(
				'ma_el_main_image_desc_set2_heading',
				[
					'label'			=> __( 'Description', MELA_TD ),
					'type'			=> Controls_Manager::HEADING,
					'description'   => __('Write Description Each line', MELA_TD),
					'condition'     => [
						'ma_el_main_image_effect'   => ['julia']
					]
				]
			);

			$repeater = new Repeater();


			$repeater->add_control('ma_el_main_image_desc_set2',
				[
					'label'         => __('Read More Text',MELA_TD),
					'type'          => Controls_Manager::TEXTAREA,
					'dynamic'       => [ 'active' => true ],
					'default'       => 'Julia dances in the deep dark',
				]
			);


			$this->add_control(
				'ma_el_main_image_desc_set2_tabs',
				[
					'type'                  => Controls_Manager::REPEATER,
					'default'               => [
						[ 'ma_el_main_image_desc_set2' => 'Julia dances in the deep dark' ],
						[ 'ma_el_main_image_desc_set2' => 'She loves the smell of the ocean' ],
						[ 'ma_el_main_image_desc_set2' => 'And dives into the morning light' ]
					],
					'fields'                => array_values( $repeater->get_controls() ),
					'title_field'           => '{{ma_el_main_image_desc_set2}}'
				]
			);


			$this->end_controls_section();







			/*
			 *  Master Addons: Image Hover Social Links
			 */
			$this->start_controls_section(
				'ma_el_main_image_social_link_section',
				[
					'label' => esc_html__( 'Social Links', MELA_TD ),
					'condition'     => [
						'ma_el_main_image_effect' => ['zoe','hera','winston']
					]
				]
			);


			/* Icons Dependencies for Styles */

			$this->add_control('ma_el_main_image_icon_heading',
				[
					'label'			=> __( 'Social Icons', MELA_TD ),
					'type'			=> Controls_Manager::HEADING,
					'description'   => __('Select Social Icons', MELA_TD)
				]
			);
			$repeater = new Repeater();


			$repeater->add_control(
				'ma_el_main_image_icon',
				[
					'label'     => __( 'Icon', MELA_TD ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-wordpress'
				]
			);

			$repeater->add_control(
				'ma_el_main_image_icon_link',
				[
					'label' => __( 'Icon Link', MELA_TD ),
					'type' => Controls_Manager::URL,
					'placeholder' => __( 'https://master-addons.com', MELA_TD ),
					'label_block' => true,
					'default' => [
						'url' => '#',
						'is_external' => true,
					]
				]
			);

			$this->add_control(
				'ma_el_main_image_icon_tabs',
				[
					'type'                  => Controls_Manager::REPEATER,
					'default'               => [
						[ 'ma_el_main_image_icon' => 'fa fa-wordpress' ],
						[ 'ma_el_main_image_icon' => 'fa fa-facebook' ],
						[ 'ma_el_main_image_icon' => 'fa fa-twitter' ],
						[ 'ma_el_main_image_icon' => 'fa fa-instagram' ],
					],
					'fields'                => array_values( $repeater->get_controls() ),
					'title_field'           => '{{ma_el_main_image_icon}}'
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
			if ( ma_el_fs()->can_use_premium_code() ) {

				$this->add_control(
					'ma_el_main_image_effect',
					[
						'label'       => esc_html__( 'Hover Effect', MELA_TD ),
						'type'        => Controls_Manager::SELECT,
						'default'     => 'lily',
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
						'default'     => 'lily',
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
							'julia'             => __( 'Julia', 	                        MELA_TD ),
							'goliath'           => __( 'Goliath', 	                        MELA_TD ),
							'hera'              => __( 'Hera', 	                            MELA_TD ),
							'winston'           => __( 'Winston', 	                        MELA_TD ),
							'selena'            => __( 'Selena', 	                        MELA_TD ),
							'terry'             => __( 'Terry', 	                        MELA_TD ),
							'phoebe'            => __( 'Phoebe', 	                        MELA_TD ),
							'apollo'            => __( 'Apollo', 	                        MELA_TD ),
							'kira'              => __( 'Kira', 	                            MELA_TD ),
							'steve'             => __( 'Steve', 	                        MELA_TD ),
							'moses'             => __( 'Moses', 	                        MELA_TD ),
							'jazz'              => __( 'Jazz', 	                            MELA_TD ),
							'ming'              => __( 'Ming', 	                            MELA_TD ),
							'lexi'              => __( 'Lexi', 	                            MELA_TD ),
							'duke'              => __( 'Duke', 	                            MELA_TD ),
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
					'default'       => '#18a367',
					'selectors' 	=> [
						'{{WRAPPER}} .ma-el-image-hover-effect figure' => 'background: {{VALUE}};'
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



            /*
             * Title Color
             */
			$this->start_controls_section('ma_el_main_image_title_style',
				[
					'label' 		=> __( 'Title', MELA_TD ),
					'tab' 			=> Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control('ma_el_main_image_title_color',
				[
					'label' => __( 'Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1
					],
					'default' => "#fff",
					'selectors' => [

						'{{WRAPPER}} .ma-el-image-hover-effect.lily .ma-el-image-hover-title' => 'color: #fff;',

						'{{WRAPPER}} .ma-el-image-hover-effect .ma-el-image-hover-title' => 'color: {{VALUE}};',
//						'{{WRAPPER}} .ma-el-image-hover-effect .effect-zoe  .ma-el-image-hover-title' => 'color: #343434;',

//                        '{{WRAPPER}} .ma-el-image-hover-effect .effect-zoe .ma-el-image-hover-title' => 'color: #3c4a50;',
//                        '{{WRAPPER}} .ma-el-image-hover-effect .effect-zoe .ma-el-image-hover-title' => 'color: {{VALUE}};',
					]
				]
			);

//			$this->add_control('ma_el_main_image_title_bg',
//				[
//					'label'			=> __( 'Background', MELA_TD ),
//					'type'			=> Controls_Manager::COLOR,
//					'default'       => '#f2f2f2',
//					'condition'		=> [
////						'ma_el_main_image_effect' => 'lily'
//					],
//					'selectors'     => [
//						'{{WRAPPER}} .ma-el-image-hover-effect'    => 'background: {{VALUE}};',
//					]
//				]
//			);

			$this->add_control('ma_el_main_image_title_border',
				[
					'label'			=> __( 'Border Color', MELA_TD ),
					'type'			=> Controls_Manager::COLOR,
					'condition'		=> [
//						'ma_el_main_image_effect' => 'animation13'
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
					'selector' => '{{WRAPPER}} .ma-el-image-hover-effect .ma-el-image-hover-title',
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
					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .ma-el-image-hover-effect .ma-image-hover-content p' => 'color: {{VALUE}};'
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
					'name'          => 'ma_el_main_image_desc_typography',
					'selector'      => '{{WRAPPER}} .ma-el-image-hover-effect .ma-image-hover-content',
					'scheme'        => Scheme_Typography::TYPOGRAPHY_3,
				]
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'label'             => __('Box Shadow',MELA_TD),
					'name'              => 'ma_el_main_image_desc_box_shadow',
					'selector'          => '{{WRAPPER}} .ma-el-image-hover-effect .ma-image-hover-content',
				]
			);

			$this->end_controls_section();



			/*
			 * Social Icons Style
			 */

			$this->start_controls_section('ma_el_main_image_icon_hover_style_section',
				[
					'label' 		=> __( 'Social Icons', MELA_TD ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
					'condition'     => [
						'ma_el_main_image_effect' => ['zoe','hera']
					]
				]
			);

			$this->start_controls_tabs( 'ma_el_main_image_icon_style_tabs' );

			$this->start_controls_tab( 'ma_el_main_image_icon_style_tab_normal',
				[ 'label' => esc_html__( 'Normal', MELA_TD )
				] );

			$this->add_control('ma_el_main_image_icon_color',
				[
					'label' => __( 'Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_2
					],
//					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .ma-el-image-hover-effect .icon-links a' => 'color: {{VALUE}};'
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'ma_el_main_image_icon_style_tab_hover',
                [ 'label' => esc_html__( 'Hover', MELA_TD )
			] );

			$this->add_control('ma_el_main_image_icon_hover_color',
				[
					'label' => __( 'Color', MELA_TD ),
					'type' => Controls_Manager::COLOR,
					'scheme' => [
						'type' => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3
					],
//					'default'   => '#fff',
					'selectors' => [
						'{{WRAPPER}} .ma-el-image-hover-effect .icon-links a:hover' => 'color: {{VALUE}};'
					],
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

			$settings = $this->get_settings_for_display();

//			$ma_el_id		= $this->get_id();


			$this->add_render_attribute( 'ma_el_image_hover_effect_wrapper', [
				'class'	=> [
					'ma-el-image-hover-effect',
					esc_attr($settings['ma_el_main_image_effect'] )
				],
				'id' => 'ma-el-image-hover-effect-' . $this->get_id()
			]);


			$ma_el_main_image = $this->get_settings_for_display( 'ma_el_main_image' );

			$ma_el_main_image_url_src = wp_get_attachment_image_src( $ma_el_main_image['id'], $settings['thumbnail_size'], $settings );

			if( empty( $ma_el_main_image_url_src ) ) {
				$ma_el_main_image_url = $ma_el_main_image['url'];
			} else {
				$ma_el_main_image_url = $ma_el_main_image_url_src[0];
			}

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
			$ma_el_main_image_effect = $settings['ma_el_main_image_effect'];
			$ma_el_main_image_alt = esc_attr( Control_Media::get_image_alt( $settings['ma_el_main_image'] ) );

			?>

				<div <?php echo $this->get_render_attribute_string( 'ma_el_image_hover_effect_wrapper' ); ?>>

					<figure class="effect-<?php echo esc_attr( $settings['ma_el_main_image_effect'] );?>">

                        <img src="<?php echo esc_url($ma_el_main_image_url); ?>" alt="<?php echo $ma_el_main_image_alt; ?>">

                        <figcaption>
							<div class="ma-image-hover-content">
								<<?php echo $settings['title_html_tag'];?> class="ma-el-image-hover-title"><?php echo
								$this->parse_text_editor($settings['ma_el_main_image_title']);
								?></<?php echo $settings['title_html_tag'];?>>


                                <?php
	                                // Social Icons Sets
	                                $ma_el_main_image_socials_array = array( "hera","zoe","winston");
	                                if (in_array($ma_el_main_image_effect, $ma_el_main_image_socials_array)) { ?>
                                    <p class="icon-links">
                                        <?php foreach( $settings['ma_el_main_image_icon_tabs'] as $index => $tab ) { ?>
                                            <a href="<?php echo esc_url_raw( $tab['ma_el_main_image_icon_link']['url'] );?>">
                                                <span class="<?php echo $tab['ma_el_main_image_icon']; ?>"></span>
                                            </a>
                                        <?php } ?>
                                    </p>
                                <?php } ?>

	                        <?php
		                        // Design Specific Descriptions for Set 1
                                if( $settings['ma_el_main_image_effect'] == "julia" ){?>
		                        <?php foreach( $settings['ma_el_main_image_desc_set2_tabs'] as $index => $tab ) { ?>
                                    <p class="ma-el-image-hover-desc"><?php echo $tab['ma_el_main_image_desc_set2']; ?></p>
		                        <?php }
	                            }

	                            // Design Specific Descriptions for Set 1
                                $ma_el_main_image_effect_array=array( "honey","zoe","goliath","selena" );
                                if (in_array($ma_el_main_image_effect,$ma_el_main_image_effect_array)) { ?>
                                    <p class="ma-el-image-hover-desc">
                                        <?php echo htmlspecialchars_decode( $settings['ma_el_main_image_desc'] ); ?>
                                    </p>
                                <?php } ?>


							</div>


                            <a class="ma-image-hover-read-more"
                               href="<?php echo esc_url( $settings['ma_el_main_image_more_text_url'] );?>">
								<?php echo $settings['ma_el_main_image_more_text'];?>
							</a>

						</figcaption>

					</figure>

				</div>
		<?php
		}

		protected function _content_template() {}

	}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Image_Hover_Effects() );