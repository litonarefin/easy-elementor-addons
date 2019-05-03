<?php
 namespace Easy_Elementor_Addons_Base;
/*
 * Easy Elementor Addons Constants
 */

if( !class_exists('Easy_Elementor_Addons') ){
	class Easy_Elementor_Addons{
		
		public  $version = "1.0.0";
		private $plugin_path;
		private $plugin_url;
		private $plugin_slug;
		public  $plugin_dir_url;
		public  $plugin_name = 'Easy Elementor Addons';

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

			//Defined Constants
			define( 'EEAEL', $this->plugin_name );
			define( 'EEAEL_VERSION', $this->version );
			define( 'EEAEL_PLUGIN_URL', $this->eeael_plugin_url());
			define( 'EEAEL_PLUGIN_DIR', $this->eeael_plugin_path() );
			define( 'EEAEL_PLUGIN_DIR_URL', $this->eeael_plugin_dir_url());
			define( 'EEAEL_IMAGE_DIR', $this->eeael_plugin_dir_url().'/assets/images/');
			define( 'EEAEL_TD', $this->eeael_load_textdomain());  // Ultimate Gutenberg Text Domain
			define( 'EEAEL_FILE', __FILE__ );
			define( 'EEAEL_DIR', dirname( __FILE__ ) );

			$this->plugin_slug    			= 'easy-elementor-addons';
			$this->plugin_path     			= untrailingslashit( plugin_dir_path( '/', __FILE__ ) );
			$this->plugin_url     			= untrailingslashit( plugins_url( '/', __FILE__ ) );

			//$this->eeael_include_files();
			$this->eeael_define_admin_hooks();			
		}


		public function widgets_registered() {

			// We check if the Elementor plugin has been installed / activated.
			if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){

				// We look for any theme overrides for this custom Elementor element.
				// If no theme overrides are found we use the default one in this plugin.

				$widget_file = 'plugins/easy-elementor-addons/addons/my-widgets.php';
				$template_file = locate_template($widget_file);
				if ( !$template_file || !is_readable( $template_file ) ) {
					$template_file = plugin_dir_path(__FILE__).'/addons/my-widgets.php';
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

								$widget_file   = 'plugins/easy-elementor-addons/addons/my-widgets.php';
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



		// Text Domains
		public function eeael_load_textdomain(){
			load_plugin_textdomain(	'eeael', false, dirname(plugin_basename(__FILE__)) . '/languages/' );
		}

		// Include Files
		public function eeael_include_files(){

		}

		// Admin Hooks
		public function eeael_define_admin_hooks(){
			
		}

		// Plugin URL
		public function eeael_plugin_url(){
	
	        if ($this->plugin_url) return $this->plugin_url;

	        return $this->plugin_url = untrailingslashit(plugins_url('/', __FILE__));
			
		}

		// Plugin Path
		public function eeael_plugin_path(){
	        if ($this->plugin_path) return $this->plugin_path;

	        return $this->plugin_path = untrailingslashit(plugin_dir_path(__FILE__));			
		}

		// Plugin Dir Path
		public function eeael_plugin_dir_url(){
			
		}


	}
}

Easy_Elementor_Addons::get_instance();