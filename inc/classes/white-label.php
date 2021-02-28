<?php

namespace MasterAddons\Inc\Classes;

class Master_Addons_White_Label
{
    private static $instance = null;

    public function __construct()
    {
        if (is_admin) {
            // Master Addons White Label Settings
            add_action('wp_ajax_jltma_save_white_label_settings', [$this, 'jltma_save_white_label_settings']);
            add_action('wp_ajax_nopriv_jltma_save_white_label_settings', [$this, 'jltma_save_white_label_settings']);

            add_action('all_plugins', [$this, 'jltma_save_white_label_settings_update']);

            add_filter('plugin_row_meta', [$this, 'jltma_plugin_row_meta'], 500, 2);
        }
    }

    public function jltma_plugin_row_meta($plugin_meta, $plugin_file)
    {
        $settings = self::get_settings();
        if ($settings['jltma_wl_plugin_row_links'] !== "1") {
            return $plugin_meta;
        }
    }


    public function jltma_save_white_label_settings_update($all_plugins)
    {
        $settings = self::get_settings();

        // 'jltma_wl_plugin_name'               => '',
        // 'jltma_wl_plugin_desc'               => '',
        // 'jltma_wl_plugin_author_name'        => '',
        // 'jltma_wl_plugin_url'                => '',
        // 'jltma_wl_plugin_menu_label'         => 'Master Addons',
        // 'jltma_wl_plugin_row_links'          => '',
        // 'jltma_wl_plugin_tab_welcome'        => '',
        // 'jltma_wl_plugin_tab_addons'         => '',
        // 'jltma_wl_plugin_tab_extensions'     => '',
        // 'jltma_wl_plugin_tab_api'            => '',
        // 'jltma_wl_plugin_tab_white_label'    => '',
        // 'jltma_wl_plugin_tab_version'        => '',
        // 'jltma_wl_plugin_tab_changelogs'     => '',
        if (!empty($all_plugins[JLTMA_BASE]) && is_array($all_plugins[JLTMA_BASE])) {
            $all_plugins[JLTMA_BASE]['Name']           = !empty($settings['jltma_wl_plugin_name']) ? $settings['jltma_wl_plugin_name'] : $all_plugins[JLTMA_BASE]['Name'];
            $all_plugins[JLTMA_BASE]['PluginURI']      = !empty($settings['jltma_wl_plugin_url']) ? $settings['jltma_wl_plugin_url'] : $all_plugins[JLTMA_BASE]['PluginURI'];
            $all_plugins[JLTMA_BASE]['Description']    = !empty($settings['jltma_wl_plugin_desc']) ? $settings['jltma_wl_plugin_desc'] : $all_plugins[JLTMA_BASE]['Description'];
            $all_plugins[JLTMA_BASE]['Author']         = !empty($settings['jltma_wl_plugin_author_name']) ? $settings['jltma_wl_plugin_author_name'] : $all_plugins[JLTMA_BASE]['Author'];
            $all_plugins[JLTMA_BASE]['AuthorURI']      = !empty($settings['jltma_wl_plugin_url']) ? $settings['jltma_wl_plugin_url'] : $all_plugins[JLTMA_BASE]['AuthorURI'];
            $all_plugins[JLTMA_BASE]['Title']          = !empty($settings['jltma_wl_plugin_name']) ? $settings['jltma_wl_plugin_name'] : $all_plugins[JLTMA_BASE]['Title'];
            $all_plugins[JLTMA_BASE]['AuthorName']     = !empty($settings['jltma_wl_plugin_author_name']) ? $settings['jltma_wl_plugin_author_name'] : $all_plugins[JLTMA_BASE]['AuthorName'];

            return $all_plugins;
        }
    }

    // White Label Settings Ajax Call
    public function jltma_save_white_label_settings()
    {

        $jltma_white_label_options = [];

        foreach ($_POST['fields'] as $key => $value) {
            $jltma_white_label_options[$value['name']] = $value['value'];
        }

        update_option('jltma_white_label_settings', $jltma_white_label_options);

        return true;
        die();
    }


    public static function get_option($key, $network_override = true)
    {
        if (is_network_admin()) {
            $value = get_site_option($key);
        } elseif (!$network_override && is_multisite()) {
            $value = get_site_option($key);
        } elseif ($network_override && is_multisite()) {
            $value = get_option($key);
            $value = (false === $value || (is_array($value) && in_array('disabled', $value))) ? get_site_option($key) : $value;
        } else {
            $value = get_option($key);
        }

        return $value;
    }
    public static function get_settings()
    {
        $default_settings = array(
            'jltma_wl_plugin_name'               => '',
            'jltma_wl_plugin_desc'               => '',
            'jltma_wl_plugin_author_name'        => '',
            'jltma_wl_plugin_url'                => '',
            'jltma_wl_plugin_menu_label'         => 'Master Addons',
            'jltma_wl_plugin_row_links'          => '',
            'jltma_wl_plugin_tab_welcome'        => '',
            'jltma_wl_plugin_tab_addons'         => '',
            'jltma_wl_plugin_tab_extensions'     => '',
            'jltma_wl_plugin_tab_api'            => '',
            'jltma_wl_plugin_tab_white_label'    => '',
            'jltma_wl_plugin_tab_version'        => '',
            'jltma_wl_plugin_tab_changelogs'     => '',
            // 'hide_license_page'         => '',
            // 'hide_elementor_plugin'     => '',
            // 'hide_elementor_pro_plugin' => '',
            // 'hide_plugin'               => '',
            // 'hide_ewl_setting_page'     => '',
        );

        $settings = self::get_option('jltma_white_label_settings', true);

        if (!is_array($settings) || empty($settings)) {
            return $default_settings;
        }

        if (is_array($settings) && !empty($settings)) {
            return array_merge($default_settings, $settings);
        }
    }


    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}

Master_Addons_White_Label::get_instance();
