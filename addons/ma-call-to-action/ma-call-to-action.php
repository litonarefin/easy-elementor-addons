<?php
	namespace Elementor;

	use Elementor\Widget_Base;

	/**
	 * Author Name: Liton Arefin
	 * Author URL: https://jeweltheme.com
	 * Date: 6/25/19
	 */

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Call_To_Action extends Widget_Base {

		public function get_name() {
			return 'ma-call-to-action';
		}

		public function get_title() {
			return esc_html__( 'MA Call to Action', MELA_TD);
		}

		public function get_icon() {
			return 'ma-el-icon eicon-call-to-action';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

		}

		protected function render() {
			$settings = $this->get_settings_for_display();
			?>

			<section class="section-content alice-green-bg">
                <div class="container">

                        <div class="content">
                            <div class="action-content">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h3>

                                        </h3>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <a href="#" class="btn">
											Purchase Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
			</section>
	        <?php
		}
	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Call_To_Action() );