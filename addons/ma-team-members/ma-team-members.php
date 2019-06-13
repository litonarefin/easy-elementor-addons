<?php
	namespace Elementor;
	use Elementor\Widget_Base;

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Team_Members extends Widget_Base {

		public function get_name() {
			return 'ma-team-members';
		}

		public function get_title() {
			return esc_html__( 'Team Member', MELA_TD);
		}

		public function get_icon() {
			return 'eicon-person';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}


		protected function _register_controls() {

		}


		protected function render() {
			echo "Rendered";
		}
	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Team_Members() );