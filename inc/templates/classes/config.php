<?php
	namespace MasterAddons\Inc\Templates\Classes;
//	use MasterAddons\Inc\Templates\Classes\Master_Addons_Helper;
//	use MasterAddonsPro\License\Admin;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 9/8/19
	 */



	if( ! defined( 'ABSPATH' ) ) exit; // No access of directly access

	if( ! class_exists('Master_Addons_Templates_Core_Config') ) {

		class Master_Addons_Templates_Core_Config {

			private static $instance = null;
			private $config;
			private $slug = 'master-addons-pro-license';
			public function __construct() {

				$this->config = array(
					'master_addons_templates'       => __('Master Addons', MELA_TD ),
					'key'                           => $this->get_license_key(),
//					'status'                        => $this->get_license_status(),
					'status'                        => 'pro',
					'license_page'                  => $this->get_license_page(),
					'pro_message'                   => $this->get_pro_message(),
					'api'                           => array(
									'enabled'   => true,
									'base'      => 'https://el.master-addons.com/',
									'path'      => 'wp-json/masteraddons/v2',
									'id'        => 9,
									'endpoints' => array(
										'templates'  => '/templates/',
										'keywords'   => '/keywords/',
										'categories' => '/categories/',
										'template'   => '/template/',
										'info'       => '/info/',
										'template'   => '/template/',
									),
					),
				);

			}


			public function get_license_key() {

				if( ! defined ('MASTER_ADDONS_PRO_ADDONS_VERSION') ) {
					return;
				}

				$key = Admin::get_license_key();

				return $key;

			}


			public function get_license_status() {

				if( ! defined ('MASTER_ADDONS_PRO_ADDONS_VERSION') ) {
					return;
				}

				$status = Admin::get_license_status();

				return $status;

			}


			public function get_license_page() {

				if( defined ('MASTER_ADDONS_PRO_ADDONS_VERSION') ) {

					return add_query_arg(
						array(
							'page'  => $this->slug,
						),
						esc_url( admin_url('admin.php') )
					);

				} else {

					$theme_slug = Master_Addons_Helper::get_installed_theme();

					$url = sprintf('https://master-addons.com/account/?utm_source=premium-templates&utm_medium=wp-dash&utm_campaign=get-pro&utm_term=%s', $theme_slug);

					return $url;

				}

			}


			public function get_pro_message() {

				if( defined ('MASTER_ADDONS_PRO_ADDONS_VERSION') ) {
					return __('Activate License', MELA_TD );
				} else {
					return __('Get Pro', MELA_TD );
				}

			}



			public function get( $key = '' ) {

				return isset( $this->config[ $key ] ) ? $this->config[ $key ] : false;

			}



			public static function get_instance() {

				if( self::$instance == null ) {

					self::$instance = new self;

				}

				return self::$instance;

			}


		}

	}