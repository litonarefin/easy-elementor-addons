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
	 * Date: 8/28/19
	 */

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

	class Master_Addons_Image_Hover_Effects extends Widget_Base {

		public function get_name() {
			return 'ma-image-hover-effects';
		}

		public function get_title() {
			return esc_html__( 'MA Image Hover Effects', MELA_TD );
		}

		public function get_icon() {
			return 'ma-el-icon eicon-image-rollover';
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		protected function _register_controls() {

			/*
			* Image Hover Effects Section Start
			*/

			$this->start_controls_section(
				'image-hover-effect-section',
				[
					'label' => __( 'Image Section', MELA_TD ),
				]
			);


			$this->add_control('ma_el_main_image',
				[
					'label'			=> __( 'Upload Image', MELA_TD ),
					'description'	=> __( 'Select an Image', MELA_TD ),
					'type'			=> Controls_Manager::MEDIA,
					'dynamic'       => [ 'active' => true ],
					'default'		=> [
						'url'	=> Utils::get_placeholder_image_src()
					],
					'show_external'	=> true
				]
			);

			$this->add_control('ma_el_image_link_url_switch',
				[
					'label'         => __('Image Link?', MELA_TD),
					'type'          => Controls_Manager::SWITCHER
				]
			);

			$this->add_control('ma_el_main_image_link_switcher',
				[
					'label'			=> __( 'Custom Link', MELA_TD ),
					'type'			=> Controls_Manager::SWITCHER,
					'description'	=> __( 'Add a custom link to the Image', MELA_TD ),
					'condition'     => [
						'ma_el_image_link_url_switch'    => 'yes',
					],
				]
			);

			$this->add_control('ma_el_main_image_custom_link',
				[
					'label'			=> __( 'Set Custom Link', MELA_TD ),
					'type'			=> Controls_Manager::URL,
					'dynamic'       => [ 'active' => true ],
					'description'	=> __( 'What custom link you want to set to Image?', MELA_TD ),
					'condition'		=> [
						'ma_el_main_image_link_switcher' => 'yes',
						'ma_el_image_link_url_switch'    => 'yes'
					],
					'show_external' => false
				]
			);


			$this->add_control('ma_el_main_image_existing_page_link',
				[
					'label'			=> __( 'Select a Page', MELA_TD ),
					'type'			=> Controls_Manager::SELECT2,
					'condition'		=> [
						'ma_el_main_image_link_switcher!' => 'yes',
						'ma_el_image_link_url_switch'    => 'yes'
					],
					'multiple'      => false,
					'options'		=> Master_Addons_Helper::ma_get_page_templates()
				]
			);

			$this->add_control('ma_el_main_image_link_title',
				[
					'label'			=> __( 'Link Title', MELA_TD ),
					'type'			=> Controls_Manager::TEXT,
					'dynamic'       => [ 'active' => true ],
					'condition'     => [
						'ma_el_image_link_url_switch'    => 'yes'
					]
				]
			);

			$this->add_control(
				'creative_link_url',
				[
					'label'       => esc_html__( 'Link URL', MELA_TD ),
					'type'        => Controls_Manager::URL,
					'label_block' => true,
					'default'     => [
						'url'         => '#',
						'is_external' => '',
					],
					'show_external' => true,
				]
			);



			$this->end_controls_section();


		}


		protected function render() {

		}

		protected function _content_template() {}

	}

Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Image_Hover_Effects() );