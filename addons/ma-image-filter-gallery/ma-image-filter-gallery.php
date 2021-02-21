<?php

namespace MasterAddons\Addons;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 10/22/19
 */

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Scheme_Color;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;


// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}


/**
 * Master Addons: MA Image Gallery
 */
class Filterable_Image_Gallery extends Widget_Base
{

	public function get_name()
	{
		return 'ma-image-filter-gallery';
	}

	public function get_title()
	{
		return __('Filterable Gallery', MELA_TD);
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_icon()
	{
		return 'ma-el-icon eicon-gallery-masonry';
	}


	public function get_style_depends()
	{
		return [
			'fancybox',
			'font-awesome-5-all',
			'font-awesome-4-shim',
			'master-addons-main-style'
		];
	}

	public function get_script_depends()
	{
		return [
			'imagesloaded',
			'fancybox',
			'isotope',
			'master-addons-scripts'
		];
	}

	public function get_keywords()
	{
		return ['image', 'image gallery', 'filter image', 'Image Filter Gallery'];
	}


	public function get_help_url()
	{
		return 'https://master-addons.com/demos/image-gallery/';
	}


	protected function _register_controls()
	{

		/*
		 * MA Image Filter Gallery
		 */
		$this->start_controls_section(
			'ma_el_image_gallery_image_section',
			[
				'label' => __('Gallery', MELA_TD),
			]
		);

		$this->add_control(
			'ma_el_image_gallery_items',
			[
				'label'       => __('Gallery Contents', MELA_TD),
				'show_label'  => false,
				'type'        => Controls_Manager::REPEATER,
				'seperator'         => 'before',
				'default'     => [

					[
						'title'                                 => __('Example Title One', MELA_TD),
						'subtitle'                              => __('Example Sub Title One', MELA_TD),
						'gallery_category_name'                 => __('Technology', MELA_TD),
						'ma_el_image_gallery_ribbon'            => __('', MELA_TD),
						'ma_el_image_gallery_button_one_text'   => __('Details', MELA_TD),
						'ma_el_image_gallery_link_one_url'      => "#",
						'ma_el_image_gallery_button_two_text'   => __('Demo', MELA_TD),
						'ma_el_image_gallery_link_two_url'      => "#"
					],
					[
						'title'                                 => __('Example Title Two', MELA_TD),
						'subtitle'                              => __('Example Sub Title Two', MELA_TD),
						'gallery_category_name'                 => __('Living', MELA_TD),
						'ma_el_image_gallery_ribbon'            => __('', MELA_TD),
						'ma_el_image_gallery_button_one_text'   => __('Details', MELA_TD),
						'ma_el_image_gallery_link_one_url'      => "#",
						'ma_el_image_gallery_button_two_text'   => __('Demo', MELA_TD),
						'ma_el_image_gallery_link_two_url'      => "#"
					],
					[
						'title'                                 => __('Example Title Three', MELA_TD),
						'subtitle'                              => __('Example Sub Title Three', MELA_TD),
						'gallery_category_name'                 => __('Workplace', MELA_TD),
						'ma_el_image_gallery_ribbon'            => __('', MELA_TD),
						'ma_el_image_gallery_button_one_text'   => __('Details', MELA_TD),
						'ma_el_image_gallery_link_one_url'      => "#",
						'ma_el_image_gallery_button_two_text'   => __('Demo', MELA_TD),
						'ma_el_image_gallery_link_two_url'      => "#"
					]
				],
				'fields'          => [
					[
						'name'          => 'gallery_category_name',
						'type'          => Controls_Manager::TEXT,
						'label'         => __('Filter Name', MELA_TD),
						'label_block'   => false,
						'dynamic' => [
							'active' => true,
						]
					],
					[
						'name'    => 'ma_el_image_gallery_img',
						'label'   => __('Image', MELA_TD),
						'type'    => Controls_Manager::GALLERY,
						'dynamic' => [
							'active' => true,
						],
						'show_label' => false,
						'render'    =>  'template',
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'type'          => Controls_Manager::TEXT,
						'name'          => 'title',
						'label_block'   => true,
						'label'         => __('Title', MELA_TD),
						'default'       => __('Item Title', MELA_TD)
					],
					[
						'type'          => Controls_Manager::TEXT,
						'name'          => 'subtitle',
						'label'         => __('Subtitle', MELA_TD),
						'label_block'   => true,
						'default'       => __('item sub-title', MELA_TD)
					],
					[
						'name'          => 'ma_el_image_gallery_show_ribbon',
						'label'        => __('Show Ribbon?', MELA_TD),
						'type'         => Controls_Manager::SWITCHER,
						'default'      => 'no',
						'return_value' => 'yes'
					],

					[
						'name'          => 'ma_el_image_gallery_ribbon',
						'label'         => __('Ribbon', MELA_TD),
						'type'          => Controls_Manager::SELECT,
						'options'   => [
							'new'           => __('New', MELA_TD),
							'popular'       => __('Popular', MELA_TD),
							'free'          => __('Free', MELA_TD),
							'pro'           => __('Pro', MELA_TD),
							'sale'          => __('Sale', MELA_TD),
							'discount'      => __('Discount', MELA_TD),
							'added'         => __('Added', MELA_TD),
							'updated'       => __('Updated', MELA_TD),
							'changed'       => __('Changed', MELA_TD),
							'fixed'         => __('Fixed', MELA_TD),
							'removed'       => __('Removed', MELA_TD),
							'note'          => __('Note', MELA_TD),
						],
						'default'   => 'new',
						'condition'     => [
							'ma_el_image_gallery_show_ribbon' => 'yes'
						]
					],

					[
						'type'          => Controls_Manager::TEXT,
						'name'          => 'ma_el_image_gallery_discount',
						'label'         => __('Discount', MELA_TD),
						'default'       => __('30% Off', MELA_TD),
						'condition'     => [
							'ma_el_image_gallery_ribbon' => ['discount', 'sale']
						]
					],

					[
						'name'          => 'ma_el_image_gallery_buttons',
						'label'        => __('Popup or Links ?', MELA_TD),
						'type'         => Controls_Manager::CHOOSE,
						'options' => [
							'popup' => [
								'title' => __('Popup', MELA_TD),
								'icon' => 'eicon-search',
							],
							'links' => [
								'title' => __('External Links', MELA_TD),
								'icon' => 'eicon-editor-external-link',
							],
						],
						'default' => 'popup',
						'frontend_available' 	=> true,
					],


					[
						'name'          => 'ma_el_image_gallery_button_one_text',
						'label'        => __('Button One Text', MELA_TD),
						'type'         => Controls_Manager::TEXT,
						'default'     => __('Details', MELA_TD),
						'placeholder' => __('Details', MELA_TD),
						'title'       => __('Enter Button text here', MELA_TD),
						'condition'     => [
							'ma_el_image_gallery_buttons' => 'links'
						]
					],

					[
						'name'          => 'ma_el_image_gallery_link_one_url',
						'label'        => __('Button One URL', MELA_TD),
						'type'         => Controls_Manager::URL,
						'label_block'   => false,
						'default'     => [
							'url' => '#',
							'is_external' => true,
							'nofollow' => true,
						],
						'show_external' => true,
						'condition'     => [
							'ma_el_image_gallery_buttons' => 'links'
						]
					],

					[
						'name'          => 'ma_el_image_gallery_button_two_text',
						'label'        => __('Button Two Text', MELA_TD),
						'type'         => Controls_Manager::TEXT,
						'default'     => __('Demo', MELA_TD),
						'placeholder' => __('Demo', MELA_TD),
						'title'       => __('Enter Button text here', MELA_TD),
						'condition'     => [
							'ma_el_image_gallery_buttons' => 'links'
						]
					],

					[
						'name'          => 'ma_el_image_gallery_link_two_url',
						'label'        => __('Button Two URL', MELA_TD),
						'label_block'   => false,
						'type'         => Controls_Manager::URL,
						'default'     => [
							'url' => '#',
							'is_external' => true,
							'nofollow' => true,
						],
						'show_external' => true,
						'condition'     => [
							'ma_el_image_gallery_buttons' => 'links'
						]
					],





				],
				'title_field' => '{{title}}'
			]
		);


		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'ma_el_image_gallery_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `ma_el_image_gallery_thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' 		=> ['custom'],
				'default' 		=> 'full',
				'separator' 	=> 'none',
			]
		);


