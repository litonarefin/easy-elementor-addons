<?php
	namespace Elementor;
	use \Elementor\Widget_Base;
	use \Elementor\Controls_Manager as Controls_Manager;
	use \Elementor\Group_Control_Border as Group_Control_Border;
	use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
	use \Elementor\Group_Control_Typography as Group_Control_Typography;
	use \Elementor\Scheme_Typography as Scheme_Typography;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 6/27/19
	 */


	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Creative_Links extends Widget_Base {

		public function get_name() {
			return 'ma-creative-buttons';
		}

		public function get_title() {
			return esc_html__( 'MA Creative Buttons', MELA_TD );
		}

		public function get_icon() {
			return 'ma-el-icon eicon-button';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

		}
	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Creative_Links() );

