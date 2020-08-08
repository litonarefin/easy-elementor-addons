<?php
namespace MasterAddons\Admin\Dashboard;
use MasterAddons\Master_Elementor_Addons;

/*
	* Master Admin Dashboard Page
	* Jewel Theme < Liton Arefin >
	*/

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) { exit(); }

class Master_Addons_Admin_Settings{

	public $menu_title;

	// Master Addons Elements Property
	private $maad_el_default_settings;
	private $maad_el_settings;
	private $maad_el_get_settings;

	// Master Addons Elements Property
	private $ma_el_default_extensions_settings;
	private $maad_el_extension_settings;
	private $maad_el_get_extension_settings;


	public function __construct() {

		$this->init();

		add_action( 'admin_menu', [ $this, 'master_addons_admin_menu' ],  '', 10);
		add_action( 'admin_enqueue_scripts', [ $this, 'master_addons_el_admin_scripts' ], 99 );

		// Master Addons Elements
		add_action( 'wp_ajax_master_addons_save_elements_settings', [ $this, 'master_addons_save_elements_settings' ] );
		add_action( 'wp_ajax_nopriv_master_addons_save_elements_settings', [ $this, 'master_addons_save_elements_settings' ] );

		// Master Addons Extensions
		add_action( 'wp_ajax_master_addons_save_extensions_settings', [ $this, 'master_addons_save_extensions_settings'
		] );
		add_action( 'wp_ajax_nopriv_master_addons_save_extensions_settings', [ $this, 'master_addons_save_extensions_settings'
		] );

		$this->ma_el_include_files();
	}

	public function init(){
        if(!get_option('jltma_activation_time')){
			add_option('jltma_activation_time', strtotime("now") );
		}
	}


	public function ma_el_include_files(){
		include_once MELA_PLUGIN_PATH . '/inc/admin/promotions.php';
	}

	public function get_menu_title() {
		return ( $this->menu_title ) ? $this->menu_title : $this->get_page_title();
	}

	protected function get_page_title() {
		return __( 'Master Addons', MELA_TD );
	}

	public function master_addons_admin_menu(){
		add_menu_page(
			esc_html__( 'Master Addons for Elementor', MELA_TD ), // Page Title
			esc_html__( 'Master Addons', MELA_TD ),    // Menu Title
			'manage_options',
			'master-addons-settings',
			[ $this, 'master_addons_el_page_content' ],
			MELA_IMAGE_DIR . 'icon.png',
			57
		);
	}


	public function master_addons_el_admin_scripts( $hook ) {
		$screen = get_current_screen();

		// Load Scripts only Master Addons Admin Page
		if($screen->id == 'toplevel_page_master-addons-settings'){

			//CSS
			wp_enqueue_style( 'master-addons-notice', MELA_ADMIN_ASSETS . 'css/master-addons-notice.css' );
			wp_enqueue_style( 'master-addons-el-admin', MELA_ADMIN_ASSETS . 'css/master-addons-admin.css' );
			wp_enqueue_style( 'sweetalert', MELA_ADMIN_ASSETS .'css/sweetalert2.min.css');
			wp_enqueue_style( 'master-addons-el-switch', MELA_ADMIN_ASSETS .'css/switch.css');

			//JS
			wp_enqueue_script( 'master-addons-el-admin', MELA_ADMIN_ASSETS . 'js/master-addons-admin.js', ['jquery'], MELA_VERSION, true );
			wp_enqueue_script( 'master-addons-el-welcome-tabs', MELA_ADMIN_ASSETS .'js/welcome-tabs.js', ['jquery'], MELA_VERSION, true );
			wp_enqueue_script( 'sweetalert', MELA_ADMIN_ASSETS .'js/sweetalert2.min.js', ['jquery'], MELA_VERSION, true );


			$jltma_localize_admin_script = array(
				'ajaxurl' 				=> admin_url( 'admin-ajax.php' ),
				'ajax_nonce' 			=> wp_create_nonce( 'maad_el_settings_nonce_action' ),
				'ajax_extensions_nonce' => wp_create_nonce( 'ma_el_extensions_settings_nonce_action' )
			);
			wp_localize_script( 'master-addons-el-admin', 'js_maad_el_settings', $jltma_localize_admin_script );


		}

		// Admin Notice Dismiss
		wp_enqueue_script( 'jltma-dismiss-notice', MELA_ADMIN_ASSETS . 'js/dismiss-notice.js', ['jquery'], MELA_VERSION, true );

		// Localize Script
		if ( is_customize_preview() ) { return; }
		wp_localize_script( 'jltma-dismiss-notice', 'dismissible_notice', array( 'nonce' => wp_create_nonce( 'dismissible-notice' )));

	}



