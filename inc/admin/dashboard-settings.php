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
            esc_html__('Version Controls', MELA_TD),
            esc_html__('Version Controls', MELA_TD),
            'manage_options',
            'master-addons-version-control',
            array( $this, 'jltma_version_control'),
            
        );

	}


	public function jltma_version_control(){ ?>

<div class="master_addons">
	<div class="wrappper about-wrap">

        <div class="intro_wrapper">

            <header class="header">
				<a class="ma_el_logo" href="https://wordpress.org/plugins/master-addons" target="_blank">
                    <div class="wp-badge welcome__logo ma_logo"></div>
				</a>

                <h1 class="ma_title">
			        <?php printf( __( '%s <small>v %s</small>'), MELA, JLTMA_PLUGIN_VERSION ); ?>
				</h1>

                <div class="about-text"></div>
            </header>

        </div>

		<div class="master_addons_contents" style="margin-top: -20px;">
			
			<div class="response-wrap"></div>

			<div class="mb-4">
				<h2 class="jltma-roll-back" style="text-align: left; margin-bottom: 5px; margin-left: 5px;">
					<?php echo __('Rollback to Previous Version', MELA_TD); ?>
				</h2>
				<p class="jltma-roll-back-span"><?php echo sprintf( __('Experiencing an issue with Master Addons for Elementor version <strong>%s</strong>? Rollback to a previous version before the issue appeared.', MELA_TD), MELA_VERSION ); ?></p>
			</div>				


			<div class="border border-muted p-3 mt-4 mb-4 align-left">
				<div class="jltma-row">
						
					<div class="jltma-col-4">
						<h3><?php echo __('Rollback Version', MELA_TD); ?></h3> 	
					</div>
					<div class="jltma-col-8">
					 	<div class="pt-4">
					 		<?php echo  sprintf( '<a href="%1$s" class="button jltma-btn jltma-rollback-button elementor-button-spinner">%2$s</a>', wp_nonce_url( admin_url( 'admin-post.php?action=master_addons_rollback' ), 'master_addons_rollback' ), __('Rollback to Version ' . JLTMA_STABLE_VERSION, MELA_TD) ); ?>		
					 	</div>
						<p class="jltma-roll-desc pt-2 text-danger">
						    <?php echo __('Warning: Please backup your database before making the rollback.', MELA_TD); ?>
						</p>				 	
					</div>

				</div>
			</div>		
		
		</div> <!-- .master_addons_contents -->

	</div>
</div>

    

	<?php }


	public function master_addons_el_admin_scripts( $hook ) {
		$screen = get_current_screen();

		// Load Scripts only Master Addons Admin Page
		if($screen->id == 'toplevel_page_master-addons-settings'){

			//CSS
			// wp_enqueue_style( 'master-addons-notice', MELA_ADMIN_ASSETS . 'css/master-addons-notice.css' );
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

		// Rollback Version
		if($screen->id == 'master-addons_page_master-addons-version-control'){

			//CSS
			wp_enqueue_style( 'bootstrap', MELA_PLUGIN_URL . '/assets/css/bootstrap.min.css');
			wp_enqueue_style( 'master-addons-el-admin', MELA_ADMIN_ASSETS . 'css/master-addons-admin.css' );

			//JS
			wp_enqueue_script( 'master-addons-el-admin', MELA_ADMIN_ASSETS . 'js/master-addons-admin.js', ['jquery'], MELA_VERSION, true );

	        wp_localize_script(
	            'master-addons-el-admin',
	            'jltmaRollBackConfirm',
	            [
	                'home_url'  => home_url(),
	                'i18n' => [
						'rollback_confirm' => __( 'Are you sure you want to reinstall version ' . JLTMA_STABLE_VERSION . ' ?', MELA_TD ),
						'rollback_to_previous_version' => __( 'Rollback to Previous Version', MELA_TD ),
						'yes' => __( 'Yes', MELA_TD ),
						'cancel' => __( 'Cancel', MELA_TD ),
					],
	            ]
	        );			
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