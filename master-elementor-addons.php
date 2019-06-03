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

// Instantiate 
$mela = new Master_Elementor_Addons();

//Defined Constants
define( 'MELA', Master_Elementor_Addons::$plugin_name );
define( 'MELA_VERSION', Master_Elementor_Addons::version() );
define( 'MELA_BASE', plugin_basename( __FILE__ ) );
define( 'MELA_PLUGIN_URL', Master_Elementor_Addons::mela_plugin_url());
define( 'MELA_PLUGIN_PATH', Master_Elementor_Addons::mela_plugin_path() );
define( 'MELA_PLUGIN_PATH_URL', Master_Elementor_Addons::mela_plugin_dir_url());
define( 'MELA_IMAGE_DIR', Master_Elementor_Addons::mela_plugin_dir_url() . '/assets/images/');
define( 'MELA_TD', $mela->mela_load_textdomain());  // Ultimate Gutenberg Text Domain
define( 'MELA_FILE', __FILE__ );
define( 'MELA_DIR', dirname( __FILE__ ) );


final class Master_Elementor_Addons{

    const VERSION = "1.0.0";
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const MINIMUM_PHP_VERSION = '5.4';

    private static $plugin_path;
    private static $plugin_url;
    private $plugin_slug;
    public static $plugin_dir_url;
    public static $plugin_name = 'Master Addons for Elementor ';


	public function __construct(){

		//Translations
		add_action('init', [$this, 'mela_load_textdomain']);

        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'plugin_actions_links' ] );
		
		// Initialize Plugin
		add_action('plugins_loaded', [$this, 'mela_init']);

		$this->mela_include_files();

        $this->mela_define_admin_hooks();


	}

    public static function version(){
        return self::VERSION;
    }


    // Text Domains
    public function mela_load_textdomain(){
        load_plugin_textdomain( 'mela', false, dirname(plugin_basename(__FILE__)) . '/languages/' );
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
    public function mela_plugin_path(){
        if (self::$plugin_path) return self::$plugin_path;

        return self::$plugin_path = untrailingslashit(plugin_dir_path(__FILE__));           
    }

    // Plugin Dir Path
    public function mela_plugin_dir_url(){
        
        if ( self::$plugin_dir_url ) return self::$plugin_dir_url;

        return self::$plugin_dir_url = untrailingslashit(plugin_dir_url(__FILE__));
    }


    public function plugin_actions_links(){
        if( is_admin() ){
            $links[] = '<a href="https://jeweltheme.com/support/" target="_blank">'. esc_html__( 'Support', MELA_TD ) .'</a>';
            $links[] = '<a href="https://docs.jeweltheme.com/" target="_blank">'. esc_html__( 'Documentation', MELA_TD ) .'</a>';
        }
        return $links;          
    }


	// Include Files
	public function mela_include_files(){
		require_once ( __DIR__  . '/class-master-elementor-addon.php' );
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


    public function mela_admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'widget-mentor' ),
            '<strong>' . esc_html__( 'Elementor Widget Mentor', 'widget-mentor' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'widget-mentor' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }	

    public function mela_admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'widget-mentor' ),
            '<strong>' . esc_html__( 'Elementor Widget Mentor', 'widget-mentor' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'widget-mentor' ) . '</strong>',
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
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'widget-mentor' ),
            '<strong>' . esc_html__( 'Elementor Widget Mentor', 'widget-mentor' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'widget-mentor' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

}
