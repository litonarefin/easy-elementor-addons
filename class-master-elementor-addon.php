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

		public function __construct(){

//			spl_autoload_register( [ $this, 'autoloader' ] );

			$this->include_files();

			// Initialize Plugin
			add_action('plugins_loaded', [$this, 'mela_init']);


			// Elementor

			//Body Class
			add_filter( 'body_class', [ $this, 'mela_ea_body_class' ] );

		}



		// Initialize
		public function mela_init(){

			// Check if Elementor installed and activated
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', array( $this, 'mela_admin_notice_missing_main_plugin' ) );
				return;
			}

			// Check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', array( $this, 'mela_admin_notice_minimum_elementor_version' ) );
				return;
			}

			// Check for required PHP version
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', array( $this, 'mela_admin_notice_minimum_php_version' ) );
				return;
			}

		}


		public function mela_ea_body_class(){
			if ( !\Elementor\Plugin::$instance->preview->is_preview_mode() ) {
				$classes[] = 'master-addons-elementor';
			}
			return $classes;
		}

		public function include_files(){
			require \Master_Elementor_Addons::mela_plugin_path() . '/inc/classes/addons-manager.php';
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


		public function mela_admin_notice_missing_main_plugin() {
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', MELA_TD ),
				'<strong>' . esc_html__( 'Master Addons for Elementor', MELA_TD ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', MELA_TD ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		public function mela_admin_notice_minimum_elementor_version() {
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', MELA_TD ),
				'<strong>' . esc_html__( 'Master Addons for Elementor', MELA_TD ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', MELA_TD ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		public function mela_admin_notice_minimum_php_version() {
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', MELA_TD ),
				'<strong>' . esc_html__( 'Master Addons for Elementor', MELA_TD ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', MELA_TD ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}



	}

	Master_Elementor_Addons_Class::get_instance();

}

