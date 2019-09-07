<?php
	namespace MasterAddons\Inc\Templates\Classes;

	use MasterAddons\Inc\Templates;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 9/8/19
	 */

	if( ! defined( 'ABSPATH' ) ) exit; // No access of directly access

	if( ! class_exists('Master_Addons_Templates_Assets') ) {


		class Master_Addons_Templates_Assets {


			private static $instance = null;

			public function __construct() {

				add_action( 'elementor/preview/enqueue_styles', array( $this, 'enqueue_preview_styles' ) );

				add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'editor_scripts' ), 0 );

				add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_styles' ) );

				add_action( 'elementor/editor/footer', array( $this, 'load_footer_scripts') );

			}


			public function editor_styles() {

				wp_enqueue_style(
					'master-editor-only',
					MELA_PLUGIN_URL . '/assets/templates/css/editor.css',
					[],
					self::VERSION
				);

			}


			public function enqueue_preview_styles() {

				wp_enqueue_style(
					'master-addons-editor-preview',
					MELA_PLUGIN_URL . '/assets/templates/css/preview.css',
					array(),
					self::VERSION,
					'all'
				);

			}


			public function editor_scripts() {

				wp_enqueue_script( 'master-addons-editor',
					MELA_PLUGIN_URL . '/assets/templates/js/editor.js',
					array(
						'jquery',
						'underscore',
						'backbone-marionette'
					),
					self::VERSION,
					true
				);


//				$button = Templates\premium_templates()->config->get('master_addons_templates');
//				$button = 'Buttons';
//				wp_localize_script( 'master-addons-editor', 'MasterAddonsData', apply_filters(
//						'master-addons-core/assets/editor/localize',
//						array(
//							'MasterAddonsEditorBtn'   => $button,
//							'modalRegions'          => $this->get_modal_region(),
//							'license'               => array(
//								'status'        => MasterAddons\Inc\Templates\premium_templates()->config->get('status'),
//								'activateLink'  => MasterAddons\Inc\Templates\premium_templates()->config->get('license_page'),
//								'proMessage'    => MasterAddons\Inc\Templates\premium_templates()->config->get('pro_message')
//							)
//						))
//				);


				$button = Templates\premium_templates()->config->get('premium_temps');

				wp_localize_script( 'premium-temps-editor', 'PremiumTempsData', apply_filters(
						'premium-templates-core/assets/editor/localize',
						array(
							'PremiumTemplatesBtn'   => $button,
							'modalRegions'          => $this->get_modal_region(),
							'license'               => array(
								'status'        => Templates\premium_templates()->config->get('status'),
								'activateLink'  => Templates\premium_templates()->config->get('license_page'),
								'proMessage'    => Templates\premium_templates()->config->get('pro_message')
							)
						))
				);

			}


			public function get_modal_region() {

				return array(
					'modalHeader'  => '.dialog-header',
					'modalContent' => '.dialog-message',
				);

			}


			public function load_footer_scripts() {


				$scripts = glob( MELA_PLUGIN_PATH . 'inc/templates/editor/*.php' );

				array_map( function( $file ) {

					$name = basename( $file, '.php' );
					ob_start();
					include $file;
					printf( '<script type="text/html" id="ma-el-modal-template-%1$s">%2$s</script>', $name, ob_get_clean() );

				}, $scripts);



			}


			public static function get_instance() {

				if( self::$instance == null ) {

					self::$instance = new self;

				}

				return self::$instance;

			}


		}

	}