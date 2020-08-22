<?php
namespace MasterAddons\Admin\Dashboard\Addons\ThirdPartyPlugins;

$jltma_elements = [
    'jltma-plugins'  	   => [
    	'title' 	           => esc_html__( 'Extensions', MELA_TD),
    	'plugin'  	       => [
            [
                'key'           => 'elementor-custom-breakpoints',
                'title'         => esc_html__( 'Custom Breakpoints', MELA_TD),
                'demo_url'      => '',
                'docs_url'      => '',
                'tuts_url'      => '',
                'pro'           => true
            ],
            [
                'key'           => 'woocommerce',
                'title'         => esc_html__( 'WooCommerce', MELA_TD),
                'demo_url'      => '',
                'docs_url'      => '',
                'tuts_url'      => ''
            ]

    	]
    ]
];