	public function master_addons_el_page_content(){

		// Master Addons Elements
		$this->maad_el_default_settings = array_fill_keys( ma_el_array_flatten(
			Master_Elementor_Addons::$maad_el_default_widgets ), true );

		$this->maad_el_get_settings = get_option( 'maad_el_save_settings', $this->maad_el_default_settings );
		$maad_el_new_settings = array_diff_key( $this->maad_el_default_settings, $this->maad_el_get_settings );

		if( ! empty( $maad_el_new_settings ) ) {
			$maad_el_updated_addons_settings = array_merge( $this->maad_el_get_settings, $maad_el_new_settings );
			update_option( 'maad_el_save_settings', $maad_el_updated_addons_settings );
		}

		// Master Addons Extensions
		$this->ma_el_default_extensions_settings = array_fill_keys( ma_el_array_flatten(Master_Elementor_Addons::$ma_el_extensions ), true);
		$this->maad_el_get_extension_settings = get_option( 'ma_el_extensions_save_settings', $this->ma_el_default_extensions_settings );
		$maad_el_new_extensions_settings = array_diff_key( $this->ma_el_default_extensions_settings,
			$this->maad_el_get_extension_settings );

		if( ! empty( $maad_el_new_extensions_settings ) ) {
			$maad_el_updated_extension_settings = array_merge( $this->maad_el_get_extension_settings,
				$maad_el_new_extensions_settings );
			update_option( 'ma_el_extensions_save_settings', $maad_el_updated_extension_settings );
		}

		// Welcome Page
		include MELA_PLUGIN_PATH . '/inc/admin/welcome.php';

	}




	public function master_addons_save_extensions_settings() {

		check_ajax_referer( 'ma_el_extensions_settings_nonce_action', 'security' );

		if( isset( $_POST['fields'] ) ) {
			parse_str( $_POST['fields'], $settings );
		} else {
			return;
		}

		$this->maad_el_extension_settings = [];

		foreach( ma_el_array_flatten( Master_Elementor_Addons::$ma_el_extensions ) as $value ){

			if( isset( $settings[ $value ] ) ) {
				$this->maad_el_extension_settings[ $value ] = 1;
			} else {
				$this->maad_el_extension_settings[ $value ] = 0;
			}
		}
		update_option( 'ma_el_extensions_save_settings', $this->maad_el_extension_settings );


		return true;
		die();

	}


	public function master_addons_save_elements_settings() {

		check_ajax_referer( 'maad_el_settings_nonce_action', 'security' );

		if( isset( $_POST['fields'] ) ) {
			parse_str( $_POST['fields'], $settings );
		} else {
			return;
		}

		$this->maad_el_settings = [];

		foreach( ma_el_array_flatten( Master_Elementor_Addons::$maad_el_default_widgets ) as $value ){

			if( isset( $settings[ $value ] ) ) {
				$this->maad_el_settings[ $value ] = 1;
			} else {
				$this->maad_el_settings[ $value ] = 0;
			}
		}

		update_option( 'maad_el_save_settings', $this->maad_el_settings );

		// Google Map API key
//		update_option( 'maad_el_google_map_api_option', $settings['google_map_api_key'] );

		return true;
		die();

	}



}

new Master_Addons_Admin_Settings();