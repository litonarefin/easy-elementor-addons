<?php
namespace MasterAddons\Inc\Extensions;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Css_Filter;

use \MasterAddons\Inc\Classes\JLTMA_Extension_Prototype;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; };

/**
 * Reveals - Opening effect
*/

class JLTMA_Extension_Morphing_Effects extends JLTMA_Extension_Prototype {
    
    private static $instance = null;
    public $name = 'Morphing Effects';
    public $has_controls = true;

    // public function get_script_depends() {
	   //  return [ 
    //         'jltma-floating-effects',
    //         'master-addons-scripts' 
    //     ];
    // }



    private function add_controls($element, $args) {

        $element_type = $element->get_type();

        $element->add_control(
            'jltma_morphing_effects_switch', 
            [
                'label' 				=> __('Morphing Effects', MELA_TD),
                'type' 					=> Controls_Manager::SWITCHER,
                'default' 				=> '',
                'label_on' 				=> __('Yes', MELA_TD),
                'label_off' 			=> __('No', MELA_TD),
                'return_value' 			=> 'yes',
                'frontend_available' 	=> true,
                'separator' 			=> 'after',
                'prefix_class' 			=> 'jltma-morphing-fx-',
            ]
        );

		$element->add_control(
			'jltma_morphing_effects',
			[
				'label' 		=> '<strong>'.esc_html__( 'Transform Effects', MELA_TD ).'</strong>',
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'translate'		=> esc_html__( 'Translate', MELA_TD ),
					'scaleX' 		=> esc_html__( 'Scale X', MELA_TD ),
					'scaleY' 		=> esc_html__( 'Scale Y', MELA_TD ),
					'scaleZ' 		=> esc_html__( 'Scale Z', MELA_TD ),
					'rotateX' 		=> esc_html__( 'Rotate X', MELA_TD ),
					'rotateY' 		=> esc_html__( 'Rotate Y', MELA_TD ),
					'rotateZ' 		=> esc_html__( 'Rotate Z', MELA_TD ),
					'skewX' 		=> esc_html__( 'Skew X', MELA_TD ),
					'skewY' 		=> esc_html__( 'Skew Y', MELA_TD ),
					'none' 		=> esc_html__( 'None', MELA_TD ),
				],
				'default' 		=> 'none',
				'condition'          => [
					'jltma_morphing_effects_switch' => 'yes'
				]
			]
		);

