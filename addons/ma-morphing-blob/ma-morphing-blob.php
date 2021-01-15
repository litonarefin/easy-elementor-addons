<?php

namespace Elementor;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Scheme_Color;

class JLTMA_Morphing_Blob extends Widget_Base
{

    public function get_name()
    {
        return "jltma-morphing-blob";
    }

    public function get_title()
    {
        return esc_html__('MA Morphing & Blob', MELA_TD);
    }

    public function get_icon()
    {
        return 'ma-el-icon eicon-youtube';
    }

    public function get_categories()
    {
        return ['master-addons'];
    }

    // public function get_script_depends()
    // {
    //     return ['rh_elparticle'];
    // }

    public function get_keywords()
    {
        return [
            'morphing',
            'animation',
            'svg animation',
            'blob',
            'blob animation',
            'morphing animation',
        ];
    }

    public function get_help_url()
    {
        return '';
    }

    protected function _register_controls()
    {
        $this->start_controls_section('general_section', [
            'label' => esc_html__('General', MELA_TD),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);
        // $this->add_control('jltma_mrbl_type', [
        //     'type'          => Controls_Manager::SELECT,
        //     'label'         => esc_html__('Enable Type of canvas', MELA_TD),
        //     'default'       => 'particles',
        //     'options'       => [
        //         'particles'     =>  esc_html__('Particles', MELA_TD),
        //         'video'         =>  esc_html__('Video', MELA_TD),
        //         'masksvg'       =>  esc_html__('Animated SVG', MELA_TD),
        //     ],
        // ]);
        $this->add_control(
            'jltma_mrbl_particle_json',
            array(
                'label'   => esc_html__('Particle json content', MELA_TD),
                'description' => 'Configure it on <a href="https://vincentgarreau.com/particles.js/" target="_blank">Particle site</a>, download json file and copy content of file to this area',
                'type'    => Controls_Manager::TEXTAREA,
                'condition' => array(
                    'jltma_mrbl_type' => 'particles',
                ),
            )
        );
        $this->add_control('rh_vid_mp4', [
            'label' => esc_html__('Mp4 video link', MELA_TD),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::TEXT,
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
        ]);
        $this->add_control('rh_vid_webm', [
            'label' => esc_html__('Webm video link', MELA_TD),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::TEXT,
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
        ]);
        $this->add_control('rh_vid_ogv', [
            'label' => esc_html__('Ogv video link', MELA_TD),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::TEXT,
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
        ]);
        $this->add_control('rh_vid_poster', [
            'label' => esc_html__('Upload poster', MELA_TD),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
            'label_block'  => true,
        ]);
        $this->add_control(
            'rh_vid_breakpoint',
            array(
                'label'   => esc_html__('Breakpoint', MELA_TD),
                'description' => esc_html__('Video will be replaced by Fallback image after if window width less than this breakpoint', MELA_TD),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 300,
                'max'     => 2500,
                'step'    => 1,
                'default' => 1200,
                'condition' => array(
                    'rh_canvas_type' => 'video',
                ),
            )
        );
        $this->add_responsive_control('rh_vid_fallback', [
            'label' => esc_html__('Upload fallback image', MELA_TD),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
            'label_block'  => true,
        ]);
        $this->add_control(
            'tensionPoints',
            [
                'label' => __('Curve Tension', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
            ]
        );
        $this->add_control(
            'numPoints',
            [
                'label' => __('Num Points', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 5,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => 3,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
            ]
        );
        $this->add_control(
            'minmaxRadius',
            [
                'label' => __('Min Max Radius', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'start' => 140,
                        'end' => 160,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                        'step' => 1,
                    ],
                ],
                'labels' => [
                    __('Min', MELA_TD),
                    __('Max', MELA_TD),
                ],
                'scales' => 0,
                'handles' => 'range',
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
            ]
        );
        $this->add_control(
            'minmaxDuration',
            [
                'label' => __('Min Max Duration', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'start' => 5,
                        'end' => 6,
                    ],
                    'unit' => 's',
                ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'labels' => [
                    __('Min', MELA_TD),
                    __('Max', MELA_TD),
                ],
                'scales' => 0,
                'handles' => 'range',
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
            ]
        );
        $this->add_responsive_control(
            'svgarea_size',
            [
                'label' => __('Svg Size', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rh-svg-blob' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'svg_size',
            [
                'label' => __('Image Size', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'condition' => [
                    'svg_image[id]!' => '',
                    'rh_canvas_type' => 'masksvg',
                ],

            ]
        );
        $this->add_control(
            'svgfilltype',
            [
                'label' => __('Fill with', MELA_TD),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'color' => __('Color', MELA_TD),
                    'image' => __('Image', MELA_TD),
                    'gradient' => __('Gradient', MELA_TD),
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'fill_color',
            [
                'label' => __('Default Color', MELA_TD),
                'type' => Controls_Manager::COLOR,
                'default' => '#FF0000',
                'alpha' => false,
                'condition' => [
                    'svgfilltype' => 'color',
                    'rh_canvas_type' => 'masksvg',
                ],

            ]
        );
        $this->add_control(
            'svg_image',
            [
                'label' => __('Image', MELA_TD),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],

                'show_label' => false,
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'image'
                ],
            ]
        );
        $this->add_control(
            'svgimage_x',
            [
                'label' => __('Translate X', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '0',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                //'render_type' => 'ui',
                'label_block' => false,
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'image'
                ],
            ]
        );
        $this->add_control(
            'svgimage_y',
            [
                'label' => __('Translate Y', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '0',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                //'render_type' => 'ui',
                'label_block' => false,
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'image'
                ],
            ]
        );
        $this->add_control(
            'gradientx1',
            [
                'label' => __('X1 position', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'label_block' => true,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradientx2',
            [
                'label' => __('X2 position', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'label_block' => true,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradienty1',
            [
                'label' => __('Y1 position', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'label_block' => true,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradienty2',
            [
                'label' => __('Y2 position', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'label_block' => true,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradientcolor1',
            [
                'label' => __('Color 1', MELA_TD),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff0000',
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradientcolor2',
            [
                'label' => __('Color 2', MELA_TD),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0000ff',
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );

        $this->add_responsive_control(
            'rhandwidth',
            [
                'label' => __('Area width', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 2500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rh_and_canvas' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'rhandheight',
            [
                'label' => __('Area height', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 2500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rh_and_canvas' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control('rh_vid_mp4', [
            'label' => esc_html__('Mp4 video link', MELA_TD),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::TEXT,
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
        ]);
        $this->add_control('rh_vid_webm', [
            'label' => esc_html__('Webm video link', MELA_TD),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::TEXT,
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
        ]);
        $this->add_control('rh_vid_ogv', [
            'label' => esc_html__('Ogv video link', MELA_TD),
            'label_block'  => true,
            'type' => \Elementor\Controls_Manager::TEXT,
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
        ]);
        $this->add_control('rh_vid_poster', [
            'label' => esc_html__('Upload poster', MELA_TD),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
            'label_block'  => true,
        ]);
        $this->add_control(
            'rh_vid_breakpoint',
            array(
                'label'   => esc_html__('Breakpoint', MELA_TD),
                'description' => esc_html__('Video will be replaced by Fallback image after if window width less than this breakpoint', MELA_TD),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 300,
                'max'     => 2500,
                'step'    => 1,
                'default' => 1200,
                'condition' => array(
                    'rh_canvas_type' => 'video',
                ),
            )
        );
        $this->add_responsive_control('rh_vid_fallback', [
            'label' => esc_html__('Upload fallback image', MELA_TD),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => array(
                'rh_canvas_type' => 'video',
            ),
            'label_block'  => true,
        ]);
        $this->add_control(
            'tensionPoints',
            [
                'label' => __('Curve Tension', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 2,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
            ]
        );
        $this->add_control(
            'numPoints',
            [
                'label' => __('Num Points', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 5,
                ],
                'label_block' => true,
                'range' => [
                    'px' => [
                        'min' => 3,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
            ]
        );
        $this->add_control(
            'minmaxRadius',
            [
                'label' => __('Min Max Radius', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'start' => 140,
                        'end' => 160,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                        'step' => 1,
                    ],
                ],
                'labels' => [
                    __('Min', MELA_TD),
                    __('Max', MELA_TD),
                ],
                'scales' => 0,
                'handles' => 'range',
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
            ]
        );
        $this->add_control(
            'minmaxDuration',
            [
                'label' => __('Min Max Duration', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'start' => 5,
                        'end' => 6,
                    ],
                    'unit' => 's',
                ],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'labels' => [
                    __('Min', MELA_TD),
                    __('Max', MELA_TD),
                ],
                'scales' => 0,
                'handles' => 'range',
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
            ]
        );
        $this->add_responsive_control(
            'svgarea_size',
            [
                'label' => __('Svg Size', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rh-svg-blob' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'svg_size',
            [
                'label' => __('Image Size', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 2000,
                    ],
                ],
                'condition' => [
                    'svg_image[id]!' => '',
                    'rh_canvas_type' => 'masksvg',
                ],

            ]
        );
        $this->add_control(
            'svgfilltype',
            [
                'label' => __('Fill with', MELA_TD),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'color' => __('Color', MELA_TD),
                    'image' => __('Image', MELA_TD),
                    'gradient' => __('Gradient', MELA_TD),
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'fill_color',
            [
                'label' => __('Default Color', MELA_TD),
                'type' => Controls_Manager::COLOR,
                'default' => '#FF0000',
                'alpha' => false,
                'condition' => [
                    'svgfilltype' => 'color',
                    'rh_canvas_type' => 'masksvg',
                ],

            ]
        );
        $this->add_control(
            'svg_image',
            [
                'label' => __('Image', MELA_TD),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],

                'show_label' => false,
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'image'
                ],
            ]
        );
        $this->add_control(
            'svgimage_x',
            [
                'label' => __('Translate X', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '0',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                //'render_type' => 'ui',
                'label_block' => false,
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'image'
                ],
            ]
        );
        $this->add_control(
            'svgimage_y',
            [
                'label' => __('Translate Y', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '0',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                //'render_type' => 'ui',
                'label_block' => false,
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'image'
                ],
            ]
        );
        $this->add_control(
            'gradientx1',
            [
                'label' => __('X1 position', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'label_block' => true,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradientx2',
            [
                'label' => __('X2 position', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'label_block' => true,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradienty1',
            [
                'label' => __('Y1 position', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => '%',
                ],
                'label_block' => true,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradienty2',
            [
                'label' => __('Y2 position', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'label_block' => true,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradientcolor1',
            [
                'label' => __('Color 1', MELA_TD),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff0000',
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );
        $this->add_control(
            'gradientcolor2',
            [
                'label' => __('Color 2', MELA_TD),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0000ff',
                'condition' => [
                    'rh_canvas_type' => 'masksvg',
                    'svgfilltype' => 'gradient'
                ],
            ]
        );

        $this->add_responsive_control(
            'rhandwidth',
            [
                'label' => __('Area width', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 2500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rh_and_canvas' => 'width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'rhandheight',
            [
                'label' => __('Area height', MELA_TD),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '100',
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 2500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rh_and_canvas' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        echo "Morphing Blob";
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new JLTMA_Morphing_Blob());
