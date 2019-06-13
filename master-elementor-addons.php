<?php
	/**
 * Plugin Name: Master Addons for Elementor
 * Description: Master Addons is easy and must have Elementor Addons for WordPress Page Builder. Clean, Modern, Hand crafted designed Addons blocks.
 * Plugin URI: https://jeweltheme.com
 * Author: Liton Arefin
 * Version: 1.0.0	
 * Author URI: https://twitter.com/Litonice11
 * Text Domain: mela
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) { exit; } // No, Direct access Sir !!!


final class Master_Elementor_Addons{

    const VERSION = "1.0.0";
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const MINIMUM_PHP_VERSION = '5.4';

    private static $plugin_path;
    private static $plugin_url;
    private static $plugin_slug;
    public static $plugin_dir_url;
    public static $plugin_name = 'Master Addons for Elementor';

	private static $instance = null;

	public $pro_enabled;

	public static $maad_el_default_widgets;
	public static $maad_el_default_form_widgets;


	public static function get_instance() {
		if ( ! self::$instance )
			self::$instance = new self;
		return self::$instance;
	}


	public function __construct(){

		self::$maad_el_default_widgets = [
			'ma-accordion',
//			'ma-tabs',
//			'ma-progress-bar',
			'ma-tooltip',
			'ma-team-members',
			'contact-form-7',
//			'ninja-forms',
//			['contact-form-7','pro'],
//			'ma-business-hours',
//			'master-cards',
//			'countdown-timer',
//			'master-tabs',
//			'master-button',
//			'post-grid',
//			'post-timeline',
//			'team-member',
//			'team-carousel',
//			'testimonial-carousel',
//			'flipbox',
//			'infobox',
//			'pricing-table',

//			'master-heading',
//			'dual-heading',
//			'post-carousel',
//			'google-maps',
//			'tooltip'
		];

		self::$maad_el_default_form_widgets = [
//			'contact-form-7'
		];

		// search for pro version
		$this->pro_enabled = apply_filters('maad_el/pro_enabled', false);

		$this->constants();
		$this->maad_el_include_files();
		$this->mela_define_admin_hooks();

        self::$plugin_slug              = 'master-addons';
        self::$plugin_path              = untrailingslashit( plugin_dir_path( '/', __FILE__ ) );
        self::$plugin_url               = untrailingslashit( plugins_url( '/', __FILE__ ) );

		//Translations
		add_action('init', [$this, 'mela_load_textdomain']);

        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'plugin_actions_links' ] );


		//Redirect Hook
		add_action( 'admin_init', [ $this, 'mael_ad_redirect_hook' ] );


		add_action( 'elementor/init', [ $this, 'mela_category' ] );

		// Enqueue Styles and Scripts
		add_action( 'wp_enqueue_scripts', [ $this, 'maad_el_enqueue_scripts' ], 20 );

		// Elementor Editor Styles
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'maad_el_editor_styles' ] );

		// Add Elementor Widgets
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'maad_el_init_widgets' ) );


	}


	public function constants(){

		//Defined Constants
		if ( ! defined( 'MELA' ) )
			define( 'MELA', self::$plugin_name );

		if ( ! defined( 'MELA_VERSION' ) )
			define( 'MELA_VERSION', self::version() );

		if ( ! defined( 'MELA_BASE' ) )
			define( 'MELA_BASE', plugin_basename( __FILE__ ) );

		if ( ! defined( 'MELA_PLUGIN_URL' ) )
			define( 'MELA_PLUGIN_URL', self::mela_plugin_url());

		if ( ! defined( 'MELA_PLUGIN_PATH' ) )
			define( 'MELA_PLUGIN_PATH', self::mela_plugin_path() );

		if ( ! defined( 'MELA_PLUGIN_PATH_URL' ) )
			define( 'MELA_PLUGIN_PATH_URL', self::mela_plugin_dir_url());

		if ( ! defined( 'MELA_IMAGE_DIR' ) )
			define( 'MELA_IMAGE_DIR', self::mela_plugin_dir_url() . '/assets/images/');

		if ( ! defined( 'MELA_ADMIN_ASSETS' ) )
			define( 'MELA_ADMIN_ASSETS', self::mela_plugin_dir_url() . '/inc/admin/assets/');

		if ( ! defined( 'MAAD_EL_ADDONS' ) )
			define( 'MAAD_EL_ADDONS', plugin_dir_path( __FILE__ ) . 'addons/' );

		if ( ! defined( 'MELA_TEMPLATES' ) )
			define( 'MELA_TEMPLATES', plugin_dir_path( __FILE__ ) . 'inc/template-parts/' );

		// Master Addons Text Domain
		if ( ! defined( 'MELA_TD' ) )
			define( 'MELA_TD', $this->mela_load_textdomain());

		if ( ! defined( 'MELA_FILE' ) )
			define( 'MELA_FILE', __FILE__ );

		if ( ! defined( 'MELA_DIR' ) )
			define( 'MELA_DIR', dirname( __FILE__ ) );

	}

    function mela_category() {

        \Elementor\Plugin::instance()->elements_manager->add_category(
            'master-addons',
            array(
                'title' => esc_html__( 'Master Addons', MELA_TD ) ,
                'icon'  => 'font',
            ),
            1 );
    }


	public static function activated_widgets() {

		$maad_el_default_settings  = array_fill_keys( self::$maad_el_default_widgets, true );
		$maad_el_get_settings      = get_option( 'maad_el_save_settings', $maad_el_default_settings );
		$maad_el_new_settings      = array_diff_key( $maad_el_default_settings, $maad_el_get_settings );

		if( ! empty( $maad_el_new_settings ) ) {
			$maad_el_updated_settings = array_merge( $maad_el_get_settings, $maad_el_new_settings );
			update_option( 'maad_el_save_settings', $maad_el_updated_settings );
		}

		return $maad_el_get_settings = get_option( 'maad_el_save_settings', $maad_el_default_settings );

	}


	public function maad_el_init_widgets(){

	    $activated_widgets = $this->activated_widgets();

	    foreach( self::$maad_el_default_widgets as $widget ) {
		    if ( $activated_widgets[$widget] == true ) {
		    	require_once MAAD_EL_ADDONS . $widget . '/' .$widget . '.php';
		    }
	    }

	    foreach( self::$maad_el_default_form_widgets as $form_widgets ) {
	    	print_r($form_widgets);
		    if ( $activated_widgets[$form_widgets] == true ) {
			    if ( $form_widgets == 'contact-form-7' ) {
				    if ( function_exists( 'wpcf7' ) ) {
					    require_once MAAD_EL_ADDONS . $form_widgets . '/' .$form_widgets . '.php';
				    }
			    } else {
				    require_once MAAD_EL_ADDONS . $form_widgets . '/' .$form_widgets . '.php';
			    }
		    }
	    }

    }


	/**
	 *
	 * Enqueue Elementor Editor Styles
	 *
	 */
	public function maad_el_editor_styles() {
		wp_enqueue_style( 'master-addons-frontend-editor', MELA_PLUGIN_URL . 'assets/css/master-addons-frontend-editor.css' );
	}

	/**
	 * Enqueue Plugin Styles and Scripts
	 *
	 */
	public function maad_el_enqueue_scripts() {

		$is_activated_widget = $this->activated_widgets();
		wp_enqueue_style( 'master-addons-main-style', MELA_PLUGIN_URL . '/assets/css/master-addons-styles.css' );

		wp_enqueue_script( 'master-addons-scripts', MELA_PLUGIN_URL . '/assets/js/master-addons-scripts.js', array( 'jquery' ), self::VERSION, true );


//		if ( $is_activated_widget['countdown-timer'] ) {
//			// jQuery Countdown Js
//			wp_enqueue_script( 'master-addons-countdown', MELA_PLUGIN_URL . '/assets/js/vendor/jquery.countdown.min.js',
//				array( 'jquery' )
//				, self::VERSION, true );
//		}


	}


	public function is_elementor_activated( $plugin_path = 'elementor/elementor.php' ){
		$installed_plugins_list = get_plugins();
		return isset( $installed_plugins_list[ $plugin_path ] );
	}


    /*
     * Activation Plugin redirect hook
     */
    public function mael_ad_redirect_hook(){
	    if ( get_option( 'maad_el_update_redirect', false ) ) {
		    delete_option( 'maad_el_update_redirect' );
		    if ( !isset($_GET['activate-multi'] ) && $this->is_elementor_activated() ) {
			    wp_redirect( 'admin.php?page=master-addons-settings' );
			    exit;
		    }
	    }
    }


    public static function version(){
        return self::VERSION;
    }


    // Text Domains
    public function mela_load_textdomain(){
        load_plugin_textdomain( 'mela' );
    }


    // Admin Hooks
    public function mela_define_admin_hooks(){
        
    }

    // Plugin URL
    public static function mela_plugin_url(){

        if ( self::$plugin_url) return self::$plugin_url;

        return self::$plugin_url = untrailingslashit(plugins_url('/', __FILE__));
        
    }

    // Plugin Path
    public static function mela_plugin_path(){
        if (self::$plugin_path) return self::$plugin_path;

        return self::$plugin_path = untrailingslashit(plugin_dir_path(__FILE__));           
    }

    // Plugin Dir Path
    public static function mela_plugin_dir_url(){

        if ( self::$plugin_dir_url ) return self::$plugin_dir_url;

        return self::$plugin_dir_url = untrailingslashit(plugin_dir_url(__FILE__));
    }


    public function plugin_actions_links( $links ){
        if( is_admin() ){
            $links[] = sprintf( '<a href="admin.php?page=master-addons-settings">' . __( 'Settings', MELA_TD ) . '</a>' );
            $links[] = '<a href="https://jeweltheme.com/support/" target="_blank">'. esc_html__( 'Support', MELA_TD ) .'</a>';
            $links[] = '<a href="https://docs.jeweltheme.com/" target="_blank">'. esc_html__( 'Documentation', MELA_TD ) .'</a>';
        }

        return $links;          
    }


	// Include Files
	public function maad_el_include_files(){

    	// Master Addons Class
		require_once $this->mela_plugin_path() . '/class-master-elementor-addon.php';

		// Helper Class
		include_once MELA_PLUGIN_PATH . '/inc/classes/helper-class.php';

		// Dashboard Settings
		include_once MELA_PLUGIN_PATH . '/inc/admin/dashboard-settings.php';

	}




}




/**
 *
 * Initilize Plugin Class
 */
function master_addons_el_init() {
	return Master_Elementor_Addons::get_instance();
}
add_action( 'plugins_loaded', 'master_addons_el_init' );


/**
 * Plugin Redirect Option Added by register_activation_hook
 *
 */
function master_addons_el_redirect() {
	add_option( 'maad_el_update_redirect', true );
}
register_activation_hook( __FILE__ , 'master_addons_el_redirect' );
