<?php
	namespace Elementor;
	use Elementor\Widget_Base;

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Widget_Team_Member extends Widget_Base {

		public function get_name() {
			return 'master-team-members';
		}

		public function get_title() {
			return esc_html__( 'Team Member', 'master-elementor-addons' );
		}

		public function get_icon() {
			return 'eicon-person';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}


		protected function _register_controls() {

		}

		// render image function
		private function render_image( $item, $settings ) {
		}

		protected function render() {
			echo "Rendered";
		}
	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Widget_Team_Member() );