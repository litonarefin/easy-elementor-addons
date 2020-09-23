<?php
namespace Elementor;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;    

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
            'jltma_ts_layout',
            [
                'label' => esc_html__( 'Layout', MELA_TD ),
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
                'options'   => element_pack_navigation_position(),
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
                'options'   => element_pack_navigation_position(),
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
                'options'   => element_pack_pagination_position(),
                'condition' => [
                    'jltma_ts_navigation' => 'dots',
                ],              
            ]
        );

        $this->end_controls_section();


        /*
        * Content: Layout
        */

	}

	protected function render() {

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Twitter_Slider() );