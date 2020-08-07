<?php
defined( 'ABSPATH' ) || exit;

define( 'JLTMA_MCB_VERSION', '1.0.0' );
define( 'JLTMA_MCB_TD', 'master-custom-breakpoint' );
define( 'JLTMA_MCB_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'JLTMA_MCB_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
define( 'JLTMA_MCB_PLUGIN_DIR', plugin_basename( __FILE__ ) );

if ( version_compare( ELEMENTOR_VERSION, '2.9.0', '>=' ) && version_compare( ELEMENTOR_VERSION, '3.0.0', '<' ) ) {
    require plugin_dir_path( __FILE__ ) . 'class-master-custom-breakpoint.php';
}