		$this->end_controls_section();


		// Tab: Settings
		$this->start_controls_section(
			'ma_el_image_gallery_filter_settings_section',
			[
				'label'         => __('Settings', MELA_TD)
			]
		);

		$this->add_control(
			'ma_el_image_gallery_filter_nav',
			[
				'label'        		=> __('Show Filter Nav?', MELA_TD),
				'type'         		=> Controls_Manager::SWITCHER,
				'default' 			=> 'yes',
				'return_value' 		=> 'yes'
			]
		);

		$this->add_control(
			'ma_el_image_gallery_tooltip',
			[
				'label'        		=> esc_html__('Show Tooltip?', MELA_TD),
				'type'         		=> Controls_Manager::SWITCHER,
				'default'      		=> 'no',
				'return_value' 		=> 'yes',
				'condition' => [
					'ma_el_image_gallery_filter_nav' => 'yes',
				]
			]
		);


		$this->add_control(
			'ma_el_image_gallery_show_all',
			[
				'label' 			=> __('Show "All" Filter Tab', MELA_TD),
				'type' 				=> Controls_Manager::SWITCHER,
				'label_on' 			=> __('Show', MELA_TD),
				'label_off' 		=> __('Hide', MELA_TD),
				'return_value' 		=> 'yes',
				'default' 			=> 'yes',
				'render_type' 		=> 'template',
				'prefix_class' 		=> 'ma-el-show-all-',
				'condition' => [
					'ma_el_image_gallery_filter_nav' => 'yes',
				]
			]
		);

		$this->add_control(
			'ma_el_image_gallery_all_cat_text',
			[
				'label'             => __('All Categories Text', MELA_TD),
				'type'              => Controls_Manager::TEXT,
				'placeholder'       => __('All', MELA_TD),
				'default'           => __('All', MELA_TD),
				'condition' => [
					'ma_el_image_gallery_filter_nav' 	=> 'yes',
					'ma_el_image_gallery_show_all' 		=> 'yes',
				]
			]
		);

