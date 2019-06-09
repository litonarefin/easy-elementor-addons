<?php
	namespace MasterAddons;

	use Elementor\Utils;

	/*
	 * Master Elementor Addons Constants
	 */

//require_once "vendor/autoload.php";

if( !class_exists('Master_Elementor_Addons_Class') ){
	
	class Master_Elementor_Addons_Class{

		private $_localize_settings = [];

		private static $instance = null;
	   	
	   	public static function get_instance() {
			if ( ! self::$instance )
				self::$instance = new self;
			return self::$instance;			
	   	}

		/* Initialize */
		public function init(){		
//			add_action( 'elementor/init', array( $this, 'widgets_registered' ) );
		}

		public function __construct(){

			spl_autoload_register( [ $this, 'autoloader' ] );

			$this->include_files();
		}

		public function include_files(){
//			require \Master_Elementor_Addons::mela_plugin_path() . '/inc/classes/addons-manager.php';
			require \Master_Elementor_Addons::mela_plugin_path() . '/addons/business-hours/module.php';
		}

		public function autoloader( $class ) {
//			echo '<pre>' . $class . '</pre>';
//			echo __NAMESPACE__;
//			if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
//				return;
//			}

			$filename = strtolower(
				preg_replace(
					[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
					[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
					$class
				)
			);
			$filename = \Master_Elementor_Addons::mela_plugin_path() . $filename . '.php';

			if ( is_readable( $filename ) ) {
				include( $filename );
			}
		}


		public function get_localize_settings() {
			return $this->_localize_settings;
		}

		public function add_localize_settings( $setting_key, $setting_value = null ) {
			if ( is_array( $setting_key ) ) {
				$this->_localize_settings = array_replace_recursive( $this->_localize_settings, $setting_key );

				return;
			}

			if ( ! is_array( $setting_value ) || ! isset( $this->_localize_settings[ $setting_key ] ) || ! is_array( $this->_localize_settings[ $setting_key ] ) ) {
				$this->_localize_settings[ $setting_key ] = $setting_value;

				return;
			}

			$this->_localize_settings[ $setting_key ] = array_replace_recursive( $this->_localize_settings[ $setting_key ], $setting_value );
		}

		public function widgets_registered() {

			// We check if the Elementor plugin has been installed / activated.
			if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){

				// We look for any theme overrides for this custom Elementor element.
				// If no theme overrides are found we use the default one in this plugin.

				$widget_file = Master_Elementor_Addons::mela_plugin_path() . '/inc/addons/my-widgets.php';
				$template_file = locate_template($widget_file);
				if ( !$template_file || !is_readable( $template_file ) ) {
					$template_file = Master_Elementor_Addons::mela_plugin_path() . '/inc/addons/my-widgets.php';
				}
				if ( $template_file && is_readable( $template_file ) ) {
					require_once $template_file;
				}
			}
			if ( defined( 'ELEMENTOR_PATH' ) && class_exists( 'Elementor\Widget_Base' ) ) {
				// get our own widgets up and running:
				// copied from widgets-manager.php

				if ( class_exists( 'Elementor\Plugin' ) ) {
					if ( is_callable( 'Elementor\Plugin', 'instance' ) ) {
						$elementor = Elementor\Plugin::instance();
						if ( isset( $elementor->widgets_manager ) ) {
							if ( method_exists( $elementor->widgets_manager, 'register_widget_type' ) ) {

								$widget_file   = Master_Elementor_Addons::mela_plugin_path() . '/inc/addons/my-widgets.php';
								$template_file = locate_template( $widget_file );
								if ( $template_file && is_readable( $template_file ) ) {
									require_once $template_file;
									Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor\Widget_My_Custom_Elementor_Thing() );

								}
							}
						}
					}
				}
			}
		}



	}

	Master_Elementor_Addons_Class::get_instance();

}

