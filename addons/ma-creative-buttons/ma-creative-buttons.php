<?php

namespace MasterAddons\Addons;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager as Controls_Manager;
use \Elementor\Group_Control_Border as Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography as Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL : https: //jeweltheme.com
 * Date       : 6/25/19
 */

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.

class Creative_Button extends Widget_Base
{

	public function get_name()
	{
		return 'ma-creative-buttons';
	}

	public function get_title()
	{
		return esc_html__('Creative Buttons', MELA_TD);
	}

	public function get_icon()
	{
		return 'ma-el-icon eicon-button';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_style_depends()
	{
		return [
			'ma-creative-buttons',
			'font-awesome-5-all',
			'font-awesome-4-shim'
		];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/creative-button/';
	}


	protected function _register_controls()
	{


		$this->start_controls_section(
			'ma_el_creative_button_content_style_presets',
			[
				'label' => esc_html__('Style Presets', MELA_TD)
			]
		);



		// Premium Version Codes
		if (ma_el_fs()->can_use_premium_code()) {

			$this->add_control(
				'creative_button_effect',
				[
					'label'   => esc_html__('Button Effects', MELA_TD),
					'type'    => Controls_Manager::SELECT,
					'default' => 'jltma-creative-button--default',
					'options' => [
						'jltma-creative-button--default' => esc_html__('Default', 	    MELA_TD),
						'jltma-creative-button--winona'  => esc_html__('Winona', 	    MELA_TD),
						'jltma-creative-button--ujarak'  => esc_html__('Ujarak', 	    MELA_TD),
						'jltma-creative-button--wayra'   => esc_html__('Wayra', 	    MELA_TD),
						'jltma-creative-button--tamaya'  => esc_html__('Tamaya', 	    MELA_TD),
						'jltma-creative-button--rayen'   => esc_html__('Rayen', 	    MELA_TD),
						//'jltma-creative-button--puck' 		=> esc_html__( 'Puck', 	        MELA_TD ),
						//'jltma-creative-button--titania' 	=> esc_html__( 'Titania', 	    MELA_TD ),
						//'jltma-creative-button--bagot' 	    => esc_html__( 'Bagot', 	    MELA_TD ),
						//'jltma-creative-button--shylock'    => esc_html__( 'Shylock', 	    MELA_TD ),
						//'jltma-creative-button--cordelia'   => esc_html__( 'Cordelia', 	    MELA_TD ),
						//'jltma-creative-button--horatio'    => esc_html__( 'Horatio.', 	    MELA_TD ),
						//'jltma-creative-button--luce'       => esc_html__( 'Luce', 	        MELA_TD ),
						//'jltma-creative-button--juliet'     => esc_html__( 'Juliet', 	    MELA_TD ),
						//'jltma-creative-button--invulner'   => esc_html__( 'Invulner', 	    MELA_TD ),
						//'jltma-creative-button--tantalid'   => esc_html__( 'Tantalid', 	    MELA_TD ),
						//'jltma-creative-button--wave' 		=> esc_html__( 'Wave', 	        MELA_TD ),
						'jltma-creative-button--pipaluk' => esc_html__('Pipaluk',       MELA_TD),
						'jltma-creative-button--moema'   => esc_html__('Moema', 	    MELA_TD),
						'jltma-creative-button--isi'     => esc_html__('Isi', 	        MELA_TD),
						'jltma-creative-button--aylen'   => esc_html__('Aylen', 	    MELA_TD),
						'jltma-creative-button--saqui'   => esc_html__('Saqui', 	    MELA_TD),
						'jltma-creative-button--wapasha' => esc_html__('Wapasha',       MELA_TD),
						'jltma-creative-button--nina'    => esc_html__('Nina', 	        MELA_TD),
						'jltma-creative-button--nanuk'   => esc_html__('Nanuk', 	    MELA_TD),
						'jltma-creative-button--nuka'    => esc_html__('Nuka', 	        MELA_TD),
						'jltma-creative-button--antiman' => esc_html__('Antiman',       MELA_TD),
						'jltma-creative-button--itzel'   => esc_html__('Itzel',         MELA_TD),
						'jltma-creative-button--naira'   => esc_html__('Naira',         MELA_TD),
						'jltma-creative-button--quidel'  => esc_html__('Quidel', 	    MELA_TD),
						'jltma-creative-button--sacnite' => esc_html__('Sacnite', 	    MELA_TD),
						'jltma-creative-button--shikoba' => esc_html__('Shikoba',       MELA_TD),
					],

				]
			);


			//Free Version Codes

		} else {

			$this->add_control(
				'creative_button_effect',
				[
					'label'   => esc_html__('Set Button Effect', MELA_TD),
					'type'    => Controls_Manager::SELECT,
					'default' => 'jltma-creative-button--default',
					'options' => [
						'jltma-creative-button--default' => esc_html__('Default', 	    MELA_TD),
						'jltma-creative-button--winona'  => esc_html__('Winona', 	    MELA_TD),
						'jltma-creative-button--ujarak'  => esc_html__('Ujarak', 	    MELA_TD),
						'jltma-creative-button--wayra'   => esc_html__('Wayra', 	    MELA_TD),
						'jltma-creative-button--tamaya'  => esc_html__('Tamaya', 	    MELA_TD),
						'jltma-creative-button--rayen'   => esc_html__('Rayen', 	    MELA_TD),
						//'jltma-creative-button--puck' 		=> esc_html__( 'Puck ( Pro )', 	    MELA_TD ),
						//'jltma-creative-button--titania' 	=> esc_html__( 'Titania ( Pro )', 	    MELA_TD ),
						//'jltma-creative-button--bagot' 	    => esc_html__( 'Bagot ( Pro )', 	    MELA_TD ),
						//'jltma-creative-button--shylock'    => esc_html__( 'Shylock ( Pro )', 	    MELA_TD ),
						//'jltma-creative-button--cordelia'   => esc_html__( 'Cordelia ( Pro )', 	    MELA_TD ),
						//'jltma-creative-button--horatio'    => esc_html__( 'Horatio ( Pro )', 	    MELA_TD ),
						//'jltma-creative-button--luce'       => esc_html__( 'Luce ( Pro )', 	        MELA_TD ),
						//'jltma-creative-button--juliet'     => esc_html__( 'Juliet ( Pro )', 	    MELA_TD ),
						//'jltma-creative-button--invulner'   => esc_html__( 'Invulner ( Pro )', 	    MELA_TD ),
						//'jltma-creative-button--tantalid'   => esc_html__( 'Tantalid ( Pro )', 	    MELA_TD ),
						//'jltma-creative-button--wave' 		=> esc_html__( 'Wave (Pro)', 	MELA_TD ),
						'jltma-creative-button--pro-1'  => esc_html__('Pipaluk (Pro)', MELA_TD),
						'jltma-creative-button--pro-2'  => esc_html__('Moema (Pro)', 	MELA_TD),
						'jltma-creative-button--pro-3'  => esc_html__('Isi (Pro)', 	MELA_TD),
						'jltma-creative-button--pro-4'  => esc_html__('Aylen (Pro)', 	MELA_TD),
						'jltma-creative-button--pro-5'  => esc_html__('Saqui (Pro)', 	MELA_TD),
						'jltma-creative-button--pro-6'  => esc_html__('Wapasha (Pro)', MELA_TD),
						'jltma-creative-button--pro-7'  => esc_html__('Nina (Pro)', 	MELA_TD),
						'jltma-creative-button--pro-8'  => esc_html__('Nanuk (Pro)', 	MELA_TD),
						'jltma-creative-button--pro-9'  => esc_html__('Nuka (Pro)', 	MELA_TD),
						'jltma-creative-button--pro-10' => esc_html__('Antiman (Pro)', MELA_TD),
						'jltma-creative-button--pro-11' => esc_html__('Itzel (Pro)',   MELA_TD),
						'jltma-creative-button--pro-12' => esc_html__('Naira (Pro)',   MELA_TD),
						'jltma-creative-button--pro-13' => esc_html__('Quidel (Pro)', 	MELA_TD),
						'jltma-creative-button--pro-14' => esc_html__('Sacnite (Pro)', MELA_TD),
						'jltma-creative-button--pro-15' => esc_html__('Shikoba (Pro)', MELA_TD),
					],
					'description' => sprintf(
						'15+ more Variations on <a href="%s" target="_blank">%s</a>',
						esc_url_raw(admin_url('admin.php?page=master-addons-settings-pricing')),
						__('Upgrade Now', MELA_TD)
					)
				]
			);
		}


		$this->add_responsive_control(
			'ma_el_creative_button_alignment',
			[
				'label'       => esc_html__('Button Alignment', MELA_TD),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'flex-start' => [
						'title' => esc_html__('Left', MELA_TD),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', MELA_TD),
						'icon'  => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => esc_html__('Right', MELA_TD),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-creative-button-wrapper' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		/*
			 * Master Addons: Creative Button Controls
			 */
		$this->start_controls_section(
			'ma_el_creative_button_content',
			[
				'label' => esc_html__('Button Controls', MELA_TD)
			]
		);


		$this->add_control(
			'creative_button_text',
			[
				'label'       => esc_html__('Button Text', MELA_TD),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Click Me!',
				'placeholder' => esc_html__('Enter button text', MELA_TD),
				'title'       => esc_html__('Enter button text here', MELA_TD),
			]
		);

		$this->add_control(
			'creative_alternative_button_text',
			[
				'label'       => esc_html__('Alternative Button Text', MELA_TD),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Go!',
				'placeholder' => esc_html__('Enter Alternative Button text', MELA_TD),
				'title'       => esc_html__('Enter Alternative Button text here', MELA_TD),
			]
		);


		$this->add_control(
			'creative_button_link_url',
			[
				'label'       => esc_html__('Link URL', MELA_TD),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => '',
				],
				'show_external' => true,
			]
		);


		$this->add_control(
			'ma_el_creative_button_icon',
			[
				'label'            => esc_html__('Icon', MELA_TD),
				'description'      => esc_html__('Please choose an icon from the list.', MELA_TD),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-external-link-alt',
					'library' => 'solid',
				],
				'render_type' => 'template'
			]
		);



		$this->add_control(
			'ma_el_creative_button_icon_alignment',
			[
				'label'   => esc_html__('Icon Position', MELA_TD),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => esc_html__('Before', MELA_TD),
					'right' => esc_html__('After', MELA_TD),
				],
				'condition' => [
					'ma_el_creative_button_icon!' => '',
				],
			]
		);


		$this->add_control(
			'ma_el_creative_button_icon_indent',
			[
				'label' => esc_html__('Icon Spacing', MELA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 60,
					],
				],
				'condition' => [
					'ma_el_creative_button_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-creative-button-icon-right' => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .jltma-creative-button-icon-left'  => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .jltma-creative-button--shikoba i' => 'left: -{{SIZE}}px;',
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
				'label' => esc_html__('Help Docs', MELA_TD),
			]
		);


		$this->add_control(
			'help_doc_1',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', MELA_TD), '<a href="https://master-addons.com/demos/creative-button/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', MELA_TD), '<a href="https://master-addons.com/docs/addons/creative-button/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', MELA_TD), '<a href="https://www.youtube.com/watch?v=kFq8l6wp1iI" target="_blank" rel="noopener">', '</a>'),
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
					'label'   => esc_html__('Unlock more possibilities', MELA_TD),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', MELA_TD),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}


		/*
			 * Master Addons: Style Controls
			 */
		$this->start_controls_section(
			'ma_el_creative_button_settings',
			[
				'label' => esc_html__('Button Styles', MELA_TD),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);



		$this->add_responsive_control(
			'ma_el_creative_button_width',
			[
				'label'      => esc_html__('Width', MELA_TD),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-creative-button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ma_el_creative_button_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-creative-button',
			]
		);

		$this->add_responsive_control(
			'ma_el_creative_button_padding',
			[
				'label'      => esc_html__('Button Padding', MELA_TD),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-creative-button'                                       => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--winona::after'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--winona > span'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--tamaya::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--rayen::before'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--rayen > span'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->start_controls_tabs('ma_el_creative_button_tabs');

		$this->start_controls_tab('normal', ['label' => esc_html__('Normal', MELA_TD)]);

		$this->add_control(
			'ma_el_creative_button_text_color',
			[
				'label'     => esc_html__('Text Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .jltma-creative-button'                                       => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--tamaya::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--tamaya::after'  => 'color: {{VALUE}};'
				],
			]
		);



		$this->add_control(
			'ma_el_creative_button_background_color',
			[
				'label'     => esc_html__('Background Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .jltma-creative-button'                                       => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--ujarak:hover'   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--wayra:hover'    => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--tamaya::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--tamaya::after'  => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--rayen:hover'    => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'ma_el_creative_button_border',
				'selector' => '{{WRAPPER}} .jltma-creative-button',
			]
		);

		$this->add_control(
			'ma_el_creative_button_border_radius',
			[
				'label' => esc_html__('Border Radius', MELA_TD),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jltma-creative-button'         => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .jltma-creative-button::before' => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .jltma-creative-button::after'  => 'border-radius: {{SIZE}}px;',
				],
			]
		);



		$this->end_controls_tab();

		$this->start_controls_tab('ma_el_creative_button_hover', [
			'label' => esc_html__('Hover', MELA_TD)
		]);

		$this->add_control(
			'ma_el_creative_button_hover_text_color',
			[
				'label'     => esc_html__('Text Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .jltma-creative-button:hover'                                => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--winona::after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button--saqui:hover,
						{{WRAPPER}} .jltma-creative-button--saqui::after'  							=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'ma_el_creative_button_hover_background_color',
			[
				'label'     => esc_html__('Background Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f54',
				'selectors' => [
					'{{WRAPPER}} .jltma-creative-button:hover'                                      => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--ujarak::before'      => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--wayra:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--tamaya:hover'        => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--rayen::before'       => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button--saqui:hover'                               => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'ma_el_creative_button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', MELA_TD),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .jltma-creative-button:hover'                                  => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--wapasha::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--antiman::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--pipaluk::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .jltma-creative-button.jltma-creative-button--quidel::before'  => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .jltma-creative-button',
			]
		);


		$this->end_controls_section();


		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'ma_el_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro Version for More Features', MELA_TD),
					'tab'   => Controls_Manager::TAB_STYLE
				]
			);

			$this->add_control(
				'ma_el_control_get_pro_style_tab',
				[
					'label'   => esc_html__('Unlock more possibilities', MELA_TD),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', MELA_TD),
							'icon'  => 'fa fa-unlock-alt',
						],
					],
					'default'     => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with
Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}
	protected function render()
	{

		$settings = $this->get_settings();

		$this->add_render_attribute('ma_el_creative_button', [
			'class' => ['jltma-button jltma-creative-button', esc_attr($settings['creative_button_effect'])],
			'href'  => esc_url($settings['creative_button_link_url']['url']),
		]);

		if ($settings['creative_button_link_url']['is_external']) {
			$this->add_render_attribute('ma_el_creative_button', 'target', '_blank');
		}

		if ($settings['creative_button_link_url']['nofollow']) {
			$this->add_render_attribute('ma_el_creative_button', 'rel', 'nofollow');
		}

		$this->add_render_attribute('ma_el_creative_button', 'data-text', esc_attr($settings['creative_alternative_button_text']));
?>

		<div class="jltma-creative-button-wrapper">
			<a <?php echo $this->get_render_attribute_string('ma_el_creative_button'); ?>>
				<span>
					<?php if (!empty($settings['ma_el_creative_button_icon']) && $settings['ma_el_creative_button_icon_alignment'] == 'left') : ?>

						<?php Master_Addons_Helper::jltma_fa_icon_picker('fas fa-external-link-alt', 'icon', $settings['ma_el_creative_button_icon'], 'ma_el_creative_button_icon', 'jltma-creative-button-icon-left'); ?>
					<?php endif; ?>

					<?php echo  $settings['creative_button_text']; ?>

					<?php if (!empty($settings['ma_el_creative_button_icon']) && $settings['ma_el_creative_button_icon_alignment'] == 'right') : ?>

						<?php Master_Addons_Helper::jltma_fa_icon_picker('fas fa-external-link-alt', 'icon', $settings['ma_el_creative_button_icon'], 'ma_el_creative_button_icon', 'jltma-creative-button-icon-right'); ?>

					<?php endif; ?>
				</span>
			</a>
		</div>

<?php
	}

	protected function _content_template()
	{
	}
}
