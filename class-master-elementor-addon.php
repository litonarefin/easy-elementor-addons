<?php
 namespace Master_Elementor_Addons;
/*
 * Master Elementor Addons Constants
 */


//Defined Constants
define( 'MELA', $this->plugin_name );
define( 'MELA_VERSION', $this->version );
define( 'MELA_BASE', plugin_basename( __FILE__ ) );
define( 'MELA_PLUGIN_URL', Master_Elementor_Addons::mela_plugin_url());
define( 'MELA_PLUGIN_PATH', $this->mela_plugin_path() );
define( 'MELA_PLUGIN_PATH_URL', $this->mela_plugin_dir_url());
define( 'MELA_IMAGE_DIR', $this->mela_plugin_dir_url().'/assets/images/');
define( 'MELA_TD', $this->mela_load_textdomain());  // Ultimate Gutenberg Text Domain
define( 'MELA_FILE', __FILE__ );
define( 'MELA_DIR', dirname( __FILE__ ) );

if( !class_exists('Master_Elementor_Addons') ){
	class Master_Elementor_Addons{
		
		public  $version = "1.0.0";
		private $plugin_path;
		private $plugin_url;
		private $plugin_slug;
		public  $plugin_dir_url;
		public  $plugin_name = 'Master Elementor Addons';

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

			$this->plugin_slug    			= 'master-elementor-addons';
			$this->plugin_path     			= untrailingslashit( plugin_dir_path( '/', __FILE__ ) );
			$this->plugin_url     			= untrailingslashit( plugins_url( '/', __FILE__ ) );

			//$this->mela_include_files();
			$this->mela_define_admin_hooks();			
		}


		public function widgets_registered() {

			// We check if the Elementor plugin has been installed / activated.
			if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){

				// We look for any theme overrides for this custom Elementor element.
				// If no theme overrides are found we use the default one in this plugin.

				$widget_file = 'plugins/master-elementor-addons/addons/my-widgets.php';
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



		// Text Domains
		public function mela_load_textdomain(){
			load_plugin_textdomain(	'eeael', false, dirname(plugin_basename(__FILE__)) . '/languages/' );
		}

		// Include Files
		public function mela_include_files(){

		}

		// Admin Hooks
		public function mela_define_admin_hooks(){
			
		}

		// Plugin URL
		public static function mela_plugin_url(){
	
	        if ($this->plugin_url) return $this->plugin_url;

	        return $this->plugin_url = untrailingslashit(plugins_url('/', __FILE__));
			
		}

		// Plugin Path
		public function mela_plugin_path(){
	        if ($this->plugin_path) return $this->plugin_path;

	        return $this->plugin_path = untrailingslashit(plugin_dir_path(__FILE__));			
		}

		// Plugin Dir Path
		public function mela_plugin_dir_url(){
			
		}


	}
}

Master_Elementor_Addons::get_instance();