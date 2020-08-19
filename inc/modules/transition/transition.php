<?php
namespace MasterAddons\Modules\Transition;

use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;


/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 1/2/20
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class Master_Addons_Entrance_Animation {

	/*
	 * Instance of this class
	 */
	private static $instance = null;


	public function __construct() {

		// Add new controls to advanced tab globally
		add_action( "elementor/element/after_section_end", array( $this, 'jltma_section_add_transition_controls'),18,3 );

	}


	public function jltma_section_add_transition_controls( $widget, $section_id, $args ){

		// Anchor element sections
		$target_sections = array('section_custom_css');

		if( ! defined('ELEMENTOR_PRO_VERSION') ) {
			$target_sections[] = 'section_custom_css_pro';
		}

		if( ! in_array( $section_id, $target_sections ) ){
			return;
		}

		// Adds transition options to all elements
		// ---------------------------------------------------------------------
		$widget->start_controls_section(
			'ma_el_section_common_inview_transition',
			array(
				'label'     => MA_EL_BADGE . __( ' Entrance Animation', MELA_TD ),
				'tab'       => Controls_Manager::TAB_ADVANCED
			)
		);

		$widget->add_control(
			'ma_el_animation_name',
			array(
				'label'   => __( 'Animation', MELA_TD ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''                             => 'None',
					'jltma-fade-in'                => 'Fade In',
					'jltma-fade-in-down'           => 'Fade In Down',
					'jltma-fade-in-down-1'         => 'Fade In Down 1',
					'jltma-fade-in-down-2'         => 'Fade In Down 2',
					'jltma-fade-in-up'             => 'Fade In Up',
					'jltma-fade-in-up-1'           => 'Fade In Up 1',
					'jltma-fade-in-up-2'           => 'Fade In Up 2',
					'jltma-fade-in-left'           => 'Fade In Left',
					'jltma-fade-in-left-1'         => 'Fade In Left 1',
					'jltma-fade-in-left-2'         => 'Fade In Left 2',
					'jltma-fade-in-right'          => 'Fade In Right',
					'jltma-fade-in-right-1'        => 'Fade In Right 1',
					'jltma-fade-in-right-2'        => 'Fade In Right 2',

					// Slide Animation
					'jltma-slide-from-right'       => 'Slide From Right',
					'jltma-slide-from-left'        => 'Slide From Left',
					'jltma-slide-from-top'         => 'Slide From Top',
					'jltma-slide-from-bot'         => 'Slide From Bottom',

					// Mask Animation
					'jltma-mask-from-top'          => 'Mask From Top',
					'jltma-mask-from-bot'          => 'Mask From Bottom',
					'jltma-mask-from-left'         => 'Mask From Left',
					'jltma-mask-from-right'        => 'Mask From Right',

					'jltma-rotate-in'              => 'Rotate In',
					'jltma-rotate-in-down-left'    => 'Rotate In Down Left',
					'jltma-rotate-in-down-left-1'  => 'Rotate In Down Left 1',
					'jltma-rotate-in-down-left-2'  => 'Rotate In Down Left 2',
					'jltma-rotate-in-down-right'   => 'Rotate In Down Right',
					'jltma-rotate-in-down-right-1' => 'Rotate In Down Right 1',
					'jltma-rotate-in-down-right-2' => 'Rotate In Down Right 2',
					'jltma-rotate-in-up-left'      => 'Rotate In Up Left',
					'jltma-rotate-in-up-left-1'    => 'Rotate In Up Left 1',
					'jltma-rotate-in-up-left-2'    => 'Rotate In Up Left 2',
					'jltma-rotate-in-up-right'     => 'Rotate In Up Right',
					'jltma-rotate-in-up-right-1'   => 'Rotate In Up Right 1',
					'jltma-rotate-in-up-right-2'   => 'Rotate In Up Right 2',

					'jltma-zoom-in'                => 'Zoom In',
					'jltma-zoom-in-1'              => 'Zoom In 1',
					'jltma-zoom-in-2'              => 'Zoom In 2',
					'jltma-zoom-in-3'              => 'Zoom In 3',

					'jltma-scale-up'               => 'Scale Up',
					'jltma-scale-up-1'             => 'Scale Up 1',
					'jltma-scale-up-2'             => 'Scale Up 2',

					'jltma-scale-down'             => 'Scale Down',
					'jltma-scale-down-1'           => 'Scale Down 1',
					'jltma-scale-down-2'           => 'Scale Down 2',

					'jltma-flip-in-down'           => 'Flip In Down',
					'jltma-flip-in-down-1'         => 'Flip In Down 1',
					'jltma-flip-in-down-2'         => 'Flip In Down 2',
					'jltma-flip-in-up'             => 'Flip In Up',
					'jltma-flip-in-up-1'           => 'Flip In Up 1',
					'jltma-flip-in-up-2'           => 'Flip In Up 2',
					'jltma-flip-in-left'           => 'Flip In Left',
					'jltma-flip-in-left-1'         => 'Flip In Left 1',
					'jltma-flip-in-left-2'         => 'Flip In Left 2',
					'jltma-flip-in-left-3'         => 'Flip In Left 3',
					'jltma-flip-in-right'          => 'Flip In Right',
					'jltma-flip-in-right-1'        => 'Flip In Right 1',
					'jltma-flip-in-right-2'        => 'Flip In Right 2',
					'jltma-flip-in-right-3'        => 'Flip In Right 3',

					'jltma-pulse'                  => 'Pulse In 1' ,
					'jltma-pulse1'                 => 'Pulse In 2',
					'jltma-pulse2'                 => 'Pulse In 3',
					'jltma-pulse3'                 => 'Pulse In 4',
					'jltma-pulse4'                 => 'Pulse In 5',

					'jltma-pulse-out-1'            => 'Pulse Out 1' ,
					'jltma-pulse-out-2'            => 'Pulse Out 2' ,
					'jltma-pulse-out-3'            => 'Pulse Out 3' ,
					'jltma-pulse-out-4'            => 'Pulse Out 4' ,

					// Specials
					'jltma-shake'                  => 'Shake',
					'jltma-bounce-in'              => 'Bounce In',
					'jltma-jack-in-box'            => 'Jack In the Box',


				),
				'default'            => '',
				'prefix_class'       => 'jltma-appear-watch-animation ',
				'label_block'        => false
			)
		);


		$widget->add_control(
			'ma_el_animation_duration',
			array(
				'label'     => __( 'Duration', MELA_TD ) . ' (ms)',
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'min'       => 0,
				'step'      => 100,
				'selectors'    => array(
					'{{WRAPPER}}' => 'animation-duration:{{SIZE}}ms;'
				),
				'condition' => array(
					'ma_el_animation_name!' => ''
				),
				'render_type' => 'template'
			)
		);

		$widget->add_control(
			'ma_el_animation_delay',
			array(
				'label'     => __( 'Delay', MELA_TD ) . ' (ms)',
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'min'       => 0,
				'step'      => 100,
				'selectors' => array(
					'{{WRAPPER}}' => 'animation-delay:{{SIZE}}ms;'
				),
				'condition' => array(
					'ma_el_animation_name!' => ''
				)
			)
		);

		$widget->add_control(
			'ma_el_animation_easing',
			array(
				'label'   => __( 'Easing', MELA_TD ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''                       => 'Default',
					'initial'                => 'Initial',

					'linear'                 => 'Linear',
					'ease-out'               => 'Ease Out',
					'0.19,1,0.22,1'          => 'Ease In Out',

					'0.47,0,0.745,0.715'     => 'Sine In',
					'0.39,0.575,0.565,1'     => 'Sine Out',
					'0.445,0.05,0.55,0.95'   => 'Sine In Out',

					'0.55,0.085,0.68,0.53'   => 'Quad In',
					'0.25,0.46,0.45,0.94'    => 'Quad Out',
					'0.455,0.03,0.515,0.955' => 'Quad In Out',

					'0.55,0.055,0.675,0.19'  => 'Cubic In',
					'0.215,0.61,0.355,1'     => 'Cubic Out',
					'0.645,0.045,0.355,1'    => 'Cubic In Out',

					'0.895,0.03,0.685,0.22'  => 'Quart In',
					'0.165,0.84,0.44,1'      => 'Quart Out',
					'0.77,0,0.175,1'         => 'Quart In Out',

					'0.895,0.03,0.685,0.22'  => 'Quint In',
					'0.895,0.03,0.685,0.22'  => 'Quint Out',
					'0.895,0.03,0.685,0.22'  => 'Quint In Out',

					'0.95,0.05,0.795,0.035'  => 'Expo In',
					'0.19,1,0.22,1'          => 'Expo Out',
					'1,0,0,1'                => 'Expo In Out',

					'0.6,0.04,0.98,0.335'    => 'Circ In',
					'0.075,0.82,0.165,1'     => 'Circ Out',
					'0.785,0.135,0.15,0.86'  => 'Circ In Out',

					'0.6,-0.28,0.735,0.045'  => 'Back In',
					'0.175,0.885,0.32,1.275' => 'Back Out',
					'0.68,-0.55,0.265,1.55'  => 'Back In Out'
				),
				'selectors' => array(
					'{{WRAPPER}}' => 'animation-timing-function:cubic-bezier({{VALUE}});'
				),
				'condition' => array(
					'ma_el_animation_name!' => ''
				),
				'default'      => '',
				'return_value' => ''
			)
		);

		$widget->add_control(
			'ma_el_animation_count',
			array(
				'label'   => __( 'Repeat Count', MELA_TD ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''  => __( 'Default', MELA_TD ),
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'infinite' => __( 'Infinite', MELA_TD )
				),
				'selectors' => array(
					'{{WRAPPER}}' => 'animation-iteration-count:{{VALUE}};opacity:1;' // opacity is required to prevent flick between repetitions
				),
				'condition' => array(
					'ma_el_animation_name!' => ''
				),
				'default'      => ''
			)
		);

		$widget->end_controls_section();
	}


	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}



}

Master_Addons_Entrance_Animation::get_instance();