		$this->add_control(
			'ma_el_image_gallery_column_number',
			[
				'label'     => __('Number of Columns', MELA_TD),
				'type'      => Controls_Manager::SELECT,
				'default'   => 3,
				'options'   => [
					1       => __('1 Column', MELA_TD),
					2       => __('2 Columns',   MELA_TD),
					3       => __('3 Columns', MELA_TD),
					4       => __('4 Columns',  MELA_TD),
					6       => __('6 Columns',  MELA_TD)
				]
			]
		);

		// Image Size
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'          => 'ma_el_image_gallery_image',
				'default'       => 'medium_large',
				'seperator'         => 'after'
			]
		);

		$this->add_control(
			'ma_el_image_gallery_title',
			[
				'label'        => __('Show Title?', MELA_TD),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes'
			]
		);

		$this->add_control(
			'ma_el_image_gallery_subtitle',
			[
				'label'        => __('Show Subtitle?', MELA_TD),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes'
			]
		);

		$this->add_control(
			'ma_el_image_gallery_category',
			[
				'label'        => __('Show Category?', MELA_TD),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes'
			]
		);

		$this->add_control(
			'ma_el_image_gallery_hover_icon',
			[
				'label'        => esc_html__('Hover Icon?', MELA_TD),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

		$this->add_control(
			'ma_el_image_gallery_popup_icon',
			[
				'label'         	=> esc_html__('Hover Icon', MELA_TD),
				'description' 		=> __('Please choose an icon from the list.', MELA_TD),
				'type'          	=> Controls_Manager::ICONS,
				'fa4compatibility' 	=> 'icon',
				'default'       	=> [
					'value'     => 'fas fa-link',
					'library'   => 'solid',
				],
				'render_type'      => 'template',
				'condition' => [
					'ma_el_image_gallery_hover_icon' 	=> 'yes',
				],
			]
		);

		$this->end_controls_section();



		/*
		 Settings: Overlay Settings
		 */
		$this->start_controls_section(
			'ma_el_image_gallery_overlay_section',
			[
				'label' => __('Overlay Setting', MELA_TD),
			]
		);

		$this->add_control(
			'ma_el_image_gallery_show_overlay',
			[
				'label' => __('Overlay Type', MELA_TD),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'hover' => __('On Hover', MELA_TD),
					'always' => __('Always', MELA_TD),
					'never' => __('Never', MELA_TD),
					'hide-on-hover' => __('Hide on Hover', MELA_TD)
				],
				'default' => 'hover',
				'render_type' => 'template',
				'prefix_class' => 'ma-el-overlay-',
			]
		);

		$this->add_control(
			'ma_el_image_gallery_caption',
			[
				'label' => __('Caption', MELA_TD),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __('Yes', MELA_TD),
				'label_off' => __('No', MELA_TD),
				'return_value' => 'yes',
				'condition' =>
				[
					'ma_el_image_gallery_show_overlay!' => 'never',
				]
			]


		);


		$this->add_control(
			'ma_el_image_gallery_icon_style',
			[
				'label' => __('Icon', MELA_TD),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' =>
				[
					'ma_el_image_gallery_show_overlay!' => 'never',
				]

			]
		);

		$this->add_control(
			'ma_el_image_gallery_icon',
			[
				'label' => __('Icon', MELA_TD),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' =>
				[
					'ma_el_image_gallery_show_overlay!' => 'never',
				]
			]
		);

		$this->add_control(
			'ma_el_image_gallery_view',
			[
				'label' => __('View', MELA_TD),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __('Default', MELA_TD),
					'stacked' => __('Stacked', MELA_TD),
					'framed' => __('Framed', MELA_TD),

				],
				'default' => 'framed',
				'prefix_class' => 'ma-el-icon-view-',
				'condition' => [
					'icon!' => '',
					'ma_el_image_gallery_show_overlay!' => 'never',
				],
			]
		);

		$this->add_control(
			'ma_el_image_gallery_hover_direction_aware',
			[
				'label' => __('Hover Direction Aware', MELA_TD),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', MELA_TD),
				'label_off' => __('No', MELA_TD),
				'return_value' => 'yes',
				'default' => 'label_off',
				'condition' => [
					'ma_el_image_gallery_show_overlay' => 'hover',
				]
			]
		);

		$this->add_control(
			'ma_el_image_gallery_overlay_speed',
			[
				'label' => __('Overlay Speed', MELA_TD),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '500',
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
						'step' => 100,
					],
				],
				'condition' => [
					'ma_el_image_gallery_show_overlay' => 'hover',
					'ma_el_image_gallery_hover_direction_aware' => 'yes',
				]
			]
		);


		$this->end_controls_section();

		/*
		 Tab: Control Style
		 */
		$this->start_controls_section(
			'ma_el_image_gallery_filter_section_style',
			[
				'label'         => __('Filter Style', MELA_TD),
				'tab'           => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'ma_el_image_gallery_filter_nav' => 'yes'
				],

			]
		);


		$this->add_control(
			'ma_el_image_gallery_filter_align',
			[
				'label'         => __('Alignment', MELA_TD),
				'type'          => Controls_Manager::CHOOSE,
				'default'       => '',
				'options'       => [
					'left'  => [
						'title' => __('Left', MELA_TD),
						'icon'  => 'fa fa-align-left',
					],
					'center'    => [
						'title' => __('Center', MELA_TD),
						'icon'  => 'fa fa-align-center',
					],
					'right'     => [
						'title' => __('Right', MELA_TD),
						'icon'  => 'fa fa-align-right',
					]
				],
				'default'      => 'center',
				'selectors' => [
					'{{WRAPPER}} .ma-el-image-filter-nav' => 'text-align: {{VALUE}};',
				]
			]
		);




		$this->add_control(
			'ma_el_image_gallery_filter_active_border_bottom_enabled',
			[
				'label'        => __('Border Bottom?', MELA_TD),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

		$this->add_responsive_control(
			'ma_el_image_gallery_filter_padding',
			[
				'label'         => __('Padding', MELA_TD),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'ma_el_image_gallery_filter_margin',
			[
				'label'         => __('Margin', MELA_TD),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'ma_el_image_gallery_filter_typography',
				'selector'      => '{{WRAPPER}} .ma-el-image-filter-nav ul li',
			]
		);


		$this->start_controls_tabs('ma_el_image_gallery_filter_tabs');
		$this->start_controls_tab('ma_el_image_gallery_filter_btn_normal', ['label' => __('Normal', MELA_TD)]);

		$this->add_control(
			'ma_el_image_gallery_filter_normal_text_color',
			[
				'label'     => __('Text Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_image_gallery_filter_normal_bg_color',
			[
				'label'     => __('Background Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'ma_el_image_gallery_filter_normal_border',
				'label'     => __('Border', MELA_TD),
				'selector'  => '{{WRAPPER}} .ma-el-image-filter-nav ul li',
			]
		);

		$this->add_control(
			'ma_el_image_gallery_normal_border_radius',
			[
				'label'     => __('Border Radius', MELA_TD),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px'    => [
						'max'   => 30
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ma-el-image-filter-nav ul li' => 'border-radius: {{SIZE}}px;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'ma_el_image_gallery_filter_shadow',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .ma-el-image-filter-nav ul li',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('ma_el_image_gallery_filter_btn_active', ['label' => __('Active', MELA_TD)]);

		$this->add_control(
			'ma_el_image_gallery_filter_active_text_color',
			[
				'label'         => __('Text Color', MELA_TD),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#fff',
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-nav ul li.active' => 'color: {{VALUE}};'
				]
			]
		);

		// image gallery control(active) background color
		$this->add_control(
			'ma_el_image_gallery_filter_active_bg_color',
			[
				'label'         => __('Background Color', MELA_TD),
				'type'          => Controls_Manager::COLOR,
				'default'       => '#4b00e7',
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-nav ul li.active' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'ma_el_image_gallery_filter_active_border',
				'label'         => __('Border', MELA_TD),
				'selector'      => '{{WRAPPER}} .ma-el-image-filter-nav ul li.active'
			]
		);


		$this->add_control(
			'ma_el_image_gallery_filter_active_border_radius',
			[
				'label'         => __('Border Radius', MELA_TD),
				'type'          => Controls_Manager::SLIDER,
				'range'         => [
					'px'        => [
						'max'   => 30
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-nav ul li.active' => 'border-radius: {{SIZE}}px;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'          => 'ma_el_image_gallery_filter_active_shadow',
				'separator'     => 'before',
				'selector'      => '{{WRAPPER}} .ma-el-image-filter-nav ul li.active',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		// Item Style
		$this->start_controls_section(
			'ma_el_image_gallery_item_section_style',
			[
				'label'         => __('Item Style', MELA_TD),
				'tab'           => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_responsive_control(
			'ma_el_image_gallery_item_container_padding',
			[
				'label'         => __('Padding', MELA_TD),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'ma_el_image_gallery_item_container_margin',
			[
				'label'         => __('Margin', MELA_TD),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'ma_el_image_gallery_item_border',
				'label'         => __('Border', MELA_TD),
				'selector'      => '{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item'
			]
		);


		$this->add_control(
			'ma_el_image_gallery_item_border_radius',
			[
				'label'         => __('Border Radius', MELA_TD),
				'type'          => Controls_Manager::SLIDER,
				'default'       => [
					'size'      => 0
				],
				'range'         => [
					'px'        => [
						'max'   => 500
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item' => 'border-radius: {{SIZE}}px;'
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'ma_el_image_gallery_image_typography_style',
			[
				'label'         => __('Image Style', MELA_TD),
				'tab'           => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'ma_el_image_gallery_image_style',
			[
				'label'         => __('Image Style', MELA_TD),
				'type'          => Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'ma_el_image_gallery_image_hover_overlay_color',
			[
				'label'         => __('Hover Overlay Color', MELA_TD),
				'type'          => Controls_Manager::COLOR,
				'default'       => 'rgba(0, 0, 0, 0.5)',
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-item .ma-image-hover-content' => 'background-color: {{VALUE}}'
				]

			]
		);

		// Title
		$this->add_control(
			'ma_el_image_gallery_image_title_style',
			[
				'label'         => __('Title Style', MELA_TD),
				'type'          => Controls_Manager::HEADING,
				'separator'     =>  'before'
			]
		);

		$this->add_control(
			'ma_el_image_gallery_image_caption_title_color',
			[
				'type'          => Controls_Manager::COLOR,
				'label'         => __('Color', MELA_TD),
				'scheme'        => [
					'type'      => Scheme_Color::get_type(),
					'value'     => Scheme_Color::COLOR_1
				],
				'default'       => '#333',
				'selectors'     => [
					'{{WRAPPER}} h3.ma-el-image-hover-title' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_image_gallery_image_title_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} h3.ma-el-image-hover-title',
			]
		);


		$this->add_control(
			'ma_el_image_gallery_image_sub_title_style',
			[
				'label'         => __('Caption Subtitle Style', MELA_TD),
				'type'          => Controls_Manager::HEADING,
				'separator'     =>  'before'
			]
		);

		$this->add_control(
			'ma_el_image_gallery_image_caption_subtitle_color',
			[
				'type'          => Controls_Manager::COLOR,
				'label'         => __('Color', MELA_TD),
				'scheme'        => [
					'type'      => Scheme_Color::get_type(),
					'value'     => Scheme_Color::COLOR_1,
				],
				'default'       => '#333',
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-hover-desc' => 'color: {{VALUE}};'
				]
			]
		);



		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'ma_el_image_gallery_image_caption_subtitle_typography',
				'selector'      => '{{WRAPPER}} .ma-el-image-hover-desc'
			]
		);


		$this->add_control(
			'ma_el_image_gallery_image_hover_icon_style',
			[
				'label'         => __('Icon Style', MELA_TD),
				'type'          => Controls_Manager::HEADING,
				'separator'     =>  'before'
			]
		);


		$this->add_control(
			'ma_el_image_gallery_popup_icon_size',
			[
				'label'     => __('Icon Size', MELA_TD),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px'    => [
						'max'   => 200
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item i' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .ma-el-image-filter-item .ma-el-fancybox svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;'
				]
			]
		);


		$this->add_control(
			'ma_el_image_gallery_image_hover_icon_color',
			[
				'type'          => Controls_Manager::COLOR,
				'label'         => __('Color', MELA_TD),
				'scheme'        => [
					'type'      => Scheme_Color::get_type(),
					'value'     => Scheme_Color::COLOR_1
				],
				'default'       => '#ffffff',
				'selectors'     => [
					'{{WRAPPER}} .ma-el-image-filter-gallery .ma-el-image-filter-item i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ma-el-image-filter-item .ma-el-fancybox svg' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();




		/* Demo & Download Button Styles */
		$this->start_controls_section(
			'ma_el_image_filter_button_settings',
			[
				'label' => esc_html__('Button One & Two Style', MELA_TD),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'ma_el_filter_image_button_one_style',
			[
				'label'         => __('Button One Style', MELA_TD),
				'type'          => Controls_Manager::HEADING,
				'description' => esc_html__('Only works while Individual Popup set to Links', MELA_TD)
			]
		);

		$this->start_controls_tabs('ma_el_image_filter_buttons_tabs');

		$this->start_controls_tab('normal', ['label' => esc_html__('Normal', MELA_TD)]);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_image_filter_button_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button',
			]
		);

		$this->add_responsive_control(
			'ma_el_image_filter_buttons_padding',
			[
				'label'      => esc_html__('Button Padding', MELA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button'	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);


		$this->add_control(
			'ma_el_image_filter_buttons_text_color',
			[
				'label'     => esc_html__('Text Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button'    => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'ma_el_image_filter_buttons_background_color',
			[
				'label'     => esc_html__('Background Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button'	=> 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ma_el_image_filter_buttons_border',
				'selector' => '{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button',
			]
		);

		$this->add_control(
			'ma_el_image_filter_buttons_border_radius',
			[
				'label' => esc_html__('Border Radius', MELA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button'         => 'border-radius: {{SIZE}}px;'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_one_box_shadow',
				'selector' => '{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('ma_el_image_filter_buttons_hover', [
			'label' => esc_html__('Hover', MELA_TD)
		]);

		$this->add_control(
			'ma_el_image_filter_buttons_hover_text_color',
			[
				'label'     => esc_html__('Text Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:hover'	=> 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'ma_el_image_filter_buttons_hover_background_color',
			[
				'label'     => esc_html__('Background Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f54',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'ma_el_image_filter_buttons_hover_border_color',
			[
				'label'     => esc_html__('Border Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:hover'	=> 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_one_box_shadow_hover',
				'selector' => '{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();





		$this->add_control(
			'ma_el_filter_image_button_two_style',
			[
				'label'         => __('Button Two Style', MELA_TD),
				'type'          => Controls_Manager::HEADING
			]
		);

		$this->start_controls_tabs('ma_el_image_filter_button_two_tabs');

		$this->start_controls_tab('button_two_normal', ['label' => esc_html__('Normal', MELA_TD)]);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_image_filter_button_two_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd)',
			]
		);

		$this->add_responsive_control(
			'ma_el_image_filter_buttons_two_padding',
			[
				'label'      => esc_html__('Button Padding', MELA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd)'	=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);


		$this->add_control(
			'ma_el_image_filter_button_two_text_color',
			[
				'label'     => esc_html__('Text Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd)'    => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'ma_el_image_filter_button_two_background_color',
			[
				'label'     => esc_html__('Background Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd)'	=> 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ma_el_image_filter_button_two_border',
				'selector' => '{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd)',
			]
		);

		$this->add_control(
			'ma_el_image_filter_button_two_border_radius',
			[
				'label' => esc_html__('Border Radius', MELA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd)'         => 'border-radius: {{SIZE}}px;'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_two_box_shadow',
				'selector' => '{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd)',
			]
		);

		$this->end_controls_tab();




		$this->start_controls_tab('ma_el_image_filter_button_two_hover', [
			'label' => esc_html__('Hover', MELA_TD)
		]);

		$this->add_control(
			'ma_el_image_filter_button_two_hover_text_color',
			[
				'label'     => esc_html__('Text Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd):hover'	=> 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'ma_el_image_filter_buttons_two_hover_background_color',
			[
				'label'     => esc_html__('Background Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f54',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd):hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'ma_el_image_filter_buttons_two_hover_border_color',
			[
				'label'     => esc_html__('Border Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd):hover'	=> 'border-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_two_box_shadow_hover',
				'selector' => '{{WRAPPER}} .ma-image-hover-content .ma-el-creative-button:nth-last-child(odd):hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();




		/**
		 * Content Tab: Docs Links
		 */
		$this->start_controls_section(
			'jltma_section_help_docs',
			[
				'label' => esc_html__('Help Docs', MELA_TD),
			]
		);


		$this->add_control(
			'help_doc_1',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', MELA_TD), '<a href="https://master-addons.com/demos/image-gallery/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', MELA_TD), '<a href="https://master-addons.com/docs/addons/filterable-image-gallery/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', MELA_TD), '<a href="https://www.youtube.com/watch?v=h7egsnX4Ewc" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();




		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'maad_el_section_pro',
				[
					'label' => esc_html__('Upgrade to Pro Version for More Features', MELA_TD)
				]
			);

			$this->add_control(
				'maad_el_control_get_pro',
				[
					'label' => esc_html__('Unlock more possibilities', MELA_TD),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', MELA_TD),
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


	private function render_image($image_id, $settings)
	{
		$ma_el_image_gallery_image = $settings['ma_el_image_gallery_image_size'];
		if ('custom' === $ma_el_image_gallery_image) {
			$image_src = Group_Control_Image_Size::get_attachment_image_src($image_id, 'ma_el_image_gallery_image', $settings);
		} else {
			$image_src = wp_get_attachment_image_src($image_id, $ma_el_image_gallery_image);
			$image_src = $image_src[0];
		}

		return sprintf('<img src="%s" alt="%s" />', esc_url($image_src), esc_html(get_post_meta($image_id, '_wp_attachment_image_alt', true)));
	}


	public function get_placeholder_images()
	{
		$demo_images =
			[
				'id'    =>  0,
				'url'   =>  Utils::get_placeholder_image_src(),
			];
		return $demo_images;
	}


	protected function render()
	{

		$settings       = $this->get_settings_for_display();

		if (!\Elementor\Plugin::$instance->editor->is_edit_mode()) {
			$this->add_render_attribute(
				'ma_el_image_filter_gallery',
				'class',
				[
					'ma-el-image-filter-gallery',
					'ma-el-image-filter-gallery-items'
				]
			);
		}


		if (function_exists('ma_el_image_filter_gallery_array_flatten')) {
			$gallery_categories = ma_el_image_filter_gallery_categories($settings['ma_el_image_gallery_items']);
		}

		echo '<div class="ma-el-image-filter-gallery-wrapper">';

		if ($settings['ma_el_image_gallery_filter_nav'] == "yes") {

			if (is_array($gallery_categories) && !empty($gallery_categories)) :
				echo '<div class="ma-el-image-filter-nav' . ($settings['ma_el_image_gallery_filter_active_border_bottom_enabled'] == 'yes' ? ' has-border-bottom' : ' no-border-bottom') . '">';

				if ($settings['ma_el_image_gallery_tooltip'] == "yes") {
					echo '<ul>';
				} else {
					echo '<ul class="ma-el-tooltip">';
				}

				if ($settings['ma_el_image_gallery_tooltip'] == "yes") {
					if ($settings['ma_el_image_gallery_show_all'] == "yes" && count($settings['ma_el_image_gallery_items']) > 1) {
						echo '<li data-filter="*" class="ma-el-tooltip-item tooltip-top active"> <div class="ma-el-tooltip-content"><span>' . esc_html(
							$settings['ma_el_image_gallery_all_cat_text']
						) . ' </span></div><div class="ma-el-tooltip-text">' . $settings['ma_el_image_gallery_all_cat_text'] . '</div></li>';
					}
				} else {
					if ($settings['ma_el_image_gallery_show_all'] == "yes" && count($settings['ma_el_image_gallery_items']) > 1) {
						echo '<li data-filter="*" class="active"> <span>' . esc_html($settings['ma_el_image_gallery_all_cat_text']) . ' </span></li>';
					}
				}


				foreach ($gallery_categories as $gallery_category) {

					if ($settings['ma_el_image_gallery_tooltip'] == "yes") {
						if ($settings['ma_el_image_gallery_show_all'] == "yes" && count($settings['ma_el_image_gallery_items']) > 1) {
							printf(
								'<li class="ma-el-tooltip-item tooltip-top" data-filter=".%s"><div class="ma-el-tooltip-content"><span>%s</span></div><div class="ma-el-tooltip-text">' . $gallery_category . '</div></li>',
								esc_attr(sanitize_title($gallery_category) . '-' . $this->get_id()),
								esc_html($gallery_category)
							);
						}
					} else {
						if ($settings['ma_el_image_gallery_show_all'] == "yes" && count($settings['ma_el_image_gallery_items']) > 1) {
							printf('<li data-filter=".%s"><span>%s</span></li>', esc_attr(sanitize_title($gallery_category) . '-' . $this->get_id()), esc_html($gallery_category));
						}
					}
				}

				echo '</ul>';
				echo '</div>';

			endif;
		}


		$ma_el_image_filter_gallery_editor = ($this->get_render_attribute_string('ma_el_image_filter_gallery')) ? $this->get_render_attribute_string('ma_el_image_filter_gallery') : "class='jltma-row'";

		if (count($settings['ma_el_image_gallery_items']) > 1) {

			$demo_images = [];

			if (empty($settings['ma_el_image_gallery_items'][0]['ma_el_image_gallery_img']) && empty($settings['ma_el_image_gallery_items'][1]['ma_el_image_gallery_img']) && empty($settings['ma_el_image_gallery_items'][0]['ma_el_image_gallery_img'])) {
				$demo_images[] = $this->get_placeholder_images();
			}

			if (is_array($settings['ma_el_image_gallery_items'])) :
				$column = 12 / $settings['ma_el_image_gallery_column_number'];

				echo '<div ' . $ma_el_image_filter_gallery_editor . '>';

				foreach ($settings['ma_el_image_gallery_items'] as $index => $item) :

					$has_icon = false;
					$images = $item['ma_el_image_gallery_img'];
					if (empty($images)) {
						$images = $demo_images;
					}

					$slide_key 			= $this->get_repeater_setting_key('slide', 'ma_el_image_gallery_items', $index);
					$images_setting_key = $this->get_repeater_setting_key('ma_el_image_gallery_title', 'ma_el_image_gallery_items', $index);

					$this->add_render_attribute([
						$images_setting_key => [
							'class' => [
								'ma-el-fancybox',
								'elementor-clickable'
							],
							// 'data-elementor-open-lightbox' 			=> ($item['ma_el_image_gallery_buttons'] == "popup") ? "yes" : "no",
							// 'data-elementor-lightbox-slideshow' 	=> 'ma-el-gallery-' . $this->get_id(),
							// 'data-elementor-lightbox-index' 		=> 'link_' . $index,
							'data-caption' 							=> ($settings['ma_el_image_gallery_lightbox_caption'] == "yes") ? $item['ma_el_image_gallery_title'] : '',
							'data-fancybox' 						=> "images"
						]
					]);

					// if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
					// 	$this->add_render_attribute($images_setting_key, [
					// 		'class' => 'elementor-clickable',
					// 	]);
					// }


					// $ma_el_image_gallery_image = $settings['ma_el_image_gallery_image_size'];
					// if ('custom' === $ma_el_image_gallery_image) {
					// 	$image_src = Group_Control_Image_Size::get_attachment_image_src($image_id, 'ma_el_image_gallery_image', $settings);
					// } else {
					// 	$image_src = wp_get_attachment_image_src($image_id, $ma_el_image_gallery_image);
					// 	$image_src = $image_src[0];
					// }
					// return sprintf('<img src="%s" alt="%s" />', esc_url($image_src), esc_html(get_post_meta($image_id, '_wp_attachment_image_alt', true)));

					//echo $this->render_image($item['ma_el_image_gallery_img']['id'], $settings);



					// if ($item['ma_el_image_gallery_img']['id']) :
					if (!empty($images)) {
						foreach ($images as $image) {

							$image_url = wp_get_attachment_image_url($image['id'], $settings['ma_el_image_gallery_thumbnail_size']);
							// print_r($image);
							// echo "<br>";
							// print_r($image_url);

							// $this->add_render_attribute($images_setting_key, [
							// 	'href' 								=> $image_url,
							// 	'data-src' 							=> $image_url,
							// 	// 'class' 							=> 'elementor-clickable',
							// 	// 'data-elementor-open-lightbox' 		=> ($item['ma_el_image_gallery_buttons'] == "popup") ? "yes" : "no",
							// 	// 'data-elementor-lightbox-slideshow' => $this->get_id(),
							// 	// 'data-elementor-lightbox-index' 	=> $index
							// ]);



							echo '<div class="ma-el-image-filter-item jltma-col-lg-' . esc_attr($column) . ' jltma-col-md-6 ' . ma_el_image_filter_gallery_category_classes($item['gallery_category_name'], $this->get_id()) . '">';
							echo '<div class="ma-image-hover-thumb">';

							// echo $this->render_image($item['ma_el_image_gallery_img']['id'], $settings);
							if (!empty($image['id'])) {
								$img = wp_get_attachment_image($image['id'], $settings['ma_el_image_gallery_thumbnail_size']);
								echo $img;
							} else {
								echo "<img src=" . $image . ">";
							}

							echo '<div class="ma-image-hover-item-info">';

							if ($settings['ma_el_image_gallery_category'] == "yes") {
								echo ma_el_image_filter_gallery_categories_parts($item['gallery_category_name']);
							}

							if ($item['ma_el_image_gallery_show_ribbon'] == "yes") {

								$ma_el_image_gallery_discount = array("discount", "sale");

								if (in_array($item['ma_el_image_gallery_ribbon'], $ma_el_image_gallery_discount)) {
									echo '<div class="ma-el-label ma-el-new">' . $item['ma_el_image_gallery_discount'] . '</div>';
								} else {
									echo '<div class="ma-el-label ma-el-' . $item['ma_el_image_gallery_ribbon'] . '">' . $item['ma_el_image_gallery_ribbon'] . '</div>';
								}
							}

							echo '</div>';
							echo '<div class="ma-image-hover-content">';

							if ($item['ma_el_image_gallery_buttons'] == "popup") {
								echo '<a ' . $this->get_render_attribute_string($images_setting_key) . ' href="' . esc_url($image_url) . '">';

								// Lightbox Icon
								if ('yes' === $settings['ma_el_image_gallery_hover_icon'] && (!empty($settings['icon']) || !empty($settings['ma_el_image_gallery_popup_icon']['value']))) {

									if (!isset($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
										$settings['icon'] = 'fa-link';
									}

									$has_icon  = !empty($settings['icon']);
									if ($has_icon and 'icon' == $settings['ma_el_image_gallery_popup_icon']) {
										$this->add_render_attribute('jltma-icon', 'class', $settings['ma_el_image_gallery_popup_icon']);
										$this->add_render_attribute('jltma-icon', 'aria-hidden', 'true');
									}

									if (!$has_icon && !empty($settings['ma_el_image_gallery_popup_icon']['value'])) {
										$has_icon = true;
									}

									$migrated  = isset($settings['__fa4_migrated']['ma_el_image_gallery_popup_icon']);
									$is_new    = empty($settings['icon']) && Icons_Manager::is_migration_allowed();


									if ($is_new || $migrated) {
										Icons_Manager::render_icon($settings['ma_el_image_gallery_popup_icon'], ['aria-hidden' => 'true']);
									} else {
										echo '<i ' . $this->get_render_attribute_string('jltma-icon') . '></i>';
									}
								} else {
									echo '<?xml version="1.0" encoding="iso-8859-1"?><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M210,229.236V90H90v150h90.935L272,369.004v-52.215L210,229.236z M180,210h-60v-90h60V210z"/></g></g><g><g><path d="M0,0v512h512V0H0z M482,482H30V30h452V482z"/></g></g><g><g><path d="M330.031,272L240,142.997v52.214l62,89.135V422h120V272H330.031z M392,392h-60v-90h60V392z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';
								}



								echo '</a>';
							} elseif ($item['ma_el_image_gallery_buttons'] == "links") {

								if ($item['ma_el_image_gallery_link_one_url']['url'] != "") {
									echo '<a class="button ma-el-creative-button ma-el-creative-button--default" href="' . $item['ma_el_image_gallery_link_two_url']['url'] . '" target="_blank">' .
										esc_html($item['ma_el_image_gallery_button_one_text']) . '</a>';
								}

								if ($item['ma_el_image_gallery_link_two_url']['url'] != "") {
									echo '<a class="button ma-el-creative-button ma-el-creative-button--default" href="' . $item['ma_el_image_gallery_link_two_url']['url'] . '" target="_blank">' .
										esc_html($item['ma_el_image_gallery_button_two_text']) . '</a>';
								}
							}

							echo '</div><!--.ma-image-hover-content-->';
							echo '</div><!--.ma-image-hover-thumb-->';
							echo '<div class="ma-image-hover-content-details">';

							if ($settings['ma_el_image_gallery_title'] == "yes") {
								echo '<h3 class="ma-el-image-hover-title">' . esc_html($item['title']) . '</h3>';
							}

							if ($settings['ma_el_image_gallery_subtitle'] == "yes") {
								echo '<span class="ma-el-image-hover-desc">' . esc_html($item['subtitle']) . '</span>';
							}

							echo '</div><!--.ma-image-hover-content-details-->';

							echo '</div>';
						} // Images Loop
					} // check empty images
				endforeach;

				echo '</div>';
			endif;
		}

		echo '</div>';
	}
}
