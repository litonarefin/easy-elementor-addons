<?php
	/*
	 * Master Admin Dashboard Page
	 * Jewel Theme < Liton Arefin >
	 */

	// Exit if accessed directly
	if( ! defined( 'ABSPATH' ) ) { exit(); }
class Master_Addons_Admin_Settings{

	private $maad_el_default_settings;

	private $maad_el_settings;

	private $maad_el_get_settings;


	public function __construct() {
		add_action( 'admin_menu', [ $this, 'master_addons_admin_menu' ], 590 );
		add_action( 'admin_enqueue_scripts', [ $this, 'master_addons_el_admin_scripts' ] );
		add_action( 'wp_ajax_master_addons_save_elements_settings', [ $this, 'master_addons_save_elements_settings' ] );
		add_action( 'wp_ajax_nopriv_master_addons_save_elements_settings', [ $this, 'master_addons_save_elements_settings' ] );
	}


	public function master_addons_admin_menu(){

		add_submenu_page(
			'elementor',
			esc_html__( 'Master Addons for Elementor', MELA_TD ), // Page Title
			esc_html__( 'Master Addons', MELA_TD ),    // Menu Title
//			'<span class="dashicons dashicons-admin-page" style="font-size: 18px"></span> ' . esc_html__( 'Master Addons', MELA_TD ),
			'manage_options', 'master-addons-settings',
			[ $this, 'master_addons_el_page_content' ]
		);

	}


	public function master_addons_el_admin_scripts( $hook ) {

		wp_enqueue_style( 'master-addons-notice', MELA_ADMIN_ASSETS . 'css/master-addons-notice.css' );

		if( isset( $hook ) && $hook == 'elementor_page_master-addons-settings' ) {
			wp_enqueue_style( 'master-addons-el-admin', MELA_ADMIN_ASSETS . 'css/master-addons-admin.css' );
			wp_enqueue_script( 'master-addons-el-admin', MELA_ADMIN_ASSETS . 'js/master-addons-admin.js', array
            ('jquery'), '1.0', true );
			wp_enqueue_script( 'master-addons-el-welcome-tabs', MELA_ADMIN_ASSETS .'js/welcome-tabs.js', array('jquery'), MELA_VERSION, true );

			//Accordion
			wp_enqueue_script( 'jquery-ui-accordion' );

		}


	}


	public function master_addons_el_page_content(){
        include_once MELA_PLUGIN_PATH . '/inc/admin/welcome.php';

		$js_info = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'maad_el_settings_nonce_action' )
		);
		wp_localize_script( 'master-addons-el-admin', 'js_maad_el_settings', $js_info );


		$this->maad_el_default_settings = array_fill_keys( Master_Elementor_Addons::$maad_el_default_widgets, true );
		$this->maad_el_get_settings = get_option( 'maad_el_save_settings', $this->maad_el_default_settings );
		$maad_el_new_settings = array_diff_key( $this->maad_el_default_settings, $this->maad_el_get_settings );

		if( ! empty( $maad_el_new_settings ) ) {
			$maad_el_updated_settings = array_merge( $this->maad_el_get_settings, $maad_el_new_settings );
			update_option( 'maad_el_save_settings', $maad_el_updated_settings );
		}
		$this->maad_el_get_settings = get_option( 'maad_el_save_settings', $this->maad_el_default_settings );

		?>

	<?php


	}




	public function master_addons_save_elements_settings() {

		check_ajax_referer( 'maad_el_settings_nonce_action', 'security' );

		if( isset( $_POST['fields'] ) ) {
			parse_str( $_POST['fields'], $settings );
		} else {
			return;
		}

		$this->maad_el_settings = [];

		foreach( Master_Elementor_Addons::$maad_el_default_widgets as $value ){
			if( isset( $settings[ $value ] ) ) {
				$this->maad_el_settings[ $value ] = 1;
			} else {
				$this->maad_el_settings[ $value ] = 0;
			}
		}
		update_option( 'maad_el_save_settings', $this->maad_el_settings );

		// Google Map API key
		update_option( 'maad_el_google_map_api_option', $settings['google_map_api_key'] );

		return true;
		die();

	}



}

new Master_Addons_Admin_Settings();