		$element->add_responsive_control(
			'jltma_morphing_effects_perspective',
			[
				'label' => esc_html__( 'Perspective Size', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 10000,
					],
				],
				'default' => [
					'size' => '1000',
				],
				'condition' => [
					'jltma_morphing_effects' => ['rotateX', 'rotateY'],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'perspective: {{SIZE}}px;',
				],
			]
		);



		$element->start_controls_tabs( 'jltma_morphing_effects_tabs' );

		$element->start_controls_tab(
			'jltma_morphing_effects_normal',
			[
				'label' => esc_html__( 'Normal', MELA_TD ),
				'condition'          => [
					'jltma_morphing_effects_switch' => 'yes'
				]
				
			]
		);

		$element->add_responsive_control(
			'jltma_morphing_effects_translateX',
			[
				'label' => esc_html__( 'Translate X', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'jltma_morphing_effects' => 'translate',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_translateY',
			[
				'label' => esc_html__( 'Translate Y', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'jltma_morphing_effects' => 'translate',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .elementor-widget-container' => 'transform: translate({{jltma_morphing_effects_translateX.SIZE || 0}}px, {{jltma_morphing_effects_translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .elementor-widget-container' => 'transform: translate({{jltma_morphing_effects_translateX_tablet.SIZE || 0}}px, {{jltma_morphing_effects_translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .elementor-widget-container' => 'transform: translate({{jltma_morphing_effects_translateX_mobile.SIZE || 0}}px, {{jltma_morphing_effects_translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_scaleX',
			[
				'label' => esc_html__( 'Scale X', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1',
				],
				'condition' => [
					'jltma_morphing_effects' => 'scaleX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: scaleX({{SIZE}});',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_scaleY',
			[
				'label' => esc_html__( 'Scale Y', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1',
				],
				'condition' => [
					'jltma_morphing_effects' => 'scaleY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: scaleY({{SIZE}});',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_scaleZ',
			[
				'label' => esc_html__( 'Scale Z', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1',
				],
				'condition' => [
					'jltma_morphing_effects' => 'scaleZ',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_rotateX',
			[
				'label' => esc_html__( 'Rotate X', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'jltma_morphing_effects' => 'rotateX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: rotateX({{SIZE}}deg);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_rotateY',
			[
				'label' => esc_html__( 'Rotate Y', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'jltma_morphing_effects' => 'rotateY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: rotateY({{SIZE}}deg);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_rotateZ',
			[
				'label' => esc_html__( 'Rotate Z', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'jltma_morphing_effects' => 'rotateZ',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: rotateZ({{SIZE}}deg);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_skewX',
			[
				'label' => esc_html__( 'Skew X', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'jltma_morphing_effects' => 'skewX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: skewX({{SIZE}}deg);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_skewY',
			[
				'label' => esc_html__( 'Skew Y', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'jltma_morphing_effects' => 'skewY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: skewY({{SIZE}}deg);',
				],
			]
		);
		$element->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'jltma_morphing_effects_filters',
				'selector' => '{{WRAPPER}} .elementor-widget-container',
				'condition'          => [
					'jltma_morphing_effects_switch' => 'yes'
				]
			]
		);

		$element->end_controls_tab();

		$element->start_controls_tab(
			'jltma_morphing_effects_hover',
			[
				'label' => esc_html__( 'Hover', MELA_TD ),
				'condition'          => [
					'jltma_morphing_effects_switch' => 'yes'
				]
			]
		);

		$element->add_responsive_control(
			'jltma_morphing_effects_translateX_hover',
			[
				'label' => esc_html__( 'Translate X', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'jltma_morphing_effects' => 'translate',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_translateY_hover',
			[
				'label' => esc_html__( 'Translate Y', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '-10',
				],
				'condition' => [
					'jltma_morphing_effects' => 'translate',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .elementor-widget-container:hover' => 'transform: translate({{jltma_morphing_effects_translateX_hover.SIZE || 0}}px, {{jltma_morphing_effects_translateY_hover.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .elementor-widget-container:hover' => 'transform: translate({{jltma_morphing_effects_translateX_hover_tablet.SIZE || 0}}px, {{jltma_morphing_effects_translateY_hover_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .elementor-widget-container:hover' => 'transform: translate({{jltma_morphing_effects_translateX_hover_mobile.SIZE || 0}}px, {{jltma_morphing_effects_translateY_hover_mobile.SIZE || 0}}px);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_scaleX_hover',
			[
				'label' => esc_html__( 'Scale X', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.05',
				],
				'condition' => [
					'jltma_morphing_effects' => 'scaleX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: scaleX({{SIZE}});',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_scaleY_hover',
			[
				'label' => esc_html__( 'Scale Y', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.05',
				],
				'condition' => [
					'jltma_morphing_effects' => 'scaleY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: scaleY({{SIZE}});',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_scaleZ_hover',
			[
				'label' => esc_html__( 'Scale Z', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.05',
				],
				'condition' => [
					'jltma_morphing_effects' => 'scaleZ',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_rotateX_hover',
			[
				'label' => esc_html__( 'Rotate X', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '15',
				],
				'condition' => [
					'jltma_morphing_effects' => 'rotateX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: rotateX({{SIZE}}deg);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_rotateY_hover',
			[
				'label' => esc_html__( 'Rotate Y', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '15',
				],
				'condition' => [
					'jltma_morphing_effects' => 'rotateY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: rotateY({{SIZE}}deg);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_rotateZ_hover',
			[
				'label' => esc_html__( 'Rotate Z', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '5',
				],
				'condition' => [
					'jltma_morphing_effects' => 'rotateZ',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: rotateZ({{SIZE}}deg);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_skewX_hover',
			[
				'label' => esc_html__( 'Skew X', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '10',
				],
				'condition' => [
					'jltma_morphing_effects' => 'skewX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: skewX({{SIZE}}deg);',
				],
			]
		);
		$element->add_responsive_control(
			'jltma_morphing_effects_skewY_hover',
			[
				'label' => esc_html__( 'Skew Y', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '5',
				],
				'condition' => [
					'jltma_morphing_effects' => 'skewY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: skewY({{SIZE}}deg);',
				],
			]
		);
		$element->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'jltma_morphing_effects_filters_hover',
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover',
				'condition'          => [
					'jltma_morphing_effects_switch' => 'yes'
				]
			]
		);
		$element->add_control(
			'jltma_morphing_effects_duration',
			[
				'label' => esc_html__( 'Transition Duration', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 100,
						'min' => 0,
						'max' => 10000,
					],
				],
				'default' => [
					'size' => '400',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transition: all {{SIZE}}ms;',
				],
			]
		);

		$element->end_controls_tab();

		$element->end_controls_tabs();

   
    }

	
    protected function add_actions() {

        // Activate controls for widgets
        add_action('elementor/element/common/jltma_section_morphing_effects_advanced/before_section_end', function( $element, $args ) {
            $this->add_controls($element, $args);
        }, 10, 2);

    }


    public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
    }
    
}

JLTMA_Extension_Morphing_Effects::get_instance();