<?php
	/**
 * Plugin Name: Master Addons for Elementor
 * Description: Master Addons is easy and must have Elementor Addons for WordPress Page Builder. Clean, Modern, Hand crafted designed Addons blocks.
 * Plugin URI: https://wordpress.org/plugins/master-addons
 * Author: Jewel Theme
 * Version: 1.0.4
 * Author URI: https://twitter.com/Litonice11
 * Text Domain: mela
 * Domain Path: /languages
 */

if ( ! function_exists( 'ma_el_fs' ) ) {
	// Create a helper function for easy SDK access.
	function ma_el_fs() {
		global $ma_el_fs;

		if ( ! isset( $ma_el_fs ) ) {
			// Activate multisite network integration.
			if ( ! defined( 'WP_FS__PRODUCT_4015_MULTISITE' ) ) {
				define( 'WP_FS__PRODUCT_4015_MULTISITE', true );
			}

			// Include Freemius SDK.
			require_once dirname(__FILE__) . '/lib/freemius/start.php';

			$ma_el_fs = fs_dynamic_init( array(
				'id'                  => '4015',
				'slug'                => 'master-addons',
				'type'                => 'plugin',
				'public_key'          => 'pk_3c9b5b4e47a06288e3500c7bf812e',
				'is_premium'          => false,
				'has_addons'          => false,
				'has_paid_plans'      => false,
				'menu'                => array(
					'slug'           => 'master-addons-settings',
					'support'        => false,
					'first-path'     => 'admin.php?page=master-addons-settings',
					'account'        => false,
				),
				'is_live'        => true,
			) );
		}

		return $ma_el_fs;
	}

	// Init Freemius.
	ma_el_fs();
	// Signal that SDK was initiated.
	do_action( 'ma_el_fs_loaded' );
}


function ma_el_fs_add_licensing_helper() { ?>
	<script type="text/javascript">
        (function () {
            window.ma_el_fs = { can_use_premium_code: <?php
				echo  json_encode( ma_el_fs()->can_use_premium_code() ) ;
				?>};
        })();
	</script>
	<?php
}

add_action( 'wp_head', 'ma_el_fs_add_licensing_helper' );

require_once dirname( __FILE__ ) . '/class-master-elementor-addons.php';

