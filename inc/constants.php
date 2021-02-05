<?php

namespace MasterAddons;

use MasterAddons\Master_Elementor_Addons;

class Master_Addons_Constants
{
    private static $instance = null;

    public function __construct()
    {
        // Constants used
        if (!defined('MELA')) {
            define('MELA', Master_Elementor_Addons::$plugin_name);
        }

        //Defined Constants
        if (!defined('MA_EL_BADGE')) {
            define('MA_EL_BADGE', '<span class="ma-el-badge"></span>');
        }

        if (!defined('MELA_VERSION')) {
            define('MELA_VERSION', Master_Elementor_Addons::version());
        }

        if (!defined('JLTMA_STABLE_VERSION')) {
            define('JLTMA_STABLE_VERSION', Master_Elementor_Addons::JLTMA_STABLE_VERSION);
        }

        if (!defined('MA_EL_SCRIPT_SUFFIX')) {
            define('MA_EL_SCRIPT_SUFFIX', defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min');
        }

        if (!defined('MELA_BASE')) {
            define('MELA_BASE', plugin_basename(__FILE__));
        }

        if (!defined('MELA_PLUGIN_URL')) {
            define('MELA_PLUGIN_URL', Master_Elementor_Addons::mela_plugin_url());
        }

        if (!defined('MELA_PLUGIN_PATH')) {
            define('MELA_PLUGIN_PATH', Master_Elementor_Addons::mela_plugin_path());
        }

        if (!defined('MELA_PLUGIN_PATH_URL')) {
            define('MELA_PLUGIN_PATH_URL', Master_Elementor_Addons::mela_plugin_dir_url());
        }

        if (!defined('MELA_IMAGE_DIR')) {
            define('MELA_IMAGE_DIR', Master_Elementor_Addons::mela_plugin_dir_url() . '/assets/images/');
        }

        if (!defined('MELA_ADMIN_ASSETS')) {
            define('MELA_ADMIN_ASSETS', Master_Elementor_Addons::mela_plugin_dir_url() . '/inc/admin/assets/');
        }

        if (!defined('MAAD_EL_ADDONS')) {
            define('MAAD_EL_ADDONS', plugin_dir_path(__FILE__) . 'addons/');
        }

        if (!defined('MELA_TEMPLATES')) {
            define('MELA_TEMPLATES', plugin_dir_path(__FILE__) . 'inc/template-parts/');
        }

        // Master Addons Text Domain
        if (!defined('MELA_TD')) {
            define('MELA_TD', $this->mela_load_textdomain());
        }

        if (!defined('MELA_FILE')) {
            define('MELA_FILE', __FILE__);
        }

        if (!defined('MELA_DIR')) {
            define('MELA_DIR', dirname(__FILE__));
        }

        if (ma_el_fs()->can_use_premium_code()) {
            if (!defined('MASTER_ADDONS_PRO_ADDONS_VERSION')) {
                define('MASTER_ADDONS_PRO_ADDONS_VERSION', ma_el_fs()->can_use_premium_code());
            }
        }

        define('JLTMA_ACTIVATION_REDIRECT_TRANSIENT_KEY', '_master_addons_activation_redirect');
    }



    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
Master_Addons_Constants::get_instance();
