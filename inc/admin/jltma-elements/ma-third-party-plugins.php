<?php
namespace MasterAddons\Admin\Dashboard\Addons\ThirdPartyPlugins;

$jltma_elements = [
    'jltma-plugins'  	   => [
    	'title' 	           => esc_html__( 'Extensions', MELA_TD),
    	'plugin'  	       => [
            [
                'key'           => 'custom-breakpoints',
                'title'         => esc_html__( 'Custom Breakpoints', MELA_TD),
                'wp_slug'       => 'elementor-custom-breakpoints',
                'download_url'  => '',
                'plugin_file'   => 'elementor-custom-breakpoints/custom-breakpoints.php'
            ],
            [
                'key'           => 'wp-disable-sitemap',
                'title'         => esc_html__( 'Disable Sitemap', MELA_TD),
                'wp_slug'       => 'wp-disable-sitemap',
                'download_url'  => '',
                'plugin_file'   => 'wp-disable-sitemap/wp-disable-sitemap.php',
            ]

    	]
    ]
];