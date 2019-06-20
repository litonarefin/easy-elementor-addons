<?php
namespace Elementor;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Business Hours Widget
 */
class Master_Addons_Business_Hours extends Widget_Base {

    public function get_name() {
        return 'ma-business-hours';
    }
    public function get_title() {
        return esc_html__( 'Business Hours', MELA_TD );
    }

    public function get_categories() {
	    return [ 'master-addons' ];
    }

    public function get_icon() {
	    return 'ma-el-icon eicon-lock-user';
    }

    protected function _register_controls() {}
    protected function render() {
    	echo "Business Hours";
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Business_Hours() );
