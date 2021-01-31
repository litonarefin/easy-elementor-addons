<?php

namespace MasterAddons\Admin\Dashboard\Addons\Marketing;

include_once MELA_PLUGIN_PATH . '/inc/admin/jltma-elements/ma-marketing.php';

$jltma_marketing = [
    'jltma-marketing'      => [
        'title'     => esc_html__('Marketing Elements', MELA_TD),
        'elements'      => [

            [
                'key'           => 'ma-mailchimp',
                'title'         => esc_html__('Mailchimp', MELA_TD),
                'demo_url'      => 'https://master-addons.com/demos/mailchimp/',
                'docs_url'      => 'https://master-addons.com/docs/addons/mailchimp-element/',
                'tuts_url'      => 'https://www.youtube.com/watch?v=hST5tycqCsw'
            ],



        ]
    ]
];
