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

	// Master Addons Third Party Plugins Property
	private $jltma_default_third_party_plugins_settings;
	private $jltma_third_party_plugins_settings;
	private $jltma_get_third_party_plugins_settings;


	public function __construct() {

		add_action( 'admin_menu', [ $this, 'master_addons_admin_menu' ],  '', 10);
		add_action( 'admin_enqueue_scripts', [ $this, 'master_addons_el_admin_scripts' ], 99 );

		// Master Addons Elements
		add_action( 'wp_ajax_master_addons_save_elements_settings', [ $this, 'master_addons_save_elements_settings' ] );
		add_action( 'wp_ajax_nopriv_master_addons_save_elements_settings', [ $this, 'master_addons_save_elements_settings' ] );

		// Master Addons Extensions
		add_action( 'wp_ajax_master_addons_save_extensions_settings', [ $this, 'master_addons_save_extensions_settings']);
		add_action( 'wp_ajax_nopriv_master_addons_save_extensions_settings', [ $this, 'master_addons_save_extensions_settings']);

		// Master Addons Third Party Plugins
		// add_action( 'wp_ajax_jltma_third_party_plugins_settings', [ $this, 'jltma_third_party_plugins_settings']);
		// add_action( 'wp_ajax_nopriv_jltma_third_party_plugins_settings', [ $this, 'jltma_third_party_plugins_settings']);

		// Master Addons API Settings
		add_action( 'wp_ajax_jltma_save_api_settings', [ $this, 'jltma_save_api_settings']);
		add_action( 'wp_ajax_nopriv_jltma_save_api_settings', [ $this, 'jltma_save_api_settings']);

		$this->ma_el_include_files();
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

        add_submenu_page(
            'master-addons-settings',
            esc_html__('Version Controls', JLTMA_MCB_TD),
            esc_html__('Version Control', JLTMA_MCB_TD),
            'manage_options',
            'master-addons-version-control',
            array( $this, 'jltma_version_control'),
            3
        );

	}


	public function jltma_version_control(){ ?>

		<div class="wrap">
        	<div class="response-wrap"></div>

	       <div class="ma-el-header-wr apper">
	          <div class="ma-el-title-left">
	             <h1 class="ma-el-title-main"><?php echo Master_Elementor_Addons::$plugin_name; ?></h1>
	             <h3 class="ma-el-title-sub"><?php echo sprintf(__('Thank you for using %s. This plugin has been developed by %s and we hope you enjoy using it.',MELA_TD), Master_Elementor_Addons::$plugin_name,Master_Elementor_Addons::$plugin_name ); ?></h3>
	          </div>
	          
                <div class="ma-el-title-right">
                    <img class="ma-el-logo" src="<?php echo MELA_IMAGE_DIR . 'logo.png'; ?>">
                </div>
	       </div>


			<div class="pa-settings-tabs">
			  <div id="pa-maintenance" class="pa-settings-tab">
			     <div class="pa-row">
			        <table class="pa-beta-table">
			           <tr>
			              <th>
			                 <h4 class="pa-roll-back"><?php echo __('Rollback to Previous Version', MELA_TD); ?></h4>
			                 <span class="pa-roll-back-span"><?php echo sprintf( __('Experiencing an issue with Master Addons for Elementor version %s? Rollback to a previous version before the issue appeared.', MELA_TD), MELA_VERSION ); ?></span>
			              </th>
			           </tr>
			           <tr class="pa-roll-row">
			              <th><?php echo __('Rollback Version', MELA_TD); ?></th>
			              <td>
			                 <div><?php echo  sprintf( '<a target="_blank" href="%1$s" class="button pa-btn pa-rollback-button elementor-button-spinner">%2$s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=master_addons_rollback' ), 'master_addons_rollback' ), __('Rollback to Version ' . JLTMA_STABLE_VERSION, MELA_TD) ); ?></div>
			                 <p class="pa-roll-desc">
			                     <span><?php echo __('Warning: Please backup your database before making the rollback.', MELA_TD); ?></span>
			                 </p>
			              </td>
			           </tr>
			        </table>
			        <input type="submit" value="<?php echo __('Save Settings', MELA_TD); ?>" class="button pa-btn pa-save-button">
			     </div>
			  </div>
			</div>	       
		
		</div>	       

	<?php }


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
				'ajax_extensions_nonce' => wp_create_nonce( 'ma_el_extensions_settings_nonce_action' ),
				'ajax_api_nonce' 		=> wp_create_nonce( 'jltma_api_settings_nonce_action' )
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

		// Master Addons Elements Settings
		$this->maad_el_default_settings = array_fill_keys( ma_el_array_flatten( Master_Elementor_Addons::$maad_el_default_widgets ), true );
		$this->maad_el_get_settings 	= get_option( 'maad_el_save_settings', $this->maad_el_default_settings );

		// Master Addons Extensions Settings
		$this->ma_el_default_extensions_settings = array_fill_keys( ma_el_array_flatten(Master_Elementor_Addons::$ma_el_extensions ), true);
		$this->maad_el_get_extension_settings = get_option( 'ma_el_extensions_save_settings', $this->ma_el_default_extensions_settings );


		// Master Addons Third Party Plugins Settings
		$this->jltma_default_third_party_plugins_settings = array_fill_keys( ma_el_array_flatten(Master_Elementor_Addons::$jltma_third_party_plugins ), true);
		$this->jltma_get_third_party_plugins_settings = get_option( 'ma_el_third_party_plugins_save_settings', $this->jltma_default_third_party_plugins_settings );

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


		// Third Party Plugin Settings
		$this->jltma_third_party_plugins_settings = [];

		foreach( ma_el_array_flatten( Master_Elementor_Addons::$jltma_third_party_plugins ) as $value ){

			if( isset( $settings[ $value ] ) ) {
				$this->jltma_third_party_plugins_settings[ $value ] = 1;
			} else {
				$this->jltma_third_party_plugins_settings[ $value ] = 0;
			}
		}
		update_option( 'ma_el_third_party_plugins_save_settings', $this->jltma_third_party_plugins_settings );


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

		return true;
		die();
	}


	public function jltma_save_api_settings() {

		check_ajax_referer( 'jltma_api_settings_nonce_action', 'security' );

		if( isset( $_POST['fields'] ) ) {
			parse_str( $_POST['fields'] );
		} else {
			return;
		}

		$jltma_api_settings = [];

		foreach( $_POST['fields'] as $key=>$value ){
				$jltma_api_settings[ $value['name']] = $value['value'];
		}

		update_option( 'jltma_api_save_settings', $jltma_api_settings );

		return true;
		die();
	}



}

new Master_Addons_Admin_Settings();