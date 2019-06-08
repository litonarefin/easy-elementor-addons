<?php
// namespace Master_Elementor_Addons_Class;
/*
 * Master Elementor Addons Constants
 */

require_once "vendor/autoload.php";

if( !class_exists('Master_Elementor_Addons_Class') ){
	
	class Master_Elementor_Addons_Class{
		

		private static $instance = null;
	   	
	   	public static function get_instance() {
			if ( ! self::$instance )
				self::$instance = new self;
			return self::$instance;			
	   	}

		/* Initialize */
		public function init(){		
			add_action( 'elementor/init', array( $this, 'widgets_registered' ) );
		}

		public function __construct(){

			//$this->mela_include_files();

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

								$widget_file   = 'plugins/master-elementor-addons/addons/my-widgets.php';
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

