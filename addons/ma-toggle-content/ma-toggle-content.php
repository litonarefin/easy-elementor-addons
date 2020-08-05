<?php
namespace Elementor;

// Elementor Classes
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;

// Master Addons Classes
use MasterAddons\Inc\Classes\Controls\Templates\Master_Addons_Template_Controls as TemplateControls;
use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 05/08/2020
 */


if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Master_Addons_Toggle_Content extends Widget_Base {

    public function get_name() {
        return 'ma-toggle-content';
    }

    public function get_title() {
        return esc_html__( 'MA Toggle Content', MELA_TD);
    }

    public function get_icon() {
        return 'ma-el-icon eicon-dual-button';
    }

    public function get_categories() {
        return [ 'master-addons' ];
    }

    public function get_style_depends(){
        return [
            'font-awesome-5-all',
            'font-awesome-4-shim'
        ];
    }

    public function get_keywords() {
        return [
            'content toggle',
            'toggle content',
            'content switcher',
            'switch content',
            'on/off content'
        ];
    }

    public function get_help_url(){
        return 'https://master-addons.com/demos/toggle-content/';
    }

    protected function _register_controls() {

        /**
         * -------------------------------------------
         * Tab Style MA Toggle Content
         * -------------------------------------------
         */
        $this->start_controls_section(
            'jltma_toggle_content_element_settings',
            [
                'label' => esc_html__( 'Content Settings', MELA_TD )
            ]
        );

        if ( ma_el_fs()->can_use_premium_code() ) {
            $this->add_control(
                'jltma_toggle_content_preset',
                [
                    'label'       	=> esc_html__( 'Style Presets', MELA_TD ),
                    'type' 			=> Controls_Manager::SELECT,
                    'default' 		=> 'two',
                    'label_block' 	=> false,
                    'options' 		=> [
                            'two'       => esc_html__( 'Horizontal Tabs', MELA_TD ),
                            'three'     => esc_html__( 'Vertical Tabs', MELA_TD ),
                            'four'      => esc_html__( 'Left Active Border', MELA_TD ),
                            'five'      => esc_html__( 'Tabular Content', MELA_TD ),
                    ]
                ]
            );
        } else{
            $this->add_control(
                'jltma_toggle_content_preset',
                [
                    'label'       	=> esc_html__( 'Style Preset', MELA_TD ),
                    'type' 			=> Controls_Manager::SELECT,
                    'default' 		=> 'two',
                    'label_block' 	=> false,
                    'options' 		=> [
                            'two'       => esc_html__( 'Horizontal Tabs', MELA_TD ),
                            'three'     => esc_html__( 'Vertical Tabs', MELA_TD ),
                            'four'      => esc_html__( 'Left Active Border', MELA_TD ),
                            'ma_tabular_pro'      => esc_html__( 'Tabular Content (Pro)', MELA_TD ),
                    ],
                ]
            );
        }

        $repeater = new Repeater();

        $repeater->start_controls_tabs( 'jltma_toggle_contents_repeater' );

        $repeater->start_controls_tab( 'jltma_toggle_contents', [ 'label' => esc_html__( 'Content', MELA_TD ) ] );

        $repeater->add_control(
            'jltma_toggle_content_text',
            [
                'default'	=> '',
                'type'		=> Controls_Manager::TEXT,
                'dynamic'	=> [ 'active' => true ],
                'label' 	=> esc_html__( 'Label', MELA_TD ),
                'separator' => 'none',
            ]
        );


        $repeater->add_control(
            'jltma_toggle_content_icon',
            [
                'label'					=> esc_html__( 'Icon', MELA_TD ),
                'type'					=> Controls_Manager::ICONS,
                'fa4compatibility'		=> 'jltma_toggle_content_fa4_icon',
                'label_block' 	        => false,
            ]
        );

        $repeater->add_control(
            'jltma_toggle_content_icon_align',
            [
                'label' 	            => esc_html__( 'Icon Position', MELA_TD ),
                'label_block'           => false,
                'type' 		            => Controls_Manager::SELECT,
                'default' 	            => 'left',
                'options' 	            => [
                    'left' 		=> esc_html__( 'Before', MELA_TD ),
                    'right' 	=> esc_html__( 'After', MELA_TD ),
                ],
                'condition' => [
                    'jltma_toggle_content_fa4_icon!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'jltma_toggle_content_icon_align',
            [
                'label' 	            => esc_html__( 'Icon Spacing', MELA_TD ),
                'type' 		            => Controls_Manager::SLIDER,
                'range' 	            => [
                    'px' 	=> [
                        'max' => 50,
                    ],
                ],
                'condition'             => [
                    'jltma_toggle_content_fa4_icon!' => '',
                ],
                // 'selectors'             => [
                //     '{{WRAPPER}} {{CURRENT_ITEM}} .ee-icon--right' => 'margin-left: {{SIZE}}{{UNIT}};',
                //     '{{WRAPPER}} {{CURRENT_ITEM}} .ee-icon--left' => 'margin-right: {{SIZE}}{{UNIT}};',
                // ],
            ]
        );

        $repeater->add_control(
            'jltma_toggle_content_type',
            [
                'label'		            => esc_html__( 'Type', MELA_TD ),
                'type' 		            => Controls_Manager::SELECT,
                'default' 	            => 'content',
                'options' 	            => [
                    'content' 		    => esc_html__( 'Content', MELA_TD ),
                    'template' 	        => esc_html__( 'Template', MELA_TD ),
                ],
            ]
        );

        $repeater->add_control(
            'jltma_toggle_content',
            [
                'label' 	            => esc_html__( 'Content', MELA_TD ),
                'type' 		            => Controls_Manager::WYSIWYG,
                'dynamic'	            => [ 'active' => true ],
                'default' 	            => esc_html__( 'I am the content ready to be toggled', MELA_TD ),
                'condition'	            => [
                    'jltma_toggle_content_type'      => 'content',
                ],
            ]
        );

        TemplateControls::add_controls( $repeater, [
            'condition' => [
                'jltma_toggle_content_type' => 'template',
            ],
            'prefix' => 'content_',
        ] );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab( 'jltma_toggle_content_label', [ 'label' => esc_html__( 'Style', MELA_TD ) ] );

        $repeater->add_control(
            'jltma_toggle_content_text_color',
            [
                'label' 	            => esc_html__( 'Label Color', MELA_TD ),
                'type' 		            => Controls_Manager::COLOR,
                'default'	            => '',
                'selectors'             => [
                    // '{{WRAPPER}} {{CURRENT_ITEM}}.ee-toggle-element__controls__item' => 'color: {{VALUE}};',
                ],
            ]
        );


        $repeater->add_control(
            'jltma_toggle_content_text_active_color',
            [
                'label' 	            => esc_html__( 'Active Label Color', MELA_TD ),
                'type' 		            => Controls_Manager::COLOR,
                'default'	            => '',
                'selectors'             => [
                    // '{{WRAPPER}} {{CURRENT_ITEM}}.ee-toggle-element__controls__item.ee--is-active,
                    //  {{WRAPPER}} {{CURRENT_ITEM}}.ee-toggle-element__controls__item.ee--is-active:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'jltma_toggle_content_active_color',
            [
                'label' 	            => esc_html__( 'Indicator Color', MELA_TD ),
                'type' 		            => Controls_Manager::COLOR,
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'jltma_toggle_content_elements',
            [
                'label' 	            => esc_html__( 'Elements', MELA_TD ),
                'type' 		            => Controls_Manager::REPEATER,
                'default' 	            => [
                    [
                        'jltma_toggle_content_text'     => '',
                        'jltma_toggle_content'          => esc_html__( 'I am the content ready to be toggled', MELA_TD ),
                    ],
                    [
                        'jltma_toggle_content_text' 	=> '',
                        'jltma_toggle_content'          => esc_html__( 'I am the content of another element ready to be toggled', MELA_TD ),
                    ],
                ],
                'fields' 		        => array_values( $repeater->get_controls() ),
                'title_field' 	        => '{{{ jltma_toggle_content_text }}}',
            ]
        );

        $this->end_controls_section();



        /**
         * Content Tab: Toggle Settings
         */
        $this->start_controls_section(
            'jltma_toggle_content_settings',
            [
                'label' => esc_html__( 'Toggle Settings', MELA_TD ),
            ]
        );

        $this->add_control(
            'jltma_toggle_content_active_index',
            [
                'label'			        => esc_html__( 'Active Index', MELA_TD ),
                'title'   		        => esc_html__( 'The index of the default active element.', MELA_TD ),
                'type'			        => Controls_Manager::NUMBER,
                'default'		        => '1',
                'min'			        => 1,
                'step'			        => 1,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'jltma_toggle_content_position',
            [
                'label'		            => esc_html__( 'Position', MELA_TD ),
                'type' 		            => Controls_Manager::SELECT,
                'default' 	            => 'before',
                'options' 	            => [
                    'before'  	  => esc_html__( 'Before', MELA_TD ),
                    'after' 	  => esc_html__( 'After', MELA_TD ),
                ],
            ]
        );


        $this->add_control(
            'jltma_toggle_content_indicator_speed',
            [
                'label' 	            => esc_html__( 'Indicator Speed', MELA_TD ),
                'type' 		            => Controls_Manager::SLIDER,
                'range' 	            => [
                    'px' 	            => [
                        'min' 	  => 0.1,
                        'max' 	  => 2,
                        'step'	  => 0.1,
                    ],
                ],
                'default' 	            => [
                    'size'        => 0.3
                ],
                'frontend_available'    => true,
            ]
        );

        $this->end_controls_section();




        /**
         * Content Tab: Toggle Style
         */
		$this->start_controls_section(
			'jltma_toggle_content_style_toggler',
			[
				'label'                  => esc_html__( 'Toggler', MELA_TD ),
				'tab'                    => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'jltma_toggle_content_toggle_style',
            [
                'label'		            => esc_html__( 'Style', MELA_TD ),
                'type' 		            => Controls_Manager::SELECT,
                'default' 	            => 'round',
                'options' 	            => [
                    'round'  => esc_html__( 'Round', MELA_TD ),
                    'square' => esc_html__( 'Square', MELA_TD ),
                ],
                // 'prefix_class'          => 'ee-toggle-element--',
            ]
        );

        $this->add_responsive_control(
            'jltma_toggle_content_toggle_align',
            [
                'label' 		=> esc_html__( 'Align', MELA_TD ),
                'label_block'	=> false,
                'type' 			=> Controls_Manager::CHOOSE,
                'options' 		=> [
                    'left'    		=> [
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
                ],
                'default' 	=> 'center',
                'selectors' => [
                    // '{{WRAPPER}} .ee-toggle-element__toggle' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'jltma_toggle_content_toggle_zoom',
            [
                'label' 	=> esc_html__( 'Zoom', MELA_TD ),
                'type' 		=> Controls_Manager::SLIDER,
                'default' 	=> [
                    'size' 	=> 16,
                ],
                'range' 	=> [
                    'px' 	=> [
                        'max' 	=> 28,
                        'min' 	=> 12,
                        'step' 	=> 1,
                    ],
                ],
                'selectors' 	=> [
                    // '{{WRAPPER}} .ee-toggle-element__controls-wrapper' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'jltma_toggle_content_toggle_spacing',
            [
                'label' 	=> esc_html__( 'Spacing', MELA_TD ),
                'type' 		=> Controls_Manager::SLIDER,
                'default' 	=> [
                    'size' 	=> 24,
                ],
                'range' 	=> [
                    'px' 	=> [
                        'max' 	=> 100,
                        'min' 	=> 0,
                        'step' 	=> 1,
                    ],
                ],
                'selectors' 	=> [
                    // '{{WRAPPER}} .ee-toggle-element__controls-wrapper--before' => 'margin-bottom: {{SIZE}}px;',
                    // '{{WRAPPER}} .ee-toggle-element__controls-wrapper--after' => 'margin-top: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'jltma_toggle_content_toggle_padding',
            [
                'label' 	=> esc_html__( 'Padding', MELA_TD ),
                'type' 		=> Controls_Manager::SLIDER,
                'default' 	=> [
                    'size' 	=> 6,
                ],
                'range' 	=> [
                    'px' 	=> [
                        'max' 	=> 10,
                        'min' 	=> 0,
                        'step' 	=> 1,
                    ],
                ],
                'selectors' 	=> [
                    // '{{WRAPPER}} .ee-toggle-element__indicator' => 'margin: {{SIZE}}px;',
                    // '{{WRAPPER}} .ee-toggle-element__controls-wrapper' => 'padding: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'jltma_toggle_content_toggle_width',
            [
                'label' 	=> esc_html__( 'Width (%)', MELA_TD ),
                'type' 		=> Controls_Manager::SLIDER,
                'range' 	=> [
                    'px' 	=> [
                        'max' 	=> 100,
                        'min' 	=> 0,
                        'step' 	=> 1,
                    ],
                ],
                'selectors' 	=> [
                    // '{{WRAPPER}} .ee-toggle-element__controls-wrapper' => 'width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'jltma_toggle_content_toggle_radius',
            [
                'label' 	=> esc_html__( 'Radius', MELA_TD ),
                'type' 		=> Controls_Manager::SLIDER,
                'default' 	=> [
                    'size' 	=> 4,
                ],
                'range' 	=> [
                    'px' 	=> [
                        'max' 	=> 10,
                        'min' 	=> 0,
                        'step' 	=> 1,
                    ],
                ],
                'selectors' 	=> [
                    // '{{WRAPPER}}.ee-toggle-element--square .ee-toggle-element__controls-wrapper' => 'border-radius: {{SIZE}}px;',
                    // '{{WRAPPER}}.ee-toggle-element--square .ee-toggle-element__indicator' => 'border-radius: calc( {{SIZE}}px - 2px );',
                ],
                'condition' => [
                    'jltma_toggle_content_toggle_style' => 'square',
                ]
            ]
        );

        $this->add_control(
            'jltma_toggle_content_toggle_background',
            [
                'label' 	=> esc_html__( 'Background Color', MELA_TD ),
                'type' 		=> Controls_Manager::COLOR,
                'selectors' => [
                    // '{{WRAPPER}} .ee-toggle-element__controls-wrapper' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' 		=> 'jltma_toggle_content_toggle',
                // 'selector' 	=> '{{WRAPPER}} .ee-toggle-element__controls-wrapper',
            ]
        );

		$this->end_controls_section();




        /**
         * Content Tab: Docs Links
         */

		$this->start_controls_section(
			'jltma_toggle_content_section_style_indicator',
			[
				'label' => esc_html__( 'Indicator', MELA_TD ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'jltma_toggle_content_indicator_color',
				[
					'label' 	=> esc_html__( 'Color', MELA_TD ),
					'type' 		=> Controls_Manager::COLOR,
					'frontend_available' => true,
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'jltma_toggle_content_indicator',
					// 'selector' 	=> '{{WRAPPER}} .ee-toggle-element__indicator',
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
                'raw'             => sprintf( esc_html__( '%1$s Live Demo %2$s', MELA_TD ), '<a href="https://master-addons.com/demos/tabs/" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_2',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Documentation %2$s', MELA_TD ), '<a href="https://master-addons.com/docs/addons/tabs-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );

        $this->add_control(
            'help_doc_3',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf( esc_html__( '%1$s Watch Video Tutorial %2$s', MELA_TD ), '<a href="https://www.youtube.com/watch?v=lsqGmIrdahw" target="_blank" rel="noopener">', '</a>' ),
                'content_classes' => 'jltma-editor-doc-links',
            ]
        );
        $this->end_controls_section();



        if ( ma_el_fs()->is_not_paying() ) {

            $this->start_controls_section(
                'ma_el_section_pro_style_section',
                [
                    'label' => esc_html__( 'Upgrade to Pro', MELA_TD ),
                ]
            );

            $this->add_control(
                'ma_el_control_get_pro_style_tab',
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

    }



}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Toggle_Content());