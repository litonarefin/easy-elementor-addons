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

    /**
	 * Retrieve business hours widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'ma-business-hours';
    }

    /**
	 * Retrieve business hours widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return esc_html__( 'Business Hours', MELA_TD );
    }

    /**
	 * Retrieve the list of categories the business hours widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
    public function get_categories() {
	    return [ 'master-addons' ];
    }

    /**
	 * Retrieve business hours widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
    public function get_icon() {
	    return 'eicon-person';
    }

    /**
	 * Register business hours widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function _register_controls() {}

    /**
	 * Render business hours widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render() {
    	echo "Business Hours";
    }


}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Business_Hours() );
