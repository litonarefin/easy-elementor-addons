<?php
namespace Elementor;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Box_Shadow;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 02/05/2020
 */

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Master_Addons_Twitter_Slider extends Widget_Base {

    private $_query = null;

	public function get_name() {
		return 'jltma-twitter-slider';
	}

	public function get_title() {
		return esc_html__( 'Twitter Slider', MELA_TD );
	}

	public function get_icon() {
		return 'ma-el-icon eicon-twitter-feed';
	}

	public function get_categories() {
		return [ 'master-addons' ];
	}

    public function get_style_depends() {
        return [
            'font-awesome-5-all',
            'font-awesome-4-shim'
        ];
    }

    public function get_script_depends() {
        return [ 'jquery-slick', 'master-addons-scripts' ];
    }

    public function get_help_url(){
        return 'https://master-addons.com/demos/logo-slider/';
    }

    public function on_import( $element ) {
        if ( ! get_post_type_object( $element['settings']['posts_post_type'] ) ) {
            $element['settings']['posts_post_type'] = 'post';
        }
        return $element;
    }

    public function get_query() {
        return $this->_query;
    }

    public function on_export( $element ) {
        $element = Group_Control_Posts::on_export_remove_setting_from_element( $element, 'posts' );
        return $element;
    }

	protected function _register_controls() {

        /*
        * Content: Layout
        */
        $this->start_controls_section(
            'jltma_ts_section_layout',
            [
                'label' => esc_html__( 'Layout', MELA_TD ),
            ]
        );


        $this->add_responsive_control(
            'jltma_ts_columns',
            [
                'label'          => esc_html__( 'Columns', MELA_TD ),
                'type'           => Controls_Manager::SELECT,
                'default'        => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options'        => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ]
        );
        
        $this->add_control(
            'jltma_ts_tweet_num',
            [
                'label'   => esc_html__( 'Limit', MELA_TD ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'jltma_ts_cache_time',
            [
                'label'   => esc_html__( 'Cache Time(m)', MELA_TD ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 60,
            ]
        );

        $this->add_control(
            'jltma_ts_show_avatar',
            [
                'label'   => esc_html__( 'Show Avatar', MELA_TD ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'jltma_ts_avatar_link',
            [
                'label'     => esc_html__( 'Avatar Link', MELA_TD ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'jltma_ts_show_avatar' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'jltma_ts_show_time',
            [
                'label'   => esc_html__( 'Show Time', MELA_TD ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'jltma_ts_long_time_format',
            [
                'label'     => esc_html__( 'Long Time Format', MELA_TD ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'jltma_ts_show_time' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'jltma_ts_show_meta_button',
            [
                'label' => esc_html__( 'Execute Buttons', MELA_TD ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'jltma_ts_exclude_replies',
            [
                'label' => esc_html__( 'Exclude Replies', MELA_TD ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();



        /*
        * Content: Layout
        */
        $this->start_controls_section(
            'jltma_ts_section_navigation',
            [
                'label' => esc_html__( 'Navigation', MELA_TD ),
            ]
        );

        $this->add_control(
            'jltma_ts_navigation',
            [
                'label'   => esc_html__( 'Navigation', MELA_TD ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
                    'both'   => esc_html__( 'Arrows and Dots', MELA_TD ),
                    'arrows' => esc_html__( 'Arrows', MELA_TD ),
                    'dots'   => esc_html__( 'Dots', MELA_TD ),
                    'none'   => esc_html__( 'None', MELA_TD ),
                ],
                'prefix_class' => 'bdt-navigation-type-',
                'render_type'  => 'template',               
            ]
        );
        
        $this->add_control(
            'jltma_ts_both_position',
            [
                'label'     => esc_html__( 'Arrows and Dots Position', MELA_TD ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                'condition' => [
                    'jltma_ts_navigation' => 'both',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_arrows_position',
            [
                'label'     => esc_html__( 'Arrows Position', MELA_TD ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => Master_Addons_Helper::jltma_carousel_navigation_position(),
                'condition' => [
                    'jltma_ts_navigation' => 'arrows',
                ],              
            ]
        );

        $this->add_control(
            'jltma_ts_dots_position',
            [
                'label'     => esc_html__( 'Dots Position', MELA_TD ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'bottom-center',
                'options'   => Master_Addons_Helper::jltma_carousel_pagination_position(),
                'condition' => [
                    'jltma_ts_navigation' => 'dots',
                ],              
            ]
        );

        $this->end_controls_section();


        /*
        * Content: Slider Setting
        */

        $this->start_controls_section(
            'jltma_ts_section_slider_settins',
            [
                'label' => esc_html__( 'Slider Settings', MELA_TD ),
            ]
        );


        $this->add_control(
            'jltma_ts_autoplay',
            [
                'label'   => esc_html__( 'Auto Play', MELA_TD ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'jltma_ts_autoplay_speed',
            [
                'label'     => esc_html__( 'Autoplay Speed', MELA_TD ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'jltma_ts_autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_pauseonhover',
            [
                'label' => esc_html__( 'Pause on Hover', MELA_TD ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'jltma_ts_speed',
            [
                'label'   => __( 'Animation Speed (ms)', MELA_TD ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 500,
                ],
                'range' => [
                    'min'  => 100,
                    'max'  => 5000,
                    'step' => 50,
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_loop',
            [
                'label'   => esc_html__( 'Loop', MELA_TD ),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'jltma_ts_transition',
            [
                'label'   => esc_html__( 'Transition', MELA_TD ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide'     => esc_html__( 'Slide', MELA_TD ),
                    'fade'      => esc_html__( 'Fade', MELA_TD ),
                    'cube'      => esc_html__( 'Cube', MELA_TD ),
                    'coverflow' => esc_html__( 'Coverflow', MELA_TD ),
                    'flip'      => esc_html__( 'Flip', MELA_TD ),
                ],
            ]
        );        
        $this->end_controls_section();




        /*
        * STYLE: Items
        */

        $this->start_controls_section(
            'jltma_ts_section_style_layout',
            [
                'label' => __( 'Items', MELA_TD ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'jltma_ts_item_color',
            [
                'label'     => __( 'Color', MELA_TD ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-carousel-item .bdt-twitter-text,
                    {{WRAPPER}} .bdt-twitter-slider .bdt-carousel-item .bdt-twitter-text *' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'jltma_ts_alignment',
            [
                'label'   => __( 'Alignment', MELA_TD ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', MELA_TD ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', MELA_TD ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', MELA_TD ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-twitter-slider .bdt-carousel-item .bdt-card-body' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*
        * STYLE: Items
        */

        /*
        * STYLE: Slider Setting
        */

	}

	protected function render() {

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Twitter_Slider() );