<?php

namespace MasterAddons\Modules;

use \Elementor\Controls_Manager;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/5/2021
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly.

class Extension_Icons_Manager_Extend
{

    /*
	* Instance of this class
	*/
    private static $instance = null;

    public function __construct()
    {
        // Add new Icons to Icons Manager
        add_filter('elementor/icons_manager/additional_tabs', [$this, 'jltma_add_icons_manager_tab']);
    }

    // Add Section Controls
    public function jltma_add_icons_manager_tab($tabs)
    {
        // Adds extra options
        // ---------------------------------------------------------------------
        $tabs['feather-icons'] = [
            'name'          => 'feather-icons',
            'label'         => __('Feather Icons', MELA_TD),
            'url'           => EXAD_ASSETS_URL . 'fonts/feather-icon/feather-icon-style.min.css',
            'enqueue'       => [EXAD_ASSETS_URL . 'fonts/feather-icon/feather-icon-style.min.css'],
            'prefix'        => 'icon-',
            'displayPrefix' => 'feather',
            'labelIcon'     => 'exad exad-logo feather icon-feather exad-font-manager',
            'ver'           => EXAD_PLUGIN_VERSION,
            'fetchJson'     => EXAD_ASSETS_URL . 'fonts/feather-icon/exclusive-icons.js?v=' . EXAD_PLUGIN_VERSION,
            'native'        => false,
        ];

        $tabs['remix-icons'] = [
            'name'          => 'remix-icons',
            'label'         => __('Remix Icons', MELA_TD),
            'url'           => EXAD_ASSETS_URL . 'fonts/remix-icon/remixicon.min.css',
            'enqueue'       => [EXAD_ASSETS_URL . 'fonts/remix-icon/remixicon.min.css'],
            'prefix'        => 'ri-',
            'displayPrefix' => 'remixicon',
            'labelIcon'     => 'exad exad-logo remixicon ri-remixicon-fill exad-font-manager',
            'ver'           => EXAD_PLUGIN_VERSION,
            'fetchJson'     => EXAD_ASSETS_URL . 'fonts/remix-icon/remix-icon.js?v=' . EXAD_PLUGIN_VERSION,
            'native'        => false,
        ];

        $tabs['teeny-icons'] = [
            'name'          => 'teeny-icons',
            'label'         => __('Teeny Icons', MELA_TD),
            'url'           => EXAD_ASSETS_URL . 'fonts/teeny-icon/teeny-icon-style.min.css',
            'enqueue'       => [EXAD_ASSETS_URL . 'fonts/teeny-icon/teeny-icon-style.min.css'],
            'prefix'        => 'ti-',
            'displayPrefix' => 'teenyicon',
            'labelIcon'     => 'exad exad-logo teenyicon ti-mood-laugh exad-font-manager',
            'ver'           => EXAD_PLUGIN_VERSION,
            'fetchJson'     => EXAD_ASSETS_URL . 'fonts/teeny-icon/teeny-icon.js?v=' . EXAD_PLUGIN_VERSION,
            'native'        => false,
        ];
        return $tabs;
    }


    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

Extension_Icons_Manager_Extend::get_instance();
