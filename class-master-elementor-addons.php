<?php

	if (!defined('ABSPATH')) { exit; } // No, Direct access Sir !!!

	if( !class_exists('Master_Elementor_Addons') ){
		final class Master_Elementor_Addons {

			const VERSION = "1.0.5";

			const MINIMUM_PHP_VERSION = '5.4';

			const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

			private $_localize_settings = [];

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
				if ( ! self::$instance ) {
					self::$instance = new self;

					self::$instance -> ma_el_init();
				}

				return self::$instance;
			}


			public function __construct() {

				self::$maad_el_default_widgets = [
					'ma-headlines',
					'ma-call-to-action',
					'ma-dual-heading',
					'ma-accordion',
					'ma-tabs',
					'ma-tooltip',
					'ma-progressbar',
					'ma-progressbars',
					'ma-team-members',
					'ma-team-members-slider',
//					'ma-creative-links',
					'contact-form-7',
//					'ninja-forms',
//					'gravity-forms',
//					'wpforms',
//					'caldera-forms',
//					'weforms',
//					'ma-creative-buttons',
//					'ma-piechart',
//					'ma-infobox',
//					'ma-flipbox',
//					'ma-cards',
//					'ma-counter-up',
//					'ma-countdown-timer',





					//			'ma-image-comparison',
					//			'ma-business-hours',
					//			'countdown-timer',
					//			'post-grid',
					//			'post-timeline',
					//			'testimonial-carousel',
					//			'pricing-table',
					//			'post-carousel',
					//			'google-maps',
					//			'tooltip',
					//			['contact-form-7','pro'],
				];

				self::$maad_el_default_form_widgets = [
					//			'contact-form-7'
				];

				// search for pro version
				$this->pro_enabled = apply_filters( 'ma_el/pro_enabled', false );

				$this->constants();
				$this->maad_el_include_files();
				$this->mela_define_admin_hooks();

				self::$plugin_slug = 'master-addons';
				self::$plugin_path = untrailingslashit( plugin_dir_path( '/', __FILE__ ) );
				self::$plugin_url  = untrailingslashit( plugins_url( '/', __FILE__ ) );

				// Initialize Plugin
				add_action('plugins_loaded', [$this, 'ma_el_plugins_loaded']);


				//Init Function
//				add_action( 'init', [ $this, 'ma_el_init' ] );

				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'plugin_actions_links' ] );



				add_action( 'elementor/init', [ $this, 'mela_category' ] );

				// Enqueue Styles and Scripts
				add_action( 'wp_enqueue_scripts', [ $this, 'maad_el_enqueue_scripts' ], 20 );


				// Elementor Dependencies

				add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'maad_el_editor_styles' ] );

				// Add Elementor Widgets
				add_action( 'elementor/widgets/widgets_registered', [ $this, 'maad_el_init_widgets' ] );

				//		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'ma_el_enqueue_frontend_scripts' ] );
				//		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'ma_el_enqueue_frontend_styles' ] );


				//Body Class
				add_filter( 'body_class', [ $this, 'mela_ea_body_class' ] );

			}


			public function ma_el_init() {

				$this->mela_load_textdomain();
				$this->ma_el_image_size();

				//Redirect Hook
				add_action( 'admin_init', [ $this, 'mael_ad_redirect_hook' ]);

			}


			// Initialize
			public function ma_el_plugins_loaded(){

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


			public function constants() {

				//Defined Constants
				if ( ! defined( 'MELA' ) ) {
					define( 'MELA', self::$plugin_name );
				}

				if ( ! defined( 'MELA_VERSION' ) ) {
					define( 'MELA_VERSION', self::version() );
				}

				if ( ! defined( 'MA_EL_SCRIPT_SUFFIX' ) ) {
					define( 'MA_EL_SCRIPT_SUFFIX', defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );
				}

				if ( ! defined( 'MELA_BASE' ) ) {
					define( 'MELA_BASE', plugin_basename( __FILE__ ) );
				}

				if ( ! defined( 'MELA_PLUGIN_URL' ) ) {
					define( 'MELA_PLUGIN_URL', self::mela_plugin_url() );
				}

				if ( ! defined( 'MELA_PLUGIN_PATH' ) ) {
					define( 'MELA_PLUGIN_PATH', self::mela_plugin_path() );
				}

				if ( ! defined( 'MELA_PLUGIN_PATH_URL' ) ) {
					define( 'MELA_PLUGIN_PATH_URL', self::mela_plugin_dir_url() );
				}

				if ( ! defined( 'MELA_IMAGE_DIR' ) ) {
					define( 'MELA_IMAGE_DIR', self::mela_plugin_dir_url() . '/assets/images/' );
				}

				if ( ! defined( 'MELA_ADMIN_ASSETS' ) ) {
					define( 'MELA_ADMIN_ASSETS', self::mela_plugin_dir_url() . '/inc/admin/assets/' );
				}

				if ( ! defined( 'MAAD_EL_ADDONS' ) ) {
					define( 'MAAD_EL_ADDONS', plugin_dir_path( __FILE__ ) . 'addons/' );
				}

				if ( ! defined( 'MELA_TEMPLATES' ) ) {
					define( 'MELA_TEMPLATES', plugin_dir_path( __FILE__ ) . 'inc/template-parts/' );
				}

				// Master Addons Text Domain
				if ( ! defined( 'MELA_TD' ) ) {
					define( 'MELA_TD', $this->mela_load_textdomain() );
				}

				if ( ! defined( 'MELA_FILE' ) ) {
					define( 'MELA_FILE', __FILE__ );
				}

				if ( ! defined( 'MELA_DIR' ) ) {
					define( 'MELA_DIR', dirname( __FILE__ ) );
				}

			}

			function mela_category() {

				\Elementor\Plugin::instance()->elements_manager->add_category(
					'master-addons',
					[
						'title' => esc_html__( 'Master Addons', MELA_TD ),
						'icon'  => 'font',
					],
					1 );
			}

			public function ma_el_image_size() {
				add_image_size( 'master_addons_team_thumb', 250, 330, true );
			}


			public static function activated_widgets() {

				$maad_el_default_settings = array_fill_keys( self::$maad_el_default_widgets, true );
				$maad_el_get_settings     = get_option( 'maad_el_save_settings', $maad_el_default_settings );
				$maad_el_new_settings     = array_diff_key( $maad_el_default_settings, $maad_el_get_settings );

				if ( ! empty( $maad_el_new_settings ) ) {
					$maad_el_updated_settings = array_merge( $maad_el_get_settings, $maad_el_new_settings );
					update_option( 'maad_el_save_settings', $maad_el_updated_settings );
				}

				return $maad_el_get_settings = get_option( 'maad_el_save_settings', $maad_el_default_settings );

			}


			public function maad_el_init_widgets() {

				$activated_widgets = $this->activated_widgets();

				foreach ( self::$maad_el_default_widgets as $widget ) {
					if ( $activated_widgets[ $widget ] == true ) {
						require_once MAAD_EL_ADDONS . $widget . '/' . $widget . '.php';
					}
				}

				foreach ( self::$maad_el_default_form_widgets as $form_widgets ) {
//					print_r( $form_widgets );
					if ( $activated_widgets[ $form_widgets ] == true ) {
						if ( $form_widgets == 'contact-form-7' ) {
							if ( function_exists( 'wpcf7' ) ) {
								require_once MAAD_EL_ADDONS . $form_widgets . '/' . $form_widgets . '.php';
							}
						} else {
							require_once MAAD_EL_ADDONS . $form_widgets . '/' . $form_widgets . '.php';
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
				wp_enqueue_style( 'master-addons-editor', MELA_PLUGIN_URL . '/assets/css/master-addons-editor.css' );
			}



			/**
			 * Enqueue Plugin Styles and Scripts
			 *
			 */
			public function maad_el_enqueue_scripts() {

				$is_activated_widget = $this->activated_widgets();
				wp_enqueue_style( 'master-addons-main-style', MELA_PLUGIN_URL . '/assets/css/master-addons-styles.css' );

				wp_enqueue_script( 'master-addons-scripts', MELA_PLUGIN_URL . '/assets/js/master-addons-scripts.js', [ 'jquery' ], self::VERSION, true );




				/*
				 * Register Styles
				 */

//				wp_register_style( 'master-addons-main-style', MELA_PLUGIN_URL . '/assets/css/master-addons-styles.css' );
//				wp_register_script( 'animated-main', MELA_PLUGIN_URL . '/assets/js/animated-main'.MA_EL_SCRIPT_SUFFIX.'.js', array( 'jquery' ), '1.0', true );

				wp_register_style( 'master-addons-headlines', MELA_PLUGIN_URL . '/assets/css/headlines.css' );




				/*
				 * Register Scripts
				 */

				wp_register_script( 'master-addons-progressbar', MELA_PLUGIN_URL . '/assets/js/loading-bar.js', [ 'jquery' ],
					self::VERSION, true );

				wp_register_script(
					'jquery-stats',
					MELA_PLUGIN_URL . '/assets/js/jquery.stats' . MA_EL_SCRIPT_SUFFIX . '.js',
					[ 'jquery' ],
					MELA_VERSION,
					true
				);

				wp_register_script( 'master-addons-waypoints', MELA_PLUGIN_URL . '/assets/vendor/jquery.waypoints.min.js', [ 'jquery' ], self::VERSION, true );

				wp_register_script( 'master-addons-team-members', MELA_PLUGIN_URL . '/assets/vendor/owlcarousel/owl.carousel.min.js', [ 'jquery' ], MELA_VERSION, true );




				// Master Addons Dependencies

				//Progressbar
				if ( $is_activated_widget['ma-progressbar'] ) {
					wp_enqueue_script('master-addons-progressbar');
					wp_enqueue_script( 'master-addons-waypoints');
				}


				//Team Members
				if ( $is_activated_widget['ma-team-members'] ) {
					wp_enqueue_script( 'master-addons-team-members' );
				}


				//Animated Headlines
				if ( $is_activated_widget['ma-headlines'] ) {
					wp_enqueue_style( 'master-addons-headlines' );
				}

				//Creative Buttons
				if ( isset( $is_activated_widget['ma-creative-buttons'] ) ) {
					wp_enqueue_style( 'ma-creative-buttons', MELA_PLUGIN_URL . '/assets/vendor/creative-btn/buttons.css' );
				}


				//Creative Links
				if (isset( $is_activated_widget['ma-creative-links'] )) {
					wp_enqueue_style( 'ma-creative-links', MELA_PLUGIN_URL . '/assets/vendor/creative-links/creative-links.css' );
				}


				//Counter Up
				if ( isset($is_activated_widget['ma-counter-up'] )) {
					wp_register_script( 'ma-counter-up', MELA_PLUGIN_URL . '/assets/js/counterup.min.js' );
					wp_enqueue_script( 'ma-counter-up' );
				}


				//Google Maps
				//		if ( $is_activated_widget['google-maps'] ) {
				//			wp_enqueue_script( 'master-addons-google-map-api', 'https://maps.googleapis.com/maps/api/js?key='
				//.get_option
				//('exad_google_map_api_option'), array('jquery'),'1.8', false );
				//			// Gmap 3 Js
				//			wp_enqueue_script( 'master-addons-gmap3', MELA_PLUGIN_URL . 'assets/js/vendor/gmap3.min.js', array(
				// 'jquery' )
				//, self::VERSION, true );
				//		}


				if ( isset($is_activated_widget['ma-countdown-timer'] )) {
					// jQuery Countdown Js
					wp_register_script( 'master-addons-countdown', MELA_PLUGIN_URL . '/assets/vendor/countdown/jquery.countdown.js',
						array( 'jquery' )
						, self::VERSION, true );

					wp_enqueue_script('master-addons-countdown');

				}



				$localize_data = array(
					'plugin_url' => MELA_PLUGIN_URL
				);
				wp_localize_script( 'master-addons-scripts', 'ma_el_editor', $localize_data );



			}


			public function is_elementor_activated( $plugin_path = 'elementor/elementor.php' ) {
				$installed_plugins_list = get_plugins();

				return isset( $installed_plugins_list[ $plugin_path ] );
			}


			/*
			 * Activation Plugin redirect hook
			 */
			public function mael_ad_redirect_hook() {
				if ( is_plugin_active( 'elementor/elementor.php' ) ) {
					if ( get_option( 'maad_el_update_redirect', false ) ) {
						delete_option( 'maad_el_update_redirect' );
						delete_transient( 'maad_el_update_redirect' );
						if ( ! isset( $_GET['activate-multi'] ) && $this->is_elementor_activated() ) {
							wp_redirect( 'admin.php?page=master-addons-settings' );
							exit;
						}
					}
				}
			}


			public static function version() {
				return self::VERSION;
			}


			// Text Domains
			public function mela_load_textdomain() {
				load_plugin_textdomain( 'mela' );
			}


			// Admin Hooks
			public function mela_define_admin_hooks() {

			}

			// Plugin URL
			public static function mela_plugin_url() {

				if ( self::$plugin_url ) {
					return self::$plugin_url;
				}

				return self::$plugin_url = untrailingslashit( plugins_url( '/', __FILE__ ) );

			}

			// Plugin Path
			public static function mela_plugin_path() {
				if ( self::$plugin_path ) {
					return self::$plugin_path;
				}

				return self::$plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
			}

			// Plugin Dir Path
			public static function mela_plugin_dir_url() {

				if ( self::$plugin_dir_url ) {
					return self::$plugin_dir_url;
				}

				return self::$plugin_dir_url = untrailingslashit( plugin_dir_url( __FILE__ ) );
			}


			public function plugin_actions_links( $links ) {
				if ( is_admin() ) {
					$links[] = sprintf( '<a href="admin.php?page=master-addons-settings">' . __( 'Settings', MELA_TD ) . '</a>' );
					$links[] = '<a href="https://jeweltheme.com/support/forum/wordpress-plugins/master-addons/" target="_blank">' . esc_html__( 'Support', MELA_TD ) . '</a>';
					$links[] = '<a href="https://docs.jeweltheme.com/master-addons" target="_blank">' . esc_html__( 'Documentation',
							MELA_TD ) . '</a>';
				}

				// go pro
				if (!$this->pro_enabled) {
					$links[] = sprintf('<a href="https://jeweltheme.com/shop/master-addons-elementor/" target="_blank" style="color: #39b54a; font-weight: bold;">' . __('Go Pro') . '</a>');
				}

				return $links;
			}


			// Include Files
			public function maad_el_include_files() {

				// Master Addons Class
//				require_once $this->mela_plugin_path() . '/class-master-elementor-addon.php';

				// Helper Class
				include_once MELA_PLUGIN_PATH . '/inc/classes/helper-class.php';

				// Dashboard Settings
				include_once MELA_PLUGIN_PATH . '/inc/admin/dashboard-settings.php';

				//Utils
				include_once MELA_PLUGIN_PATH . '/inc/classes/utils.php';

				include_once MELA_PLUGIN_PATH . '/inc/modules/animated-gradient/animated-gradient.php';
				include_once MELA_PLUGIN_PATH . '/inc/modules/particles/particles.php';
				include_once MELA_PLUGIN_PATH . '/inc/modules/bg-slider/bg-slider.php';

			}




			public function mela_ea_body_class($classes){
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
				$plugin = 'elementor/elementor.php';

				if ( $this->is_elementor_activated() ) {
					if ( ! current_user_can( 'activate_plugins' ) ) {
						return;
					}
					$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
					$message = __( 'Master Addons requires <b>Elementor plugin to be active. Please activate Elementor to continue.', MELA_TD );
					$button_text = __( 'Activate Elementor', MELA_TD );

				} else {
					if ( ! current_user_can( 'install_plugins' ) ) {
						return;
					}

					$activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
					$message = sprintf( __( 'Master Addons requires %1$s"Elementor"%2$s plugin to be installed and activated. Please install Elementor to continue.', MELA_TD ), '<strong>', '</strong>' );
					$button_text = __( 'Install Elementor', MELA_TD );
				}




				$button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';

				printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p>%2$s</div>', $message , $button );

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


	}

