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

	public function __construct(){

		//Translations
		add_action('init', [$this, 'mela_i18n']);
		
		// Initialize Plugin
		add_action('plugins_loaded', [$this, 'mela_init']);

		$this->mela_include_files();
	}

	// Include Files
	public function mela_include_files(){
		require_once ( __DIR__  . '/class-master-elementor-addon.php' );
	}

	// Translation
	public function mela_i18n(){
		load_plugin_textdomain(	'mela', false, dirname(plugin_basename(__FILE__)) . '/languages/' );
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

// Instantiate 
new Master_Elementor_Addons();