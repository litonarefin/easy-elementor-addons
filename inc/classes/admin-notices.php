<?php
namespace MasterAddons\Inc\Classes\AdminNotice;
/**
 * Exit if called directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'JLTMA_Admin_Notice' ) ) {

	/**
	 * Class JLTMA_Admin_Notice
	 */
	class JLTMA_Admin_Notice {

		public static function init() {
			add_action( 'wp_ajax_dismiss_admin_notice', array( __CLASS__, 'dismiss_admin_notice' ) );
		}

		/**
		 * Handles Ajax request to persist notices dismissal.
		 * Uses check_ajax_referer to verify nonce.
		 */
		public static function dismiss_admin_notice() {
			$option_name        = sanitize_text_field( $_POST['option_name'] );
			$dismissible_length = sanitize_text_field( $_POST['dismissible_length'] );

			if ( 'forever' != $dismissible_length ) {
				// If $dismissible_length is not an integer default to 1
				$dismissible_length = ( 0 == absint( $dismissible_length ) ) ? 1 : $dismissible_length;
				$dismissible_length = strtotime( absint( $dismissible_length ) . ' days' );
			}

			check_ajax_referer( 'dismissible-notice', 'nonce' );
			self::set_admin_notice_cache( $option_name, $dismissible_length );
			wp_die();
		}

		/**
		 * Is admin notice active?
		 *
		 * @param string $arg data-dismissible content of notice.
		 *
		 * @return bool
		 */
		public static function is_admin_notice_active( $arg ) {
			$array       = explode( '-', $arg );
			$length      = array_pop( $array );
			$option_name = implode( '-', $array );
			$db_record   = self::get_admin_notice_cache( $option_name );

			if ( 'forever' == $db_record ) {
				return false;
			} elseif ( absint( $db_record ) >= time() ) {
				return false;
			} else {
				return true;
			}
		}

		/**
		 * Returns admin notice cached timeout.
		 *
		 * @access public
		 *
		 * @param string|bool $id admin notice name or false.
		 *
		 * @return array|bool The timeout. False if expired.
		 */
		public static function get_admin_notice_cache( $id = false ) {
			if ( ! $id ) {
				return false;
			}
			$cache_key = 'pand-' . md5( $id );
			$timeout   = get_site_option( $cache_key );
			$timeout   = 'forever' === $timeout ? time() + 60 : $timeout;

			if ( empty( $timeout ) || time() > $timeout ) {
				return false;
			}

			return $timeout;
		}

		/**
		 * Sets admin notice timeout in site option.
		 *
		 * @access public
		 *
		 * @param string      $id       Data Identifier.
		 * @param string|bool $timeout  Timeout for admin notice.
		 *
		 * @return bool
		 */
		public static function set_admin_notice_cache( $id, $timeout ) {
			$cache_key = 'pand-' . md5( $id );
			update_site_option( $cache_key, $timeout );

			return true;
		}

	}
}