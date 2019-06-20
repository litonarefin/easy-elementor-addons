<?php
	namespace Elementor;

// Elementor Classes
	use Elementor\Controls_Manager;
	use Elementor\Utils;
	use Elementor\Group_Control_Background;
	use Elementor\Group_Control_Box_Shadow;
	use Elementor\Group_Control_Border;
	use Elementor\Group_Control_Typography;
	use Elementor\Scheme_Typography;
	use Elementor\Scheme_Color;
//	use Elementor\Modules\DynamicTags\Module as TagsModule;


// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) { exit; }

	/**
	 * Business Hours Widget
	 */
	class Master_Addons_Ninja_Forms extends Widget_Base {

		public function get_name() {
			return 'ma-el-ninja-forms';
		}
		public function get_title() {
			return esc_html__( 'Ninja Forms', MELA_TD );
		}

		public function get_categories() {
			return [ 'master-addons' ];
		}

		public function get_icon() {
			return 'ma-el-icon eicon-lock-user';
		}

		protected function _register_controls() {
		    /*
		     * Master Addons: Ninja Forms
		     */
			$this->start_controls_section(
				'section_info_box',
				[
					'label'                 => esc_html__( 'Ninja Forms', MELA_TD ),
				]
			);

			$this->add_control(
				'contact_form_list',
				[
					'label'                 => esc_html__( 'Contact Form', MELA_TD ),
					'type'                  => Controls_Manager::SELECT,
					'label_block'       	=> true,
					'options'           	=> pp_elements_lite_get_ninja_forms(),
					'default'               => '0',
				]
			);

			$this->add_control(
				'custom_title_description',
				[
					'label'                 => esc_html__( 'Title & Description?', MELA_TD ),
					'type'                  => Controls_Manager::SWITCHER,
					'label_on'              => esc_html__( 'Yes', MELA_TD ),
					'label_off'             => esc_html__( 'No', MELA_TD ),
					'return_value'          => 'yes',
				]
			);


			$this->add_control(
				'form_title',
				[
					'label'                 => __( 'Title', MELA_TD ),
					'type'                  => Controls_Manager::SWITCHER,
					'default'               => 'yes',
					'label_on'              => __( 'Show', MELA_TD ),
					'label_off'             => __( 'Hide', MELA_TD ),
					'return_value'          => 'yes',
					'prefix_class'          => 'pp-ninja-form-title-',
					'condition'             => [
						'custom_title_description!'   => 'yes',
					],
				]
			);

			$this->add_control(
				'form_title_custom',
				[
					'label'                 => esc_html__( 'Title', MELA_TD ),
					'type'                  => Controls_Manager::TEXT,
					'label_block'           => true,
					'default'               => '',
					'condition'             => [
						'custom_title_description'   => 'yes',
					],
				]
			);


			$this->add_control(
				'form_description_custom',
				[
					'label'                 => esc_html__( 'Description', MELA_TD ),
					'type'                  => Controls_Manager::TEXTAREA,
					'default'               => '',
					'condition'             => [
						'custom_title_description'   => 'yes',
					],
				]
			);

			$this->add_control(
				'labels_switch',
				[
					'label'                 => __( 'Labels', MELA_TD ),
					'type'                  => Controls_Manager::SWITCHER,
					'default'               => 'yes',
					'label_on'              => __( 'Show', MELA_TD ),
					'label_off'             => __( 'Hide', MELA_TD ),
					'return_value'          => 'yes',
					'prefix_class'          => 'pp-ninja-form-labels-',
				]
			);

			$this->add_control(
				'placeholder_switch',
				[
					'label'                 => __( 'Placeholder', MELA_TD ),
					'type'                  => Controls_Manager::SWITCHER,
					'default'               => 'yes',
					'label_on'              => __( 'Show', MELA_TD ),
					'label_off'             => __( 'Hide', MELA_TD ),
					'return_value'          => 'yes',
				]
			);

			$this->end_controls_section();





		}


	}

	Plugin::instance()->widgets_manager->register_widget_type( new Master_Addons_Ninja_Forms() );
