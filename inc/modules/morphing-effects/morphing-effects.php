<?php
namespace MasterAddons\Inc\Extensions;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Background;

use \MasterAddons\Inc\Classes\JLTMA_Extension_Prototype;
use MasterAddons\Inc\Controls\MA_Group_Control_Transition;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; };


/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 17/09/2020
 */


/**
 * Blob - Morphing Animation
*/

class JLTMA_Extension_Morphing_Effects extends JLTMA_Extension_Prototype {
    
    private static $instance = null;
    public $name = 'Morphing Effects';
    public $has_controls = true;
    public $common_sections_actions = array(
        array(
            'element' => 'common',
            'action' => '_section_style',
        ),
        
        array(
            'element' => 'column',
            'action' => 'section_advanced',
        ),
    );


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
                'prefix_class' 			=> 'jltma-morphing-fx-',
            ]
        );


		$element->add_control(
			'jltma_morphing_blob_animation',
			[
				'label' 		=> esc_html__( 'Blob Animation', MELA_TD ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'1'			=> esc_html__( 'Effect One', MELA_TD ),
					'2' 		=> esc_html__( 'Effect Two', MELA_TD ),
					'3' 		=> esc_html__( 'Effect Three', MELA_TD ),
					'4' 		=> esc_html__( 'Effect Four', MELA_TD )
				],
				'default' 		=> '1',
				'condition'          => [
					'jltma_morphing_effects_switch' => 'yes'
				],
				'prefix_class' 			=> 'animation_svg_0'
			]
		);


		$element->add_control(
			'jltma_morphing_blob_type',
			[
				'label' 		=> esc_html__( 'Blob Type', MELA_TD ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'color'			=> esc_html__( 'Color/Gradient', MELA_TD ),
					'lottie' 		=> esc_html__( 'Lottie', MELA_TD )
				],
				'default' 		=> 'gradient',
				'condition'          => [
					'jltma_morphing_effects_switch' => 'yes'
				]
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

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' 		=> 'jltma_morphing_effects_background',
                'selector' 	=> '{{WRAPPER}} .elementor-widget-container',
                'types' 	=> [ 'classic', 'gradient' ],
                'default'	=> 'classic',
				'condition'          => [
					'jltma_morphing_blob_type' => 'color'
				]
            ]
        );

		$element->add_responsive_control(
			'jltma_morphing_effects_maxwidth',
			[
				'label' => esc_html__( 'Max Width', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				// 'default' => [
				// 	'size' => '100',
				// ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$element->add_responsive_control(
			'jltma_morphing_effects_maxheight',
			[
				'label' => esc_html__( 'Maximum Height', MELA_TD ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'max-height: {{SIZE}}{{UNIT}}',
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


        $element->add_group_control(
            MA_Group_Control_Transition::get_type(),
            [
                'name' 			=> 'jltma_morphing_effects_transition',
                'selector' 		=> '{{WRAPPER}} .elementor-widget-container',
            ]
        );


		// $element->add_control(
		// 	'jltma_morphing_effects_transition_duration',
		// 	[
		// 		'label' => esc_html__( 'Transition Duration', MELA_TD ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'step' => 100,
		// 				'min' => 0,
		// 				'max' => 10000,
		// 			],
		// 		],
		// 		'default' => [
		// 			'size' => '400',
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .elementor-widget-container' => 'transition: all {{SIZE}}ms;',
		// 		],
		// 	]
		// );		

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


        $element->add_group_control(
            MA_Group_Control_Transition::get_type(),
            [
                'name' 			=> 'jltma_morphing_effects_hover_transition',
                'selector' 		=> '{{WRAPPER}} .elementor-widget-container',
            ]
        );



		// $element->add_control(
		// 	'jltma_morphing_effects_transition_hover_duration',
		// 	[
		// 		'label' => esc_html__( 'Transition Duration', MELA_TD ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'step' => 100,
		// 				'min' => 0,
		// 				'max' => 10000,
		// 			],
		// 		],
		// 		'default' => [
		// 			'size' => '400',
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .elementor-widget-container:hover' => 'transition: all {{SIZE}}ms;',
		// 		],
		// 	]
		// );

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