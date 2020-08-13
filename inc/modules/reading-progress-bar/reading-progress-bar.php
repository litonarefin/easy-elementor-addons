<?php
	namespace MasterAddons\Modules;

	// Elementor Classes
	use \Elementor\Controls_Manager;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 10/12/19
	 */
	// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) { exit; }

	/**
	 * Master Addons: Content Reading Progress bar & Scroll Indicator
	 */
	class Master_Addons_Reading_Progress_Bar {

		private static $_instance = null;

		public function __construct(){
			add_action('elementor/documents/register_controls', [$this, 'jltma_rpb_register_controls'], 10);
			// add_action('wp_footer', [$this, 'jltma_reading_progress_bar_render']);
			// add_action( 'wp_enqueue_scripts', [$this, 'jltma_reading_progress_bar_scripts'] );
			// add_action( 'wp_head', [$this, 'jltma_reading_progress_bar_scripts'] );
		}

		public function jltma_rpb_register_controls( $element ){

	        // $template_name = get_post_meta($id, '_elementor_template_type', true);
	        // $template_list = [ 'footer', 'header', 'section', 'popup' ];
	        
	        // if(in_array($template_name, $template_list)){
	        // 	return false;	
	        // } 

			$global_settings = get_option('jltma_global_settings');

			$element->start_controls_section(
				'jltma_reading_progress_bar_section',
				[
					'tab' 			=> Controls_Manager::TAB_SETTINGS,
					'label' 		=> MA_EL_BADGE . esc_html__( ' Reading Progress Bar', MELA_TD )
				]
			);

			$element->add_control(
				'jltma_enable_reading_progress_bar',
				[
					'type'  		=> Controls_Manager::SWITCHER,
					'label' 		=> esc_html__('Enable Reading Progress Bar', MELA_TD),
					'default' 		=> '',
					'label_on' 		=> esc_html__( 'Yes', MELA_TD ),
					'label_off' 	=> esc_html__( 'No', MELA_TD ),
					'return_value' 	=> 'yes'
				]
			);


	        $element->add_control(
	            'jltma_reading_progress_has_global',
	            [
	                'label' => __('Enabled Globally?', MELA_TD),
	                'type' => \Elementor\Controls_Manager::HIDDEN,
	                'default' => isset($global_settings['reading_progress']['enabled']) ? true : false,
	            ]
	        );


	        if (isset($global_settings['reading_progress']['enabled']) && ($global_settings['reading_progress']['enabled'] == true) && get_the_ID() != $global_settings['reading_progress']['post_id'] && get_post_status($global_settings['reading_progress']['post_id']) == 'publish') {

	            $element->add_control(
	                'jltma_global_warning_text',
	                [
	                    'type' => Controls_Manager::RAW_HTML,
	                    'raw' => __('You can modify the Global Reading Progress Bar by <strong><a href="' . get_bloginfo('url') . '/wp-admin/post.php?post=' . $global_settings['reading_progress']['post_id'] . '&action=elementor">Clicking Here</a></strong>', MELA_TD),
	                    'content_classes' => 'elementor-warning',
	                    'separator' => 'before',
	                    'condition' => [
	                        'jltma_enable_reading_progress_bar' => 'yes',
	                    ],
	                ]
	            );

        	} else{

				$element->add_control(
					'jltma_reading_progress_bar_enable_global',
					[
						'label' 		=> esc_html__('Entire Site?', MELA_TD),
						'description' 	=> esc_html__('Enable to apply entire site', MELA_TD),
						'type' 			=> Controls_Manager::SWITCHER,
						'default' 		=> 'no',
						'label_on' 		=> esc_html__('Yes', MELA_TD),
						'label_off' 	=> esc_html__('No', MELA_TD),
						'return_value' 	=> 'yes',
						'condition' 	=> [
							'jltma_enable_reading_progress_bar' => 'yes',
						],
					]
				);

				$element->add_control(
					'jltma_reading_progress_bar_global_condition',
					[
						'label' 		=> esc_html__('Display On', MELA_TD),
						'type' 			=> \Elementor\Controls_Manager::SELECT,
						'default' 		=> 'all',
						'options' 	=> [
							'posts' 	=> esc_html__('All Posts', MELA_TD),
							'pages' 	=> esc_html__('All Pages', MELA_TD),
							'all' 		=> esc_html__('All Posts & Pages', MELA_TD),
						],
						'condition' => [
							'jltma_enable_reading_progress_bar' => 'yes',
							'jltma_reading_progress_bar_enable_global' => 'yes',
						]
					]
				);

        	}



			// $element->add_control(
			// 	'jltma_enable_reading_progress_bar_id',
			// 	[
			// 		'label' 		=> esc_html__('Single Post/Page Scrollbar', MELA_TD),
			// 		'type' 			=> \Elementor\Controls_Manager::HIDDEN,
			// 		'default' 		=> get_the_ID(),
			// 		'condition' 	=> [
			// 			'jltma_enable_reading_progress_bar' => 'yes',
			// 		],
			// 	]
			// );

			$element->add_control(
				'jltma_reading_progress_bar_position',
				[
					'label' 		=> esc_html__('Position', MELA_TD),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'top',
					'label_block' 	=> false,
					'options' 		=> [
						'top' 		=> esc_html__('Top', MELA_TD),
						'bottom' 	=> esc_html__('Bottom', MELA_TD),
					],
					'condition' 	=> [
						'jltma_enable_reading_progress_bar' => 'yes',
					],

					'selectors' => [
						'.ma-el-page-scroll-indicator, .logged-in.admin-bar .ma-el-page-scroll-indicator' => 'top:inherit; bottom:0;',
					],

				]
			);




			$element->add_control(
				'jltma_reading_progress_bar_height',
				[
					'label' => esc_html__('Height', MELA_TD),
					'type' => Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 5,
					],
					'selectors' => [
						'.ma-el-page-scroll-indicator, .ma-el-scroll-indicator' => 'height: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'jltma_enable_reading_progress_bar' => 'yes',
					],
				]
			);

			$element->add_control(
				'jltma_reading_progress_bar_bg_color',
				[
					'label' => esc_html__('Background Color', MELA_TD),
					'type' => Controls_Manager::COLOR,
					'default' => '#fff',
					'selectors' => [
						'.ma-el-page-scroll-indicator' => 'background: {{VALUE}}',
					],
					'condition' => [
						'jltma_enable_reading_progress_bar' => 'yes',
					],
				]
			);

			$element->add_control(
				'jltma_reading_progress_bar_fill_color',
				[
					'label' => esc_html__('Fill Color', MELA_TD),
					'type' => Controls_Manager::COLOR,
					'default' => '#007bff',
					'selectors' => [
						'ma-el-scroll-indicator' => 'background: {{VALUE}}',
					],
					'condition' => [
						'jltma_enable_reading_progress_bar' => 'yes',
					],
				]
			);

			$element->add_control(
				'jltma_reading_progress_bar_animation_speed',
				[
					'label' => esc_html__('Animation Speed', MELA_TD),
					'type' => Controls_Manager::SLIDER,
					'size_units' => ['px'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 50,
					],
					'selectors' => [
						'.ma-el-scroll-indicator' => 'transition: width {{SIZE}}ms ease;',
					],
					'condition' => [
						'jltma_enable_reading_progress_bar' => 'yes',
					],
				]
			);

			$element->end_controls_section();
		}


		public function jltma_reading_progress_bar_scripts(){
			global $post;
			$post_id = $post->ID;

			if (is_singular() && did_action('elementor/loaded')) {

				$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers('page');
				$page_settings_model = $page_settings_manager->get_model($post_id);

				$jltma_r_p_b_height  			= $page_settings_model->get_settings('jltma_reading_progress_bar_height');
				$jltma_r_p_b_bg_color  			= $page_settings_model->get_settings('jltma_reading_progress_bar_bg_color');
				$jltma_r_p_b_fill_color  		= $page_settings_model->get_settings('jltma_reading_progress_bar_fill_color');
				$jltma_r_p_b_animation_speed  	= $page_settings_model->get_settings('jltma_reading_progress_bar_animation_speed');

				if( $jltma_r_p_b_bg_color !="" && $jltma_r_p_b_fill_color !="" ){
					$jltma_r_p_b_custom_css = ".ma-el-page-scroll-indicator{ background: {$jltma_r_p_b_bg_color};}
						.ma-el-scroll-indicator{ background: {$jltma_r_p_b_fill_color};}
						.ma-el-page-scroll-indicator, .ma-el-scroll-indicator{ height: {$jltma_r_p_b_height['size']}px;}";
						echo '<style>' . $jltma_r_p_b_custom_css . '</style>';
				}
				
			}

		}


		public function jltma_reading_progress_bar_render() {


			if (is_singular() && did_action('elementor/loaded')) {


				global $post;
				$post_id = $post->ID;
				$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers('page');
				$page_settings_model = $page_settings_manager->get_model($post_id);

				$jlma_reading_bar_condition = $page_settings_model->get_settings('jltma_reading_progress_bar_global_condition');

				$jltma_reading_progress_bar_enable_global = $page_settings_model->get_settings('jltma_reading_progress_bar_enable_global');


				$jltma_reading_progress_bar_html = '<div class="ma-el-page-scroll-indicator">
					<div class="ma-el-scroll-indicator"></div>
				</div>';

				// Need to re-check Global Settings
				// if ( $jltma_reading_progress_bar_enable_global == "no" or
				// ($page_settings_model->get_settings('jltma_enable_reading_progress_bar_id') != $post_id)) {

				// 	if ( $jlma_reading_bar_condition == 'pages' && is_page()) {
				// 		echo $jltma_reading_progress_bar_html;
				// 	} else if ( $jlma_reading_bar_condition == 'posts' && is_single()) {
				// 		echo $jltma_reading_progress_bar_html;
				// 	} else if ( $jlma_reading_bar_condition == 'all' && is_singular()) {
				// 		echo $jltma_reading_progress_bar_html;
				// 	}
				// }

				if( $page_settings_model->get_settings('jltma_enable_reading_progress_bar') == 'yes' ){

					if ( $jltma_reading_progress_bar_enable_global == 'yes') {

						// echo "Global in";
						// die();
						// echo $jltma_reading_progress_bar_html;

						// if(is_single() || is_page()){
							// if(is_singular()){}
							// echo is_single() ? 'Single Page' : is_page() ? 'Pagess ' : 'Others';
							// die();

							if(is_page()){
								echo $jltma_reading_progress_bar_html;
							}
							// echo $jltma_reading_progress_bar_html;
						// }
						// if ( $jlma_reading_bar_condition == 'pages' && is_page()) {
						// 	echo $jltma_reading_progress_bar_html;
						// } else if ( $jlma_reading_bar_condition == 'posts' && is_single()) {
						// 	echo $jltma_reading_progress_bar_html;
						// } else if ( $jlma_reading_bar_condition == 'all' && is_singular()) {
						// 	echo $jltma_reading_progress_bar_html;
						// }

					} else {

						if( $page_settings_model->get_settings('jltma_enable_reading_progress_bar_id') === $post_id ){
							echo $jltma_reading_progress_bar_html;
						}
					}


				} // Enable Progress Bar

			}
		}



		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

	}

	Master_Addons_Reading_Progress_Bar::instance();